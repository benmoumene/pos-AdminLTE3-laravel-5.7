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
        // $salesproducts = Sale::whereDate('updated_at','=',$today)->get();
        // foreach ($salesproducts as $key => $salesproduct) {
        //     $product_sales = $salesproduct->products;
        //     $sp_quantity = $salesproduct->pivot->quantity;
        //     dd($sp_quantity);
        // }
        // Best product that sale
$salesproducts= Product::join('product_sale', 'products.id','=','product_sale.product_id')
           ->selectRaw('products.*, SUM(product_sale.quantity) AS qty')
           ->groupBy('products.id')
           ->orderBy('qty', 'desc')
           ->get();
        //dd($salesproducts);
        // Product with min stock
        $stock_alerts = DB::table('products')->where('stock','<=','min_stock')->get();

        //dd($stock_alerts);
        return view('dashboard.index', compact('moderator', 'categories', 'products', 'sumprofit','salesproducts','stock_alerts'));
    }
    public function pos()
    {
        $moderator = User::all();
        $categories = Category::all();
        $products = Product::all();
        return view('dashboard.pos.index', compact('moderator', 'categories', 'products'));
    }
    
}