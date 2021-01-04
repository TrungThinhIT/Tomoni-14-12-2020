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
        $PriceIn = $request->PriceIn;
        $PriceOut = $request->PriceOut;
        $Pricedelb = $request->Pricedelb;

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

        $ledgers = Ledger::query();

        $ledgers->where('Uname', 'like', '%' . $Uname . '%')->orWhere('PriceIn', $PriceIn)
            ->orWhere('PriceOut', $PriceOut)->orWhere('Pricedelb', $Pricedelb);

        $ledgers = $ledgers->orderBy('Id', 'DESC')->paginate(5);

        $data = ['Uname' => $Uname, 'PriceIn' => $PriceIn, 'PriceOut' => $PriceOut, 'Pricedelb' => $Pricedelb, 'ledgers' => $ledgers];
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
