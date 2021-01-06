<?php

namespace App\Services\Warehouses;

use App\Models\Bill;
use App\Models\Product;
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

        $exporteds = $exporteds->select('product.quantity')->selectRaw('product_standard.name')->selectRaw('product.jan_code')->selectRaw('sum(quantity) as totalQuantity')
        ->groupBy('product.jan_code');
        
        if($name){
            $exporteds = $exporteds->where('name', 'like', '%' .$name. '%');
        }

        if($jan_code){
            $exporteds = $exporteds->where('product_standard.jan_code', $jan_code);
        }
        
        $exporteds = $exporteds->orderBy('Date_Create', 'DESC')->paginate(10);
        return ['exporteds' => $exporteds, 'jan_code'=> $jan_code, 'name'=> $name];
    }

    public function detailByJanCode($jan_code){
        $exported = Bill::where('deleted_at', null)->select()->distinct()->join(
            'product',
            'product.codeorder',
            '=',
            'accoutant_order.Codeorder'
        )->where('jan_code', $jan_code)->get();
        return view('warehouses.includes.modalExported', compact('exported'));
    }
}

?>