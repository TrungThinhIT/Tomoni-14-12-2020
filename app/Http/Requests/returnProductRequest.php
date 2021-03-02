<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class returnProductRequest extends FormRequest
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
            'uname'=>'required|exists:users,uname',
            'Jancode'=>'required',
            'Quantity'=>'required',
            'price'=>'required',
            'CodeOrder'=>'required|exists:accoutant_order,Codeorder'
        ];
    }
}
