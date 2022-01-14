<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index(Request $request){
        $validator=Validator()->make($request->all(),[
            'country_id'=>'required'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'failed',$validator->errors());

        }
        $areas=City::with('areas')->where('country_id','=',$request->country_id)->get();
        return responseJson(200,'success',$areas);
    }
    public function stores(Request $request){
        $validator=Validator()->make($request->all(),[
            'area_id'=>'required',
            'category_id'=>'required'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'failed',$validator->errors());

        }
        $stores=Area::with('city.country.stores.vendorCategories')
            ->whereHas('city.country.stores.vendorCategories',function ($query) use ($request){
            $query->where('vendor_category_id','=',$request->category_id);
        })->where('id','=',$request->area_id)
            ->get()
            ->pluck('city.country.stores')
            ->collapse();

        return  responseJson(200,'success',$stores);
    }

    public function vendorByArea(Request $request){
        $validator=Validator()->make($request->all(),[
            'vendor_id'=>'required',
            'area_id'=>'required'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'failed',$validator->errors());

        }
        $vendor=Area::with('city.country.stores.vendorSetting','city.country.stores.products.categories')
            ->whereHas('city.country.stores',function ($query) use ($request){
            $query->where('id','=',$request->vendor_id);
        })->where('id','=',$request->area_id)
            ->get()
            ->pluck('city.country.stores')
            ->collapse();
        if($vendor->isNotEmpty())
        {
            return  responseJson(200,'success',$vendor);

        }
        else
        {
            return  responseJson(404,'Sorry, the vendor does not exist in this area');

        }


    }
    public function itemByArea(Request $request){
        $validator=Validator()->make($request->all(),[
            'item_id'=>'required',
            'area_id'=>'required'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'failed',$validator->errors());

        }
        $item=Area::with('city.country.stores.products.addons')
            ->whereHas('city.country.stores.products',function ($query)use ($request){
                $query->where('id','=',$request->item_id);
            })
            ->where('id','=',$request->area_id)
            ->get()
            ->unique('id')
            ->pluck('city.country.stores')
            ->collapse();
        if($item->isNotEmpty())
        {
            return  responseJson(200,'success',$item);

        }
        else
        {
            return  responseJson(404,'Sorry, the product does not exist in this area');

        }

    }

}
