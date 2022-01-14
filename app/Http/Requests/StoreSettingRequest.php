<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
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
            'phone'=>'required|numeric',
            'cover_image'=>'image|mimes:jpeg,jpg,png,gif|max:1014',
            'logo'=>'image|mimes:jpeg,jpg,png,gif|max:1014',
            'meta_description'=>'required'

        ];
    }
}
