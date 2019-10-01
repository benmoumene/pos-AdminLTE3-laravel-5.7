<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use App\Product;
use App\Category;
use App\GeneralSetting;
use Illuminate\Http\Request;
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

        return view('dashboard.index', compact('moderator', 'categories', 'products', 'sumprofit'));
    }
    public function pos()
    {
        $moderator = User::all();
        $categories = Category::all();
        $products = Product::all();
        return view('dashboard.pos.index', compact('moderator', 'categories', 'products'));
    }
}