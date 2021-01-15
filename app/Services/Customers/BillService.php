<?php

namespace App\Services\Customers;

use App\Http\Requests\Orders\CreateBillRequest;
use App\Models\Bill;
use App\Models\LogAccountant;
use App\Models\LogAdmin;
use App\Models\Order;
use App\Models\PaymentCustomer;
use Illuminate\Support\Facades\Auth;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillService
{
    public function getALlBillByUname(Request $request)
    {
        $codeOrderByBill = Bill::select('Codeorder')->get()->toArray();
        $billcodes = DB::table('quanlythe')->where('Sohoadon', '!=', null)->select('Sohoadon')->distinct()->get()->toArray();
        foreach ($codeOrderByBill as  $value) {
            $priceOrder = DB::table('oder')->where('codeorder', $value)->first();
            Bill::where('Codeorder', $value)->update([
                'PriceOut' => $priceOrder->total
            ]);
        }

        foreach ($billcodes as $value) {
            $sumPriceIn = DB::table('quanlythe')->where('Sohoadon', $value->Sohoadon)->selectRaw('sum(price_in) as totalPriceIn')->first();
            Bill::where('So_Hoadon', $value->Sohoadon)->update([
                'PriceIn' => $sumPriceIn->totalPriceIn
            ]);
        }
        $So_Hoadon = $request->So_Hoadon;
        $Date_Create = $request->Date_Create;
        $uname = Auth::user()->uname;

        $bills = Bill::with('Order')->whereHas('Order', function ($query) use ($uname) {
            return $query->where('uname', $uname);
        });

        if (!empty($So_Hoadon)) {
            $bills = $bills->where('So_Hoadon', 'like', '%' . $So_Hoadon);
        }

        if (!empty($Date_Create)) {
            $bills = $bills->whereDate('Date_Create', $Date_Create);
        }

        $bills = $bills->where('deleted_at', null)
            ->select()->selectRaw('count(Id) as total')
            ->selectRaw('sum(PriceOut) as totalPriceOut')
            ->groupBy('So_Hoadon')->orderBy('Date_Create', 'ASC')->get();
        $priceDebt = 0;
        foreach ($bills as $value) {
            $priceDebt += ($value->PriceIn - $value->totalPriceOut);
            $value->setAttribute('totalPriceDebt', $priceDebt);            # code...
        }
        $bills = $bills->sortByDESC('Date_Create')->paginate(10);
        return ['bills' => $bills, 'So_Hoadon' => $So_Hoadon, 'Uname' => $uname, 'Date_Create' => $Date_Create];
    }

    public function ExportALlBillByUname(Request $request)
    {
        $codeOrderByBill = Bill::select('Codeorder')->get()->toArray();
        $billcodes = DB::table('quanlythe')->where('Sohoadon', '!=', null)->select('Sohoadon')->distinct()->get()->toArray();
        foreach ($codeOrderByBill as  $value) {
            $priceOrder = DB::table('oder')->where('codeorder', $value)->first();
            Bill::where('Codeorder', $value)->update([
                'PriceOut' => $priceOrder->total
            ]);
        }

        foreach ($billcodes as $value) {
            $sumPriceIn = DB::table('quanlythe')->where('Sohoadon', $value->Sohoadon)->selectRaw('sum(price_in) as totalPriceIn')->first();
            Bill::where('So_Hoadon', $value->Sohoadon)->update([
                'PriceIn' => $sumPriceIn->totalPriceIn
            ]);
        }
        $So_Hoadon = $request->eSo_Hoadon;
        $Date_Create = $request->eDate_Create;
        $uname = Auth::user()->uname;

        $bills = Bill::with('Order')->whereHas('Order', function ($query) use ($uname) {
            return $query->where('uname', $uname);
        });

        if (!empty($So_Hoadon)) {
            $bills = $bills->where('So_Hoadon', 'like', '%' . $So_Hoadon);
        }

        if (!empty($Date_Create)) {
            $bills = $bills->whereDate('Date_Create', $Date_Create);
        }

        $bills = $bills->where('deleted_at', null)
            ->select()->selectRaw('count(Id) as total')
            ->selectRaw('sum(PriceOut) as totalPriceOut')
            ->groupBy('So_Hoadon')->orderBy('Date_Create', 'ASC')->get();
        $priceDebt = 0;
        foreach ($bills as $value) {
            $priceDebt += ($value->PriceIn - $value->totalPriceOut);
            $value->setAttribute('totalPriceDebt', $priceDebt);            # code...
        }
        $bills = $bills->sortByDESC('Date_Create')->paginate(10);
        return ['bills' => $bills, 'So_Hoadon' => $So_Hoadon, 'Uname' => $uname, 'Date_Create' => $Date_Create];
    }

    public function getBillById($billcode)
    {
        $uname = Auth::user()->uname;
        $bill = Bill::where('So_Hoadon', $billcode)->with('Order')->whereHas('Order', function ($query) use ($uname) {
            return $query->where('uname', $uname);
        })->where('deleted_at', null)->with('Order.Transport', 'Product.ProductStandard')->orderBy('Date_Create', 'DESC')->get();
        $nap = PaymentCustomer::query()->where('Sohoadon', $billcode)->get();
        $codeorders = Bill::where('So_Hoadon', $billcode)->where('uname', $uname)->where('deleted_at', null)->get('Codeorder')->toArray();
            $mua = Order::query()->whereIn('codeorder', $codeorders)->get();
        $customer = collect($nap)->merge($mua)->sortBy('dateget');
        $deDebt = 0;
        foreach ($customer as $value) {
            if ($value->depositID) {
                $deDebt += $value->price_in;
            } else {
                $deDebt -= $value->total;
            }
            $value->setAttribute('deDebt', $deDebt);
        }
        $hien_mau = PaymentCustomer::query()->where('Sohoadon', $billcode)->where('uname', $uname)->orderBy('dateget', 'ASC')->get();
        $priceIn = 0;
        foreach($hien_mau as $value){
            $value->setAttribute('priceIn', $priceIn += $value->price_in);    
        }

        $hien_mau = $hien_mau->sortByDesc('dateget')->groupBy('dateget');

        $hien_mau = $hien_mau->paginate(10);
        $customer = $customer->sortByDesc('dateget');
        return ['bill' => $bill, 'customer' => $customer, 'hien_mau'=> $hien_mau];
    }

    public function getPaymentByBillCodeAndDate(Request $request, $billcode){
        $nap = PaymentCustomer::where('Sohoadon', $billcode)->where('uname', Auth::user()->uname)->whereDate('dateget', $request->date)->get();
        return view('orders.includes.modalPaymentDetail', compact('nap'));
    }

    public function getBillDetailById($codeorder)
    {
        $uname = Auth::user()->uname;
        $detail = Order::where('codeorder', $codeorder)->where('uname', $uname)
            ->with('Transport', 'Product.ProductStandard')->first();
        return ['detail' => $detail];
    }

    public function loadLog($codeorder)
    {
        $log = Order::where('codeorder', $codeorder)
            ->with('Transport', 'Product.ProductStandard', 'LogAdmin', 'LogUser')->first();
        $log = $log->LogAdmin->merge($log->LogUser)->sortBy('date');
        $html = view('orders.includes.logOrderDetail', compact('log'));
        return $html;
    }

    public function addLog(Request $request, $codeorder)
    {
        $uname = Auth::user()->uname;
        LogAdmin::create([
            'codeorder' => $codeorder,
            'uname' => $uname,
            'note' => $request->note
        ]);
    }
}
