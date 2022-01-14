<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddonRequest;
use App\Models\AddonSection;
use App\Models\AddonSectionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AddonController extends Controller
{

    public function index()
    {
        $addons=AddonSection::where('vendor_id','=',Auth()->user()->vendor_id)->paginate(10);
        return view('vendor.addons.index',compact('addons'));
    }


    public function create()
    {
        return view('vendor.addons.create');
    }


    public function store(AddonRequest $request)
    {

        $addonSectionId=AddonSection::insertGetId([
           'vendor_id'=>Auth('vendor')->user()->vendor_id,
           'name_en'=>$request->section_name_en,
            'name_ar'=>$request->section_name_ar,
            'quantity'=>$request->quantity,
            'must_select'=>$request->addon_select_type,
            'quantity_meter'=>$request->quantity_meter,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()

        ]);
        $i=0;
        while ($i < count($request->addon_name_en))
        {
            AddonSectionDetail::create([
               'name_en'=>$request->addon_name_en[$i],
                'name_ar'=>$request->addon_name_ar[$i],
                'price'=>$request->price[$i],
                'addon_id'=>$addonSectionId
            ]);
            $i++;
        }

    }

    public function edit($id)
    {
        $addonSection=AddonSection::where('id','=',$id)->get();
        $addonSectionDetails=AddonSectionDetail::where('addon_id','=',$addonSection[0]->id)->get();

        return view('vendor.addons.edit',compact('addonSection','addonSectionDetails'));
    }


    public function update(AddonRequest $request, $id)
    {
        $addonSection=AddonSection::findorfail($id);
        $addonSection->update([
            'name_en'=>$request->section_name_en,
            'name_ar'=>$request->section_name_ar,
            'quantity'=>$request->quantity,
            'must_select'=>$request->addon_select_type,
            'quantity_meter'=>$request->quantity_meter,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        $addonSectionDetails=AddonSectionDetail::where('addon_id','=',$addonSection->id)->get();
        foreach ($addonSectionDetails as $sectionDetail)
        {
            $sectionDetail->delete();
        }
        $i=0;
        while ($i < count($request->addon_name_en))
        {
            AddonSectionDetail::create([
                'name_en'=>$request->addon_name_en[$i],
                'name_ar'=>$request->addon_name_ar[$i],
                'price'=>$request->price[$i],
                'addon_id'=>$id
            ]);
            $i++;
        }
    }


    public function destroy($id)
    {
        $addonSection=AddonSection::findorfail($id);
        $addonSectionDetails=AddonSectionDetail::where('addon_id','=',$addonSection->id)->get();
        foreach ($addonSectionDetails as $sectionDetail)
        {
            $sectionDetail->delete();
        }
        $addonSection->delete();

        return redirect()->route('addons.index')->with('message','you have successfully deleted the addon');
    }
}
