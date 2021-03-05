<?php

namespace App\Services\Warehouses;

use App\Models\Bill;
use App\Models\NoteWarehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ExportedService {

    public function index(Request $request){
        $name = $request->name;
        $jan_code = $request->jan_code;

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
        ->selectRaw('product.jan_code')->selectRaw('sum(quantity) as totalQuantity')
        ->selectRaw('sum(product.item_in_box) as itemInBox')
        ->groupBy('product.jan_code');
        if($name){
            $exporteds = $exporteds->where('name', 'like', '%' .$name. '%');
        }

        if($jan_code){
            $exporteds = $exporteds->where('product_standard.jan_code', $jan_code);
        }
        
        $exporteds = $exporteds->orderBy('Date_Create', 'DESC')->paginate(50);
        return ['exporteds' => $exporteds, 'jan_code'=> $jan_code, 'name'=> $name];
    }

    public function detailByJanCode(Request $request, $jan_code){
        $exported = Bill::where('deleted_at', null)->select()->distinct()->join(
            'product',
            'product.codeorder',
            '=',
            'accoutant_order.Codeorder'
        )->where('jan_code', $jan_code)->paginate(10);
        return view('warehouses.includes.modalExported', compact('exported'));
    }

    public function loadNote($jancode){
        $log = NoteWarehouse::where('Jancode', $jancode)->where('action', 'export')->orderBy('created_at', 'ASC')->get();
        $html = view('warehouses.includes.logWarehouse', compact('log'));
        return $html;
    }

    public function doNoteExport(Request $request, $jancode){
        NoteWarehouse::create([
            'note' => $request->note,
            'uname' => Auth::user()->uname,
            'action' => 'export',
            'Jancode' => $jancode
        ]);
    }
}

?>