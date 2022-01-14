<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;


class DashboardController extends Controller
{
    public function index(){
     $number=order::count();
        return view('vendor.dashboard.index',compact('number'));

    }
}
