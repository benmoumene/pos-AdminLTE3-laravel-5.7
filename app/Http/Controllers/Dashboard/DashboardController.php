<?php

namespace App\Http\Controllers\Dashboard;

use App\Sale;
use App\User;
use App\Product;
use App\Category;
use App\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $moderator = User::all();
        $categories = Category::all();
        $products = Product::all();
        // Sale for every today
        $today = Carbon::today();
        $salesproducts = Sale::whereDate('updated_at','=',$today)->get(); 
        
        dd($salesproducts);

        
        return view('dashboard.index', compact('moderator', 'categories', 'products', 'sumprofit','salesproducts'));
    }
    public function pos()
    {
        $moderator = User::all();
        $categories = Category::all();
        $products = Product::all();
        return view('dashboard.pos.index', compact('moderator', 'categories', 'products'));
    }
    
}