<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddonRequest extends FormRequest
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
            'section_name_en' => ['required', 'string', 'max:255','regex:/^[a-zA-Z\s]*$/'],
            'section_name_ar' => ['required', 'max:255','regex:/[ء-ي]+/'],
            'quantity'=>'required|numeric',
            'addon_select_type'=>'required|in:1,2',
            'addon_name_en'=>['required', 'array'],
            'addon_name_ar'=>['required','array'],
            'price'=>'required',
            'quantity_meter'=>'required'
            ];
    }
}
