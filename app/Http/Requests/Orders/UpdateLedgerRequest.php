<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLedgerRequest extends FormRequest
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
            'eUname' => 'nullable|unique:accountant_socai,Uname,'.$this->Id,
            'ePriceIn' => 'required|numeric',
            'ePriceOut' => 'required|numeric',
            'ePricedelb' => 'required|numeric',
        ];
    }
}
