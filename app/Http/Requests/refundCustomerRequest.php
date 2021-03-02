<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class refundCustomerRequest extends FormRequest
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
            'depositId'=>'required',
            'dateInprice'=>'required|date',
            'priceIn'=>'required|',
            'uname'=>'required|exists:users,uname'
        ];
    }
}