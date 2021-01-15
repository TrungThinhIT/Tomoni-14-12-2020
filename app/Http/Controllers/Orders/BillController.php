<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\CreateBillRequest;
use App\Services\Orders\BillService;
use Illuminate\Http\Request;

class BillController extends Controller
{
    protected $billService;

    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
    }

    public function searchBillCode(Request $request){
        return $this->billService->searchBillCode($request);
    }

    public function indexALl(Request $request){
        $data = $this->billService->getALl($request);
        return view('orders.bill', compact('data'));
    }

    public function indexAllByUname(Request $request, $uname){
        $data =  $this->billService->getALlBillByUname($request, $uname);
        return view('orders.billByUname', compact('data'));
    }

    public function getBillById(Request $request, $billcode){
        $data = $this->billService->getBillById($request, $billcode);
        return view('orders.order', compact('data'));
    }    

    public function getTranfer(Request $request, $codeorder){
        return $this->billService->getTranfer($request, $codeorder);
    }

    public function putTranfer(Request $request, $codeorder){
        return $this->billService->putTranfer($request, $codeorder);
    }

    public function getPaymentDetail(Request $request, $billcode){
        return $this->billService->getPaymentByBillCodeAndDate($request, $billcode);
    }

    public function getBillDetailById($codeorder){
        $billDetail = $this->billService->getBillDetailById($codeorder);
        return view('orders.order_detail', compact('billDetail'));
    }

    public function UpdateBillDetailById(Request $request, $codeorder){
        return $this->billService->UpdateBillDetailById($request, $codeorder);
    }

    public function create(CreateBillRequest $request){
        return $this->billService->createNew($request);
    }

    public function updateFee(Request $request, $codeorder){
        return $this->billService->updateFee($request, $codeorder);
    }

    public function updateShipId(Request $request, $codeorder){
        return $this->billService->updateShipId($request, $codeorder);
    }

    public function loadLog($codeorder){
        return $this->billService->loadLog($codeorder);
    }

    public function comment(Request $request, $codeorder){
        return $this->billService->createComment($request, $codeorder);
    }

    public function deleteBillCode($id){
        return $this->billService->deleteCoceorderInBill($id);
    }
}
