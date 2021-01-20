@extends('layout')
@section('title', 'Khách hàng thanh toán')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Khách hàng thanh toán</h4>
                </div>
                <form action="{{route('orders.payment-customers.insert')}}" method="POST">
                    @csrf
                    <fieldset>
                        <div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">DepositID</label>
                                <input value="{{ old('depositId') }}" type="text" class="form-control" name="depositId"
                                id="depositId"
                                placeholder="Nhập số DepositID">
                                <span class="alert-danger-custom">{{$errors->first('depositId')}}</span>
                            </div>
                            <div class="col-md-1 mb-1">
                                <label for="validationDefault01">User name</label>
                                <input class="form-control" value="{{ old('uname') }}" type="text"
                                    name="uname" id="uname"
                                    placeholder="User name" list="litsusername" onkeyup='searchUser(this)'> <datalist id='litsusername'></datalist>
                                <span class="alert-danger-custom">{{$errors->first('uname')}}</span>
                            </div>
                            <div class="col-md-1 mb-1">
                                <label for="validationDefault01">Note</label>
                                <input data-type="currency" value="{{ old('note') }}" type="text" class="form-control" name="note" id="note" placeholder="Nhập note">
                                <span class="alert-danger-custom">{{$errors->first('note')}}</span>
                            </div>
                            <div class="col-md-2 mb-1">
                                <label for="validationDefault01">Date Inprice</label>
                                <input type="date" value="{{ old('dateInprice') }}" class="form-control" name="dateInprice" id="dateInprice"
                                    placeholder="Ngày nhập tiền">
                                <span class="alert-danger-custom">{{$errors->first('dateInprice')}}</span>
                            </div>
                            <div class="col-md-1 mb-1">
                                <label for="validationDefault01">Price In</label>
                                <input class="form-control" value="{{ old('priceIn') }}" type="text"
                                    name="priceIn" id="priceIn" placeholder="Price In">
                                <span class="alert-danger-custom">{{$errors->first('priceIn')}}</span>
                            </div>
                            <div class="col-md-1 mb-1">
                                <label for="validationDefault01">Số hoá đơn</label>
                                <input class="form-control" value="{{ old('SoHoadon') }}" type="text"
                                    name="SoHoadon" id="SoHoadon" placeholder="So hoa don" list="listbillcode" onkeyup='searchMaHoaDon(this)'> <datalist id='listbillcode'></datalist>
                                <span class="alert-danger-custom">{{$errors->first('SoHoadon')}}</span>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Insert</button>
                            </div>
                            <div>
                                <button type="button" onclick="resetFormInsert()" class="btn btn-info ml-2" style="margin-top: 20px;">Reset</button>
                                <script>
                                    function resetFormInsert() {
                                        debugger;
                                        document.getElementById("depositId").value = "";
                                        document.getElementById("uname").value = "",
                                        document.getElementById("note").value = "",
                                        document.getElementById("dateInprice").value = "";
                                        document.getElementById("dateInsert").value = "";
                                        document.getElementById("priceIn").value = "",
                                        document.getElementById("SoHoadon").value = "";
                                    }

                                </script>
                            </div>
                        </div>


                    </fieldset>

                </form>
                <div class="card-body">
                    <div>
                        <div style="margin: 1% 1% 1% 1%;">
                            <form action="{{route('orders.payment-customers.index')}}">
                                <fieldset>
                                    <div class="form-row" style=" margin-top: 1%;">
                                        <div>
                                            <input class="form-control" value="{{$data['Uname']}}" type="text" name="Uname" id="Uname" placeholder="User name">
                                        </div>
                                        <div>
                                            <input class="form-control" value="{{$data['date_inprice']}}" type="date" name="date_inprice" id="date_inprice">
                                        </div>
                                        <div>
                                            <input class="form-control" value="{{$data['date_insert']}}" type="date" name="date_insert" id="date_insert">
                                        </div>
                                        <div>
                                            <input class="form-control" value="{{$data['Sohoadon']}}" type="text" name="Sohoadon" id="Sohoadon" placeholder="Số hóa đơn">
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary" style="margin-left: 2%;">Search</button>
                                        </div>
                                        <div>
                                            <button type="button" onclick="resetFormSearch()" class="btn btn-info ml-2" style="margin-left: 2%;">Reset</button>
                                            <script>
                                                function resetFormSearch() {
                                                    document.getElementById("Uname").value = "";
                                                    document.getElementById("date_inprice").value = "";
                                                    document.getElementById("date_insert").value = "";
                                                    document.getElementById("Sohoadon").value = "";
                                                }

                                            </script>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                            <div style="float: right" class="mt-3">
                                {!! $data['PCustomers']->withQueryString()->links('commons.paginate') !!}</div>
                            <table class="table table-bordered table-striped" style="margin-top: 1%;">
                                <thead>
                                    <tr>
                                        <th>DepositID</th>
                                        <th style="min-width: 200px;">Uname</th>
                                        <th style="min-width: 200px;">Note</th>
                                        <th>date_inprice</th>
                                        <th>date_insert</th>
                                        <th>Price In</th>
                                        <th>Sohoadon</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach ($data['PCustomers'] as $item)
                                    <tr>
                                        <td>{{$item->depositID}}</td>
                                        <td>
                                            <div>
                                                <input type="text" class="form-control" id="us{{$item->Id}}"
                                                    value="{{$item->uname}}" onchange="update{{$item->Id}}()"
                                                    placeholder="User name" list="litsusername" onkeyup='searchUser(this)'> <datalist id='litsusername'></datalist>
                                            </div>
                                        </td>
                                        <td>{{$item->note}}</td>
                                        <td>{{$item->dateget}}</td>
                                        <td>{{$item->date_insert}}</td>
                                        <td>{{number_format($item->price_in, 0)}}</td>
                                        <td>
                                            <div>
                                                <input type="text" class="form-control" id="shd{{$item->Id}}"
                                                    value="{{$item->Sohoadon}}" onchange="update{{$item->Id}}()"
                                                    placeholder="So hoa don" list="listbillcode" onkeyup='searchMaHoaDon(this)'> <datalist id='listbillcode'></datalist>
                                            </div>
                                        </td>
                                    </tr>
                                    <script>
                                        function update{{$item->Id}}() {
                                            var id = {{$item->Id}};
                                            var us = $("#us{{$item->Id}}").val();
                                            var shd = $("#shd{{$item->Id}}").val();
                                            $.ajax({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                type: 'PUT',
                                                url: "payment-customers/" + id,
                                                data: {
                                                    uname: us,
                                                    sohoadon: shd
                                                },
                                                success: function (response) {
                                                    toastr.success('Cập nhập thành công.', 'Notifycation', {timeOut: 1000})
                                                }
                                            });
                                        }
                                    </script>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>

function searchUser(obj) {
        var text = $(obj).val();
            if(text.length > 1){
                $.ajax({
                type: 'GET',
                url: "{{route('commons.search-user')}}",
                data: {
                    uname: text
                },
                success: function (response) {
                    var len = response.length;
                    $("#litsusername").empty();
                    for (var i = 0; i < len; i++) {
                        var name = response[i]['uname'];
                        var name1 = response[i]['fname'];

                        $("#litsusername").append("<option value='" + name + "'>" + name1 +
                            "</option>");

                    }
                }
            });
            };
    }

    function searchMaHoaDon(obj) {
        var text = $(obj).val();
            if(text.length > 3){
                $.ajax({
                type: 'GET',
                url: "{{route('commons.searchBillCode')}}",
                data: {
                    BillCode: text
                },
                success: function (response) {
                    var len = response.length;
                    $("#listbillcode").empty();
                    for (var i = 0; i < len; i++) {
                        var name = response[i]['So_Hoadon'];

                        $("#listbillcode").append("<option value='" + name + "'>" + name +
                            "</option>");

                    }
                }
            });
            };
    }

</script>
@endsection
