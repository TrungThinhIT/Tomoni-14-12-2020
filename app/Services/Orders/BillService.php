<?php

namespace App\Services\Orders;

use App\Http\Requests\Orders\CreateBillRequest;
use App\Models\Bill;
use App\Models\LogAdmin;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transport;
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
        return Bill::where('So_Hoadon', $billcode)->with('Order.Transport', 'Product.ProductStandard')->get();
    }

    public function getBillDetailById($codeorder){
        $detail = Order::where('codeorder', $codeorder)
        ->with('Transport', 'Product.ProductStandard')->first();
        return ['detail' => $detail];
    }

    public function UpdateBillDetailById(Request $request, $codeorder){
        Order::where('codeorder', $codeorder)->update([
            'total' => $request->price,
            'quantity' => $request->quantity,
            'total_all' => $request->total
        ]);
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

    public function updateFee(Request $request, $codeorder){
       Transport::where('codeorder',$codeorder)->update([
           'fee_service' => $request->fee_service,
           'fee_box' => $request->fee_box
       ]);
    }

    public function updateShipId(Request $request, $codeorder){
        Order::where('codeorder',$codeorder)->update([
            'shipid' => $request->shipid
        ]);
     }

     public function loadLog($codeorder){
        $log = Order::where('codeorder', $codeorder)
        ->with('Transport', 'Product.ProductStandard', 'LogAdmin', 'LogUser')->first();
        $log = $log->LogAdmin->merge($log->LogUser)->sortBy('date');
        $html = view('orders.includes.logOrderDetail', compact('log'));
        return $html;
     }

     public function createComment(Request $request, $codeorder){
        LogAdmin::create([
            'codeorder' => $codeorder,
            'uname' => 'admin',
            'note' => $request->note
        ]);
     }
}
