<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorSubCategoryRequest extends FormRequest
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
            'parent_id'=>'required'
        ];
    }
}
