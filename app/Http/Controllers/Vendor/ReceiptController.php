<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function index($id){
        $order=Order::with('user','orderItems','orderItems.orderItemAddons')->findOrFail($id);
        $totalCartPrice=$this->totalCartPrice($order);

        return view('vendor.receipt.index',compact('order','totalCartPrice'));
    }
    public function thermal($id){
        $order=Order::with('orderItems','orderItems.orderItemAddons')->findorfail($id);
        $totalCartPrice=$this->totalCartPrice($order);

        return view('vendor.thermal-printer.index',compact('order','totalCartPrice'));
    }

    protected function totalCartPrice($order){
        $totalItemPrice=0;
        $totalAddonPrice=0;
        foreach ($order->orderItems as $item)
        {
            $totalItemPrice=$totalItemPrice+$item->unit_price*$item->quantity;
            foreach ($item->orderItemAddons as $itemAddon)
            {
                $totalAddonPrice=$totalAddonPrice+$itemAddon->addon_unit_price;

            }
        }
        return $totalItemPrice+$totalAddonPrice;
    }
}
