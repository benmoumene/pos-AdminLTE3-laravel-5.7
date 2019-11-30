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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
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
            Route::resource('/sale', 'Dashboard\SaleController');
            Route::resource('/purchase', 'Dashboard\PurchaseController');
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
    }
);