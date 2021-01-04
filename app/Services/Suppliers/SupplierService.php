<?php

namespace App\Services\Suppliers;

use App\Http\Requests\Suppliers\SupplierRequest;
use App\Http\Requests\Suppliers\SupplierRequestUpdate;
use Illuminate\Http\Request;
use App\Models\Supplier;

class   SupplierService
{
    public function showList(){
        return Supplier::paginate(10);
    }

    public function createNew(SupplierRequest $request){
        $supplier = Supplier::create([
            'code_name' => $request->ucode,
            'name' => $request->uname,
            'email' => $request->umail,
            'address' => $request->uadd,
            'phone' => $request->uphone,
            'BankName' =>$request->ubank,
            'Branch' => $request->ubranch,
            'AccountNumber' => $request->uAccountNumber,
            'AccountName' => $request->uAccountName,
            'note' => $request->unote,
            'rank' => $request->urank
        ]);
        if($supplier){
            toastr()->success('Insert success fully!', 'Notifycation');
            return back();
        }
    }

    public function showDetail($code_name){
        $supplier = Supplier::where('code_name', $code_name)->first();
        $html = view('suppliers.includes.modalSupplierDetail',compact('supplier'));
        return $html;
    }

    public function updateDetail(SupplierRequestUpdate $request, $code_name){
        $supplier = Supplier::where('code_name',$code_name)->update([
            'name' => $request->ename,
            'email' => $request->email,
            'address' => $request->eadd,
            'phone' => $request->ephone,
            'BankName' =>$request->ebank,
            'Branch' => $request->ebranch,
            'AccountNumber' => $request->eAccountNumber,
            'AccountName' => $request->eAccountName,
            'note' => $request->enote,
            'rank' => $request->erank
        ]);

        if($supplier){
            return 1;
        }else{
            return 2;
        }
    }
}
