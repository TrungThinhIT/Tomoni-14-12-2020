<?php

namespace App\Http\Requests\Suppliers;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'ucode' => 'required|unique:supplier,code_name',
            'uname' => 'required',
            'umail' => 'required|email',
            'uadd' => 'required',
            'uphone' => 'required|numeric',
            'ubank' => 'required',
            'ubranch' => 'required',
            'uAccountNumber' => 'required|numeric|unique:supplier,AccountNumber',
            'uAccountName' => 'required',
            'unote' => 'required',
            'urank' => 'required'
        ];
    }
}
