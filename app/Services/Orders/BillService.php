<?php

namespace App\Services\Orders;

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
    public function searchBillCode(Request $request)
    {
        $data = Bill::where('So_Hoadon', 'like', '%' . $request->BillCode . "%")->limit(10)->get();
        return response()->json($data);
    }
    public function getALl(Request $request)
    {
        $codeOrderByBill = Bill::select('Codeorder')->get()->toArray();
        $billcodes = DB::table('quanlythe')->where('Sohoadon', '!=', null)->select('Sohoadon')->distinct()->get()->toArray();
        foreach ($codeOrderByBill as  $value) {
            $priceOrder = DB::table('oder')->where('codeorder', $value)->first();
            Bill::where('Codeorder', $value)->update([
                'PriceOut' => $priceOrder->total,
                'uname' => $priceOrder->uname
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
        $Uname = $request->Uname;

        $bills = $bills = Bill::with('Order')->where('deleted_at',  null);

        if (!empty($So_Hoadon)) {
            $bills = $bills->where('So_Hoadon', 'like', '%' . $So_Hoadon);
        }

        if (!empty($Date_Create)) {
            $bills = $bills->orWhereDate('Date_Create', $Date_Create);
        }

        if (!empty($Uname)) {
            $bills = $bills->whereHas('Order', function ($query) use ($Uname) {
                return $query->where('uname', $Uname);
            });
        }

        $bills = $bills
            ->select()->selectRaw('count(Id) as total')
            ->selectRaw('sum(PriceOut) as totalPriceOut')
            ->groupBy('So_Hoadon')->orderBy('Date_Create', 'DESC')
            ->paginate(5);
        return ['bills' => $bills, 'So_Hoadon' => $So_Hoadon, 'Uname' => $Uname, 'Date_Create' => $Date_Create];
    }

    public function getALlBillByUname(Request $request, $uname)
    {
        $codeOrderByBill = Bill::select('Codeorder')->get()->toArray();
        $billcodes = DB::table('quanlythe')->where('Sohoadon', '!=', null)->select('Sohoadon')->distinct()->get()->toArray();
        foreach ($codeOrderByBill as  $value) {
            $priceOrder = DB::table('oder')->where('codeorder', $value)->first();
            Bill::where('Codeorder', $value)->update([
                'PriceOut' => $priceOrder->total,
                'uname' => $priceOrder->uname
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
            ->groupBy('So_Hoadon')->orderBy('Date_Create', 'DESC')
            ->paginate(5);
        return ['bills' => $bills, 'So_Hoadon' => $So_Hoadon, 'Uname' => $uname, 'Date_Create' => $Date_Create];
    }

    public function getBillById($billcode)
    {
        return Bill::where('So_Hoadon', $billcode)->where('deleted_at', null)->with('Order.Transport', 'Product.ProductStandard')->get();
    }

    public function getBillDetailById($codeorder)
    {
        $detail = Order::where('codeorder', $codeorder)
            ->with('Transport', 'Product.ProductStandard')->first();
        return ['detail' => $detail];
    }

    public function UpdateBillDetailById(Request $request, $codeorder)
    {
        Order::where('codeorder', $codeorder)->update([
            'total' => $request->price,
            'quantity' => $request->quantity,
            'total_all' => $request->total
        ]);
    }

    public function createNew(CreateBillRequest $request)
    {
        $check = Order::where('codeorder', $request->Codeorder)->first();
        if($check === null){
            $request->flash('request', $request->all());
            Session()->flash('Codeorder', 'Codeorder wrong!');
        }else{

        $bill = Bill::create([
            'So_Hoadon' => $request->So_Hoadon,
            'Codeorder' => $request->Codeorder,
            'note' => $request->note
        ]);
        $order = Order::where('codeorder', $request->Codeorder)->update([
            'Sohoadon' => $request->So_Hoadon
        ]);

        $order = Bill::where('Codeorder', $request->Codeorder)->has('Product')->first();
        
        LogAccountant::create([
            'jan_code' => $order['Product']->jan_code,
            'codeorder' => $bill->Codeorder,
            'uname' => Auth::user()->uname,
            'Sohoadon' => $bill->So_Hoadon,
            'note' => 'Tạo hoá đơn',
            'DateAct' => now()
        ]);

        toastr()->success('Create successfully!', 'Notifycation');
        }
        return back();
    }

    public function updateFee(Request $request, $codeorder)
    {
        Transport::where('codeorder', $codeorder)->update([
            'fee_service' => $request->fee_service,
            'fee_box' => $request->fee_box
        ]);
    }

    public function updateShipId(Request $request, $codeorder)
    {
        Order::where('codeorder', $codeorder)->update([
            'shipid' => $request->shipid
        ]);
    }

    public function loadLog($codeorder)
    {
        $log = Order::where('codeorder', $codeorder)
            ->with('Transport', 'Product.ProductStandard', 'LogAdmin', 'LogUser')->first();
        $log = $log->LogAdmin->merge($log->LogUser)->sortBy('date');
        $html = view('orders.includes.logOrderDetail', compact('log'));
        return $html;
    }

    public function createComment(Request $request, $codeorder)
    {
        $uname = Auth::user()->uname;
        LogAdmin::create([
            'codeorder' => $codeorder,
            'uname' => $uname,
            'note' => $request->note
        ]);
    }

    public function deleteCoceorderInBill($id)
    {
        $codeorder = Bill::where('Id', $id)->with('Order.Product')->first();
        $billcode = $codeorder->So_Hoadon;
        $log = LogAccountant::create([
            'jan_code' => $codeorder->Order->Product->jan_code,
            'codeorder' => $codeorder->Codeorder,
            'uname' => Auth::user()->uname,
            'Sohoadon' => $codeorder->So_Hoadon,
            'note' => 'Xoá hoá đơn',
            'DateAct' => now()
        ]);
        Bill::where('Id', $codeorder->Id)->update([
            'deleted_at' => now()
        ]);
        if ($log) {
            $status = Bill::where('So_Hoadon', $billcode)->where('deleted_at', null)->first();
            if($status !== null){
                toastr()->success('Delete successfully!', 'Notifycation');
            return back();
            }else{
                toastr()->success('Delete successfully!', 'Notifycation');
                return redirect()->intended(route('orders.bills.indexALl'));
            }
        } else {
            toastr()->error('Delete failed!', 'Notifycation');
            return back();
        }
    }
}
