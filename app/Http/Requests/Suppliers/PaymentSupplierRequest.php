<?php

namespace App\Http\Requests\Suppliers;

use Illuminate\Foundation\Http\FormRequest;

class PaymentSupplierRequest extends FormRequest
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
            'depositID' => 'required',
            'SupplierId'=> 'required',
            'dateget' => 'required',
            'date_insert' => 'required',
            'price_in' => 'required',
            'price_out' => 'required',
            'type_price' => 'required',
            'cardID' => 'required',
            'note' => 'required',
            'useradmin' => 'required|exists:users,uname',
            'Sohoadon' => 'required|exists:acountant_hddv,Invoice'
        ];
    }
}
