<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\PaymentCustomerRequest;
use App\Services\Orders\PaymentCustomerService;
use Illuminate\Http\Request;

class PaymentCustomerController extends Controller
{
    protected $paymentCustomer;

    public function __construct(PaymentCustomerService $paymentCustomer)
    {
        $this->paymentCustomer = $paymentCustomer;
    }

    public function index(Request $request){
        $data = $this->paymentCustomer->indexAll($request);
        return view('orders.payment_customers', compact('data'));
    }

    public function insert(PaymentCustomerRequest $request){
        return $this->paymentCustomer->insert($request);
    }

    public function update(Request $request, $id){
        return $this->paymentCustomer->updateById($request, $id);
    }
}
