<?php

namespace App\Http\Controllers\Dashboard;

use App\Spending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SpendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spendings = Spending::all();
        // somme of column spending price in table spendings
        $totalspendings = collect($spendings)->sum('spending_price');
        return view('dashboard.spending.index', compact('spendings', 'totalspendings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'spending_name' => 'required',
            'spending_description' => 'required',
            'spending_price' => 'required',

        ]);
        Spending::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function show(Spending $spending)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function edit(Spending $spending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spending  $spending
     * @return \Illuminate\Http\Response
     */


    public function updatespend(Request $request, $id)
    {

        $request->validate([
            'spending_name' => 'required',
            'spending_description' => 'required',
            'spending_price' => 'required',

        ]);

        $spending = Spending::findOrFail($id);
        $spending->spending_name = $request->input('spending_name');
        $spending->spending_description = $request->input('spending_description');
        $spending->spending_price = $request->input('spending_price');

        $spending->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spending $spending)
    {
        $spending->delete();
        return redirect()->back();
    }
}