<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\VendorCategoryController;
use App\Http\Controllers\API\VendorController;
use App\Http\Controllers\API\VendorSubCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
Route::get('vendor-categories', [VendorCategoryController::class, 'index']);
Route::get('vendor-categories/sub-categories', [VendorCategoryController::class, 'subCategories']);
Route::apiResource('vendor-sub-categories', VendorSubCategoryController::class);
Route::get('vendors', [VendorController::class, 'index']);
Route::get('vendors/category', [VendorController::class, 'vendorByCategory']);
Route::get('user/addresses', [\App\Http\Controllers\API\UserAddressController::class, 'index']);
Route::get('areas', [\App\Http\Controllers\API\AreaController::class, 'index']);
Route::get('area/stores', [\App\Http\Controllers\API\AreaController::class, 'stores']);
Route::get('area/vendor', [\App\Http\Controllers\API\AreaController::class, 'vendorByArea']);
Route::get('area/item', [\App\Http\Controllers\API\AreaController::class, 'itemByArea']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('cart', [\App\Http\Controllers\API\CartController::class, 'index']);
    Route::post('cart/product/{id}', [\App\Http\Controllers\API\CartController::class, 'create']);
    Route::put('cart/product/{id}', [\App\Http\Controllers\API\CartController::class, 'update']);
    Route::delete('cart/product/{id}', [\App\Http\Controllers\API\CartController::class, 'destroy']);

});
Route::post('cart/checkout', [\App\Http\Controllers\API\CartController::class, 'checkout']);
Route::post('forget-password',[\App\Http\Controllers\API\ForgetPasswordController::class,'sendLink']);
Route::get('forget-password/{token}',[\App\Http\Controllers\API\ForgetPasswordController::class,'resetPasswordForm'])->name('resetPasswordForm');
Route::post('reset-password',[\App\Http\Controllers\API\ResetPasswordController::class,'reset'])->name('resetPassword');

Route::apiResource('ads',\App\Http\Controllers\API\AdsController::class);
