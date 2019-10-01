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
        //$lastsaleId = sale::all()->last()->number_sale;

        //$sale_number = 'SN' . date('Ymd') . '0001';
        if (Purchase::all()->last() == null) {
            $purchase_number = 'PN' . date('Ymd') . '0001';
        } else {
            $lastsaleId = Purchase::all()->last()->number_purchase;
            $lastIncreament = substr($lastsaleId, -4);
            $purchase_number = 'PN' . date('Ymd') . str_pad($lastIncreament + 1, 4, 0, STR_PAD_LEFT);
        }

        return view('dashboard.purchase.create', compact('purchase_number', 'providers', 'categories', 'products'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $providers = Provider::all();
        $categories = Category::all();
        $products = Product::all();
        return view('dashboard.purchase.edit', compact('purchase', 'providers', 'categories', 'products'));
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
        //
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
        // ToDo later destroy by soft-Delete
    }
}