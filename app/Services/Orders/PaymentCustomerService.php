<?php

namespace App\Services\Orders;

use App\Http\Requests\Orders\PaymentCustomerRequest;
use App\Models\Bill;
use App\Models\PaymentCustomer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\PaymentCustomers\paymentCustomerExcel;

class PaymentCustomerService
{
    protected $paymentExcel;
    public function __construct(paymentCustomerExcel $paymentExcel)
    {
        $this->paymentExcel = $paymentExcel;
    }
    public function indexAll(Request $request)
    {
        $Uname = $request->Uname;
        $date_inprice = $request->date_inprice;
        $date_insert = $request->date_insert;
        $Sohoadon = $request->Sohoadon;
        $checkbox = $request->checkbox;
        // dd($request->all());
        $PCustomers = PaymentCustomer::query();

        if (!empty($Uname)) {
            $PCustomers = $PCustomers->where('uname', 'like', '%' . $Uname . '%');
        }

        if ($date_inprice && $date_insert) {
            $PCustomers = $PCustomers->whereBetween('dateget', [$date_inprice, $date_insert]);
        }

        if (!empty($Sohoadon)) {
            $PCustomers = $PCustomers->where('Sohoadon', 'like', '%' . $Sohoadon . '%');
        }

        $PCustomers = $PCustomers->orderByDesc('date_insert')->get();
        $PCustomers = $PCustomers->groupBy('depositID')->paginate(50);
        return ['PCustomers' => $PCustomers, 'Uname' => $Uname, 'date_inprice' => $date_inprice, 'date_insert' => $date_insert, 'Sohoadon' => $Sohoadon];
    }

    public function insert(PaymentCustomerRequest $request)
    {
        PaymentCustomer::create([
            'uname' => $request->uname,
            'depositID' => $request->depositId,
            'dateget' => $request->dateInprice,
            'date_insert' => now(),
            'note' => $request->note,
            'price_in' => $request->priceIn,
            'Sohoadon' => $request->SoHoadon
        ]);
        toastr()->success('Create successfully!', 'Notifycation');
        return back();
    }

    public function updateById(Request $request, $Id)
    {
        
        $paymentCustomer = PaymentCustomer::where("Id", $Id)->update([
            'uname' => $request->uname,
            'Sohoadon' => $request->sohoadon
        ]);

        if ($paymentCustomer) {
            return 1;
        } else {
            return 2;
        }
    }
}
