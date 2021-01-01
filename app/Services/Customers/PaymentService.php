<?php

namespace App\Services\Customers;

use Illuminate\Http\Request;
use App\Models\PaymentCustomer;
use Illuminate\Support\Facades\Auth;

class PaymentService
{
    public function index(Request $request){
        $Uname = Auth::user()->uname;
        $dateget = $request->dateget;
        $date_insert = $request->date_insert;
        $Sohoadon = $request->Sohoadon;

        $PCustomers = PaymentCustomer::query();

        if (!empty($Uname)) {
            $PCustomers = $PCustomers->where('uname', 'like', '%'.$Uname.'%');
        }

        if (!empty($dateget)) {
            $PCustomers = $PCustomers->whereDate('dateget', $dateget);
        }

        if (!empty($date_insert)) {
            $PCustomers = $PCustomers->whereDate('date_insert', $date_insert);
        }

        if (!empty($Sohoadon)) {
            $PCustomers = $PCustomers->where('Sohoadon', 'like', '%'.$Sohoadon.'%');
        }

        $PCustomers = $PCustomers->paginate(10);
        return ['PCustomers'=> $PCustomers, 'dateget' => $dateget, 'date_insert' => $date_insert, 'Sohoadon' => $Sohoadon];
    }
}
