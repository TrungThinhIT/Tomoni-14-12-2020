<?php

namespace App\Services\Warehouses;

use Illuminate\Http\Request;
use App\Models\InvoiceDetailSupplier;
use App\Models\Bill;
use App\Models\Inventory;
use App\Models\NoteWarehouse;
use App\Models\Product;
use App\Models\ProductStandard;
use Illuminate\Support\Facades\Auth;

class InventoryService
{

    public function index(Request $request)
    {
        $janCode = $request->jan_code;
        $status = $request->status;

        $importeds = InvoiceDetailSupplier::query();

        if ($janCode) {
            $importeds = $importeds->where('Jancode', $janCode);
        }

        $importeds = $importeds->join(
            'product_standard',
            'product_standard.jan_code',
            '=',
            'acountant_jancodeitem.Jancode',
        );

        $importeds = $importeds->select()->selectRaw('sum(acountant_jancodeitem.Quantity) as totalQuantity')->selectRaw('sum(acountant_jancodeitem.Price) as totalPrice')->groupBy('Jancode')->get();
        $exporteds = Bill::where('deleted_at', null)->select()->distinct()->join(
            'product',
            'product.codeorder',
            '=',
            'accoutant_order.Codeorder'
        )->join(
            'product_standard',
            'product_standard.jan_code',
            '=',
            'product.jan_code',
        );

        $exporteds = $exporteds->select('product.quantity')->select('product.item_in_box')->selectRaw('product_standard.name')
            ->selectRaw('product_standard.weight')->selectRaw('product_standard.length')->selectRaw('product_standard.width')->selectRaw('product_standard.height')
            ->selectRaw('product.jan_code')->selectRaw('sum(quantity) as totalQuantity')->selectRaw('sum(product.item_in_box) as itemInBox')
            ->groupBy('product.jan_code')->get();

        if ($janCode) {
            $exporteds = $exporteds->where('jan_code', $janCode);
        }

        foreach ($exporteds as $value) {
            $value->setAttribute('Jancode', $value->jan_code);
        }
        $inventories = collect($importeds)->merge($exporteds)->groupBy('Jancode');

        foreach ($inventories as $value) {
            if (count($value) > 1) {
                $TotalQuantity = $value[0]->totalQuantity - $value[1]->totalQuantity;
                $value[0]->setAttribute('TotalQuantity', $TotalQuantity);
            } else {
                $value[0]->setAttribute('TotalQuantity', ($value[0]->totalQuantity));
            }
            if (count($value) > 1) {
                $TotalQuantity = $value[0]->totalQuantity - $value[1]->totalQuantity;
                $value[0]->setAttribute('TotalQuantity', $TotalQuantity);
            } else {
                if ($value[0]->name_2) {
                    $TotalQuantity = $value[0]->totalQuantity;
                    $value[0]->setAttribute('TotalQuantity', $TotalQuantity);
                } else {
                    $TotalQuantity =  - ($value[0]->totalQuantity);
                    $value[0]->setAttribute('TotalQuantity', $TotalQuantity);
                }
            }
        }

        $inventories = $inventories->flatten();

        if ($status && $status == 1) {
            $inventories = $inventories->where('TotalQuantity', '>', '0');
        }

        if ($status && $status == 2) {
            $inventories = $inventories->where('TotalQuantity', '=', '0');
        }

        if ($status && $status == 3) {
            $inventories = $inventories->where('TotalQuantity', '<', 0);
        }

        $inventories = $inventories->groupBy('Jancode');

        $inventories = $inventories->sortBy('Dateinsert')->paginate(10);
        return ['inventories' => $inventories, 'jan_code' => $janCode, 'status' => $status];
    }

    public function detailInventory(Request $request, $jancode)
    {
        $status = $request->status;
        // $imported = InvoiceDetailSupplier::where('Jancode', $jancode)->orderBy('Dateinsert', 'DESC')->get();

        // $exported = Bill::where('deleted_at', null)->select()->distinct()->join(
        //     'product',
        //     'product.codeorder',
        //     '=',
        //     'accoutant_order.Codeorder'
        // )->where('jan_code', $jancode);
        // if($request->status == 1){
        //     $exported = $exported->whereHas('Product.Inventory', function ($query) {
        //         return $query->where('action', 'Xuất order');                
        //     });
        // }
        // if($request->status == 2){
        //     $exported = $exported->whereHas('Product.Inventory', function ($query) {
        //         return $query->where('action', 'Trả lại hàng mua');                
        //     });
        // }
        // $exported = $exported->get();
        // foreach ($exported as $item) {
        //     $item->setAttribute('Dateinsert', $item->Date_Create);
        //     $item->setAttribute('Jancode', $item->jan_code);
        // }
        // $inventory = collect($imported)->merge($exported)->sortBy('Dateinsert');

        // $debtQuantity = 0;

        // foreach ($inventory as $item) {
        //     if ($item->jan_code) {
        //         $item->setAttribute('debtQuantity', $debtQuantity -= $item->quantity);
        //     } else {
        //         $item->setAttribute('debtQuantity', $debtQuantity += $item->Quantity);
        //     }
        // }
        $inventories = Inventory::where('jancode', $jancode)->get();
        if($status == 1){
            $inventories = $inventories->where('action', 'Xuất order');
        }
        if($status == 2){            
            $inventories = $inventories->where('action', 'Trả lại hàng mua');
        }
        $inventories = collect($inventories)->groupBy('codeorder');

            foreach($inventories as $value){
                $i = 0; 
                foreach($value->sortBy('created_at') as $item){
                    if($item[0]){
                        $item->setAttribute('debtQuantity', 0);
                        $i = $item->quantityUpdate;
                    }else{
                        $item->setAttribute('debtQuantity', $item->quantityUpdate - $i);
                        $i = $item->quantityUpdate;
                    }
                }
                $value = $value->sortByDesc('created_at');
            }
            $inventories = $inventories->values();
        if ($request->ajax() || 'NULL') {
            $inventory = $inventories->paginate(10);
            return view('warehouses.includes.modalInventory', compact('inventory', 'jancode', 'status'));
        } else {
            $inventory = $inventories->paginate(10);
            return view('warehouses.includes.modalInventory', compact('inventory', 'jancode', 'status'));
        }
    }

    public function detailUpdateProduct($jancode)
    {
        $product = ProductStandard::where('jan_code', $jancode)->first();
        return view('warehouses.includes.modalUpdateProduct', compact('product'));
    }

    public function doUpdateProduct(Request $request, $jancode)
    {
        $product = ProductStandard::where('jan_code', $jancode)->update([
            'weight' => $request->weight,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height
        ]);
        if ($product) {
            return 1;
        } else {
            return 2;
        }
    }

    public function loadNoteWarehouse($jancode)
    {
        $log = NoteWarehouse::where('Jancode', $jancode)->orderBy('created_at', 'ASC')->get();
        $html = view('warehouses.includes.logWarehouse', compact('log'));
        return $html;
    }

    public function doNoteInventory(Request $request, $jancode)
    {
        NoteWarehouse::create([
            'note' => $request->note,
            'uname' => Auth::user()->uname,
            'action' => 'inventory',
            'Jancode' => $jancode
        ]);
    }
}
