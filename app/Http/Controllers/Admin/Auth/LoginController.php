<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function adminLoginForm()
    {
        return view('admin.auth.login');

    }
    public function adminLogin(AdminLoginRequest $request)
    {

        $remember_me=$request->has('remember_me')?true:false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->withErrors('message');


    }
    public function logout(){
        Auth('admin')->logout();

        return redirect()->route('admin.login');
    }
}
