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

    public function detail(Request $request, $jan_code){
        return $this->exportedService->detailByJanCode($request, $jan_code);
    }

    public function loadNote($jancode){
        return $this->exportedService->loadNote($jancode);
    }

    public function noteExport(Request $request, $jancode){
        return $this->exportedService->doNoteExport($request, $jancode);
    }
}
