<?php

namespace App\Services\Orders;

use App\Exports\Orders\BillExportExcel;
use App\Exports\Orders\OrderExportExcel;
use App\Http\Requests\Orders\CreateBillRequest;
use App\Models\Bill;
use App\Models\Inventory;
use App\Models\LogAccountant;
use App\Models\LogAdmin;
use App\Models\NoteWarehouse;
use App\Models\Order;
use App\Models\PaymentCustomer;
use App\Models\Product;
use App\Models\refundCustomerModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use Maatwebsite\Excel\Facedes\Excel;
use Illuminate\Support\Str;

class BillService
{

    protected $orderExportExcel;

    public function __construct(OrderExportExcel $orderExportExcel)
    {
        $this->orderExportExcel = $orderExportExcel;
    }

    public function searchBillCode(Request $request)
    {
        $data = Bill::where('So_Hoadon', 'like', '%' . $request->BillCode . "%")->select('So_Hoadon')->distinct()->limit(10)->get();
        return response()->json($data);
    }
    public function getALl(Request $request)
    {
        $codeOrderByBill = Bill::select('Codeorder')->get()->toArray();
        foreach ($codeOrderByBill as  $value) {
            $priceOrder = DB::table('product')->where('codeorder', $value)->select('uname')->selectRaw('sum(total) as totalPriceIn')->first();
            Bill::where('Codeorder', $value)->update([
                'PriceOut' => $priceOrder->totalPriceIn,
                'uname' => $priceOrder->uname
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
            $bills = $bills->whereDate('Date_Create', $Date_Create);
        }

        if (!empty($Uname)) {
            $bills = $bills->whereHas('Order', function ($query) use ($Uname) {
                return $query->where('uname', $Uname);
            });
        }

        $bills = $bills->select()->selectRaw('count(Id) as total')
            ->selectRaw('sum(PriceOut) as totalPriceOut')
            ->groupBy('So_Hoadon')->orderBy('Date_Create', 'DESC')->get();

        $sumDebt = 0;
        foreach ($bills as $value) {
            $sumDebt += $value->PriceIn - $value->totalPriceOut;
        }
        foreach ($bills as $value) {
            $sumPriceIn = DB::table('quanlythe')->where('Sohoadon', $value->So_Hoadon)->where('uname', $value->uname)->selectRaw('sum(price_in) as totalPriceIn')->first();
            Bill::where('So_Hoadon', $value->So_Hoadon)->where('uname', $value->uname)->update([
                'PriceIn' => $sumPriceIn->totalPriceIn
            ]);
        }
        $bills = $bills->paginate(50);
        return ['bills' => $bills, 'So_Hoadon' => $So_Hoadon, 'Uname' => $Uname, 'Date_Create' => $Date_Create, 'sumDebt' => $sumDebt];
    }


    public function getALlBillByUname(Request $request, $uname)
    {
        $codeOrderByBill = Bill::select('Codeorder')->get()->toArray();
        $billcodes = DB::table('quanlythe')->where('Sohoadon', '!=', null)->select('Sohoadon')->distinct()->get()->toArray();

        foreach ($codeOrderByBill as  $value) {
            $priceO = 0;
            $priceOrder = DB::table('product')->where('codeorder', $value)->get();
            foreach ($priceOrder as $item) {
                $priceO += $item->total;
                $uname2 = $item->uname;
            }
            Bill::where('Codeorder', $value)->update([
                'PriceOut' => $priceO,
                'uname' => $uname2
            ]);
        }

        foreach ($billcodes as $value) {
            $sumPriceIn = DB::table('quanlythe')->where('Sohoadon', $value->Sohoadon)->where('uname', $uname)->selectRaw('sum(price_in) as totalPriceIn')->first();
            Bill::where('So_Hoadon', $value->Sohoadon)->where('uname', $uname)->update([
                'PriceIn' => $sumPriceIn->totalPriceIn
            ]);
        }
        $So_Hoadon = $request->So_Hoadon;
        $Date_Create = $request->Date_Create;
        // $PriceIn = $request->priceIn;
        // $PriceOut = $request->priceOut;

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
            ->groupBy('So_Hoadon')->orderBy('Date_Create', 'DESC')
            ->get();

        $sumDebt = 0;
        foreach ($bills as $value) {
            $sumDebt += $value->PriceIn - $value->totalPriceOut;
        }

        $bills = $bills->paginate(5);

        return ['bills' => $bills, 'So_Hoadon' => $So_Hoadon, 'Uname' => $uname, 'Date_Create' => $Date_Create, 'sumDebt' => $sumDebt];
    }

    public function getBillById(Request $request, $billcode)
    {
        $startDate = Carbon::create(2020, 10, 1);
        $endDate = $request->endDate;
        $date = Carbon::parse($endDate);
        $endDate2 = $date->addDays(1)->toDateString();
        $nowDate = now()->addDays(-2)->toDateString();

        $bill = Bill::where('So_Hoadon', $billcode)->where('deleted_at', null)->with('Order.Transport', 'Product.ProductStandard', 'listProduct.ProductStandard')->orderBy('Date_Create', 'DESC')->get();
        foreach ($bill as $value) {
            $value->setAttribute('date_payment', $value->Order->date_payment);
        }
        $totalWeightReal = 0;
        $totalWeightKhoi = 0;
        //tính khối và khối thực tế
        foreach ($bill as $value) {
            foreach ($value->listProduct as $item) {
                $weightKhoi = $item->ProductStandard->length * $item->ProductStandard->width * $item->ProductStandard->height / 1000000;
                $item->setAttribute('totalWeightkhoi', $weightKhoi);
                $totalWeightKhoi += $weightKhoi * $item->quantity;
                $totalWeightReal += $item->ProductStandard->weight * $item->quantity;
            }
        }
        $nap = PaymentCustomer::query()->where('Sohoadon', $billcode)->where('uname', $bill->first()->uname)->get();
        $codeorders = Bill::where('So_Hoadon', $billcode)->where('deleted_at', null)->get('Codeorder')->toArray();
        $mua = Order::query()->whereIn('codeorder', $codeorders)->with('listProduct')->get();
        $customer = collect($nap)->merge($mua)->sortBy('dateget');
        $deDebt = 0;
        $money = 0;
        $moneyNeedToPay = 0;
        foreach ($bill as $item) {
            $listProduct  = Product::where('codeorder', $item->Codeorder)->get();
            foreach ($listProduct as $item) {
                $money +=  $item->total;
            }
        }
        //tính lại số dư nếu có tiền hoàn trả
        $listRefund = refundCustomerModel::where('billcode', $billcode)->where('uname', $bill->first()->uname)->orderBy('date_in', 'DESC')->get();
        $moneyRefund = $listRefund->sum('money');
        if ($startDate && $endDate) {
            $customer = $customer->whereBetween('date_payment', [$startDate, $endDate2]);
            $checkScroll = 1;
            $money = 0;
            foreach ($customer as $value) {
                if ($value->date_payment < $endDate2) {
                    foreach ($value->listProduct as $item) {
                        $deDebt -= $item->total;
                        $money += $item->total;
                    }
                }
                $value->setAttribute('deDebt', $deDebt);
            }
        } else {
            $checkScroll = 0;
            $mua = $mua->sortBy('dateget');
            foreach ($mua as $value) {
                if ($value->date_payment < $nowDate) {
                    $moneyNeedToPay -= $value->total;
                }
            }
            foreach ($customer as $value) {
                if ($value->depositID) {
                    $deDebt += $value->price_in;
                } else {
                    $deDebt -= $value->total;
                }
                $value->setAttribute('deDebt', $deDebt);
            }
        }
        $hien_mau = PaymentCustomer::where('uname', $bill->first()->uname)->where('Sohoadon', $billcode)->orderBy('dateget', 'ASC')->get();
        $priceIn = 0;
        foreach ($hien_mau as $value) {
            $value->setAttribute('priceIn', $priceIn += $value->price_in);
        }
        $hien_mau = $hien_mau->sortByDesc('dateget');
        $customer = $customer->sortByDesc('dateget');

        if (count($customer) >= 1) {
            $priceDebt = $customer->first()->deDebt;
        } else {
            $priceDebt = 0;
        }
        if ($request->check == 'true') {
            $hien_mau = $hien_mau;
            return $this->orderExportExcel->ExportOrder($bill, $hien_mau);
        } else {
            $hien_mau = $hien_mau->groupBy('dateget')->paginate(10);
            $bill = $bill->sortByDesc('date_payment');
            return [
                'bill' => $bill, 'priceDebt' => $priceDebt, 'hien_mau' => $hien_mau, 'priceIn' => $priceIn, 'startDate' => $startDate, 'endDate' => $endDate, 'checkScroll' => $checkScroll,
                'moneyNeedToPay' => $money, 'totalWeightReal' => $totalWeightReal, 'totalWeightKhoi' => $totalWeightKhoi, 'moneyRefund' => $moneyRefund, 'listRefund' => $listRefund
            ];
        }
    }

    public function getTranfer(Request $request, $codeorder)
    {
        $currentBill = Bill::where('Codeorder', $codeorder)->where('deleted_at', null)->first();
        $bills = Bill::where('uname', $currentBill->uname)->where('So_Hoadon', '!=', $request->billcode)->where('deleted_at', null)->select()->selectRaw('count(Id) as total')
            ->groupBy('So_Hoadon')->orderBy('Date_Create', 'ASC')->get();
        $codeorder = $codeorder;
        $html = view('orders.includes.modalTranfer', compact('bills', 'codeorder'));
        return $html;
    }

    public function putTranfer(Request $request, $codeorder)
    {
        $currentBill = Bill::where('Codeorder', $codeorder)->where('deleted_at', null)->first();
        $currentSoHoadon = $currentBill->So_Hoadon;
        $billNew = Bill::where('Codeorder', $codeorder)->where('deleted_at', null)->update([
            'So_Hoadon' => $request->sohoadon
        ]);
        Order::where('codeorder', $codeorder)->where('SohoaDon', $currentBill->So_Hoadon)->update([
            'SohoaDon' => $request->sohoadon
        ]);
        if ($billNew) {
            $checkBill = Bill::where('So_Hoadon', $currentSoHoadon)->first();
            LogAccountant::create([
                'codeorder' => $currentBill->Codeorder,
                'uname' => Auth::user()->uname,
                'Sohoadon' => $currentSoHoadon,
                'Note' => 'Di chuyển từ số hoá đơn ' . $currentSoHoadon . ' đến ' . $request->sohoadon,
                'DateAct' => now()
            ]);
            // return response()->json($checkBill);
            if (!empty($checkBill)) {
                return 1;
            } else {
                return 3;
            }
        } else {
            return 2;
        }
    }

    public function getPaymentByBillCodeAndDate(Request $request, $billcode)
    {
        $nap = PaymentCustomer::where('Sohoadon', $billcode)->whereDate('dateget', $request->date)->orderBy('date_insert', 'DESC')->get();
        return view('orders.includes.modalPaymentDetail', compact('nap'));
    }

    public function getBillDetailById($codeorder)
    {
        $detail = Order::where('codeorder', $codeorder)
            ->with('Transport', 'Product.ProductStandard')->first();
        return ['detail' => $detail];
    }

    public function UpdateBillDetailById(Request $request, $codeorder)
    {
        $bill = Product::where('codeorder', $codeorder)->first();
        Product::where('codeorder', $codeorder)->update([
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);
        NoteWarehouse::create([
            'note' => $codeorder . ' cập nhập số lượng từ ' . $bill->quantity . '  đến ' . $request->quantity,
            'uname' => Auth::user()->uname,
            'action' => 'update',
            'Jancode' => $bill->jan_code
        ]);
        Inventory::create([
            'jancode' => $bill->jan_code,
            'codeorder' => $codeorder,
            'uname' => Auth::user()->uname,
            'action' => $bill->quantity <= $request->quantity ? 'Xuất order' : 'Trả lại hàng mua',
            'quantityUpdate' => $request->quantity,
            'created_at' => now()
        ]);
        return response()->json(Product::where('codeorder', $codeorder)->first());
    }

    public function createNew(CreateBillRequest $request)
    {

        $check = Order::where('codeorder', $request->Codeorder)->first();
        if ($check === null) {
            $request->flash('request', $request->all());
            Session()->flash('Codeorder', 'Codeorder wrong!');
        } else {
            $unames = Str::of($request->Codeorder)->explode('-');
            $checkLocked = Bill::where('So_Hoadon', $request->So_Hoadon)->where('locked', '!=', 0)->get()->toArray();
            if (!empty($checkLocked)) {
                toastr()->warning('Hóa đơn đã khóa sổ', 'Notification', ['timeOut' => 1100]);
                return back();
            }
            $checkbill = Bill::where('So_Hoadon', $request->So_Hoadon)->first();
            if (!empty($checkbill)) {
                if ($unames[1] != $checkbill->uname) {
                    toastr()->warning('Không được khác uname trong cùng hóa đơn', 'Notification', ['timeOut' => 1100]);
                    return back();
                }
            }
            $listProduct = Product::where('codeorder', $request->Codeorder)->get();
            $sumTotal = 0;
            foreach ($listProduct as $item) {
                $sumTotal += $item->total;
            }
            $bill = Bill::create([
                'So_Hoadon' => $request->So_Hoadon,
                'Codeorder' => $request->Codeorder,
                'note' => $request->note,
                'PriceOut' => $sumTotal
            ]);
            $codeorder = Order::where('codeorder', $request->Codeorder)->with('listProduct')->get();
            foreach ($codeorder as $items) {
                foreach ($items->listProduct as $item) {
                    Inventory::create([
                        'action' => 'Đã bán',
                        'jancode' => $item->jan_code,
                        'codeorder' => $request->Codeorder,
                        'quantityUpdate' => $item->quantity,
                        'uname' => Auth::user()->uname,
                        'created_at' => now()
                    ]);
                }
            }
            $order = Order::where('codeorder', $request->Codeorder)->update([
                'Sohoadon' => $request->So_Hoadon
            ]);

            $order = Bill::where('Codeorder', $request->Codeorder)->has('listProduct')->get();
            // LogAccountant::create([
            //     'jan_code' => $order['Product']->jan_code,
            //     'codeorder' => $bill->Codeorder,
            //     'uname' => Auth::user()->uname,
            //     'Sohoadon' => $bill->So_Hoadon,
            //     'note' => 'Tạo hoá đơn',
            //     'DateAct' => now()
            // ]);
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
            'deleted_at' => now(),
        ]);
        //ko delete được
        Order::where('codeorder', $codeorder->Codeorder)->where('SohoaDon', $codeorder->So_Hoadon)->update([
            'SohoaDon' => Null
        ]);
        //
        if ($log) {
            $status = Bill::where('So_Hoadon', $billcode)->where('deleted_at', null)->first();
            if ($status !== null) {
                toastr()->success('Delete successfully!', 'Notifycation');
                return back();
            } else {
                toastr()->success('Delete successfully!', 'Notifycation');
                return redirect()->intended(route('orders.bills.indexALl'));
            }
        } else {
            toastr()->error('Delete failed!', 'Notifycation');
            return back();
        }
    }
}
