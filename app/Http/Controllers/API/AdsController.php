<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Vendor;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class AdsController extends Controller
{
    /**
     * @OA\get(
     *     path="/api/ads",
     *     summary="ads",
     *     operationId="index",
     *    @OA\RequestBody(
     *    required=true,
     *
     * ),
     */

    public function index()
    {
        $adsChocolate=Ads::where('type','=','chocolates')->get();
        $adsFlowers=Ads::where('type','=','flowers')->get();
        $adsPerfumes=Ads::where('type','=','perfumes')->get();

        return responseJson(200,'success',['chocolates'=>$adsChocolate,'flowers'=>$adsFlowers,'perfumes'=>$adsPerfumes]);

    }

    /**
     * @OA\post(
     *     path="/api/ads",
     *     summary="ads",
     *     operationId="store",
     *    @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"type","title","image","vendor_id"},

     *    ),
     * ),
     *

     * @OA\Response(
     *    response=400,
     *    description="validation error",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="type is required")
     *        )
     *     )
     * )
     */

    public function store(Request $request)
    {
        $validator=Validator()->make($request->all(),[
            'type'=>'required|in:flowers,perfumes,chocolates',
            'title'=>'required',
            'image'=>'image|mimes:jpeg,jpg,png,gif|required|max:1014',
            'vendor_id'=>'required'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'failed',$validator->errors());

        }
        if($request->has('image'))
        {
            $filePath = uploadImage('ads', $request->image);
        }
        //dd($filePath);
        $ads= Ads::create([
            'title'=>$request->title,
            'type'=>$request->type,
            'vendor_id'=>$request->vendor_id,
            'image'=>$filePath
        ]);
        return responseJson(200,'success',$ads);

    }
    /**
     * @OA\PUT(
     *     path="/api/ads/{id}",
     *     summary="ads",
     *     operationId="update",
     *    @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"type","title","image","vendor_id"},

     *    ),
     * ),
     *

     * @OA\Response(
     *    response=400,
     *    description="validation error",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="type is required")
     *        )
     *     )
     * )
     */

    public function update(Request $request, $id)
    {
        $validator=Validator()->make($request->all(),[
            'type'=>'required|in:flowers,perfumes,chocolates',
            'title'=>'required',
            'image'=>'image|mimes:jpeg,jpg,png,gif|nullable|max:1014',
            'vendor_id'=>'required'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'failed',$validator->errors());

        }
        $ads=Ads::findorfail($id);

        if($request->has('image'))
        {
            $filePath = uploadImage('ads', $request->image);
            if(file_exists(public_path($ads->image))){
                {
                    unlink($ads->image);
                }
            }
            $ads->update([
                'title'=>$request->title,
                'type'=>$request->type,
                'vendor_id'=>$request->vendor_id,
                'image'=>$filePath
            ]);
        }
        else{
            $ads->update($request->all());
        }
        return responseJson(200,'success',$ads);

    }

    /**
     * @OA\Delete (
     *     path="/api/ads/{id}",
     *     summary="ads",
     *     operationId="destory",
     *    @OA\RequestBody(
     *    required=true,
     *
     * ),
     *

     */
    public function destroy($id)
    {
        $ads=Ads::findorfail($id);
        if(file_exists(public_path($ads->image))){
            unlink($ads->image);
        }
        $ads->delete();
        return responseJson(200,'success',$ads);

    }
}
