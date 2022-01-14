<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromoCodeRequest extends FormRequest
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

        $rules=[

            'user_limit'=>'required|numeric'
        ];
        if($this->getMethod()=='POST')
        {
            $rules+=[
                'start_date'=>'required|date',
                'end_date'=>'required|date',
                'code'=>'required|unique:promo_codes,code',
                'type'=>'required|in:exact_amount,percentage',
                'minimum_total_cart_price'=>'required|numeric',
                'usage'=>'required|in:once,multiple'

            ];
        }
        else{
            $rules+=[
                'start_date'=>'nullable|date',
                'end_date'=>'nullable|date',
            ];
        }
        return $rules;
    }
}
