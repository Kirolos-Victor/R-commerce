<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSettingRequest;
use App\Models\StoreSetting;
use Illuminate\Http\Request;

class StoreSettingController extends Controller
{
    public function index()
    {
        $storeSetting=StoreSetting::where('vendor_id','=',Auth()->user()->vendor_id)->first();
        return view('vendor.storeSettings.index',compact('storeSetting'));
    }
    public function update(StoreSettingRequest $request, $id){
        $storeSetting=StoreSetting::findorfail($id);
        $storeSetting->update([
           'name_en'=>$request->name_en,
           'name_ar'=>$request->name_ar,
           'phone'=>$request->phone,
           'meta_description'=>$request->meta_description
        ]);
        if($request->has('cover_image')){
            if(isset($storeSetting->cover_image))
            {
                unlink($storeSetting->cover_image);

            }
            $coverImageFilePath = uploadImage('store/cover_images', $request->cover_image);
            $storeSetting->update([
               'cover_image'=>$coverImageFilePath
            ]);
        }

        if($request->has('logo')){
            if(isset($storeSetting->logo))
            {
                unlink($storeSetting->logo);

            }
            $logoFilePath = uploadImage('store/logos', $request->logo);
            $storeSetting->update([
                'logo'=>$logoFilePath
            ]);
        }
        return redirect()->back()->with('message','You have successfully updated the settings');
    }
}
