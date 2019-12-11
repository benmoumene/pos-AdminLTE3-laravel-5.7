<?php

namespace App\Http\Controllers\Dashboard;

use App\Sale;
use App\User;
use App\Product;
use App\Category;
use App\Purchase;
use App\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\MoneyBox;
use App\Spending;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $moderator = User::all();
        $categories = Category::all();
        $products = Product::all();
        //$sumprofit = collect($products)->sum('purchase_price', '-', 'sale_price');
        $sales = Sale::all();
        $purchases = Purchase::all();
        $spendmoneys = Spending::all();
        $totalspendmoneys = collect($spendmoneys)->sum('spending_price');
        //$moneybox = MoneyBox::all();
        $today = Carbon::today();
        // Count number of Sale today
        $sales_today = Sale::whereDate('created_at', '=', $today);
        // Count number of Purchase today
        $purchases_today = Purchase::whereDate('created_at', '=', $today);
        //dd($sales_today);
        // foreach ($salesproducts as $key => $salesproduct) {
        //     $product_sales = $salesproduct->products;
        //     $sp_quantity = $salesproduct->pivot->quantity;
        //     dd($sp_quantity);
        // }
        // Best product that sale
        $topsales = DB::table('product_sale')
            ->leftJoin('products', 'products.id', '=', 'product_sale.product_id')
            ->select(
                'products.id',
                'products.product_name',
                'product_sale.product_id',
                DB::raw('SUM(product_sale.quantity) as total')
            )
            ->groupBy('products.id', 'product_sale.product_id', 'products.product_name')
            ->orderBy('total', 'desc')
            ->limit(6)
            ->get();

        // Best product that purchase
        $toppurchases = DB::table('product_purchase')
            ->leftJoin('products', 'products.id', '=', 'product_purchase.product_id')
            ->select(
                'products.id',
                'products.product_name',
                'product_purchase.product_id',
                DB::raw('SUM(product_purchase.quantity) as total')
            )
            ->groupBy('products.id', 'product_purchase.product_id', 'products.product_name')
            ->orderBy('total', 'desc')
            ->limit(6)
            ->get();
        //dd($salesproducts);

        $sale_profit = DB::table('product_sale')
            ->leftJoin('products', 'products.id', '=', 'product_sale.product_id')
            ->select(
                'products.id',
                'products.product_name',
                'products.sale_price',
                'products.purchase_price',
                'products.created_at',
                'product_sale.product_id',
                DB::raw('SUM(products.sale_price - products.purchase_price) as total')
            )
            ->groupBy('products.id', 'product_sale.product_id', 'products.product_name', 'products.created_at')
            ->orderBy('total', 'desc')
            ->whereDate('created_at', '=', $today)->get();
        $sumprofit = $sale_profit->sum('total');

        //dd($sale_profit);
        // Product with min stock
        $stock_alerts = DB::table('products')->where('stock', '<=', 'min_stock')->paginate(3, ['*'], 'stockalert');

        //dd($stock_alerts);
        return view(
            'dashboard.index',
            compact(
                'moderator',
                'categories',
                'products',
                'sumprofit',
                'topsales',
                'toppurchases',
                'stock_alerts',
                'sales',
                'sales_today',
                'purchases',
                'purchases_today',
                'totalspendmoneys'
            )
        );
    }
    public function pos()
    {
        $moderator = User::all();
        $categories = Category::all();
        $products = Product::all();
        return view('dashboard.pos.index', compact('moderator', 'categories', 'products'));
    }
}