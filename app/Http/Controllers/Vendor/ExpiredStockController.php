<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ExpiredStockController extends Controller
{
    public function index()
    {
        $expiredProducts=Product::where('vendor_id','=',Auth()->user()->vendor_id)->ExpiredProducts()->paginate();
        return view('vendor.expired-products.index',compact('expiredProducts'));
    }
}
