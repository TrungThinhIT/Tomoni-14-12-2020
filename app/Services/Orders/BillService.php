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
        $data = DB::table('quanlythe')->where('depositID', 'like', '%' .$request->BillCode . "%")->limit(10)->get();
        return response()->json($data);
    }
    public function getALl(Request $request){

        $codeOrderByBill = Bill::select('Codeorder')->get()->toArray();
        foreach ($codeOrderByBill as  $value) {
            $priceOrder = DB::table('oder')->where('codeorder', $value)->first();
            Bill::where('Codeorder', $value)->update([
                'PriceOut' => $priceOrder->total
            ]);
        }

        $So_Hoadon = $request->So_Hoadon;
        $Date_Create = $request->Date_Create;

        $bills = DB::table('accoutant_order');

        $bills = $bills->where('So_Hoadon', 'like', '%' . $So_Hoadon)->orWhereDate('Date_Create', $Date_Create)
        ->select()->selectRaw('count(Id) as total')->selectRaw('sum(PriceIn) as totalPriceIn')
        ->selectRaw('sum(PriceOut) as totalPriceOut')
        ->groupBy('So_Hoadon')
        ->paginate(5);
        return ['bills' => $bills, 'So_Hoadon'=> $So_Hoadon, 'Date_Create'=> $Date_Create];
    }

    public function getBillById($billcode){
        return Bill::where('So_Hoadon', $billcode)->get();
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
