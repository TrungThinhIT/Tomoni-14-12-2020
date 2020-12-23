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
                                            <img style="float: left; max-width: 150px; max-height: 200px" src="{{$billDetail['detail']->Product->urlimg}}"
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
                                    <td><input type="number" onchange="updateInfoOrder()" id="price" class="form-control" value="{{$billDetail['detail']->total}}"></td>
                                    <td><input type="number" onchange="updateInfoOrder()" id="quantity" class="form-control" value="{{$billDetail['detail']->quantity}}"></td>
                                    <td><input type="number" id="total" value="{{$billDetail['detail']->total_all}}" readonly class="form-control"></td>
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
                error: function (response) {
                    $.each(response.responseJSON.errors, function (field_name, error) {
                        alert(error)
                    })
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
                error: function (response) {
                    $.each(response.responseJSON.errors, function (field_name, error) {
                        alert(error)
                    })
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
        var totalAfter = price * quantity;
        $("#total").val(totalAfter);
        if (totalAfter != null) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PUT',
                url: "/orders/bills/detail/" + codeorder,
                data: {
                    price: price,
                    quantity: quantity,
                    total: totalAfter
                }
            })
        }
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
