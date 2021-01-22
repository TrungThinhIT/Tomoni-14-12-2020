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
    public function exportExcel(Request $request,$id){
        return $this->billService->exportExcelById($request,$id);

    }
    public function export(Request $request){
        return $this->billService->ExportALlBillByUname($request);
    }

    public function order(Request $request,$billcode){
        $data = $this->billService->getBillById($request,$billcode);
        return view('customers.order', compact('data'));
    }

    public function getPaymentDetail(Request $request, $billcode){
        return $this->billService->getPaymentByBillCodeAndDate($request, $billcode);
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
    public function getIdBillcode(Request $request,$id_bill){
        $data = $this->billService->exportExcelById($request,$id_bill);
        dd($data);
        return view('customers.order',compact('data'));
    }
}
