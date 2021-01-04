<?php

namespace App\Http\Controllers\Warehouse;

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
    public function index()
    {
        return $this->exportedService->index();
    }
}
