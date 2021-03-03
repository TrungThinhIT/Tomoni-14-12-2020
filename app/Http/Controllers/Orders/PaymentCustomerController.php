<?php

namespace App\Http\Controllers\Orders;

use App\Exports\PaymentCustomers\paymentCustomerExcel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\addUnamesRequest;
use App\Http\Requests\Orders\PaymentCustomerRequest;
use App\Services\Orders\PaymentCustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PaymentCustomer;
use Carbon\Carbon;

class PaymentCustomerController extends Controller
{
    protected $paymentCustomer;

    public function __construct(PaymentCustomerService $paymentCustomer, paymentCustomerExcel $paymentExcel)
    {
        $this->paymentCustomer = $paymentCustomer;
        $this->paymentExcel = $paymentExcel;
    }

    public function index(Request $request)
    {
        $data = $this->paymentCustomer->indexAll($request);
        return view('orders.payment_customers', compact('data'));
    }
    public function exportExcel(Request $request)
    {
        $Uname = $request->Uname;
        $date_inprice = $request->date_inprice;
        $date_insert = $request->date_insert;
        $Sohoadon = $request->Sohoadon;
        $checkbox = $request->checkbox;
        // dd($request->all());
        $PCustomers = PaymentCustomer::query();

        if (!empty($Uname)) {
            $PCustomers = $PCustomers->where('uname', 'like', '%' . $Uname . '%');
        }

        if ($date_inprice && $date_insert) {
            $PCustomers = $PCustomers->whereBetween('dateget', [$date_inprice, $date_insert]);
            // dd($PCustomers);
        }

        if (!empty($Sohoadon)) {
            $PCustomers = $PCustomers->where('Sohoadon', 'like', '%' . $Sohoadon . '%');
        }
        if ($checkbox) {
            $PCustomers = $PCustomers->orderByDesc('date_insert')->get();
            return $this->paymentExcel->ExportProduct($PCustomers);
        }
        return  1;
    }


    public function insert(PaymentCustomerRequest $request)
    {
        return $this->paymentCustomer->insert($request);
    }

    public function update(Request $request, $id)
    {
        return $this->paymentCustomer->updateById($request, $id);
    }
    public function addUnames(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "deposit" => "required",
            "getDate" => "required|date",
            "uname.*" => "exists:users,uname",
        ]);

        if ($validator->fails()) {
            $er = $validator->errors();
            return response()->json([$er]);
        }
        PaymentCustomer::where('depositID', $request->deposit)->delete();
        for ($i = 0; $i < count($request->uname); $i++) {
            $create = PaymentCustomer::create([
                'uname' =>   $request->uname[$i],
                'depositID' => $request->deposit,
                'dateget' => $request->getDate,
                'note' => $request->note[$i],
                'price_in' => $request->price[$i],
                'Sohoadon' => $request->hoadon[$i]
            ]);
        }
        if ($create) {
            return "oke";
        } else {
            return "false";
        }
    }
    public function depositDetails($id)
    {
        $lists  =  PaymentCustomer::where('depositID', $id)->get();
        return view('orders.includes.modalDepositIDDetails', compact('lists', 'id'));
        return response()->json($lists);
    }
    public function updateDeposit(Request $request, $Id)
    {
        $paymentCustomer = PaymentCustomer::where("Id", $Id)->update([
            'uname' => $request->uname,
            'Sohoadon' => $request->sohoadon
        ]);
        if ($paymentCustomer) {
            $item = PaymentCustomer::where("Id", $Id)->first();
            $list = PaymentCustomer::where("depositID", $item->depositID)->get()->toArray();
            if (count($list) > 1) {
                return response()->json($list);
            }
        } else {
            return 2;
        }
    }
    public function shareMoney(Request $request, $deposit)
    {
        $sum = $request->sum;
        return view('orders.includes.modalShareMoney', compact('deposit', 'sum'));
    }
}
