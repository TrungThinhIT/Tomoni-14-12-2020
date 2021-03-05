<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\refundCustomerRequest;
use App\Models\Bill;
use App\Models\refundCustomerModel;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class refundCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $uname = $request->Uname;
        $date_inprice = $request->date_inprice;
        $date_end = $request->date_insert;
        $invoice = $request->Sohoadon;
        $refundCustomer = refundCustomerModel::query();
        if ($uname) {
            $refundCustomer = $refundCustomer->where('uname', $uname);
        }

        if ($date_inprice && $date_end) {
            $refundCustomer = $refundCustomer->whereBetween('date_in', [$date_inprice, $date_end]);
        }

        if ($invoice) {
            $refundCustomer = $refundCustomer->where('billcode', $invoice);
        }
        $data = $refundCustomer->orderBy('date_insert', 'DESC')->paginate(50);
        return view('orders.refundCustomer', compact('data', 'date_inprice', 'date_end', 'uname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(refundCustomerRequest $request)
    {
        $check = Bill::where([['uname', $request->uname], ['So_Hoadon', $request->SoHoadon]])->get()->toArray();
        if (!empty($check)) {
            $insert = refundCustomerModel::create([
                'uname' => $request->uname,
                'note' => $request->note,
                'date_in' => $request->dateInprice,
                'money' => $request->priceIn,
                'billcode' => $request->SoHoadon
            ]);
            if ($insert) {
                toastr()->success('Created success', 'Notification', ['timeOut' => 1000]);
                return back();
            } else {
                toastr()->error('Created Failed', 'Notification', ['timeOut' => 1000]);
                return back();
            }
        } else {
            toastr()->error('Số hóa đơn hoặc uname sai', 'Notifications', ['timeOUt' => 1000]);
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\refundCustomerModel  $refundCustomerModel
     * @return \Illuminate\Http\Response
     */
    public function show(refundCustomerModel $refundCustomerModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\refundCustomerModel  $refundCustomerModel
     * @return \Illuminate\Http\Response
     */
    public function edit(refundCustomerModel $refundCustomerModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\refundCustomerModel  $refundCustomerModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, refundCustomerModel $refundCustomerModel, $Id)
    {
        //
        $refundCustomer = $refundCustomerModel::find($Id)->update([
            'uname' => $request->uname,
            'billcode' => $request->sohoadon
        ]);
        if ($refundCustomer) {
            return 1;
        } else {
            return 2;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\refundCustomerModel  $refundCustomerModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(refundCustomerModel $refundCustomerModel)
    {
        //
    }
}
