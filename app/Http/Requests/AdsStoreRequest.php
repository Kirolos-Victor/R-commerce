<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdsStoreRequest extends FormRequest
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
            'type'=>'required|in:flowers,perfumes,chocolates',
            'title'=>'required',
            'image'=>'image|mimes:jpeg,jpg,png,gif|required|max:1014',
            'vendor_id'=>'required'
        ];
    }
}
