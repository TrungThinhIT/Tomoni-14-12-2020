<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Controllers\Controller;
use App\Services\Warehouses\ImportedService;
use Illuminate\Http\Request;

class ImportedController extends Controller
{
    protected $importedService;

    public function __construct(ImportedService $importedService)
    {
        $this->importedService = $importedService;
    }
    public function index(Request $request)
    {
        $data = $this->importedService->index($request);
        return view('warehouses.imported', compact('data'));
    }

    public function detail($jan_code)
    {
        return $this->importedService->detailByJanCode($jan_code);
    }
}
