<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function index(Request $request){

        $validator=Validator()->make($request->all(),[
            'user_id'=>'required'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'failed',$validator->errors());

        }

        $addresses=UserAddress::where('user_id','=',$request->user_id)->get();
        return responseJson(200,'success',$addresses);
    }
}
