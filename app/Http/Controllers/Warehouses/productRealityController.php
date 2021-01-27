<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Controllers\Controller;
use App\Http\Requests\warehouse\productRealityRequest;
use App\Models\productReality;
use Illuminate\Http\Request;
use App\Models\addressCustomer;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class productRealityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAddress($id)
    {
        $uname = addressCustomer::find($id)->uname;
        $data = addressCustomer::where('uname', $uname)->get(['address', 'id', 'add_default']);
        return response()->json($data);
    }
    public function index()
    {
        //
        $product_reality = productReality::paginate(10);
        $unames = addressCustomer::all('id', 'uname')->unique('uname');
        return view('warehouses.productReality', compact('product_reality', 'unames'));
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
    public function store(productRealityRequest $request)
    {
        //
        // $imgPath = $request->Image->store('images');
        $address = addressCustomer::find($request->selectedAddress);
        if ($img = $request->file('Image')) {
            $extension =  $img->getClientOriginalExtension();
            $name = Str::random(60);
            while (file_exists('images/' . $name . $extension)) {
                $name = Str::random(60);
            }
            $imgage = Image::make($img->getRealPath());
            // dd($imgage);
            $imgage->resize(100, 100)->save(public_path('images/' . $name . '.' . $extension));
        }
        if (productReality::create([
            'codeorder' => $request->CodeOrder,
            'uname' => $address->uname,
            'container' => $request->Container,
            'quantity' => $request->quantity,
            'invoice' => $request->Invoice,
            'address' => $address->address,
            'imghoadongiaohang' => $imgage->basename,
            // 'delivery_time' => $request->DeliveryDate . ' ' . $request->DeliveryTime,
        ])) {
            session()->flash('success', 'Created success');
            return back();
        }
        session()->flash('wrong', 'Create Fail');
        return back();

        // return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\productReality  $productReality
     * @return \Illuminate\Http\Response
     */
    public function show(productReality $productReality)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\productReality  $productReality
     * @return \Illuminate\Http\Response
     */
    public function edit(productReality $productReality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\productReality  $productReality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, productReality $productReality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productReality  $productReality
     * @return \Illuminate\Http\Response
     */
    public function destroy(productReality $productReality)
    {
        //
    }
}
