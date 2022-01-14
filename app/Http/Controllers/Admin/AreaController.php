<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas=Area::with('city')->paginate(10);
        return view('admin.areas.index',compact('areas'));
    }


    public function create()
    {
        $cities=City::all();
        return view('admin.areas.create',compact('cities'));


    }


    public function store(AreaRequest $request)
    {
        Area::create($request->all());
        return redirect()->route('areas.index')->with('message','You have created the area successfully');

    }


    public function edit(Area $area)
    {
        $cities=City::all();

        return view('admin.areas.edit',compact('area','cities'));

    }


    public function update(AreaRequest $request, Area $area)
    {
        $area->update($request->all());
        return redirect()->route('areas.index')->with('message','You have updated the area successfully');

    }


    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->back()->with('message','You have deleted the area successfully');

    }
}
