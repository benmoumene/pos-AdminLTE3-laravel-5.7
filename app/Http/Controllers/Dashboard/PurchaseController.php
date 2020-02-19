<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use App\Category;
use App\Provider;
use App\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $providers = Provider::all();
        $categories = Category::all();
        $products = Product::all();
        $purchases = Purchase::all();
        return view('dashboard.purchase.index', compact('purchases', 'providers', 'categories', 'products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::all();
        $categories = Category::all();
        $products = Product::all();
        $purchases = Purchase::all();

        if (Purchase::all()->last() == null) {
            $purchase_number = 'PN' . ' : ' . '1' . ' / ' . date('Y');
        } else {
            $lastpurchaseNumber = Purchase::all()->last()->number_purchase;
            $lastNumber = substr($lastpurchaseNumber, 5 ,-7);
            $purchase_number = 'PN' . ' : ' . str_pad($lastNumber + 1, 0, 0, STR_PAD_LEFT). ' / ' . date('Y');
        }
         // generate barcode code 128 number
        if (Product::all()->last() == null) {
            $barcode_number = '000000000001';
        } else {
            $lastsaleId = Product::all()->count();
            $lastIncreament = substr($lastsaleId, -12);
            $barcode_number = str_pad($lastIncreament + 1, 12, '0', STR_PAD_LEFT);
        }

        return view('dashboard.purchase.create', compact('purchase_number', 'barcode_number', 'providers', 'categories', 'products'));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'number_purchase' => 'required',
            'total' => 'required',
            'discount' => 'required',
            'total_amount' => 'required',
            'paid' => 'required',
            'credit' => 'required',
            'status' => 'required',
            'provider_id' => 'required',
            'product' => 'required',
            'quantity' => 'required',
        ]);
        $data = $request->all();

        $purchase = Purchase::create([
            'number_purchase' => $data['number_purchase'],
            'total' => $data['total'],
            'discount' => $data['discount'],
            'total_amount' => $data['total_amount'],
            'paid' => $data['paid'],
            'due' => $data['credit'],
            'status' => $data['status'],
            'provider_id' => $data['provider_id'],

        ]);
        $dat = $data['product'];
        $qty = $request->get('quantity');
        //attach sale with there products and quantities
        $attach_data = [];
        for ($i = 0; $i < count($dat); $i++) {
            $attach_data[$dat[$i]] = ['quantity' => $qty[$i]];
        }
        $purchase->products()->attach($attach_data);
        //check products stock and substract quntities that is sale
        for ($i = 0; $i < count($dat); $i++) {
            $product = Product::find($dat[$i]);
            $product->stock = $product->stock + ($qty[$i]);
            $product->save();
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        $product_purchases = $purchase->products;
        $provider_purchases = $purchase->provider;
        // foreach ($product_sales as $key => $product_sale) {
        //     dd($product_sale->quantity);
        // }
        $purchases = Purchase::findorfail($purchase)->first();
        //dd($sale);
        $i = 0;


        return view('dashboard.purchase.showtwo', compact('product_purchases', 'provider_purchases', 'purchase', 'i'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $providersel = $purchase->provider;
        $providers = Provider::all();
        $categories = Category::all();
        $products = Product::all();
        return view('dashboard.purchase.edit', compact('purchase', 'providersel', 'providers', 'categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'number_purchase' => 'required',
            'total' => 'required',
            'discount' => 'required',
            'total_amount' => 'required',
            'paid' => 'required',
            'credit' => 'required',
            'status' => 'required',
            'provider_id' => 'required',
            'product' => 'required',
            'quantity' => 'required',
        ]);

        foreach ($purchase->products as $key => $product) {
            $product->update([
                'stock' => $product->stock - $product->pivot->quantity
            ]);
        }
        $purchase->delete();

        $data = $request->all();

        $purchase_update = Purchase::create([
            'number_purchase' => $data['number_purchase'],
            'total' => $data['total'],
            'discount' => $data['discount'],
            'total_amount' => $data['total_amount'],
            'paid' => $data['paid'],
            'due' => $data['credit'],
            'status' => $data['status'],
            'provider_id' => $data['provider_id'],

        ]);
        $dat = $data['product'];
        $qty = $request->get('quantity');
        //attach sale with there products and quantities
        $attach_data = [];
        for ($i = 0; $i < count($dat); $i++) {
            $attach_data[$dat[$i]] = ['quantity' => $qty[$i]];
        }
        $purchase_update->products()->attach($attach_data);
        //check products stock and substract quntities that is sale
        for ($i = 0; $i < count($dat); $i++) {
            $product = Product::find($dat[$i]);
            $product->stock = $product->stock + ($qty[$i]);
            $product->save();
        }
        return redirect()->route('purchase.index');
    }
    // Payment of credit function
    public function paymentduep(Request $request, $id)
    {

        $credits = Purchase::find($id);
        $paid = $request->input('paid');
        $due = $request->input('credit');
        $pdue = $request->input('paidcredit');
        if ($pdue == $due) {
            $credits->due =  $due -  $pdue;
            $credits->paid = $paid + $pdue;
            $credits->status = "paid";
        } elseif ($pdue < $due) {
            $credits->due =  $due -  $pdue;
            $credits->paid = $paid + $pdue;
            $credits->status = "debt";
        }
        $credits->save();
    }


    public function destroy(Purchase $purchase)
    {
        foreach ($purchase->products as $key => $product) {
            $product->update([
                'stock' => $product->stock - $product->pivot->quantity
            ]);
        }
        $purchase->delete();
        toast('Purchase deleted Successfully', 'error', 'top-right');
        return redirect()->back();
    }
}
