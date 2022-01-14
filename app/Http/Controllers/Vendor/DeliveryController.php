<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryRequest;
use App\Models\Area;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Delivery;
use App\Models\DeliveryHour;
use App\Models\DeliveryZoneArea;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{

    public function index()
    {
        $deliveries=Delivery::where('vendor_id','=',Auth('vendor')->user()->id)->paginate(10);
        return view('vendor.deliveries.index',compact('deliveries'));
    }


    public function create()
    {
        $branches=Branch::where('vendor_id','=',Auth('vendor')->user()->id)->get();
        $countries=Country::all();
        $areas=Area::all();
        return view('vendor.deliveries.create',compact('branches','countries','areas'));
    }


    public function store(DeliveryRequest $request)
    {
       $zone_id= Delivery::insertGetId([
           'vendor_id'=> Auth('vendor')->user()->id,
            'branch_id'=>$request->branch_id,
            'country_id'=>$request->country_id,
            'delivery_time'=>$request->delivery_time,
            'delivery_fees'=>$request->delivery_fees,
            'minimum_order_price'=>$request->minimum_order_price,
           'estimated_preparation_time'=>$request->estimated_preparation_time,
           'radius'=>$request->radius,
           'area'=>$request->area,
           'longitude'=>$request->longitude,
           'latitude'=>$request->latitude,
           'created_at'=>Carbon::now(),
           'updated_at'=>Carbon::now()
        ]);
       $i=0;
       while($i < count($request->day))
       {

           DeliveryHour::create([
               'zones_id'=>$zone_id,
               'day'=>$request->day[$i],
               'from'=>$request->from[$i],
               'to'=>$request->to[$i]
           ]);
           $i++;

       }
       if($request->has('areas'))
       {
           $areas=$request->areas;
           foreach($areas as $area)
           {
               DeliveryZoneArea::create([
                  'zone_id'=>$zone_id,
                  'area_id'=>$area
               ]);

           }
       }

    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $branches=Branch::where('vendor_id','=',Auth('vendor')->user()->id)->get();
        $countries=Country::all();
        $zone=Delivery::with('deliveryHours')->findorfail($id);
        $areas=Area::all();
        $deliveryZoneAreas=DeliveryZoneArea::with('area')->where('zone_id','=',$id)->get();

        return view('vendor.deliveries.edit',compact('zone','branches','countries','areas','deliveryZoneAreas'));
    }


    public function update(DeliveryRequest $request, $id)
    {
        $deliveryZone=Delivery::findorfail($id);
        $deliveryZone->update([
            'branch_id'=>$request->branch_id,
            'country_id'=>$request->country_id,
            'delivery_time'=>$request->delivery_time,
            'delivery_fees'=>$request->delivery_fees,
            'minimum_order_price'=>$request->minimum_order_price,
            'estimated_preparation_time'=>$request->estimated_preparation_time,
            'radius'=>$request->radius,
            'area'=>$request->area,
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude,
        ]);
        $deliveryHours=DeliveryHour::where('zones_id','=',$id)->get();
        foreach ($deliveryHours as $deliveryHour)
        {
            $deliveryHour->delete();
        }
        $i=0;
        while($i < count($request->day))
        {

            DeliveryHour::create([
                'zones_id'=>$id,
                'day'=>$request->day[$i],
                'from'=>$request->from[$i],
                'to'=>$request->to[$i]
            ]);
            $i++;

        }
        if($request->has('areas'))
        {
            $deliveryZoneAreas=DeliveryZoneArea::where('zone_id','=',$id)->get();
            foreach ($deliveryZoneAreas as $deliveryZoneArea){
                $deliveryZoneArea->delete();
            }
            $areas=$request->areas;
            foreach($areas as $area)
            {
                DeliveryZoneArea::create([
                    'zone_id'=>$id,
                    'area_id'=>$area
                ]);

            }
        }

    }


    public function destroy($id,Request $request)
    {
        $zone=Delivery::findorfail($id);

        $deliveryHours=DeliveryHour::where('zones_id','=',$zone->id)->get();
        foreach ($deliveryHours as $deliveryHour)
        {
            $deliveryHour->delete();
        }
        $deliveryZoneAreas=DeliveryZoneArea::where('zone_id','=',$zone->id)->get();
        foreach ($deliveryZoneAreas as $deliveryZoneArea)
        {
            $deliveryZoneArea->delete();
        }
        $zone->delete();

        return redirect()->route('delivery.index')->with('message','You have deleted the zone successfully');
    }
}
