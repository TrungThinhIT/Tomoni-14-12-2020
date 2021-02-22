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
        
        $listBillCode = Bill::where('uname', $uname)->select('So_Hoadon')->distinct()->get()->toArray();

        $nap = PaymentCustomer::query()->where('uname', $uname)->whereIn('Sohoadon', $listBillCode)->get();
        $mua = Bill::query()->where('uname',$uname)->get();

        foreach ($mua as $item){
            $item->setAttribute('dateget', $item->Date_Create);
        }

        $customer = collect($nap)->merge($mua)->sortBy('dateget');
        $id_debt = 1;
        $price_in = 0;
        $price_out = 0;
        foreach ($customer as $value) {
            if ($value->depositID) {
                $deDebt += $value->price_in;
                $price_in += $value->price_in;
            } else {
                $deDebt -= $value->PriceOut;
                $price_out += $value->PriceOut;
            }
            $value->setAttribute('deDebt', $deDebt);
            $value->setAttribute('id_debt', $id_debt);
            $id_debt ++;
        }

        if ($date_start && $date_end) {
            $customer = $customer->whereBetween('dateget', [$date_start, $date_end]);
        }

        $customer = $customer->sortByDesc('id_debt')->paginate($record);
        // dd($customer);
        return ['customer' => $customer, 'record' => $record, 'uname' => $uname, 'dateStart' => $date_start, 'dateEnd' => $date_end , 'price_in' => $price_in, 'price_out'=> $price_out];
    }
}
