<?php

namespace App\Services\Customers;

use Illuminate\Http\Request;
use App\Models\PaymentCustomer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PaymentService
{
    public function index(Request $request){
        $Uname = Auth::user()->uname;
        $dateget = $request->dateget;
        $date_insert = $request->date_insert;
        $Sohoadon = $request->Sohoadon;

        $date = Carbon::parse($date_insert);
        $date_insert = $date->addDays(1);

        $PCustomers = PaymentCustomer::where('uname', $Uname);

        if($dateget && $date_insert){
          $PCustomers = $PCustomers->whereBetween('dateget', [$dateget, $date_insert]);
        }

        if ($Sohoadon) {
            $PCustomers = $PCustomers->where('Sohoadon', 'like', '%'.$Sohoadon.'%');
        }

        $PCustomers = $PCustomers->orderByDesc('dateget')->paginate(10);
        return ['PCustomers'=> $PCustomers, 'dateget' => $dateget, 'date_insert' => $date_insert, 'Sohoadon' => $Sohoadon];
    }
}
