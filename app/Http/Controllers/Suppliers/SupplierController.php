<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suppliers\SupplierRequest;
use App\Http\Requests\Suppliers\SupplierRequestUpdate;
use App\Services\Suppliers\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }
    public function list()
    {
        $suppliers = $this->supplierService->showList();
        return view('suppliers.management', compact('suppliers'));
    }

    public function create(SupplierRequest $request)
    {
        return $this->supplierService->createNew($request);
    }

    public function show($code_name)
    {
        return $this->supplierService->showDetail($code_name);
    }

    public function update(SupplierRequestUpdate $request, $code_name)
    {
        return $this->supplierService->updateDetail($request, $code_name);
    }
    public function index(Request $request)
    {
        $records = $request->record ?: 25;
        // dd($records);q
        return view('suppliers.debt');
    }
}
