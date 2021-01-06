<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Controllers\Controller;
use App\Services\Warehouses\ExportedService;
use Illuminate\Http\Request;

class ExportedController extends Controller
{
    protected $exportedService;

    public function __construct(ExportedService $exportedService)
    {
        $this->exportedService = $exportedService;
    }
    public function index(Request $request)
    {
        $data = $this->exportedService->index($request);
        return view('warehouses.exported', compact('data'));
    }

    public function detail($jan_code){
        return $this->exportedService->detailByJanCode($jan_code);
    }
}
