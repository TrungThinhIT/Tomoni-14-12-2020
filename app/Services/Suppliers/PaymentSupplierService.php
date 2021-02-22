<?php

namespace App\Services\Suppliers;

use App\Http\Requests\Suppliers\PaymentSupplierRequest;
use App\Models\InvoiceSupplier;
use App\Models\LogPaymentSupplier;
use App\Models\PaymentSupplier;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentSupplierService
{

    public function index(Request $request)
    {
        $suppliers = DB::table('supplier')->get();
        $sSupplierId = $request->sSupplierId;
        $date_inprice = $request->date_inprice;
        $date_insert = $request->date_insert;
        $Sohoadon = $request->Sohoadon;

        $payments = PaymentSupplier::query();
        if ($sSupplierId) {
            $payments = $payments->where('SupplierId', $sSupplierId);
        }

        if ($date_inprice) {
            $payments = $payments->whereDate('dateget', $date_inprice);
        }

        if ($date_insert) {
            $payments = $payments->whereDate('date_insert', $date_insert);
        }

        if ($Sohoadon) {
            $payments = $payments->where('Sohoadon', 'like', '%' . $Sohoadon . '%');
        }

        $payments = $payments->orderBy('Id', 'DESC')->paginate(10);
        return ['payments' => $payments, 'suppliers' => $suppliers, 'sSupplierId' => $sSupplierId, 'date_inprice' => $date_inprice, 'date_insert' => $date_insert, 'Sohoadon' => $Sohoadon];
    }

    public function create(PaymentSupplierRequest $request)
    {
        $payment = PaymentSupplier::create(
            $request->all()
        );

        LogPaymentSupplier::create([
            'PaymentSupplierId' => $payment->Id,
            'SupplierId' => $request->SupplierId,
            'Sohoadon' => $request->Sohoadon,
            'uname' => Auth::user()->uname,
            'action' => 'insert'
        ]);
        toastr()->success('Insert success fully!', 'Notifycation');
        return back();
    }

    public function update(Request $request, $Id)
    {
        $suppliers = Supplier::where('code_name', $request->SupplierId)->first();
        $billCode = InvoiceSupplier::where('Invoice', $request->Sohoadon)->first();
        if (empty($suppliers) || empty($billCode)) {
            return response()->json(['error' => !empty($suppliers) ? "Số hóa đơn " . $request->Sohoadon . " Không tồn tại " : "ID nhà cung cấp " . $request->SupplierId . " Khồng tồn tại"]);
        }
        if (PaymentSupplier::where('Id', $Id)->update([
            'SupplierId' => $request->SupplierId,
            'Sohoadon' => $request->Sohoadon
        ])) {
            $payment = PaymentSupplier::where('Id', $Id)->first();

            LogPaymentSupplier::create([
                'PaymentSupplierId' => $payment->Id,
                'SupplierId' => $payment->SupplierId,
                'Sohoadon' => $payment->Sohoadon,
                'uname' => Auth::user()->uname,
                'action' => 'insert'
            ]);
            return 1;
        }

        // $payment = PaymentSupplier::where('Id', $Id)->first();

        // LogPaymentSupplier::create([
        //     'PaymentSupplierId' => $payment->Id,
        //     'SupplierId' => $payment->SupplierId,
        //     'Sohoadon' => $payment->Sohoadon,
        //     'uname' => Auth::user()->uname,
        //     'action' => 'insert'
        // ]);
    }

    public function delete($Id)
    {
        $payment = PaymentSupplier::where('Id', $Id)->first();
        LogPaymentSupplier::create([
            'PaymentSupplierId' => $payment->Id,
            'SupplierId' => $payment->SupplierId,
            'Sohoadon' => $payment->Sohoadon,
            'uname' => Auth::user()->uname,
            'action' => 'delete'
        ]);
        toastr()->success('Delete success fully!', 'Notifycation');
        PaymentSupplier::find($Id)->delete();
        return back();
    }

    public function searchInvoice(Request $request)
    {
        return InvoiceSupplier::where('Invoice', 'like', '%' . $request->invoice . '%')->limit(10)->get();
    }

    public function searchSupplier(Request $request)
    {
        return Supplier::where('name', 'like', '%' . $request->supplier . '%')->limit(10)->get();
    }
}
