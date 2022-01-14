<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\AddonSection;
use App\Models\AddonSectionDetail;
use App\Models\AddonsProduct;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBranch;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        
        $products=Product::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->orderBy('created_at','desc')->paginate(10);
        return view('vendor.products.index',compact('products'));
    }


    public function create()
    {
        $categories=Category::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->get();
        $branches=Branch::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->get();
        $addons=AddonSection::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->get();
        return view('vendor.products.create',compact('branches','addons','categories'));
    }


    public function store(ProductRequest $request)
    {
        //dd($request->image);

        $product=Product::create([
            'name_en'=>$request->name_en,
           'vendor_id'=>Auth()->user()->vendor_id,
            'name_ar'=>$request->name_ar,
            'description_en'=>$request->description_en,
            'description_ar'=>$request->description_ar,
            'amount'=>$request->amount,
            'price'=>$request->price,
            'cost'=>$request->cost,
            'is_hidden'=>$request->is_hidden
        ]);
        $productId=$product->id;
        if($request->hasFile('image'))
        {

            foreach ($request->file('image') as $image)
            {

                $filePath=UploadImage('products',$image);

                ProductImage::create([
                    'product_id'=>$productId,
                    'image'=>$filePath

                ]);
            }

        }
        if($request->has('branches'))
        {
            $branches=$request->branches;
            foreach ($branches as $branch)
            {
                ProductBranch::create([
                    'product_id'=>$productId,
                    'branch_id'=>$branch
                ]);
            }
        }
        if($request->has('addons'))
        {
            $addons=$request->addons;
            foreach ($addons as $addon)
            {
                AddonsProduct::create([
                    'product_id'=>$productId,
                    'addon_id'=>$addon
                ]);
            }
        }
        if($request->has('categories'))
        {
            $categories=$request->categories;
            foreach($categories as $category)
            {
                ProductCategory::create([
                    'product_id'=>$productId,
                    'category_id'=>$category
                ]);

            }

        }
        if($request->has('section_name_en') && $request->section_name_en != null)
        {
            $addonSectionId=AddonSection::insertGetId([
                'vendor_id'=>Auth('vendor')->user()->vendor_id,
                'name_en'=>$request->section_name_en,
                'name_ar'=>$request->section_name_ar,
                'quantity'=>$request->quantity,
                'must_select'=>$request->addon_select_type,
                'quantity_meter'=>$request->quantity_meter,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()

            ]);
            $i=0;
            while ($i < count($request->addon_name_en))
            {
                AddonSectionDetail::create([
                    'name_en'=>$request->addon_name_en[$i],
                    'name_ar'=>$request->addon_name_ar[$i],
                    'price'=>$request->price[$i],
                    'addon_id'=>$addonSectionId
                ]);
                $i++;
            }
            AddonsProduct::create([
                'product_id'=>$productId,
                'addon_id'=>$addonSectionId
            ]);
        }
        return response()->json('done');
    }


    public function edit($id)
    {

        $product=Product::findorfail($id);
        $productAddons=AddonsProduct::where('product_id','=',$id)->get();
        $productCategories=ProductCategory::where('product_id','=',$id)->get();
        $productBranches=ProductBranch::where('product_id','=',$id)->get();
        $branches=Branch::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->get();
        $addons=AddonSection::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->get();
        $categories=Category::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->get();
        $images=ProductImage::where('product_id','=',$id)->get();
        //dd($images);

        return view('vendor.products.edit',compact('branches','product','productBranches','addons','productAddons','categories','productCategories','images'));
    }


    public function update(ProductRequest $request, Product $product)
    {
        if($request->has('branches'))
        {
            $productBranches=ProductBranch::where('product_id','=',$product->id)->get();
            foreach($productBranches as $productBranch){
                $productBranch->delete();

            }
            $branches=$request->branches;
            foreach ($branches as $branch)
            {
                ProductBranch::create([
                    'product_id'=>$product->id,
                    'branch_id'=>$branch
                ]);
            }
        }

        if($request->has('addons'))
        {
            $productAddons=AddonsProduct::where('product_id','=',$product->id)->get();
            foreach($productAddons as $productAddon){
                $productAddon->delete();

            }
            $addons=$request->addons;
            foreach ($addons as $addon)
            {
                AddonsProduct::create([
                    'product_id'=>$product->id,
                    'addon_id'=>$addon
                ]);
            }
        }
        if($request->has('categories'))
        {
            $productCategories=ProductCategory::where('product_id','=',$product->id)->get();
            foreach($productCategories as $productCategory){
                $productCategory->delete();

            }
            $categories=$request->categories;
            foreach($categories as $category)
            {
                ProductCategory::create([
                    'product_id'=>$product->id,
                    'category_id'=>$category
                ]);

            }

        }
        if($request->has('is_hidden')&& $request->is_hidden == 'on')
        {
            $is_hidden=1;
        }
        else
        {
            $is_hidden=0;
        }
        if($request->has('image'))
        {
            $productImages=ProductImage::where('product_id','=',$product->id)->get();
            foreach ($productImages as $productImage){
                if(!empty($productImage))
                {
                    unlink($productImage->image);
                    $productImage->delete();

                }

            }
            foreach ($request->image as $image)
            {
                //dd($image);

                $filePath=UploadImage('products',$image);

                ProductImage::create([
                    'product_id'=>$product->id,
                    'image'=>$filePath

                ]);
            }

        }

            $product->update([
                'name_en' => $request->name_en,
                'vendor_id' => Auth()->user()->vendor_id,
                'name_ar' => $request->name_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'amount' => $request->amount,
                'cost'=>$request->cost,
                'price' => $request->price,
                'is_hidden'=>$is_hidden
            ]);

        return redirect()->route('products.index')->with('message','You have updated the product successfully');

    }


    public function destroy(Product $product)
    {
        $productBranches=ProductBranch::where('product_id','=',$product->id)->get();
        foreach($productBranches as $productBranch){
            $productBranch->delete();

        }
        $productImages = ProductImage::where('product_id', '=', $product->id)->get();
            foreach ($productImages as $productImage) {
                unlink($productImage->image);
                $productImage->delete();

            }

        $productAddons=AddonsProduct::where('product_id','=',$product->id)->get();
        foreach($productAddons as $productAddon){
            $productAddon->delete();

        }
        $product->delete();
        return redirect()->back()->with('message','You have deleted the product successfully');
    }
}
