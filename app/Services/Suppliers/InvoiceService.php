<?php

namespace App\Services\Suppliers;

use App\Http\Requests\Suppliers\AddInvoiceDetailRequest;
use App\Http\Requests\Suppliers\InvoiceDetailRequest;
use App\Http\Requests\Suppliers\InvoiceRequest;
use App\Http\Requests\Suppliers\UpdateInvoiceDetailRequest;
use App\Models\InvoiceDetailSupplier;
use App\Models\InvoiceSupplier;
use App\Models\LogInvoiceDetailSupplier;
use App\Models\LogInvoiceSupplier;
use App\Models\ProductStandard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceService
{

    public function showList(Request $request)
    {
        $suppliers = DB::table('supplier')->get();
        $accounts = InvoiceSupplier::select('Account')->get();

        $request->record ? $record = $request->record : $record = 10;
        $sinvoice = $request->sinvoice;
        $supplier = $request->supplier;
        $productName = $request->productName;
        $webOrder = $request->webOrder;
        $janCode = $request->janCode;
        $paymentDate = $request->paymentDate;
        $stockDate = $request->stockDate;

        $invoices = InvoiceSupplier::query();
        if (isset($sinvoice)) {
            $invoices = InvoiceSupplier::where('Invoice', '=', $sinvoice);
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
        $invoices = $invoices->with('detail.product')->orderBy('Id', 'DESC')->get();

        foreach($invoices as $value){
            foreach($value['detail'] as $product){
                $product_standard = DB::table('product_standard')->where('jan_code', $product->Jancode)->first();
                if($product_standard != null){
                 $name =  $product_standard->name;
                $product->setAttribute('name', $name);
                    if($product_standard->weight > 0 && $product_standard->length > 0 && $product_standard->width && $product_standard->height > 0){
                        $product->setAttribute('checkStatus', 1);
                    }else{
                        $product->setAttribute('checkStatus', 0);
                    }
                }
            }
        }
        
        $invoices = $invoices->paginate($record);
        return ['invoices' => $invoices, 'accounts' => $accounts, 'suppliers' => $suppliers, 'record' => $record,
         'productName' => $productName, 'sinvoice' => $sinvoice, 'supplier'=> $supplier,
        'webOrder'=> $webOrder, 'janCode' => $janCode, 'paymentDate'=> $paymentDate, 'stockDate'=> $stockDate];
    }

    public function showInvoiceById($Id){
        $priceInvoice = 0;
        $suppliers = DB::table('supplier')->get();
        $object = InvoiceSupplier::where('Id', $Id)->with('detail.product')->first();
        $priceInvoice = ($object->TotalPrice + $object->PurchaseCosts);
        $priceDetail = 0;

        foreach ($object['detail'] as $key => $value) {
            $priceDetail +=  $value->Quantity * $value->Price;
        }

        

        return ['object'=> $object, 'suppliers' => $suppliers, 'priceInvoice'=> $priceInvoice, 'priceDetail' => $priceDetail];
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

    public function deleteInvoice($Invoice){
        LogInvoiceSupplier::create([
            'Invoice' => $Invoice,
            'action' => 'delete',
            'uname' => Auth::user()->uname
        ]);

        $invoiceDetails = InvoiceDetailSupplier::where('Invoice', $Invoice)->get();
        
        InvoiceSupplier::where('Invoice', $Invoice)->delete();
        InvoiceDetailSupplier::where('Invoice', $Invoice)->delete();

        foreach ($invoiceDetails as $value) {
            LogInvoiceDetailSupplier::create([
                'uname' => Auth::user()->uname,
                'action' => 'delete',
                'Invoice' => $Invoice,
                'Jancode' => $value->Jancode,
                'Codeorder' => $value->Codeorder
            ]);
        }

        toastr()->success('Delete success fully!', 'Notifycation');
        return back();
    }

    public function deleteInvoiceDetail($Id){
        $invoiceDetails = InvoiceDetailSupplier::where('Id', $Id)->first();
        
        LogInvoiceDetailSupplier::create([
            'Invoice' => $invoiceDetails->Invoice,
            'action' => 'delete',
            'Jancode' => $invoiceDetails->Jancode,
            'Codeorder' => $invoiceDetails->Codeorder,
            'uname' => Auth::user()->uname
        ]);
        
        try {
            InvoiceDetailSupplier::where('Id', $Id)->delete();
            $invoiceDetails = InvoiceDetailSupplier::where('Invoice', $invoiceDetails->Invoice)->get();
            $totalPriceInvoiceDetails = 0;
        foreach ($invoiceDetails as $value) {
            $totalPriceInvoiceDetails += ($value->Price * $value->Quantity);
        }
            return response()->json([5, $invoiceDetails, $totalPriceInvoiceDetails]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

        // toastr()->success('Delete success fully!', 'Notifycation');

    public function searchCodeOrder(Request $request){
        $codeOrders = DB::table('oder')->where('codeorder', 'like', '%'. $request->search_ordercode ."%")->orderBy('codeorder', 'DESC')->limit(10)->orderBy('dateget', 'ASC')->get();

        return response()->json($codeOrders);
    }

    public function searchCodeJan(Request $request){
        $codeJans = DB::table('product_standard')->where('jan_code', 'like', '%'. $request->search_jancode ."%")->orderBy('jan_code', 'DESC')->limit(20)->get();
        return response()->json($codeJans);
    }

    public function createInvoice(InvoiceRequest $request)
    {
           $invoice = InvoiceSupplier::create([
                'Invoice' => $request->uinvoice,
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

           LogInvoiceSupplier::create([
               'Invoice' => $request->uinvoice,
               'action' => 'insert',
               'uname' => Auth::user()->uname
           ]);

           if($invoice){
               return 1;
           }
    }

    public function createInvoiceDetail(InvoiceDetailRequest $request)
    {
        $invoiceDetail = InvoiceDetailSupplier::create([
           'Codeorder' => $request->CodeorderItem,
           'jancode' => $request->Jancode,
           'Quantity' => $request->Quantity,
           'Price' => $request->Price,
           'PriceTax' => $request->PriceTax,
           'Invoice' => $request->Invoice
        ]);

        LogInvoiceDetailSupplier::create([
            'uname' => Auth::user()->uname,
            'action' => 'insert',
            'Invoice' => $request->Invoice,
            'Jancode' => $request->Jancode,
            'Codeorder' => $request->CodeorderItem
        ]);

        if($invoiceDetail){
        return 1;
        }
    }

    public function updateInvoice(Request $request, $Id){
        $totalPriceCurrentInvoice = $request->TotalPrice + $request->PurchaseCosts;
        $invoiceDetails = InvoiceDetailSupplier::where('Invoice', $request->Invoice)->get();
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

            LogInvoiceSupplier::create([
                'Invoice' => $request->Invoice,
                'action' => 'update',
                'uname' => Auth::user()->uname
            ]);
            return [1, $totalPriceCurrentInvoice, $totalPriceInvoiceDetails];
        }else{
            return 2;
        }
    }

    public function updateInvoiceDetail(UpdateInvoiceDetailRequest $request, $Id){
        $currentInvoiceDetail = InvoiceDetailSupplier::where('Id', $Id)->first();
        $invoiceDetails = InvoiceDetailSupplier::where('Invoice', $currentInvoiceDetail->Invoice)->where('Id', '!=', $currentInvoiceDetail->Id)->get();
        $totalPriceInvoice = InvoiceSupplier::where('Invoice', $currentInvoiceDetail->Invoice)->first()->TotalPrice + InvoiceSupplier::where('Invoice', $currentInvoiceDetail->Invoice)->first()->PurchaseCosts;
        $totalPriceInvoiceDetails = 0;
        foreach ($invoiceDetails as $value) {
            $totalPriceInvoiceDetails += ($value->Price * $value->Quantity);
        }
        $currentTotalPrice = $totalPriceInvoiceDetails + ($request->quantity * $request->price);
            if($currentTotalPrice <= $totalPriceInvoice){
                InvoiceDetailSupplier::where('Id', $Id)->update([
                'Codeorder' => $request->codeorder,
                'Jancode' => $request->Jancode,
                'Quantity' => $request->quantity,
                'Price' => $request->price,
                'PriceTax' => $request->tax
            ]);
            LogInvoiceDetailSupplier::create([
                'uname' => Auth::user()->uname,
                'action' => 'update',
                'Invoice' => $currentInvoiceDetail->Invoice,
                'Jancode' => $request->Jancode,
                'Codeorder' => $request->codeorder
            ]);
            return [1, $currentTotalPrice];
            }else{
                return 2;
            }
    }

    public function createMoreInvoiceDetail(AddInvoiceDetailRequest $request, $Invoice)
    {
        InvoiceDetailSupplier::create([
           'Codeorder' => $request->Codeorder,
           'jancode' => $request->Jancode,
           'Quantity' => $request->Quantity,
           'Price' => $request->Price,
           'PriceTax' => $request->PriceTax,
           'Invoice' => $request->Invoice
        ]);

        LogInvoiceDetailSupplier::create([
            'uname' => Auth::user()->uname,
            'action' => 'insert',
            'Invoice' => $request->Invoice,
            'Jancode' => $request->Jancode,
            'Codeorder' => $request->Codeorder
        ]);

        $invoiceDetail = InvoiceDetailSupplier::where('Invoice', $Invoice)->where('Jancode', $request->Jancode)->first();

        $Invoice = InvoiceSupplier::where('Invoice', $Invoice)->first();

        $totalPriceInvoice = $Invoice->TotalPrice + $Invoice->PurchaseCosts;

        $invoiceDetails =  InvoiceDetailSupplier::where('Invoice', $request->Invoice)->get();

        $totalPriceInvoiceDetail = 0;
        foreach($invoiceDetails as $value){
            $totalPriceInvoiceDetail += $value->Price * $value->Quantity;
        }
        return response()->json([
            'invoiceAdd' => $invoiceDetail,
            'totalPriceInvoice' => $totalPriceInvoice,
            'totalPriceInvoiceDetail' => $totalPriceInvoiceDetail
        ]);
    }
}
