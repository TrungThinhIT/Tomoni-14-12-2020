<?php

namespace App\Services\Customers;

use App\Exports\Customers\Debt\DebtExport;
use Illuminate\Http\Request;
use App\Models\PaymentCustomer;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel;
use PHPExcel_IOFactory;

class DebtService
{
    public function index(Request $request){
        if($request->record){
            $record = $request->record;
        }else{
            $record = 25;
        }

        $uname = Auth::user()->uname;

        $deDebt = 0;

        $nap = PaymentCustomer::query()->where('uname', $uname)->get();
        $mua = Order::query()->where('uname', $uname)->get();

        $customer = collect($nap)->merge($mua)->sortBy('dateget');
        foreach ($customer as $value) {
            if ($value->depositID) {
                $deDebt += $value->price_in;
            } else {
                $deDebt -= $value->total;
            }
            $value->setAttribute('deDebt', $deDebt);
        }
        $customer = $customer->sortByDesc('dateget')->paginate($record);
        return ['customer' => $customer, 'record' => $record, 'uname' => $uname];
    }

}
