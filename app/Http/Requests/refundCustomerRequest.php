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
            'dateInprice' => 'required|date',
            'priceIn' => 'required|',
            'uname' => 'required|exists:users,uname',
            'SoHoadon' => 'required|exists:accoutant_order,So_Hoadon'
        ];
    }
}
