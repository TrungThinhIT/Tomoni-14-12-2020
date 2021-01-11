<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Services\Customers\BillService;
use Illuminate\Http\Request;

class BillCustomerController extends Controller
{
    protected $billService;

    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
    }

    public function index(Request $request){
        $data = $this->billService->getALlBillByUname($request);
        return view('customers.bill', compact('data'));
    }

    public function order($billcode){
        $bill = $this->billService->getBillById($billcode);
        return view('customers.order', compact('bill'));
    }

    public function orderDetail($codeorder){
       $billDetail = $this->billService->getBillDetailById($codeorder);
       return view('customers.order_detail', compact('billDetail'));
    }

    public function loadLog($codeorder){
        return $this->billService->loadLog($codeorder);
    }

    public function addLog(Request $request, $codeorder){
        return $this->billService->addLog($request, $codeorder);
    }
}
