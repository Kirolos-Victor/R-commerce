<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorLoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function vendorLoginForm()
    {
        return view('vendor.auth.login');

    }
    public function vendorLogin(VendorLoginRequest $request)
    {

        $remember_me=$request->has('remember_me')?true:false;

        if (auth()->guard('vendor')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            return redirect()->route('vendor.dashboard');
        }
        return redirect()->back()->withErrors('message');


    }
    public function logout(){
        Auth('vendor')->logout();

        return redirect()->route('vendor.login');
    }
}
