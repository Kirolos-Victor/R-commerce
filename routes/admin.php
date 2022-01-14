<?php

use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VendorAdminsController;
use App\Http\Controllers\Admin\VendorCategoryController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\VendorSubCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => 'guest:admin'], function () {
    Route::get('login', [LoginController::class, 'adminLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'adminLogin'])->name('admin.login.submit');
});
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/', function () {
        return view('admin.dashboard.index');
    })->name('admin');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('vendor-category', VendorCategoryController::class);
    Route::post('vendor-category/toggleActivation/{id}', [VendorCategoryController::class, 'toggleActivation'])->name('vendor-category.toggleActivation');
    Route::resource('vendor-sub-category', VendorSubCategoryController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('vendor-admins', VendorAdminsController::class);
    Route::resource('ads', AdsController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('cities', CityController::class);
    Route::resource('areas', AreaController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::get('users/{id}/order', [\App\Http\Controllers\Admin\UserController::class, 'order'])->name('user.orders');
    Route::get('abandoned-carts', [\App\Http\Controllers\Admin\AbandonedCartController::class, 'index'])->name('abandoned-carts.index');
});
