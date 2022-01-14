<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name_en' => ['required', 'string', 'max:255','regex:/^[A-Za-z. -]+$/'],
            'name_ar' => ['required', 'max:255','regex:/[ء-ي]+/'],
            'description_en' => ['required', 'string', 'max:30','regex:/^[A-Za-z. -]+$/'],
            'description_ar' => ['required', 'max:30','regex:/[ء-ي]+/'],
            'amount'=>'required|numeric',
            'image.*' => 'nullable|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048',
            'price'=>'required|numeric',
            'cost'=>'required|numeric',
            'branches'=>'required',

        ];
    }
}
