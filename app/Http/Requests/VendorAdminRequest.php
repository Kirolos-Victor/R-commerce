<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $vendor_admin=$this->route('vendor_admin');
       $rules=[
           'name'=>'required',
           'type'=>'required|in:owner,manager',
           'vendor_id'=>'required',
       ];
       if($this->getMethod()=='POST')
       {
           $rules+=[
               'password'=>'required|min:6',
               'email'=>'required|email|unique:vendor_admins,email',
           ];
       }
       else{
           $rules+=[
               'password'=>'nullable|min:6',
               'email'=>'required|email|unique:vendor_admins,email,'.$vendor_admin->id,
           ];
       }
       return $rules;
    }
}
