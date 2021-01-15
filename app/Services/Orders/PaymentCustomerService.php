<?php

namespace App\Services\Orders;

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

        $PCustomers = $PCustomers->orderByDesc('dateget')->paginate(10);
        return ['PCustomers' => $PCustomers, 'Uname' => $Uname, 'date_inprice' => $date_inprice, 'date_insert' => $date_insert, 'Sohoadon' => $Sohoadon];
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
