<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\CreateLedgerRequest;
use App\Http\Requests\Orders\UpdateLedgerRequest;
use App\Services\Orders\LedgerService;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    protected $ledgerService;

    public function __construct(LedgerService $ledgerService)
    {
        $this->ledgerService = $ledgerService;
    }

    public function searchUser(Request $request){
        return $this->ledgerService->searchUser($request);
    }

    public function index(Request $request){
        $data = $this->ledgerService->showList($request);
        return view('orders.ledger', compact('data'));
    }

    public function get($Id){
        return $this->ledgerService->getLedger($Id);
    }

    public function create(CreateLedgerRequest $request){
        return $this->ledgerService->createNew($request);
    }

    public function update(UpdateLedgerRequest $request, $Id){
        return $this->ledgerService->update($request, $Id);
    }

    public function delete($Id){
        return $this->ledgerService->deleteById($Id);
    }
}
