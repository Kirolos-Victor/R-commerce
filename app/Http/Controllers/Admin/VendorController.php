<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\Country;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    public function index()
    {
        $vendors = Vendor::paginate(10);
        return view('admin.vendors.index', compact('vendors'));
    }


    public function create()
    {
        $countries = Country::all();

        return view('admin.vendors.create', compact('countries'));
    }


    public function store(VendorRequest $request)
    {
        if ($request->active != null) {
            $active = 1;
        } else {
            $active = 0;
        }
        $request->merge(['active' => $active]);
        if ($request->preorder_availability != null) {
            $preorder_availability = 1;
        } else {
            $preorder_availability = 0;
        }
        $request->merge(['active' => $active, 'preorder_availability' => $preorder_availability]);
        Vendor::create($request->all());
        return redirect()->route('vendors.index')->with('message', 'You have created the vendor');
    }


    public function show($id)
    {
        //
    }


    public function edit(Vendor $vendor)
    {
        $countries = Country::all();
        return view('admin.vendors.edit', compact('vendor', 'countries'));
    }


    public function update(VendorRequest $request, Vendor $vendor)
    {
        if ($request->active != null) {
            $active = 1;
        } else {
            $active = 0;
        }
        if ($request->preorder_availability != null) {
            $preorder_availability = 1;
        } else {
            $preorder_availability = 0;
        }
        $request->merge(['active' => $active, 'preorder_availability' => $preorder_availability]);
        $vendor->update($request->all());
        return redirect()->route('vendors.index')->with('message', 'You have updated the vendor');
    }

    public function destroy(Vendor $vendor)
    {
        try {
            $vendor->delete();
        } catch (\Exception $e) {
            return redirect()->route('vendors.index')->withErrors('Sorry, you can not delete this vendor.');
        }
        return redirect()->route('vendors.index')->with('message', 'You have deleted the vendor');
    }
}
