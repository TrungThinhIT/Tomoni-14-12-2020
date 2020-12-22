<?php

namespace App\Services\Orders;

use App\Http\Requests\Orders\CreateBillRequest;
use App\Models\Bill;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillService
{
    public function searchBillCode(Request $request){
        $data = Bill::where('So_Hoadon', 'like', '%' .$request->BillCode . "%")->limit(10)->get();
        return response()->json($data);
    }
    public function getALl(Request $request){
        $codeOrderByBill = Bill::select('Codeorder')->get()->toArray();
        $billcodes = DB::table('quanlythe')->where('Sohoadon', '!=', null)->select('Sohoadon')->distinct()->get()->toArray();
        foreach ($codeOrderByBill as  $value) {
            $priceOrder = DB::table('oder')->where('codeorder', $value)->first();
            Bill::where('Codeorder', $value)->update([
                'PriceOut' => $priceOrder->total
            ]);
        }

        foreach($billcodes as $value){
            $sumPriceIn = DB::table('quanlythe')->where('Sohoadon', $value->Sohoadon)->selectRaw('sum(price_in) as totalPriceIn')->first();
            Bill::where('So_Hoadon', $value->Sohoadon)->update([
                'PriceIn' => $sumPriceIn->totalPriceIn
            ]);
        }

        $So_Hoadon = $request->So_Hoadon;
        $Date_Create = $request->Date_Create;

        $bills = DB::table('accoutant_order');

        if (!empty($So_Hoadon)) {
            $bills = $bills->where('So_Hoadon', 'like', '%' . $So_Hoadon);
        }

        if (!empty($Date_Create)) {
            $bills = $bills->orWhereDate('Date_Create', $Date_Create);
        }

        $bills = $bills
        ->select()->selectRaw('count(Id) as total')
        ->selectRaw('sum(PriceOut) as totalPriceOut')
        ->groupBy('So_Hoadon')
        ->paginate(5);
        return ['bills' => $bills, 'So_Hoadon'=> $So_Hoadon, 'Date_Create'=> $Date_Create];
    }

    public function getBillById($billcode){
        return Bill::where('So_Hoadon', $billcode)->with('Order.Transport', 'Product')->get();
    }

    public function getBillDetailById($codeorder){
        $detail = Order::where('codeorder', $codeorder)
        ->with('Transport', 'LogAdmin', 'LogUser')->first();
        $log = $detail->LogAdmin->merge($detail->LogUser)->sortBy('date');
        return ['detail' => $detail, 'log' => $log];
    }

    public function createNew(CreateBillRequest $request){
        Bill::create([
            'So_Hoadon' => $request->So_Hoadon,
            'Codeorder' => $request->Codeorder,
            'note' => $request->note
        ]
        );
        Order::where('codeorder', $request->Codeorder)->update([
            'Sohoadon' => $request->So_Hoadon
        ]);
        toastr()->success('Create successfully!', 'Notifycation');
        return back();
    }
}
