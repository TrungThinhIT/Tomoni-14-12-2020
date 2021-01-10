<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suppliers\PaymentSupplierRequest;
use App\Services\Suppliers\PaymentSupplierService;
use Illuminate\Http\Request;

class PaymentSupplierController extends Controller
{
    protected $paymentSupplierService;

    public function __construct(PaymentSupplierService $paymentSupplierService)
    {
        $this->paymentSupplierService = $paymentSupplierService;
    }
    public function index(Request $request){
        $data = $this->paymentSupplierService->index($request);
        return view('suppliers.payments', compact('data'));
    }

    public function create(PaymentSupplierRequest $request){
        return $this->paymentSupplierService->create($request);
    }

    public function update(Request $request, $Id){
        return $this->paymentSupplierService->update($request, $Id);
    }

    public function delete($Id){
        return $this->paymentSupplierService->delete($Id);
    }

    public function searchInvoice(Request $request){
        return $this->paymentSupplierService->searchInvoice($request);
    }
    
    public function searchSupplier(Request $request){
        return $this->paymentSupplierService->searchSupplier($request);
    }
}
