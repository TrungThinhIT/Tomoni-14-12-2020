<?php

namespace App\Http\Controllers\AddressBook;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\devvn_City;
use App\Http\Controllers\Controller;
use App\Http\Requests\addressBookRequest;
use App\Models\addressCustomer;
use Illuminate\Http\Request;
use App\Models\devvn_District;
use App\Models\devv_xaphuongthitran;

class addressBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWard($id) //ajax select Ward by District
    {
        if ($id < 10) {
            $id = '00' . $id;
        }
        if ($id >= 10 && $id < 100) {
            $id = '0' . $id;
        }

        $districts = devv_xaphuongthitran::where('maqh', $id)->get();
        return response()->json($districts);
    }
    public function getDistrict($id) //ajax select Disstrict by City
    {
        if ($id < 10) {
            $id = '0' . $id;
        }
        $districts = devvn_District::where('matp', $id)->get();
        return response()->json($districts);
    }
    public function index()
    {
        //
        $users = User::all();
        $citys = devvn_City::all();
        $list = addressCustomer::paginate(10);
        return view('addressBook.index', compact('citys', 'users', 'list'));
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
    public function store(addressBookRequest $request)
    {
        //lấy tên thành phố
        // dd($request->City);
        if ($request->City < 10) {
            $idCity = '0' . $request->City;
        } else {
            $idCity = $request->City;
        }

        $city = devvn_City::find($idCity)->name;
        //lấy tên quận 
        if ($request->District < 10) {
            $idDistrict = '00' . $request->District;
        }
        if ($request->District >= 10 && $request->District < 100) {
            $idDistrict = '0' . $request->District;
        } else {
            $idDistrict = $request->District;
        }
        $district = devvn_District::find($idDistrict)->name;
        //lấy tên xã 
        if ($request->Ward < 10) {
            $idWard = '0000' . $request->Ward;
        }
        if ($request->Ward >= 10 && $request->Ward < 100) {
            $idWard = '00' . $request->Ward;
        }
        if ($request->Ward >= 100 && $request->Ward < 1000) {
            $idWard = '00' . $request->Ward;
        }
        if ($request->Ward >= 1000 && $request->Ward < 9999) {
            $idWard = '0' . $request->Ward;
        } else {
            $idWard = $request->Ward;
        }

        // dd($request->Ward);
        $ward = devv_xaphuongthitran::find($idWard)->name;
        $address = $city . ',' . $district . ',' . $ward . ',' . $request->StreetHome; //nối địa chỉ
        $uname = User::find($request->selectUname)->uname; //lấy uname
        $checkAddress = addressCustomer::where('uname', $uname)->get()->toArray();
        // dd(count($checkAddress));
        if (empty($checkAddress)) {
            addressCustomer::create([
                'addcode' => $uname . '_1',
                'address' => $address,
                'phonenumber' => $request->Phone,
                'uname' => $uname,
                'delivery_time' =>  $request->DeliveryTime,
            ]);
            session()->flash('success', 'Đã tạo thành công');
            return back();
        }
        if (empty(addressCustomer::where([['uname', $uname], ['address', $address]])->get()->toArray())) {
            $count = count($checkAddress) + 1;
            addressCustomer::create([
                'addcode' => $uname . '_' . $count,
                'address' => $address,
                'phonenumber' => $request->Phone,
                'uname' => $uname,
                'delivery_time' => $request->DeliveryTime,
            ]);
            session()->flash('success', 'Đã tạo thành công');
            return back();
        } else {
            session()->flash('wrong', 'Địa chỉ của uname đã tồn tại');
            return back();
        }
        //check địa chỉ ngườI dùng
        // $checkAddress = addressCustomer::where([['address', $address], ['uname', $uname]])->first();
        // if (!empty($checkAddress)) {
        //     return back();
        // }
        // return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\addressCustomer  $addressCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(addressCustomer $addressCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\addressCustomer  $addressCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(addressCustomer $addressCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\addressCustomer  $addressCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, addressCustomer $addressCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\addressCustomer  $addressCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(addressCustomer $addressCustomer)
    {
        //
    }
}
