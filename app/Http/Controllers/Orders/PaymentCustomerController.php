<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Services\Orders\PaymentCustomerService;
use Illuminate\Http\Request;

class PaymentCustomerController extends Controller
{
    protected $paymentCustomer;

    public function __construct(PaymentCustomerService $paymentCustomer)
    {
        $this->paymentCustomer = $paymentCustomer;
    }

    public function index(){
        $data = $this->paymentCustomer->indexAll();
        return view('orders.payment_customers', compact('data'));
    }

    public function update(Request $request, $id){
        return $this->paymentCustomer->updateById($request, $id);
    }
}
