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
        //sum of due of Sale today
        $sale_due_today = Sale::whereDate('created_at', '=', $today)->sum('due');
        //sum of spending in day
        $spending_today = Spending::whereDate('created_at', '=', $today)->sum('spending_price');


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
            ->leftJoin('sales', 'sales.id', '=', 'product_sale.sale_id')
            ->select(
                'sales.id',
                'products.product_name',
                'products.sale_price',
                'products.purchase_price',
                'product_sale.product_id',
                'product_sale.quantity as qty',
                'sales.created_at',
                //DB::raw('SUM(products.sale_price - products.purchase_price) as profit'),
                DB::raw('SUM(products.sale_price - products.purchase_price) * product_sale.quantity as profits'),
                DB::raw('DATE(sales.created_at) as date')

            )
            ->groupBy('sales.id', 'product_sale.product_id', 'products.product_name', 'sales.created_at', 'date', 'qty')
            ->orderBy('date')
            ->whereDate('sales.created_at', '=', $today)
            ->get();
        //dd($sale_profit);

        $sumprofit = $sale_profit->sum('profits') - $sale_due_today - $spending_today;
        //dd($sumprofit);

        //dd($sumprofit);
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