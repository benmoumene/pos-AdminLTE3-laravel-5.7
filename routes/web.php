<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'Dashboard\DashboardController@index')->name(
        'dashboard'
    );

    Route::resource('/moderator', 'Dashboard\ModeratorController')->except([
        'show'
    ]);
    Route::resource('/category', 'Dashboard\CategoryController')->except([
        'show'
    ]);
    Route::resource('/product', 'Dashboard\ProductController')->except([
        'show'
    ]);
    Route::get('/searchsale', ['uses' => 'Dashboard\ProductController@searchsale', 'as' => 'product.searchsale']);
    Route::get('/searchpurchase', ['uses' => 'Dashboard\ProductController@searchpurchase', 'as' => 'product.searchpurchase']);
    Route::get('/addproduct', ['uses' => 'Dashboard\ProductController@addproduct', 'as' => 'product.addproduct']);

    Route::put('/paymentdue/{id}', 'Dashboard\SaleController@paymentdue');
    Route::put('/paymentduep/{id}', 'Dashboard\purchaseController@paymentduep');
    Route::resource('/sale', 'Dashboard\SaleController')->except([
        'show'
    ]);
    Route::resource('/purchase', 'Dashboard\PurchaseController')->except([
        'show'
    ]);
    Route::post('/newproduct', 'Dashboard\NewProductController@store');
    Route::resource('/newproduct', 'Dashboard\NewProductController')->except([
        'show', 'index', 'update', 'destroy', 'create', 'edit'
    ]);
    Route::post('/newprovider', 'Dashboard\NewProviderController@store');
    Route::resource('/newprovider', 'Dashboard\NewProviderController')->except([
        'show', 'index', 'update', 'destroy', 'create', 'edit'
    ]);
    Route::post('/newclient', 'Dashboard\NewClientController@store');
    Route::resource('/newclient', 'Dashboard\NewClientController')->except([
        'show', 'index', 'update', 'destroy', 'create', 'edit'
    ]);
    Route::resource('/client', 'Dashboard\ClientController')->except([
        'show'
    ]);
    Route::resource('/provider', 'Dashboard\ProviderController')->except([
        'show'
    ]);

    // category spending route

    Route::post('/catspend', 'Dashboard\CategorySpendingController@store');
    Route::put('/updatecatspend/{id}', 'Dashboard\CategorySpendingController@updatecatspend');
    Route::get('/categoryspending/catdpenddelete', 'Dashboard\CategorySpendingController@catdpenddelete')->name('categoryspending.catdpenddelete');
    Route::resource('/categoryspending', 'Dashboard\CategorySpendingController')->except([
        'show'
    ]);

    // spending route

    Route::post('/newspend', 'Dashboard\SpendingController@store');
    Route::put('/updatespend/{id}', 'Dashboard\SpendingController@updatespend');
    Route::resource('/spending', 'Dashboard\SpendingController')->except([
        'show'
    ]);

    // Money box route
    Route::get('/moneybox', 'Dashboard\MoneyBoxController@index');

    // generale Settings route
    Route::resource('/generalsetting', 'Dashboard\GeneralSettingController')->except([
        'show', 'update', 'destroy', 'create', 'edit'
    ]);
});