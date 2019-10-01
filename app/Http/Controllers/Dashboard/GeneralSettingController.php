<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use App\GeneralSetting;
use Milon\Barcode\DNS1D;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GeneralSetting $generalSetting)
    {
        $products = Product::all();

        return view('dashboard.settings.index', compact('products'));
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
            'store_name' => 'required',
            'start_day' => 'required',
            'image' => 'image',
            'investment_capital' => 'required',
        ]);
        $id = $request->input('id');
        $general_setting = GeneralSetting::findOrFail($id);
        $request_data = $request->all();
        if ($request->image) {
            if ($general_setting->image != 'logo_default.png') {
                Storage::disk('public_uploads')->delete(
                    '/settings/' . $general_setting->image
                );
            }
            Image::make($request->image)
                ->resize(160, 160, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(
                    public_path(
                        'uploads/settings/' . $request->image->hashName()
                    )
                );
            $request_data['image'] = $request->image->hashName();
        }
        $general_setting->update($request_data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function show(GeneralSetting $generalSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(GeneralSetting $generalSetting)
    {
        //


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GeneralSetting $generalSetting)
    {
        //
    }

    public function updatesetting(Request $request)
    { }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeneralSetting $generalSetting)
    {
        //
    }
}
