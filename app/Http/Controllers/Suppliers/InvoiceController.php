<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suppliers\InvoiceRequest;
use App\Services\Suppliers\InvoiceService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function list(Request $request){
        $data = $this->invoiceService->showList($request);
        return view('suppliers.invoice', compact('data'));
    }

    public function create(InvoiceRequest $request)
    {
       return $this->invoiceService->createNew($request);
    }
}
