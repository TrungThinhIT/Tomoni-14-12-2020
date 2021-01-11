<?php

namespace App\Http\Requests\Suppliers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UpdateInvoiceDetailRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'Jancode' => ['required', Rule::unique('acountant_jancodeitem')->ignore($this->Id)->where(function ($query) use($request) {
                $query->where('Invoice', $request->Invoice);
            })]
        ];
    }
}
