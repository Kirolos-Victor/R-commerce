<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            'branch_id'=>'required',
            'country_id'=>'required',
            'delivery_time'=>'required|numeric',
            'delivery_fees'=>'required|numeric',
            'estimated_preparation_time'=>'required|numeric',
            'minimum_order_price'=>'required|numeric',
            'day'=>'required',
            'from'=>'required',
            'to'=>'required'


        ];
    }
}
