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

    public function getBillById($billcode){
        $bill = $this->billService->getBillById($billcode);
        return view('orders.order', compact('bill'));
    }

    public function create(CreateBillRequest $request){

        return $this->billService->createNew($request);
    }
}
