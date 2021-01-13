@extends('layout')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Chi tiết đơn hàng: <strong
                            style="color: chartreuse">{{$billDetail['detail']->codeorder}}</strong></h4>
                    
                            <a href="{{route('index')}}">Index</a>&nbsp; - &nbsp;<a href="{{route('orders.bills.getBillById', $billDetail['detail']->SohoaDon)}}">{{$billDetail['detail']->SohoaDon}}</a>
                            &nbsp; - &nbsp;<a href="{{route('orders.bills.getBillDetailById', $billDetail['detail']->codeorder)}}">{{$billDetail['detail']->codeorder}}</a>
                </div>
                <div class="card-body row">
                    <div style=" margin-left:1%; width:100%; padding:1%">
                        <table class="table table-bordered table-head-bg-info table-bordered-bd-info">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img style="float: left; max-width: 150px; max-height: 200px"
                                            src="
                                                @if (strpos($billDetail['detail']->Product->urlimg, 'http') === 0)
                                                {{$billDetail['detail']->Product->urlimg}}
                                                @else
                                                https://tomoniglobal.com/{{$billDetail['detail']->Product->urlimg}}
                                                @endif"
                                                alt="">
                                            <div class="text-left">
                                                <strong>Name:
                                                    {{$billDetail['detail']->Product['ProductStandard']->name}}</strong>
                                                <br>
                                                <strong style="color: blueviolet">Jancode:
                                                    {{$billDetail['detail']->Product['ProductStandard']->jan_code}}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td><input type="number" onchange="updateInfoOrder()" id="price" class="form-control" value="{{$billDetail['detail']->Product->price}}"></td>
                                    <td><input type="number" onchange="updateInfoOrder()" id="quantity" class="form-control" value="{{$billDetail['detail']->Product->quantity}}"></td>
                                    <td><input type="number" id="total" value="{{$billDetail['detail']->Product->total}}" readonly class="form-control"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" rowspan="4">
                                        <div style="height:250px; overflow-y: scroll" id="log">

                                        </div>
                                        <div class=" row" style="margin: 1%;">
                                            <input style="width: 80%; margin-right:1%" type="text" class="form-control"
                                                name="note" id="note" placeholder="Nhập ghi chú">
                                            <button type="button" onclick="addLog()"
                                                class="btn btn-primary">Gửi</button>
                                        </div>
                                    </td>
                                    <td>Tổng</td>
                                    <td>2</td>
                                    <td>123</td>
                                </tr>
                                <tr>
                                    <td>Phí dịch vụ</td>
                                    <td colspan="2">
                                        <div>
                                            <input style="width: 70%; margin-right:1%"
                                                value="{{$billDetail['detail']->Transport->first()->fee_box}}"
                                                type="text" class="form-control" name="fee_box" id="fee_box"
                                                placeholder="Nhập phí dịch vụ" onchange="updateFee()">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipping nội địa:</td>
                                    <td colspan="2">
                                        <div>
                                            <input style="width: 70%; margin-right:1%" type="text"
                                                value="{{$billDetail['detail']->Transport->first()->fee_service}}"
                                                class="form-control" name="fee_service" id="fee_service"
                                                placeholder="Nhập shipping nội địa" onchange="updateFee()">
                                        </div>
                                    </td>
                                </tr>
                                <input type="text" hidden value="{{$billDetail['detail']->codeorder}}" id="codeorder">
                                <tr>
                                    <td>Tracking number</td>
                                    <td colspan="2">
                                        <div>
                                            <input style="width: 70%; margin-right:1%" type="text"
                                                value="{{$billDetail['detail']->shipid}}" class="form-control"
                                                name="shipid" id="shipid" placeholder="Nhập tracking number"
                                                onchange="updateTracking()">
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<script>
    var codeorder = $("#codeorder").val();

    function updateFee() {
        var fee_box = $("#fee_box").val();
        var fee_service = $("#fee_service").val();
        if (codeorder != null) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PUT',
                url: "/orders/bills/update-fee/" + codeorder,
                data: {
                    fee_box: fee_box,
                    fee_service: fee_service
                },
                success: function (response){
                    toastr.success('Cập nhập thông tin phẩm thành công.', 'Notifycation', {timeOut: 1000})
                }
            })
        }
    }

    function updateTracking() {
        var shipid = $("#shipid").val();

        if (codeorder != null) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PUT',
                url: "/orders/bills/update-tracking/" + codeorder,
                data: {
                    shipid: shipid
                },
                success: function (response) {
                    toastr.success('Cập nhập giá sản phẩm thành công.', 'Notifycation', {timeOut: 1000})
                }
            })
        }
    }

    $(document).ready(function () {
        $.ajax({
            type: 'get',
            url: '/orders/bills/log/' + codeorder,
            success: function (response) {
                $('#log').append(response);
                $('#log').scrollTop(1000000);
            }
        })
    });

    $('#note').keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            addLog();
        }
    });

    function updateInfoOrder(){
        var price = $("#price").val();
        var quantity = $("#quantity").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PUT',
                url: "/orders/bills/detail/" + codeorder,
                data: {
                    price: price,
                    quantity: quantity
                },
                success: function (response) {
                    $('#total').val(response.total);
                    toastr.success('Cập nhập giá sản phẩm thành công.', 'Notifycation', {timeOut: 1000})
                }
            })
    }

    function addLog() {
        var note = $("#note").val();
        if (codeorder != null) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "/orders/bills/comment/" + codeorder,
                data: {
                    note: note
                },
                success: function (response) {
                    $("#note").val('');
                    $(document).ready(function () {
                        $.ajax({
                            type: 'get',
                            url: '/orders/bills/log/' + codeorder,
                            success: function (response) {
                                toastr.success('Cập nhập giá sản phẩm thành công.', 'Notifycation', {timeOut: 1000});
                                $("#remove").remove();
                                $('#log').append(response);
                                $('#log').scrollTop(1000000);
                            }
                        })
                    });
                }
            })
        }
    }

</script>
@endsection
