<?php

namespace App\Http\Requests\warehouse;

use Illuminate\Foundation\Http\FormRequest;

class productRealityRequest extends FormRequest
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
            'CodeOrder'=>'required|exists:oder,codeorder',
            'selectUname'=>'required',
            'Invoice'=>'required',
            'Container'=>'required',
            'quantity'=>'required',
            'Image'=>'required|image|mimes:png,jpg,jpeg,svg',
            'selectedAddress'=>'required',
            // 'DeliveryDate' => 'required|date',
            // 'DeliveryTime' => 'required',
        ];
    }
}
