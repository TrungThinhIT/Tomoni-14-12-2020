<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suppliers\AddInvoiceDetailRequest;
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

    public function show($Invoice){
        return $this->invoiceService->showInvoice($Invoice);
    }

    public function showById($Id){
        $data = $this->invoiceService->showInvoiceById($Id);
        return view('suppliers.invoiceDetail', compact('data'));
    }

    public function delete($Invoice){
        return $this->invoiceService->deleteInvoice($Invoice);
    }

    public function deleteDetail($Id){
        return $this->invoiceService->deleteInvoiceDetail($Id);
    }

    public function searchCodeOrder(Request $request){
        return $this->invoiceService->searchCodeOrder($request);
    }

    public function searchCodeJan(Request $request){
        return $this->invoiceService->searchCodeJan($request);
    }

    public function create(InvoiceRequest $request)
    {
       return $this->invoiceService->createInvoice($request);
    }

    public function createDetail(Request $request){
        return $this->invoiceService->createInvoiceDetail($request);
    }

    public function updateInvoice(Request $request, $Id){
        return $this->invoiceService->updateInvoice($request, $Id);
    }

    public function updateInvoiceDetail(Request $request, $Id){
        return $this->invoiceService->updateInvoiceDetail($request, $Id);
    }

    public function createMoreDetail(AddInvoiceDetailRequest $request, $Invoice){
        return $this->invoiceService->createMoreInvoiceDetail($request, $Invoice);
    }
}
