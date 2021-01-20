<?php

namespace App\Services\Orders;

use App\Http\Requests\Orders\PaymentCustomerRequest;
use App\Models\PaymentCustomer;
use Illuminate\Http\Request;

class PaymentCustomerService
{
    public function indexAll(Request $request)
    {
        $Uname = $request->Uname;
        $date_inprice = $request->date_inprice;
        $date_insert = $request->date_insert;
        $Sohoadon = $request->Sohoadon;

        $PCustomers = PaymentCustomer::query();

        if (!empty($Uname)) {
            $PCustomers = $PCustomers->where('uname', 'like', '%' . $Uname . '%');
        }

        if($date_inprice && $date_insert){
            $PCustomers = $PCustomers->whereBetween('dateget', [$date_inprice, $date_insert]);
        }

        if (!empty($Sohoadon)) {
            $PCustomers = $PCustomers->where('Sohoadon', 'like', '%' . $Sohoadon . '%');
        }

        $PCustomers = $PCustomers->orderByDesc('date_insert')->paginate(10);
        return ['PCustomers' => $PCustomers, 'Uname' => $Uname, 'date_inprice' => $date_inprice, 'date_insert' => $date_insert, 'Sohoadon' => $Sohoadon];
    }

    public function insert(PaymentCustomerRequest $request){
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
