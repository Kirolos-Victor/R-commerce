<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function index()
    {
        $countries=Country::paginate(10);
        return view('admin.countries.index',compact('countries'));
    }


    public function create()
    {
        return view('admin.countries.create');

    }


    public function store(CountryRequest $request)
    {
        Country::create($request->all());
        return redirect()->route('countries.index')->with('message','You have created the country successfully');

    }




    public function edit(Country $country)
    {
        return view('admin.countries.edit',compact('country'));

    }


    public function update(CountryRequest $request, Country $country)
    {
        $country->update($request->all());
        return redirect()->route('countries.index')->with('message','You have updated the country successfully');

    }


    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->back()->with('message','You have deleted the country successfully');

    }
}
