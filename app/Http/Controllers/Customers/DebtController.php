<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Customers\DebtService;

class DebtController extends Controller
{
    protected $debtService;

    public function __construct(DebtService $debtService)
    {
        $this->debtService = $debtService;
    }
    public function index(Request $request){
        $data = $this->debtService->index($request);
        return view('customers.debt', compact('data'));
    }

    public function export(){
       return $this->debtService->export(); 
    }
}
