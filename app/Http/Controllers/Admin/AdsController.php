<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdsStoreRequest;
use App\Http\Requests\AdsUpdateRequest;
use App\Models\Ads;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdsController extends Controller
{

    public function index()
    {
        $ads = Ads::paginate(10);
        return view('admin.ads.index', compact('ads'));
    }


    public function create()
    {
        $vendors = Vendor::all();
        return view('admin.ads.create', compact('vendors'));

    }


    public function store(AdsStoreRequest $request)
    {
        if ($request->has('image')) {
            $filePath = uploadImage('ads', $request->image);
        }
        //dd($filePath);
        Ads::create([
            'title' => $request->title,
            'type' => $request->type,
            'vendor_id' => $request->vendor_id,
            'image' => $filePath
        ]);
        return redirect()->route('ads.index')->with('message', 'You have created Ad');

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $ads = Ads::findorfail($id);
        $vendors = Vendor::all();
        return view('admin.ads.edit', compact('vendors', 'ads'));
    }


    public function update(AdsUpdateRequest $request, $id)
    {
        $ads = Ads::findorfail($id);

        if ($request->has('image')) {
            $filePath = uploadImage('ads', $request->image);
            if (file_exists(public_path() . '/' . $ads->image)) {
                unlink($ads->image);

            }
            $ads->update([
                'title' => $request->title,
                'type' => $request->type,
                'vendor_id' => $request->vendor_id,
                'image' => $filePath
            ]);
        } else {
            $ads->update($request->all());
        }
        return redirect()->route('ads.index')->with('message', 'You have updated Ad');

    }


    public function destroy($id)
    {
        $ads = Ads::findorfail($id);

        if (file_exists(public_path() . '/' . $ads->image)) {
            unlink($ads->image);

        }
        $ads->delete();
        return redirect()->route('ads.index')->with('message', 'You have deleted Ad');

    }
}
