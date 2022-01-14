<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorAdminRequest;
use App\Http\Requests\VendorUserRequest;
use App\Models\Branch;
use App\Models\Vendor;
use App\Models\VendorAdmin;
use App\Models\VendorAdminBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorUsersController extends Controller
{

    public function index()
    {
        $vendorUsers=VendorAdmin::where('vendor_id','=',Auth('vendor')->user()->vendor_id)
            ->where('id','!=',Auth('vendor')->user()->id)
            ->where('type','!=','owner')
            ->with('vendor')
            ->paginate(10);
        return view('vendor.vendorUsers.index',compact('vendorUsers'));
    }


    public function create()
    {
        $branches=Branch::all();
        return view('vendor.vendorUsers.create',compact('branches'));

    }

    public function store(VendorUserRequest $request)
    {
        $vendorAdminId=VendorAdmin::insertGetId([
        'password'=>bcrypt($request->password),
            'name'=>$request->name,
            'email'=>$request->email,
            'type'=>$request->type,
            'vendor_id'=>Auth('vendor')->user()->vendor_id
        ]);

            foreach($request->branches as $branchId)
            {
                VendorAdminBranch::create([
                    'vendor_admin_id'=>$vendorAdminId,
                    'branch_id'=>$branchId
                ]);

            }
        return redirect()->route('vendor-users.index')->with('message','You have created successfully');

    }


    public function edit($id)
    {
        $vendorAdmin=VendorAdmin::findorfail($id);
        $branches=Branch::all();

        return view('vendor.vendorUsers.edit',compact('vendorAdmin','branches'));

    }


    public function update(VendorUserRequest $request, $id)
    {

        $vendorAdmin=VendorAdmin::findorfail($id);

        $vendorAdmin->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'type'=>$request->type,
            'vendor_id'=>Auth('vendor')->user()->vendor_id
        ]);
        if($request->password !== '')
        {
            $vendorAdmin->update([
                'password'=>bcrypt($request->password)
            ]);
        }

        $vendorAdminBranches=VendorAdminBranch::where('vendor_admin_id','=',$id)->get();
        foreach ($vendorAdminBranches as $branch)
        {
            $branch->delete();
        }
        foreach($request->branches as $branchId)
        {
            VendorAdminBranch::create([
                'vendor_admin_id'=>$id,
                'branch_id'=>$branchId
            ]);

        }
        return redirect()->route('vendor-users.index')->with('message','You have updated successfully');


    }


    public function destroy($id)
    {
        $vendorAdmin=VendorAdmin::findorfail($id);
        $vendorAdminBranches=VendorAdminBranch::where('vendor_admin_id','=',$id)->get();
        foreach ($vendorAdminBranches as $branch)
        {
            $branch->delete();
        }
            $vendorAdmin->delete();
        return redirect()->route('vendor-users.index')->with('message','You have deleted successfully');
    }
}
