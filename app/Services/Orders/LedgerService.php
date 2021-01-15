<?php

namespace App\Services\Orders;

use App\Http\Requests\Orders\CreateLedgerRequest;
use App\Http\Requests\Orders\UpdateLedgerRequest;
use App\Models\Ledger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bill;
use Illuminate\Validation\Rules\Unique;

class LedgerService
{

    public function searchUser(Request $request)
    {
        $users = DB::table('users')->where('uname', 'like', '%' . $request->uname . '%')->get();
        return response()->json($users);
    }

    public function showList(Request $request)
    {
        $Uname = $request->Uname;
        $PriceInSearch = $request->PriceIn;
        $PriceOutSearch = $request->PriceOut;
        $PricedelbSearch = $request->Pricedelb;
        $users = Ledger::get()->toArray();

        foreach($users as $item){
            $RawPriceIn = Bill::where('uname', $item['Uname'])->where('deleted_at', null)->select('PriceIn')->distinct()->get();
            $priceIn = 0;
            foreach ($RawPriceIn as $value) {
                $priceIn += $value->PriceIn;
            }
            $priceOut = Bill::where('uname', $item['Uname'])->where('deleted_at', null)->selectRaw('sum(PriceOut) as priceOuts')->first();
            $pricedelb = $priceIn - $priceOut->priceOuts;
            Ledger::where('Uname', $item['Uname'])->update([
                'PriceIn' => $priceIn,
                'PriceOut' => $priceOut->priceOuts,
                'Pricedelb' => $pricedelb
            ]);
        }

       $ledgers = Ledger::select();

       if($Uname){
          $ledgers =  $ledgers->where('Uname', $Uname);
       }

       if($PriceInSearch){
           $ledgers = $ledgers->where('PriceIn', $PriceInSearch);
       }
       
       if($PriceOutSearch){
           $ledgers = $ledgers->where('PriceOut', '=', $PriceOutSearch);
       }

       if($PricedelbSearch){
           $ledgers = $ledgers->where('Pricedelb', $PricedelbSearch);
       }
        $ledgers = $ledgers->orderBy('Id', 'DESC')->paginate(5);

        $data = ['Uname' => $Uname, 'PriceIn' => $PriceInSearch, 'PriceOut' => $PriceOutSearch, 'Pricedelb' => $PricedelbSearch, 'ledgers' => $ledgers];
        return $data;
    }

    public function getLedger($Id)
    {
        $ledger = Ledger::find($Id);
        $html = view('orders.includes.modalLedgerDetail', compact('ledger'));
        return $html;
    }

    public function createNew(CreateLedgerRequest $request)
    {
        Ledger::create(
            $request->all()
        );
        toastr()->success('Create successfully!', 'Notifycation');
        return back();
    }

    public function update(UpdateLedgerRequest $request, $Id)
    {
        Ledger::where('Id', $Id)->update([
            'Uname' => $request->eUname,
            'PriceIn' => $request->ePriceIn,
            'PriceOut' => $request->ePriceOut,
            'Pricedelb' => $request->ePricedelb,
        ]);
            toastr()->success('Update successfully!', 'Notifycation');
            return 1;
    }

    public function deleteById($Id){
        Ledger::where('ID', $Id)->delete();
        toastr()->info('Delete successfully!', 'Notifycation');
        return back();
    }
}
