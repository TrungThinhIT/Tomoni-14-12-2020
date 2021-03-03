<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\returnProductRequest;
use App\Models\Bill;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\returnProductModel;
use Illuminate\Http\Request;

class returnProductController extends Controller
{
    //
    public function index()
    {
        $data = returnProductModel::paginate(50);
        return view('orders.returnProduct', compact('data'));
    }
    public function create(returnProductRequest $request)
    {
        $check = returnProductModel::create([
            'jancode' => $request->Jancode,
            'price' => $request->price,
            'quantity' => $request->Quantity,
            'uname' => $request->uname,
            'codeorder' => $request->CodeOrder
        ]);
        if ($check) {
            Inventory::create([
                'jancode' => $request->Jancode,
                'codeorder' => $request->CodeOrder,
                'uname' => $request->uname,
                'action' => "Trả lại hàng mua",
                'quantityUpdate' => $request->Quantity,
                'created_at' => now()
            ]);
            toastr()->success('Created Successfully', 'Notification', ['timeOut' => 1200]);
            return back();
        }
    }
    public function searchCodeOrder(Request $request)
    {
        $data = Bill::where('Codeorder', 'like', '%' . $request->BillCode . "%")->select('Codeorder')->distinct()->limit(10)->get();
        return response()->json($data);
    }
    public function searchJanCode(Request $request)
    {
        $data = Product::where('codeorder', $request->CodeOrder)->get();
        return response()->json($data);
    }
    public function infoJancode(Request $request, $jancode)
    {
        $data = Product::where('jan_code', $jancode)->where('codeorder', $request->codeorder)->select('price', 'quantity')->get();
        return response()->json($data);
    }
}
