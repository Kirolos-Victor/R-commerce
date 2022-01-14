<?php

use App\Http\Controllers\Vendor\AddonController;
use App\Http\Controllers\Vendor\Auth\LoginController;
use App\Http\Controllers\Vendor\BranchController;
use App\Http\Controllers\Vendor\CartController;
use App\Http\Controllers\Vendor\CategoryController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\DeliveryController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\PaymentSettingController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\PromoCodeController;
use App\Http\Controllers\Vendor\ReceiptController;
use App\Http\Controllers\Vendor\SalesReportController;
use App\Http\Controllers\Vendor\StatisticController;
use App\Http\Controllers\Vendor\StoreSettingController;
use App\Http\Controllers\Vendor\VendorUsersController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale().'/vendor',
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],

    function()
    {
Route::get('logout',[LoginController::class,'logout'])->name('vendor.logout');

Route::group(['middleware'=>'guest:vendor'],function(){

    Route::get('login',[LoginController::class,'vendorLoginForm'])->name('vendor.login');
    Route::post('login',[LoginController::class,'vendorLogin'])->name('vendor.login.submit');

});

Route::group(['middleware'=>'auth:vendor'],function(){
    Route::get('/',function (){
        return view('vendor.dashboard.index');
    })->name('vendor');

    Route::get('dashboard',[DashboardController::class,'index'])->name('vendor.dashboard');
    Route::resource('branches',BranchController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('products',ProductController::class);
    Route::resource('addons',AddonController::class);
    Route::resource('vendor-users',VendorUsersController::class);
    Route::resource('promo-codes',PromoCodeController::class);
    Route::resource('delivery',DeliveryController::class);

    Route::get('store-settings',[StoreSettingController::class,'index'])->name('store-settings.index');
    Route::put('store-settings/{id}/update',[StoreSettingController::class,'update'])->name('store-settings.update');
    Route::get('payment-settings',[PaymentSettingController::class,'index'])->name('payment-settings.index');
    Route::put('payment-settings/{id}/update',[PaymentSettingController::class,'update'])->name('payment-settings.update');
    Route::get('orders',[OrderController::class,'index'])->name('order.index');
    Route::get('orders/create',[OrderController::class,'create'])->name('order.create');
    Route::put('orders/update/{id}',[OrderController::class,'update'])->name('order.update');
    Route::get('orders/refreshNewOrders',[OrderController::class,'refreshNewOrders'])->name('order.refreshNewOrders');

    Route::get('orders/item/{id}',[OrderController::class,'item'])->name('order.item');

    Route::post('orders/item/{id}/addToCart',[OrderController::class,'orderItem'])->name('addToCart');
    Route::get('orders/details/{id}',[OrderController::class,'orderDetail'])->name('vendor.orderDetail');
    Route::get('cart',[CartController::class,'index'])->name('vendor-cart.index');
    Route::PUT('cart/product/{id}',[CartController::class,'update'])->name('vendor-cart.update');
    Route::delete('cart/product/{id}',[CartController::class,'destroy'])->name('vendor-cart.destroy');
    Route::get('cart/addon-detail/{id}',[CartController::class,'addonDetail']);
    Route::get('cart/check-out/branches',[CartController::class,'branches']);
    Route::get('cart/check-out/areas',[CartController::class,'areas']);
    Route::get('cart/check-out',[CartController::class,'checkoutForm'])->name('vendor-cart.checkout.form');

    Route::post('cart/check-out',[CartController::class,'checkout'])->name('vendor-cart.checkout');
    Route::get('receipt/order/{id}',[ReceiptController::class,'index'])->name('receipt.index');
    Route::get('receipt/thermal-print/{id}',[ReceiptController::class,'thermal'])->name('thermal-print');
    Route::get('sales-report',[SalesReportController::class,'index'])->name('salesReport');
    Route::get('sales-report/monthly',[SalesReportController::class,'orderByMonth'])->name('salesReportByMonth');

    Route::get('statistics-report',[StatisticController::class,'index'])->name('statistics');
    Route::get('expired-stock',[\App\Http\Controllers\Vendor\ExpiredStockController::class,'index'])->name('expiredStock');
    Route::get('product/{id}/amount',[CartController::class,'productAmount'])->name('vendor-product.amount');


});
});
