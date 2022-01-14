<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\CategoryVendor;
use App\Models\Vendor;
use App\Models\VendorCategory;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * @OA\get(
     *     path="/api/vendors",
     *     summary="vendors",
     *     operationId="index",
     *    @OA\RequestBody(
     *    required=true,
     *
     * ),
     */
    public function index()
    {
        $vendors=Vendor::paginate();
        return responseJson(200,'success',$vendors);
    }
    /**
     * @OA\get(
     *     path="/api/vendors/category",
     *     summary="vendors",
     *     operationId="vendorByCategory",
     *    @OA\RequestBody(
     *    required=true,
     *      @OA\JsonContent(
     *       required={"vendor_category_id"},

     *    ),
     *
     * ),
     */
    public function vendorByCategory(Request $request)
    {
        $validator=Validator()->make($request->all(),[
            'vendor_category_id'=>'required'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'failed',$validator->errors());

        }
        $vendors=CategoryVendor::with('vendors')
            ->where('vendor_category_id','=',$request->vendor_category_id)
            ->get()
            ->pluck('vendors');

        return responseJson(200,'success',$vendors);

    }

}
