<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class PaymentCustomerRequest extends FormRequest
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
            'depositId' => 'required|unique:quanlythe,depositID,except,id',
            'uname' => 'required|exists:users,uname',
            'note' => 'required',
            'dateInprice' => 'required|date',
            'priceIn' => 'required|numeric',
            // 'SoHoadon' => 'exists:accoutant_order,So_Hoadon'
        ];
    }
}
