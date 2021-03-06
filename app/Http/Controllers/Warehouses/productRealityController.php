<?php

namespace App\Http\Controllers\Warehouses;

use App\Exports\ProductReality\ProductRealityExcel;
use App\Http\Controllers\Controller;
use App\Http\Requests\warehouse\productRealityRequest;
use App\Models\productReality;
use Illuminate\Http\Request;
use App\Models\addressCustomer;
use App\Models\Order;
use finfo;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class productRealityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $productRealityExport;

    public function __construct(ProductRealityExcel $productRealityExport)
    {
        $this->productRealityExport = $productRealityExport;
    }
    public function getCodeOrder(Request $request)
    {
        $codeorder  = Order::where('codeorder', 'like', '%' . $request->search_ordercode . '%')->limit(10)->get();
        return response()->json($codeorder);
    }
    public function getAddress($id)
    {
        $uname = addressCustomer::find($id)->uname;
        $data = addressCustomer::where('uname', $uname)->get(['address', 'id', 'add_default']);
        $sum = $data->sum('add_default');
        $data = ['data' => $data, 'sum' => $sum];
        return response()->json($data);
    }
    public function index()
    {
        //
        $product_reality = productReality::paginate(10);
        $unames = addressCustomer::all('id', 'uname')->unique('uname');
        return view('warehouses.productReality', compact('product_reality', 'unames'));
    }

    public function dataTable(Request $request)
    {
        $uname = $request->uname;
        $codeorder = $request->codeorder;
        $container = $request->container;
        $invoice = $request->invoice;
        $quantity = $request->quantity;
        $export = $request->export;
        // dd($request->all());
        $product_reality = productReality::query();

        if ($uname ) {
            $product_reality = $product_reality->where('uname', $uname);
        }

        if ($codeorder ) {
            $product_reality = $product_reality->where('codeorder','like','%'. $codeorder.'%');
        }

        if ($container ) {
            $product_reality = $product_reality->where('container', $container);
        }

        if ($invoice ) {
            $product_reality = $product_reality->where('invoice', $invoice);
        }

        if ($quantity ) {
            $product_reality = $product_reality->where('quantity', $quantity);
        }

        if ($export == "true") {
            $products = $product_reality->get();
            // dd($product_reality);
            return $this->productRealityExport->ExportProduct($products);
        }

        $product_reality = $product_reality->paginate(3);
        return view('warehouses.includes.tableProductReality', compact('product_reality'));
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
        // $imgPath = $request->Image->store('images');
        $address = addressCustomer::find($request->selectedAddress);
        //resize img & change name img
        if ($img = $request->Image) {
            // dd($img);
            $ext = $img->getClientOriginalExtension();
            $name =  $img->getClientOriginalName();
            // dd($name);
            $str = Str::random(40);
            while (file_exists('images/' . $str . '.' . $ext)) {
                $str = Str::random(40);
            }
            // 
            // dd($img->storeAs('images', $str . '.' . $ext));
            $image = Image::make($img->storeAs('images', $str . '.' . $ext));

            // dd($image);
            $image->resize(80, 80);
            $image->save(public_path('thumnails/' . $str . '.' . $ext));
            // dd($image);

        }
        if (productReality::create([
            'codeorder' => $request->CodeOrder,
            'uname' => $address->uname,
            'container' => $request->Container,
            'quantity' => $request->quantity,
            'invoice' => $request->Invoice,
            'address' => $address->address,
            'imghoadongiaohang' => $image->basename,
            // 'delivery_time' => $request->DeliveryDate . ' ' . $request->DeliveryTime,
        ])) {

            toastr()->success('Create successfully!', 'Notifycation', ['timeOut' => 500]);
            // session()->flash('success', 'Created success');
            return back();
        }
        session()->flash('wrong', 'Fail');
        return back();

        //
        return back();
    }
    public function getImage($img)
    {
        return view('warehouses.includes.imageModal', compact('img'));
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
    // public function getSearch(Request $request)
    // {
    //     // return response()->json($request->all());
    //     $uname = $request->uname2;
    //     $codeorder = $request->codeorder2;
    //     $container =  $request->container2;
    //     $invoice = $request->invoice2;
    //     $quantity = $request->quantity2;
    //     $search = productReality::select();
    //     if ($uname != "") {
    //         $search = $search->where('uname', $uname);
    //     }
    //     if ($codeorder != "") {
    //         $search = $search->where('codeorder', 'like', '%' . $codeorder . '%');
    //     }
    //     if ($container != "") {
    //         $search = $search->where('container', $container);
    //     }
    //     if ($invoice != "") {
    //         $search = $search->where('invoice', $invoice);
    //     }
    //     if ($quantity != "") {
    //         $search = $search->where('quantity', $quantity);
    //     }

    //     $data = $search->get()->toArray();
    //     // if (!empty($data)) {
    //     //     return response()->json($data);
    //     // }
    //     $search = $search->paginate(2);
    //     return view('warehouses.includes.searchProductReality', compact('search'));
    //     // $search->withQueryString()->links('commons.paginate');
    //     $data = ['paginate' => $search];
    //     return response()->json($data);
    // }
}
