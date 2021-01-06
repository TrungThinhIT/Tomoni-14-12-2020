<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Controllers\Controller;
use App\Services\Warehouses\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    protected $inventoryService;

    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }
    public function index(Request $request){
        $data = $this->inventoryService->index($request);
        return view('warehouses.inventory', compact('data'));
    }

    public function detail(Request $request, $jancode){
        return $this->inventoryService->detailInventory($request, $jancode);
    }
}
