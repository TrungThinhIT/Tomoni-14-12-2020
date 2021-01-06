<?php

namespace App\Services\Warehouses;

use App\Models\Bill;
use App\Models\InvoiceDetailSupllier;
use Illuminate\Http\Request;

class ImportedService {

    public function index(Request $request){
        $jan_code = $request->jan_code;

        $importeds = InvoiceDetailSupllier::query();
        
        if($jan_code){
            $importeds = $importeds->where('Jancode', $jan_code);
        }

        $importeds = $importeds->with('product')->select()->selectRaw('sum(Quantity) as totalQuantity')->selectRaw('sum(Price) as totalPrice')->groupBy('Jancode')->paginate(10);
        return ['importeds' => $importeds, 'jan_code'=> $jan_code];
    }

    public function detailByJanCode($jan_code){
        $imported = InvoiceDetailSupllier::where('Jancode', $jan_code)->orderBy('Dateinsert', 'DESC')->get();
        return view('warehouses.includes.modalImported', compact('imported'));
    }
}
