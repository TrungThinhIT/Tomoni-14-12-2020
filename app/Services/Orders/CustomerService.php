<?php

namespace App\Services\Orders;

use App\Models\Bill;
use App\Models\Order;
use App\Models\PaymentCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CustomerService
{

    public function getIndex(Request $request)
    {
        if ($request->record) {
            $record = $request->record;
        } else {
            $record = 25;
        }

        $uname = $request->uname;

        $deDebt = 0;

        $date_start = $request->dateStart;
        $date_end = $request->dateEnd;

        $date = Carbon::parse($date_end);
        $date_end = $date->addDays(1);
        $nap = PaymentCustomer::query()->where('uname', $uname)->get();
        // dd($nap);
        // $mua = Order::query()->where('uname', $uname)->get();
        $mua = Bill::query()->where('uname',$uname)->get();
        // dd($mua);
        $customer = collect($nap)->merge($mua)->sortBy('dateget');
        // dd($customer);
        foreach ($customer as $value) {
            
            if ($value->depositID) {
                $deDebt += $value->price_in;
            } else {
                $deDebt -= $value->total;
            }
            $value->setAttribute('deDebt', $deDebt);
        }

        if ($date_start && $date_end) {
            $customer = $customer->whereBetween('dateget', [$date_start, $date_end]);
        }

        $customer = $customer->sortByDesc('dateget')->paginate($record);
        // dd($customer);
        return ['customer' => $customer, 'record' => $record, 'uname' => $uname, 'dateStart' => $date_start, 'dateEnd' => $date_end];
    }
}
