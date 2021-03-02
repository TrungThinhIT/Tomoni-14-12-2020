<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\returnProductRequest;
use Illuminate\Http\Request;

class returnProductController extends Controller
{
    //
    public function index(){
        return view('orders.returnProduct');
    }
    public function create(returnProductRequest $request){
        
    }
}
