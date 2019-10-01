<?php

namespace App\Http\Controllers\Dashboard;

use App\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewProviderController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'provider_name' => 'required',
            'phone' => 'required',
            'address' => 'required',

        ]);
        Provider::create($request->all());
        toast('Provider created Successfully', 'success', 'top-right');
    }
}