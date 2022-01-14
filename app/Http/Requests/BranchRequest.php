<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
        return [
            'name_en' => ['required', 'string', 'max:255','regex:/^[a-zA-Z\s]*$/'],
            'name_ar' => ['required', 'max:255','regex:/[ء-ي]+/'],
            'address'=>'nullable',
            'phone_number'=>'required|numeric',
            'longitude'=>'required',
            'latitude'=>'required',
            'contact_person_number'=>'required|numeric'
        ];
    }
}
