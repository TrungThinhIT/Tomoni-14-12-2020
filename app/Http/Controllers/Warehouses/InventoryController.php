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

    public function detailProduct($jancode){
        return $this->inventoryService->detailUpdateProduct($jancode);
    }

    public function updateProduct(Request $request, $jancode){
        return $this->inventoryService->doUpdateProduct($request, $jancode);
    }

    public function loadNote($jancode){
        return $this->inventoryService->loadNoteWarehouse($jancode);
    }

    public function noteInventory(Request $request, $jancode){
        return $this->inventoryService->doNoteInventory($request, $jancode);
    }
}
