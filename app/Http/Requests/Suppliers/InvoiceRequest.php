<?php

namespace App\Http\Requests\Suppliers;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            // 'uinvoice' => 'required|min:3|max:6',
            // 'Dateinvoice' => 'required|date',
            // 'uTotalPrice' => 'required',
            // 'uPurchaseCosts' => 'required',
            // 'TaxPurchaseCosts' => 'required',
            // 'unamesupplier' => 'required',
            // 'Buyer' => 'required',
            // 'PaymentDate' => 'required',
            // 'StockDate' => 'required',
            // 'uTracking' => 'required',
            // 'PaidInvoice' => 'required',
            // 'Typehoadon' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'uinvoice.required' => 'Không được để trống',
            'uinvoice.min' => 'Quá ngắn',
            'uinvoice.max' => 'Quá dài',

            'Dateinvoice.required' => 'Không được để trống',
            'Dateinvoice.date' => 'Phải là dạng ngày',
        ];
    }
}
