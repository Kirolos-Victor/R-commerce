<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorSubCategoryRequest;
use App\Models\VendorCategory;
use Illuminate\Http\Request;

class VendorSubCategoryController extends Controller
{

    public function index()
    {
        $vendorSubCategories=VendorCategory::where('parent_id','!=',null)->paginate(10);
        return view('admin.vendorSubCategories.index',compact('vendorSubCategories'));

    }

    public function create()
    {
        $vendorCategories=VendorCategory::where('parent_id','=',null)->get();
        return view('admin.vendorSubCategories.create',compact('vendorCategories'));
    }


    public function store(VendorSubCategoryRequest $request)
    {
        VendorCategory::create($request->all());
        return redirect()->route('vendor-sub-category.index')->with('message','You have created the vendor sub category');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $vendorCategories=VendorCategory::where('parent_id','=',null)->get();

        $vendorCategory=VendorCategory::findorfail($id);
        return view('admin.vendorSubCategories.edit',compact('vendorCategory','vendorCategories'));

    }

    public function update(Request $request, $id)
    {
        $vendorCategory=VendorCategory::findorfail($id);

        $vendorCategory->update([
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'parent_id'=>$request->parent_id
        ]);
        return redirect()->route('vendor-sub-category.index')->with('message','You have updated the vendor sub category');
    }

    public function destroy($id)
    {
        $vendorCategory=VendorCategory::findorfail($id);

        $vendorCategory->delete();
        return redirect()->route('vendor-sub-category.index')->with('message','You have deleted the vendor sub category');
    }
}
