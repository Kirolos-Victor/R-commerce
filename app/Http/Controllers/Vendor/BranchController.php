<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Http\Requests\VendorRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    public function index()
    {
        $branches=Branch::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->paginate(10);
        return view('vendor.branches.index',compact('branches'));
    }


    public function create()
    {
        return view('vendor.branches.create');

    }


    public function store(BranchRequest $request)
    {

        Branch::create(
        [
           'vendor_id'=>Auth('vendor')->user()->vendor_id,
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'address'=>$request->address,
            'phone_number'=>$request->phone_number,
            'contact_person_number'=>$request->contact_person_number,
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude
        ]);
        return redirect()->route('branches.index')->with('message','You have created the branch successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit(Branch $branch)
    {
        return view('vendor.branches.edit',compact('branch'));

    }


    public function update(BranchRequest $request, Branch $branch)
    {

        $branch->update([
            'vendor_id'=>Auth('vendor')->user()->vendor_id,
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'address'=>$request->address,
            'phone_number'=>$request->phone_number,
            'contact_person_number'=>$request->contact_person_number,
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude
        ]);
        return redirect()->route('branches.index')->with('message','You have updated the branch successfully');

    }


    public function destroy(Branch $branch)
    {
        $branch->delete();

        return redirect()->back()->with('message','You have deleted the branch successfully');
    }
}
