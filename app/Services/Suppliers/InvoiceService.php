<?php

namespace App\Services\Suppliers;

use App\Http\Requests\Suppliers\InvoiceRequest;
use App\Models\InvoiceDetailSupllier;
use App\Models\InvoiceSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceService
{

    public function showList(Request $request)
    {
        $suppliers = DB::table('supplier')->get();
        $accounts = InvoiceSupplier::select('Account')->get();

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
        $invoices = $invoices->orderBy('Dateinsert', 'DESC')->paginate($record);

        $data = ['invoices' => $invoices, 'accounts' => $accounts, 'suppliers' => $suppliers, 'record' => $record,
         'productName' => $productName, 'uinvoice' => $uinvoice, 'supplier'=> $supplier,
        'webOrder'=> $webOrder, 'janCode' => $janCode, 'paymentDate'=> $paymentDate, 'stockDate'=> $stockDate];
        return $data;
    }

    public function showInvoice($Invoice){
        $total = 0;
        $ids = [];
        $suppliers = DB::table('supplier')->get();
        $object = InvoiceSupplier::where('Invoice', $Invoice)->with('detail.product')->first();
        foreach ($object['detail'] as $key => $value) {
            $total +=  $value->Quantity * $value->Price;
            array_push($ids, $value->Id);
        }
        $data = ['object'=> $object, 'suppliers' => $suppliers, 'total'=> $total];
        $html = view('suppliers.includes.modalInvoiceDetail',compact('data', 'ids'));
        return $html;
    }

    public function searchCodeOrder(Request $request){
        $codeOrders = DB::table('oder')->where('codeorder', 'like', '%'. $request->search_ordercode ."%")->orderBy('codeorder', 'DESC')->limit(20)->get();

        return response()->json($codeOrders);
    }

    public function searchCodeJan(Request $request){
        $codeJans = DB::table('product_standard')->where('jan_code', 'like', '%'. $request->search_jancode ."%")->orderBy('jan_code', 'DESC')->limit(20)->get();
        return response()->json($codeJans);
    }

    public function createInvoice(InvoiceRequest $request)
    {
           $invoice = InvoiceSupplier::create([
                'Invoice' => $request->Insert_Invoice,
                'TotalPrice' => $request->TotalPrice,
                'PurchaseCosts' => $request->PurchaseCosts,
                'TaxPurchaseCosts' => $request->TaxPurchaseCosts,
                'Supplier' => $request->UnameSupplier,
                'PaymentDate' => $request->PaymentDate,
                'StockDate' => $request->StockDate,
                'InvoiceStatus' => $request->PaidInvoice,
                'TypeInvoice' => $request->Typehoadon,
                'Buyer' => $request->Buyer,
                'Dateinvoice' => $request->Dateinvoice,
                'Trackingnumber' => $request->Trackingnumber
           ]);

           if($invoice){
               return 1;
           }
    }

    public function createInvoiceDetail(Request $request)
    {
        $invoiceDetail = InvoiceDetailSupllier::create([
           'Codeorder' => $request->CodeorderItem,
           'jancode' => $request->Jancode,
           'Quantity' => $request->Quantity,
           'Price' => $request->Price,
           'PriceTax' => $request->PriceTax,
           'Invoice' => $request->Invoice
        ]);

        if($invoiceDetail){
        return 1;
        }
    }

    public function updateInvoice(Request $request, $Id){
        $totalPriceCurrentInvoice = $request->TotalPrice;
        $invoiceDetails = InvoiceDetailSupllier::where('Invoice', $request->Invoice)->get();
        $totalPriceInvoiceDetails = 0;
        foreach ($invoiceDetails as $value) {
            $totalPriceInvoiceDetails += ($value->Price * $value->Quantity);
        }
        if($totalPriceCurrentInvoice >= $totalPriceInvoiceDetails){
            InvoiceSupplier::where('Id', $Id)->update([
                'Invoice' => $request->Invoice,
                'TypeInvoice' => $request->TypeInvoice,
                'TotalPrice' => $request->TotalPrice,
                'PurchaseCosts' => $request->PurchaseCosts,
                'TaxPurchaseCosts' => $request->TaxPurchaseCosts,
                'InvoiceStatus' => $request->InvoiceStatus,
                'Supplier' => $request->Supplier,
                'PaymentDate' => $request->PaymentDate,
                'StockDate' => $request->StockDate,
                'DateInvoice' => $request->DateInvoice,
                'Buyer' => $request->Buyer,
                'TrackingNumber' => $request->TrackingNumber
            ]);
            return 1;
        }else{
            return 2;
        }
    }

    public function updateInvoiceDetail(Request $request, $Id){
        $currentInvoiceDetail = InvoiceDetailSupllier::where('Id', $Id)->first();
        $invoiceDetails = InvoiceDetailSupllier::where('Invoice', $currentInvoiceDetail->Invoice)->where('Id', '!=', $currentInvoiceDetail->Id)->get();
        $totalPriceInvoice = InvoiceSupplier::where('Invoice', $currentInvoiceDetail->Invoice)->first()->TotalPrice;
        $totalPriceInvoiceDetails = 0;
        foreach ($invoiceDetails as $value) {
            $totalPriceInvoiceDetails += ($value->Price * $value->Quantity);
        }
        $currentTotalPrice = $totalPriceInvoiceDetails + ($request->quantity * $request->price);
        if($currentTotalPrice <= $totalPriceInvoice){
        InvoiceDetailSupllier::where('Id', $Id)->update([
            'Codeorder' => $request->codeorder,
            'Jancode' => $request->jancode,
            'Quantity' => $request->quantity,
            'Price' => $request->price,
            'PriceTax' => $request->tax
        ]);
        return 1;
        }else{
            return 2;
        }
    }
}
