<?php

namespace App\Services\Warehouses;

use App\Models\NoteWarehouse;
use App\Models\InvoiceDetailSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImportedService {

    public function index(Request $request){
        $jan_code = $request->jan_code;

        $importeds = InvoiceDetailSupplier::query();
        
        if($jan_code){
            $importeds = $importeds->where('Jancode', $jan_code);
        }

        $importeds = $importeds->has('product')->select()->selectRaw('sum(Quantity) as totalQuantity')->selectRaw('sum(Price) as totalPrice')->groupBy('Jancode')->paginate(10);
        return ['importeds' => $importeds, 'jan_code'=> $jan_code];
    }

    public function detailByJanCode(Request $request, $jan_code){
        $imported = InvoiceDetailSupplier::where('Jancode', $jan_code)->orderBy('Dateinsert', 'DESC')->paginate(50);
        return view('warehouses.includes.modalImported', compact('imported'))->render();
    }

    public function loadNote($jancode){
        $log = NoteWarehouse::where('Jancode', $jancode)->where('action', 'import')->orderBy('created_at', 'ASC')->get();
        $html = view('warehouses.includes.logWarehouse', compact('log'));
        return $html;
    }

    public function doNoteImport(Request $request, $jancode){
        NoteWarehouse::create([
            'note' => $request->note,
            'uname' => Auth::user()->uname,
            'action' => 'import',
            'Jancode' => $jancode
        ]);
    }
}