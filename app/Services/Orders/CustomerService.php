<?php

namespace App\Services\Orders;

use App\Models\Order;
use App\Models\PaymentCustomer;
use Illuminate\Http\Request;

class CustomerService
{

    public function getIndex(Request $request)
    {
        if($request->record){
            $record = $request->record;
        }else{
            $record = 25;
        }

        $uname = $request->uname;

        $deDebt = 0;

        $nap = PaymentCustomer::query()->where('uname', $uname)->get();
        $mua = Order::query()->where('uname', $uname)->get();

        $customer = collect($nap)->merge($mua)->sortBy('dateget');
        foreach ($customer as $value) {
            if ($value->depositID) {
                $deDebt += $value->price_in;
            } else {
                $deDebt -= $value->total_all;
            }
            $value->setAttribute('deDebt', $deDebt);
        }
        $customer = $customer->sortByDesc('dateget')->paginate($record);
        return ['customer' => $customer, 'record' => $record, 'uname' => $uname];
    }
}
