<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CreateBillRequest extends FormRequest
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
            'So_Hoadon' => 'required',
            'Codeorder' => 'required',
            'Codeorder' => Rule::unique('accoutant_order')->where(function ($query) {
                return $query->where('deleted_at', null);
            }),
            // 'note' => 'required'
        ];
    }
}
