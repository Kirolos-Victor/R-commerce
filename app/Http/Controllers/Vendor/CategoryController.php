<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories=Category::where('vendor_id','=',Auth('vendor')->user()->id)->paginate(10);
        return view('vendor.categories.index',compact('categories'));
    }


    public function create()
    {
        return view('vendor.categories.create');
    }


    public function store(CategoryRequest $request)
    {
        if($request->has('is_hidden')&& $request->is_hidden == 'on')
        {
            $is_hidden=1;
        }
        else
        {
            $is_hidden=0;
        }
        Category::create([
           'name_en'=>$request->name_en,
           'name_ar'=>$request->name_ar,
           'vendor_id'=>Auth('vendor')->user()->vendor_id,
            'is_hidden'=>$is_hidden
        ]);
        return redirect()->route('categories.index')->with('message','You have created the category successfully');

    }



    public function edit(Category $category)
    {
        return view('vendor.categories.edit',compact('category'));
    }


    public function update(CategoryRequest $request, Category $category)
    {
        //dd($request->all());
        if($request->has('is_hidden')&& $request->is_hidden == 'on')
        {
            $is_hidden=1;
        }
        else
        {
            $is_hidden=0;
        }
        //dd($is_hidden);
        $category->update(
            [
                'name_en'=>$request->name_en,
                'name_ar'=>$request->name_ar,
                'is_hidden'=>$is_hidden,
                'vendor_id'=>Auth('vendor')->user()->vendor_id,
            ]);
        return redirect()->route('categories.index')->with('message','You have updated the category successfully');

    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('message','You have deleted the category successfully');
    }
}
