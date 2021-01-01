<?php

namespace App\Services\Customers;

use App\Http\Requests\Orders\CreateBillRequest;
use App\Models\Bill;
use App\Models\LogAccountant;
use App\Models\LogAdmin;
use App\Models\Order;
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
            $bills = $bills->orWhereDate('Date_Create', $Date_Create);
        }

        $bills = $bills->where('deleted_at', null)
            ->select()->selectRaw('count(Id) as total')
            ->selectRaw('sum(PriceOut) as totalPriceOut')
            ->groupBy('So_Hoadon')
            ->paginate(5);
        return ['bills' => $bills, 'So_Hoadon' => $So_Hoadon, 'Uname' => $uname, 'Date_Create' => $Date_Create];
    }

    public function getBillById($billcode)
    {
        $uname = Auth::user()->uname;
        return Bill::where('So_Hoadon', $billcode)->with('Order')->whereHas('Order', function ($query) use ($uname) {
            return $query->where('uname', $uname);
        })->where('deleted_at', null)->with('Order.Transport', 'Product.ProductStandard')->get();
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
