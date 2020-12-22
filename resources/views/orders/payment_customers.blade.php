@extends('layout')
@section('title', 'Khách hàng thanh toán')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Khách hàng thanh toán</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>
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
                                        <th>date_inprice</th>
                                        <th>date_insert</th>
                                        {{-- <th>Price In</th>
                                  <th>Prince Out</th>
                                  <th>type_price</th>
                                  <th>cardID</th>
                                  <th>note</th>
                                  <th>useradmin</th> --}}
                                        <th>Sohoadon</th>
                                        <th>Function</th>
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
                                        <td>{{$item->date_inprice}}</td>
                                        <td>{{$item->date_insert}}</td>
                                        {{-- <td>{{$item->price_in}}</td>
                                        <td>
                                            {{$item->price_out}}
                                        </td>
                                        <td>{{$item->type_price}}</td>
                                        <td>{{$item->cardID}}</td>
                                        <td>{{$item->note}}</td>
                                        <td>{{$item->useradmin}}</td> --}}
                                        <td>
                                            <div>
                                                <input type="text" class="form-control" id="shd{{$item->Id}}"
                                                    value="{{$item->Sohoadon}}" onchange="update{{$item->Id}}()"
                                                    placeholder="So hoa don" list="listbillcode" onkeyup='searchMaHoaDon(this)'> <datalist id='listbillcode'></datalist>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger px-3"><i class="fa fa-times"
                                                    aria-hidden="true"></i></button>
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
                                                // success: function (response) {
                                                //     if (response == 1) {
                                                //         alert()
                                                //     }
                                                //     if (response == 2) {
                                                //         location.reload();
                                                //     }
                                                // }
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
                        var name1 = response[i]['Codeorder'];

                        $("#listbillcode").append("<option value='" + name + "'>" + name1 +
                            "</option>");

                    }
                }
            });
            };
    }

</script>
@endsection
