<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalesReportRequest;
use App\Models\Order;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function index(Request $request){
        $ordersByMonth=Order::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->get();

        if($request->from > $request->to)
        {
            return redirect()->back()->withErrors('Sorry, To date must be greater than From date.');
        }

        if($request->has('from')&& $request->from != null && $request->has('to')&& $request->to != null){

            $orders=Order::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->whereDate('created_at','>=', $request->from)->whereDate('created_at','<=',$request->to)->get();

        }
        else
        {
            $orders=Order::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->get();

        }
        return view('vendor.salesReport.index',compact('orders','ordersByMonth'));
    }
    public function orderByMonth(Request $request)
    {
        $orders=Order::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->get();

        if($request->from > $request->to)
        {
            return redirect()->back()->withErrors('Sorry, To date must be greater than From date.');
        }

        if($request->has('from')&& $request->from != null && $request->has('to')&& $request->to != null){

            $ordersByMonth=Order::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->where('created_month','>=', $request->from)->where('created_month','<=',$request->to)->get();

        }
        else
        {
            $ordersByMonth=Order::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->get();

        }
        return view('vendor.salesReport.index',compact('ordersByMonth','orders'));
    }
}
