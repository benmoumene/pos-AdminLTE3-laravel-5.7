<?php

namespace App\Http\Controllers\Dashboard;

use App\Sale;
use App\Client;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        $categories = Category::all();
        $products = Product::all();
        $sales = Sale::all();
        return view('dashboard.sale.index', compact('sales', 'clients', 'categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $categories = Category::all();
        $products = Product::all();
        $sales = Sale::all();
        //$lastsaleId = sale::all()->last()->number_sale;

        //$sale_number = 'SN' . date('Ymd') . '0001';
        if (sale::all()->last() == null) {
            $sale_number = 'SN' . date('Ymd') . '0001';
        } else {
            $lastsaleId = sale::all()->last()->number_sale;
            $lastIncreament = substr($lastsaleId, -4);
            $sale_number = 'SN' . date('Ymd') . str_pad($lastIncreament + 1, 4, 0, STR_PAD_LEFT);
        }

        return view('dashboard.sale.create', compact('sale_number', 'clients', 'categories', 'products'));
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
            'number_sale' => 'required',
            'total' => 'required',
            'discount' => 'required',
            'total_amount' => 'required',
            'paid' => 'required',
            'credit' => 'required',
            'status' => 'required',
            'client_id' => 'required',
            'product' => 'required',
            'quantity' => 'required',
        ]);
        $data = $request->all();

        $sale = Sale::create([
            'number_sale' => $data['number_sale'],
            'total' => $data['total'],
            'discount' => $data['discount'],
            'total_amount' => $data['total_amount'],
            'paid' => $data['paid'],
            'due' => $data['credit'],
            'status' => $data['status'],
            'client_id' => $data['client_id'],

        ]);
        $dat = $data['product'];
        $qty = $request->get('quantity');
        //attach sale with there products and quantities
        $attach_data = [];
        for ($i = 0; $i < count($dat); $i++) {
            $attach_data[$dat[$i]] = ['quantity' => $qty[$i]];
        }
        $sale->products()->attach($attach_data);
        //check products stock and substract quntities that is sale
        for ($i = 0; $i < count($dat); $i++) {
            $product = Product::find($dat[$i]);
            if ($product->stock == 0) {
                toast('this product stock is empty', 'error', 'top-right');
            } else {
                $product->stock = $product->stock - ($qty[$i]);
                $product->save();
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $product_sales = $sale->products;
        $client_sales = $sale->client;
        // foreach ($product_sales as $key => $product_sale) {
        //     dd($product_sale->quantity);
        // }
        $sales = Sale::findorfail($sale)->first();
        //dd($sale);
        $i = 0;


        return view('dashboard.sale.showtwo', compact('product_sales', 'client_sales', 'sale', 'i'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $clientsel = $sale->client;
        $clients = Client::all();
        $categories = Category::all();
        $products = Product::all();
        return view('dashboard.sale.edit', compact('sale', 'clientsel', 'clients', 'categories', 'products'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'number_sale' => 'required',
            'total' => 'required',
            'discount' => 'required',
            'total_amount' => 'required',
            'paid' => 'required',
            'credit' => 'required',
            'status' => 'required',
            'client_id' => 'required',
            'product' => 'required',
            'quantity' => 'required',
        ]);

        foreach ($sale->products as $key => $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $sale->delete();

        $data = $request->all();

        $sale_update = Sale::create([
            'number_sale' => $data['number_sale'],
            'total' => $data['total'],
            'discount' => $data['discount'],
            'total_amount' => $data['total_amount'],
            'paid' => $data['paid'],
            'due' => $data['credit'],
            'status' => $data['status'],
            'client_id' => $data['client_id'],

        ]);
        $dat = $data['product'];
        $qty = $request->get('quantity');
        //attach sale with there products and quantities
        $attach_data = [];
        for ($i = 0; $i < count($dat); $i++) {
            $attach_data[$dat[$i]] = ['quantity' => $qty[$i]];
        }
        //dd($sale->products());

        $sale_update->products()->attach($attach_data);
        //check products stock and substract quntities that is sale
        for ($i = 0; $i < count($dat); $i++) {
            $product = Product::find($dat[$i]);
            if ($product->stock == 0) {
                toast('this product stock is empty', 'error', 'top-right');
            } else {
                $product->stock = $product->stock - ($qty[$i]);
                $product->save();
            }
        }
        return redirect()->route('sale.index');
    }

    // Payment of credit function
    public function paymentdue(Request $request, $id)
    {
        $credits = Sale::find($id);
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        foreach ($sale->products as $key => $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $sale->delete();
        toast('Sale deleted Successfully', 'error', 'top-right');
        return redirect()->back();
    }
}