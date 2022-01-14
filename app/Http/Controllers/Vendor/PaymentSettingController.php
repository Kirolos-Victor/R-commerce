<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentSettingRequest;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index(){
        $paymentSetting=PaymentSetting::where('vendor_id','=',Auth()->user()->vendor_id)->first();
       // dd($paymentSetting);
        return view('vendor.paymentSettings.index',compact('paymentSetting'));
    }
    public function update(PaymentSettingRequest $request,$id){
       //dd($request->all());
        $paymentSetting= PaymentSetting::findorfail($id);
        if($request->has('cash_on_delivery') && $request->has('knet') && $request->has('visa'))
        {
            $paymentSetting->update([
                'cash_on_delivery'=>$request->cash_on_delivery,
                'knet'=>$request->knet,
                'visa'=>$request->visa
            ]);
        }
        elseif($request->has('cash_on_delivery') && $request->has('knet'))
        {
            $paymentSetting->update([
                'cash_on_delivery'=>$request->cash_on_delivery,
                'knet'=>$request->knet,
                'visa'=>2
            ]);
        }
        elseif($request->has('cash_on_delivery') && $request->has('visa'))
        {
            $paymentSetting->update([
                'cash_on_delivery'=>$request->cash_on_delivery,
                'knet'=>2,
                'visa'=>1
            ]);
        }
        elseif($request->has('visa') && $request->has('knet'))
        {
            $paymentSetting->update([
                'cash_on_delivery'=>2,
                'knet'=>1,
                'visa'=>1
            ]);
        }
        elseif($request->has('cash_on_delivery'))
        {
            $paymentSetting->update([
                'cash_on_delivery'=>1,
                'knet'=>2,
                'visa'=>2
            ]);
        }
        elseif($request->has('knet'))
        {
            $paymentSetting->update([
                'cash_on_delivery'=>2,
                'knet'=>1,
                'visa'=>2
            ]);
        }
        elseif($request->has('visa'))
        {
            $paymentSetting->update([
                'cash_on_delivery'=>2,
                'knet'=>2,
                'visa'=>1
            ]);
        }

        else{
            $paymentSetting->update([
                'cash_on_delivery'=>2,
                'knet'=>2,
                'visa'=>2
            ]);
        }

       return redirect()->back()->with('message','You have updated the payment setting successfully');

    }
}
