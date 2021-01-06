<?php

namespace App\Services\Warehouses;

use Illuminate\Http\Request;
use App\Models\InvoiceDetailSupllier;
use App\Models\Bill;

class InventoryService
{

    public function index(Request $request)
    {
        $janCode = $request->jan_code;

        $importeds = InvoiceDetailSupllier::query();

        if ($janCode) {
            $importeds = $importeds->where('Jancode', $janCode);
        }

        $importeds = $importeds->select()->selectRaw('sum(Quantity) as totalQuantity')->selectRaw('sum(Price) as totalPrice')->groupBy('Jancode')->get();

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

        $exporteds = $exporteds->select('product.quantity')->selectRaw('product_standard.name')->selectRaw('product.jan_code')->selectRaw('sum(quantity) as totalQuantity')
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
                $value[0]->setAttribute('TotalQuantity', $value[0]->totalQuantity);
            }
        }

        $inventories = $inventories->sortBy('Dateinsert')->paginate(10);
        return ['inventories' => $inventories, 'jan_code' => $janCode];
    }

    public function detailInventory(Request $request, $jancode)
    {
        $imported = InvoiceDetailSupllier::where('Jancode', $jancode)->orderBy('Dateinsert', 'DESC')->get();
        $exported = Bill::where('deleted_at', null)->select()->distinct()->join(
            'product',
            'product.codeorder',
            '=',
            'accoutant_order.Codeorder'
        )->where('jan_code', $jancode)->get();
        foreach ($exported as $item) {
            $item->setAttribute('Dateinsert', $item->Date_Create);
            $item->setAttribute('Jancode', $item->jan_code);
        }
        $inventory = collect($imported)->merge($exported)->sortBy('Dateinsert');

        $debtQuantity = 0;

        foreach ($inventory as $item) {
            if ($item->jan_code) {
                $item->setAttribute('debtQuantity', $debtQuantity -= $item->quantity);
            } else {
                $item->setAttribute('debtQuantity', $debtQuantity += $item->Quantity);
            }
        }
        if($request->ajax() || 'NULL'){
            $inventory = $inventory->sortByDesc('Dateinsert')->paginate(10);
            return view('warehouses.includes.modalInventory', compact('inventory'));
        }else{

            $inventory = $inventory->sortByDesc('Dateinsert')->paginate(10);
        return view('warehouses.includes.modalInventory', compact('inventory'));
    }
    }
}
