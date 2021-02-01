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
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use App\Exports\AddressBook\addressBookExport;

class addressBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $addBookExport;
    public function __construct(addressBookExport $addBookExport)
    {
        $this->addBookExport = $addBookExport;
    }
    public function search(Request $request)
    {
        $uname = $request->uname;
        $addcode = $request->addcode;
        $address = $request->address;
        $phone = $request->phone;
        $export  = $request->checkbox;
        // dd($request->all());
        // return response()->json($request->all());
        $addressBookSearch = addressCustomer::query();

        if ($uname) {
            $addressBookSearch = $addressBookSearch->where('uname', 'like', '%' . $uname . '%');
        }

        if ($addcode) {
            $addressBookSearch = $addressBookSearch->where('addcode', 'like', '%' . $addcode . '%');
        }

        if ($address) {
            $addressBookSearch = $addressBookSearch->where('address', 'like', '%' . $address . '%');
        }

        if ($phone) {
            $addressBookSearch = $addressBookSearch->where('phonenumber', $phone);
        }
        // return response()->json($addressBookSearch->get());
        if ($export == true) {
            $addressBookExport = $addressBookSearch->orderBy('uname', 'ASC')->get();
            // dd($addressBookExport);
            return $this->addBookExport->ExportAddressBook($addressBookExport);
        }
        $list = $addressBookSearch->paginate(10);
        // return response()->json($list);
        // dd($list);
        return view('addressBook.modals.search', compact('list'));
    }
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
        $unames = addressCustomer::all('id', 'uname')->unique('uname');
        return view('addressBook.index', compact('citys', 'users', 'list', 'unames'));
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
        $idDistrict = $request->District;
        if ($request->District < 10) {
            $idDistrict = '00' . $request->District;
        }
        if ($request->District >= 10 && $request->District < 100) {
            $idDistrict = '0' . $request->District;
        }
        $district = devvn_District::find($idDistrict)->name;
        //lấy tên xã
        $idWard = $request->Ward;
        if ($request->Ward < 10) {
            $idWard = '0000' . $request->Ward;
        }
        if ($request->Ward >= 10 && $request->Ward < 100) {
            $idWard = '000' . $request->Ward;
        }
        if ($request->Ward >= 100 && $request->Ward < 1000) {
            $idWard = '00' . $request->Ward;
        }
        if ($request->Ward >= 1000 && $request->Ward < 9999) {
            $idWard = '0' . $request->Ward;
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
    public function show(addressCustomer $addressCustomer, $id)
    {

        $data = $addressCustomer->find($id); //thong tin của đỉa chỉ
        $arr = explode(',', $data->address); //tách chuỗi

        $checkCity = devvn_City::where('name', $arr[0])->first(); //để lấy mã city
        $listCity = devvn_City::all(); //lấy list City

        $checkDistrict = devvn_District::where('name', $arr[1])->first(); //lấy mã city để trả về select theo city
        $listDistrict = devvn_District::where('matp', $checkDistrict->matp)->get(); //listDistrict theo matp

        $checkWard = devv_xaphuongthitran::where('name', $arr[2])->first();
        $listWard = devv_xaphuongthitran::where('maqh', $checkWard->maqh)->get();

        return view('addressBook.modals.show', compact('data', 'listCity', 'arr', 'checkCity', 'listDistrict', 'checkDistrict', 'checkWard', 'listWard'));
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
    public function update(Request $request, addressCustomer $addressCustomer, $id)
    {
        //
        if ($request->selectCity < 10) {
            $idCity = '0' . $request->selectCity;
        } else {
            $idCity = $request->selectCity;
        }

        $city = devvn_City::find($idCity)->name;
        //lấy tên quận
        $idDistrict = $request->selectDistrict;
        if ($request->selectDistrict < 10) {
            $idDistrict = '00' . $request->selectDistrict;
        }
        if ($request->selectDistrict >= 10 && $request->selectDistrict < 100) {
            $idDistrict = '0' . $request->selectDistrict;
        }
        $district = devvn_District::find($idDistrict)->name;
        //lấy tên xã
        $idWard = $request->ward;
        if ($request->ward < 10) {
            $idWard = '0000' . $request->ward;
        }
        if ($request->ward >= 10 && $request->ward < 100) {
            $idWard = '000' . $request->ward;
        }
        if ($request->ward >= 100 && $request->ward < 1000) {
            $idWard = '00' . $request->ward;
        }
        if ($request->ward >= 1000 && $request->ward < 9999) {
            $idWard = '0' . $request->ward;
        }
        // $data = [$idCity, $idDistrict, $idWard];
        // return response()->json($data);
        $ward = devv_xaphuongthitran::find($idWard)->name;
        $address = $city . ',' . $district . ',' . $ward . ',' . $request->street; //nối địa chỉ
        $uname = addressCustomer::find($id)->uname; //lấy uname

        //set colunm add_default của 1 uname chỉ duy nhất có 1 đỉa chỉ mặc đỊnh
        if ($request->checkbox == 1) {
            $lists = addressCustomer::where([['uname', $uname], ['id', '!=', $id]])->get();
            $checkbox = 1;
            if (!empty($lists)) {
                foreach ($lists as $item) {
                    $item->add_default = false;
                    $item->save();
                }
            }
        } else {
            $checkbox = 0;
        }
        $update = addressCustomer::find($id)->update(
            [
                'address' => $address, 'phonenumber' => $request->phone, 'add_default' => $checkbox,
                'delivery_time' => $request->time,
            ]
        );
        if ($update) {
            $data = ['address' => $address, 'phone' => $request->phone, 'time' => $request->time, 'checkbox' => $request->checkbox];
            return response()->json($data);
        } else {
            return "fail";
        }
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
