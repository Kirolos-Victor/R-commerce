<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVendorCategoryRequest;
use App\Http\Requests\VendorCategoryRequest;
use App\Models\VendorCategory;
use Illuminate\Http\Request;

class VendorCategoryController extends Controller
{

    public function index()
    {
        $vendorCategories = VendorCategory::where('parent_id', '=', null)->paginate(10);
        return view('admin.vendorCategories.index', compact('vendorCategories'));
    }


    public function create()
    {
        return view('admin.vendorCategories.create');
    }


    public function store(VendorCategoryRequest $request)
    {
        $inputs = $request->all();
        if ($request->has('image')) {
            $filePath = uploadImage('vendor_categories', $request->image);
            //add request
            $inputs['image'] = $filePath;
        }
        VendorCategory::create($inputs);
        return redirect()->route('vendor-category.index')->with('message', 'You have created the vendor category');
    }

    public function show($id)
    {
        //
    }

    public function edit(VendorCategory $vendorCategory)
    {
        if (in_array($vendorCategory->id, [1, 2, 3])) {
            abort(403);
        }
        return view('admin.vendorCategories.edit', compact('vendorCategory'));
    }


    public function update(VendorCategoryRequest $request, VendorCategory $vendorCategory)
    {
        if (in_array($vendorCategory->id, [1, 2, 3])) {
            abort(403);
        }
        $inputs = ['name_en' => $request->name_en,
            'name_ar' => $request->name_ar,];
        if ($request->has('image')) {
            $filePath = uploadImage('vendor_categories', $request->image);
            //add request
            $inputs['image'] = $filePath;
            if (file_exists($vendorCategory->image)) {
                unlink($vendorCategory->image);

            }
        }

        $vendorCategory->update($inputs);
        return redirect()->route('vendor-category.index')->with('message', 'You have updated the vendor category');

    }


    public function destroy(VendorCategory $vendorCategory)
    {
        $vendorCategory->delete();
        return redirect()->route('vendor-category.index')->with('message', 'You have deleted the vendor category');


    }

    public function toggleActivation($id)
    {
        $vendorCategory = VendorCategory::query()->find($id);
        $vendorCategory->toggleIsActive()->update();
        return redirect()->route('vendor-category.index')->with('message', 'You have changed the active state of  the vendor category');


    }
}
