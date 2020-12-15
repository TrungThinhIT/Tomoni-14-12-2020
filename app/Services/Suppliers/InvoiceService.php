<?php

namespace App\Services\Suppliers;

use App\Http\Requests\Suppliers\InvoiceRequest;
use App\Models\InvoiceSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceService
{

    public function showList(Request $request)
    {
        $suppliers = DB::table('supplier')->get();

        $request->record ? $record = $request->record : $record = 10;
        $uinvoice = $request->uinvoice;
        $supplier = $request->supplier;
        $productName = $request->productName;
        $webOrder = $request->webOrder;
        $janCode = $request->janCode;
        $paymentDate = $request->paymentDate;
        $stockDate = $request->stockDate;

        $invoices = InvoiceSupplier::query();
        if (isset($uinvoice)) {
            $invoices = InvoiceSupplier::where('Invoice', '=', $uinvoice);
        }
        if (isset($supplier)) {
            $invoices = InvoiceSupplier::where('Supplier', '=', $supplier);
        }
        if (isset($productName)) {
            $invoices = InvoiceSupplier::whereHas('detail.product', function ($query) use ($productName) {
                return $query->where('name', 'like', $productName . '%');
            });
        }
        if (isset($webOrder)) {
            $invoices = InvoiceSupplier::whereHas('detail', function ($query) use ($webOrder) {
                return $query->where('Codeorder', $webOrder);
            });
        }
        if (isset($janCode)) {
            $invoices = InvoiceSupplier::whereHas('detail', function ($query) use ($janCode) {
                return $query->where('jancode', $janCode);
            });
        }
        if (isset($paymentDate)) {
            $invoices = InvoiceSupplier::whereDate('PaymentDate', $paymentDate);
        }
        if (isset($stockDate)) {
            $invoices = InvoiceSupplier::where('StockDate', $stockDate);
        }
        $invoices = $invoices->paginate($record);

        $data = ['invoices' => $invoices, 'suppliers' => $suppliers, 'record' => $record,
         'productName' => $productName, 'uinvoice' => $uinvoice, 'supplier'=> $supplier,
        'webOrder'=> $webOrder, 'janCode' => $janCode, 'paymentDate'=> $paymentDate, 'stockDate'=> $stockDate];
        return $data;
    }

    public function createNew(InvoiceRequest $request)
    {
        dd($request->all());
    }
}
