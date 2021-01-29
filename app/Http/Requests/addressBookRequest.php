<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addressBookRequest extends FormRequest
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
            //
            'selectUname' => 'required',
            'City' => 'required',
            'Phone' => 'required',
            'DeliveryTime' => 'required',
            'District' => 'required',
            'Ward' => 'required',
            'StreetHome' => 'required',
        ];
    }
}
