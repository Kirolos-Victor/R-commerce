<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromoCodeRequest;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{

    public function index()
    {
        $promoCodes=PromoCode::where('vendor_id','=',Auth('vendor')->user()->id)->paginate(10);
        return view('vendor.promoCodes.index',compact('promoCodes'));
    }


    public function create()
    {
        return view('vendor.promoCodes.create');
    }


    public function store(PromoCodeRequest $request)
    {
        if($request->start_date > $request->end_date)
        {
            return redirect()->back()->withErrors('Sorry, start date can not be greater than end date.');
        }

        PromoCode::create([
           'vendor_id'=>Auth('vendor')->user()->id,
           'code'=>$request->code,
           'type'=>$request->type,
           'user_limit'=>$request->user_limit,
           'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'value'=>$request->value,
            'usage'=>$request->usage,
            'minimum_total_cart_price'=>$request->minimum_total_cart_price
        ]);
        return redirect()->route('promo-codes.index')->with('message','You have created promo code successfully');
    }


    public function show($id)
    {
        //
    }
    public function edit($id){
        $promoCode=PromoCode::findorfail($id);

        return view('vendor.promoCodes.edit',compact('promoCode'));
    }


    public function update(PromoCodeRequest $request, $id)
    {
        $promoCode=PromoCode::findorfail($id);

            $promoCode->update([
                'user_limit'=>$request->user_limit,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
            ]);


        return redirect()->route('promo-codes.index')->with('message','You have updated promo code successfully');

    }


    public function destroy($id)
    {
        $promoCode=PromoCode::findorfail($id);
        $promoCode->delete();
        return redirect()->back()->with('message','You have successfully deleted the promo code');

    }
}
