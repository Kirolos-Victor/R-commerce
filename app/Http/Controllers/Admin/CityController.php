<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities=City::with('country')->paginate(10);
        return view('admin.cities.index',compact('cities'));
    }


    public function create()
    {
        $countries=Country::all();
        return view('admin.cities.create',compact('countries'));

    }


    public function store(CityRequest $request)
    {
        City::create($request->all());
        return redirect()->route('cities.index')->with('message','You have created the city successfully');

    }



    public function edit(City $city)
    {
        $countries=Country::all();

        return view('admin.cities.edit',compact('city','countries'));

    }


    public function update(CityRequest $request, City $city)
    {
        $city->update($request->all());
        return redirect()->route('cities.index')->with('message','You have updated the city successfully');

    }


    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->back()->with('message','You have deleted the city successfully');

    }
}
