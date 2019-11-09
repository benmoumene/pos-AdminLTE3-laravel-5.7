<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        //its just a dummy data object.
        $general_settings = DB::table('general_settings')->where('id', 1)->get();
        foreach ($general_settings as $key => $general_setting) {
            $store_id = $general_setting->id;
            $store_name = $general_setting->store_name;
            $activity = $general_setting->activity;
            $phone = $general_setting->phone;
            $address = $general_setting->address;
            $start_day = $general_setting->start_day;
            $logo = $general_setting->image;
            $investment_capital = $general_setting->investment_capital;
            $rc = $general_setting->rc;
            $article = $general_setting->article;
            $nif = $general_setting->nif;
            $nis = $general_setting->rc;
        }
        // Sharing is caring
        View::share('store_id', $store_id);
        View::share('store_name', $store_name);
        View::share('activity', $activity);
        View::share('phone', $phone);
        View::share('address', $address);
        View::share('start_day', $start_day);
        View::share('logo', $logo);
        View::share('investment_capital', $investment_capital);
        View::share('rc', $rc);
        View::share('article', $article);
        View::share('nif', $nif);
        View::share('nis', $nis);
    }
}