<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users=User::paginate(10);
        return view('admin.users.index',compact('users'));

    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        if($request->active != null)
        {
            $active=1;
        }
        else
        {
            $active=0;
        }

        User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'active'=>$active
        ]);
        return redirect()->route('users.index')->with('message','You have Successfully created a new user.');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user=User::findorfail($id);
        return view('admin.users.edit',compact('user'));
    }


    public function update(UserRequest $request, $id)
    {
        if($request->active != null)
        {
            $active=1;
        }
        else
        {
            $active=0;
        }
        $user=User::findorfail($id);
        $user->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'active'=>$active
        ]);
        if($request->has('password'))
        {
            $user->update([
                'password'=>Hash::make($request->password)
            ]);
        }
        return redirect()->route('users.index')->with('message','You have Successfully updated the user.');

    }


    public function destroy($id)
    {
        $user=User::findorfail($id);
        $user->delete();

        return redirect()->back()->with('message','You have successfully deleted the user');

    }
    public function order($id){
        $orders=UserOrder::where('user_id','=',$id)->paginate(10);
        return view('admin.users.order',compact('orders'));

    }
}
