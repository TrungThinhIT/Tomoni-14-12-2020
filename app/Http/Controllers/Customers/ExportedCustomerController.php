<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Services\Customers\ExportedService;
use Illuminate\Http\Request;

class ExportedCustomerController extends Controller
{
    protected $exportedService;

    public function __construct(ExportedService $exportedService)
    {
        $this->exportedService = $exportedService;
    }
    
    public function index(Request $request)
    {
        $data = $this->exportedService->index($request);
        return view('customers.exported', compact('data'));
    }

    public function detail(Request $request, $jancode){
        return $this->exportedService->detailByJanCode($request, $jancode);
    }
}
