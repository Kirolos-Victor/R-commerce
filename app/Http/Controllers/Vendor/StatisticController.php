<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(){
        $totalSalesOrder=0;
        $orders=Order::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->get();
        foreach ($orders as $order)
        {
            $totalSalesOrder=$totalSalesOrder+$order->total;
        }
        $topSellingItems=[];
        $uniqueOrderItems=OrderItem::all()->unique('product_id');
        foreach ($uniqueOrderItems as $orderItem){
            $topSellingItems[$orderItem->product_id]=OrderItem::where('product_id','=',$orderItem->product_id)->count();
        }


        return view('vendor.statistics.index',compact('totalSalesOrder','topSellingItems'));
    }
}
