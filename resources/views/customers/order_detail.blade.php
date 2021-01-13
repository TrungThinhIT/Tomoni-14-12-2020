@extends('commons_customer.layout')
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
                                    <td>{{$billDetail['detail']->total}}</td>
                                    <td>{{$billDetail['detail']->quantity}}</td>
                                    <td>{{$billDetail['detail']->total_all}}</td>
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
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Phí dịch vụ</td>
                                    <td colspan="2">
                                    {{$billDetail['detail']->Transport->first()->fee_box}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipping nội địa:</td>
                                    <td colspan="2">
                                        {{$billDetail['detail']->Transport->first()->fee_service}}
                                    </td>
                                </tr>
                                <input type="text" hidden value="{{$billDetail['detail']->codeorder}}" id="codeorder">
                                <tr>
                                    <td>Tracking number</td>
                                    <td colspan="2">
                                        {{$billDetail['detail']->shipid}}
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

    $(document).ready(function () {
        $.ajax({
            type: 'get',
            url: 'load-log/' + codeorder,
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

    function addLog() {
        var note = $("#note").val();
        if (codeorder != null) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "add-log/" + codeorder,
                data: {
                    note: note
                },
                success: function (response) {
                    $("#note").val('');
                    $(document).ready(function () {
                        $.ajax({
                            type: 'get',
                            url: 'load-log/' + codeorder,
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
