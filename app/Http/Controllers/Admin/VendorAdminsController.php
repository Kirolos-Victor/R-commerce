<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorAdminRequest;
use App\Models\Vendor;
use App\Models\VendorAdmin;
use Illuminate\Http\Request;

class VendorAdminsController extends Controller
{

    public function index()
    {
        $vendorAdmins=VendorAdmin::with('vendor')->paginate(10);
        return view('admin.vendorAdmins.index',compact('vendorAdmins'));
    }


    public function create()
    {
        $vendors=Vendor::all();
        return view('admin.vendorAdmins.create',compact('vendors'));

    }

    public function store(VendorAdminRequest $request)
    {
        $vendorAdmins=VendorAdmin::where('vendor_id','=',$request->vendor_id)->get();
        foreach($vendorAdmins as $admin)
        {
            if($admin->type=='owner' && $request->type=='owner')
            {
                return redirect()->back()->withErrors('Can not create more than one owner for each vendor');
            }
        }
        VendorAdmin::create([
            'name'=>$request->name,
        'password'=>bcrypt($request->password),
            'email'=>$request->email,
            'type'=>$request->type,
            'vendor_id'=>$request->vendor_id
        ]);
        return redirect()->route('vendor-admins.index')->with('message','You have created successfully');

    }


    public function show($id)
    {
        //
    }

    public function edit(VendorAdmin $vendorAdmin)
    {
        $vendors=Vendor::all();

        return view('admin.vendorAdmins.edit',compact('vendorAdmin','vendors'));

    }


    public function update(VendorAdminRequest $request, VendorAdmin $vendorAdmin)
    {
        $vendorAdmins=VendorAdmin::where('vendor_id','=',$request->vendor_id)->get();
        foreach($vendorAdmins as $admin)
        {
            if($admin->type=='owner' && $request->type=='owner')
            {
                return redirect()->back()->withErrors('Can not create more than one owner for each vendor');
            }
        }
        $vendorAdmin->update($request->except('password'));
        if($request->password !== '')
        {
            $vendorAdmin->password=bcrypt($request->password);
        }
        $vendorAdmin->save();
        return redirect()->route('vendor-admins.index')->with('message','You have updated successfully');


    }


    public function destroy(VendorAdmin $vendorAdmin)
    {
        if($vendorAdmin->type ==='owner')
        {
            return redirect()->back()->withErrors('You can not delete vendor owner');
        }
        else{
            $vendorAdmin->delete();
        }
        return redirect()->route('vendor-admins.index')->with('message','You have deleted successfully');
    }
}
