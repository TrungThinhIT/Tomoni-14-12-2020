<?php

namespace App\Services\Customers;

use App\Http\Requests\Orders\CreateBillRequest;
use App\Models\Bill;
use App\Models\LogAccountant;
use App\Models\LogAdmin;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportedService
{
    public function index(Request $request){
        $name = $request->name;
        $jan_code = $request->jan_code;

        $exporteds = Bill::where('deleted_at', null)->where('accoutant_order.uname', Auth::user()->uname)->select()->distinct()->join(
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
        
        $exporteds = $exporteds->orderBy('Date_Create', 'DESC')->paginate(10);
        return ['exporteds' => $exporteds, 'jan_code'=> $jan_code, 'name'=> $name];
    }

    public function detailByJanCode(Request $request, $jan_code){
        $exported = Bill::where('deleted_at', null)->where('accoutant_order.uname', Auth::user()->uname)->select()->distinct()->join(
            'product',
            'product.codeorder',
            '=',
            'accoutant_order.Codeorder'
        )->where('jan_code', $jan_code)->paginate(1);
        return view('customers.includes.modalExported', compact('exported'));
    }
}
