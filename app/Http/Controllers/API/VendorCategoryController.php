<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\VendorCategory;
use Illuminate\Http\Request;

class VendorCategoryController extends Controller
{

    /**
     * @OA\get(
     *     path="/api/vendor-categories",
     *     summary="ads",
     *     operationId="index",
     *    @OA\RequestBody(
     *    required=true,
     *
     * ),
     */
    public function index()
    {
        $vendorCategories = VendorCategory::query()->where('is_active', '=', true)->where('parent_id', '=', null)->withCount('subCategories')->paginate(10);
        $vendorCategories = $vendorCategories->map(function ($vendorCategory) {
            return [
                'id' => $vendorCategory->id,
                'parent_id' => $vendorCategory->parent_id,
                'name_ar' => $vendorCategory->name_ar,
                'name_en' => $vendorCategory->name_en,
                'subCategoriesCount' => $vendorCategory->subCategoriesCount,
                'created_at' => $vendorCategory->created_at,
                'updated_at' => $vendorCategory->updated_at,
                'image' => asset($vendorCategory->image),
            ];
        });
        return responseJson(200, 'success', $vendorCategories);
    }

    /**
     * @OA\get(
     *     path="/api/vendor-categories",
     *     summary="sub categories",
     *     operationId="subCategories",
     *    @OA\RequestBody(
     *    required=true,
     *      @OA\JsonContent(
     *       required={"vendor_main_category_id"},
     *    ),
     *
     * ),
     */
    public function subCategories(Request $request)
    {
        $validator = Validator()->make($request->all(), [

            'vendor_main_category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return responseJson(400, 'failed', $validator->errors());

        }
        $vendorSubCategories = VendorCategory::where('parent_id', '=', $request->vendor_main_category_id)->get();
        return responseJson(200, 'success', $vendorSubCategories);
    }


}
