<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\VendorCategory;
use Illuminate\Http\Request;

class VendorSubCategoryController extends Controller
{
    /**
     * @OA\get(
     *     path="/api/vendors-sub-categories",
     *     summary="vendors sub categories",
     *     operationId="index",
     *    @OA\RequestBody(
     *    required=true,
     *
     * ),
     */

    public function index()
    {
        $vendorSubCategories=VendorCategory::where('parent_id','!=',null)->get();
        return responseJson(200,'success',$vendorSubCategories);

    }

    /**
     * @OA\Post (
     *     path="/api/vendors-sub-categories",
     *     summary="vendors sub categories",
     *     operationId="store",
     *    @OA\RequestBody(
     *    required=true,
     *      @OA\JsonContent(
     *       required={"name_en","name_ar","parent_id"},

     *    ),
     *
     * ),
     */
    public function store(Request $request)
    {
        $validator=Validator()->make($request->all(),[
            'name_en' => ['required', 'string', 'max:255','regex:/^[a-zA-Z\s]*$/'],
            'name_ar' => ['required', 'max:255','regex:/[ء-ي]+/'],
            'parent_id'=>'required'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'failed',$validator->errors());

        }
        $vendorSubCategory=VendorCategory::create($request->all());
        return responseJson(200,'success',$vendorSubCategory);

    }


    public function show($id)
    {
        //
    }

    /**
     * @OA\PUT  (
     *     path="/api/vendors-sub-categories",
     *     summary="vendors sub categories",
     *     operationId="update",
     *    @OA\RequestBody(
     *    required=true,
     *      @OA\JsonContent(
     *       required={"name_en","name_ar","parent_id"},

     *    ),
     *
     * ),
     */
    public function update(Request $request, $id)
    {
        $validator=Validator()->make($request->all(),[
            'name_en' => ['required', 'string', 'max:255','regex:/^[a-zA-Z\s]*$/'],
            'name_ar' => ['required', 'max:255','regex:/[ء-ي]+/'],
            'parent_id'=>'required'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'failed',$validator->errors());

        }
        $vendorCategory=VendorCategory::findorfail($id);
        $vendorCategory->update($request->all());
        return responseJson(200,'success',$vendorCategory);
    }

    /**
     * @OA\Delete  (
     *     path="/api/vendors-sub-categories",
     *     summary="vendors sub categories",
     *     operationId="destroy",
     */
    public function destroy($id)
    {
        $vendorCategory=VendorCategory::findorfail($id);

        $vendorCategory->delete();
        return responseJson(200,'success',$vendorCategory);
    }
}
