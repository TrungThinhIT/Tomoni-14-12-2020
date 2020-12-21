<?php

namespace App\Services\Orders;

use App\Models\PaymentCustomer;
use Illuminate\Http\Request;

class PaymentCustomerService
{
    public function indexAll(){
        $PCustomers = PaymentCustomer::paginate(10);
        return ['PCustomers'=> $PCustomers];
    }

    public function updateById(Request $request, $Id){
        $paymentCustomer = PaymentCustomer::where("Id", $Id)->update([
'uname' => $request->uname,
'Sohoadon' => $request->sohoadon
        ]);

        if($paymentCustomer){
            return 1;
        }else{
            return 2;
        }
    }

}
