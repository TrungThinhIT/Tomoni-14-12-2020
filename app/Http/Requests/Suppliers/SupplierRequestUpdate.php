<?php

namespace App\Http\Requests\Suppliers;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequestUpdate extends FormRequest
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
            'ecode' => 'required',
            'ename' => 'required',
            'email' => 'required|email',
            'eadd' => 'required',
            'ephone' => 'required|numeric',
            'ebank' => 'required',
            'ebranch' => 'required',
            'eAccountNumber' => 'required|numeric',
            'eAccountName' => 'required',
            'enote' => 'required',
            'erank' => 'required'
        ];
    }
}
