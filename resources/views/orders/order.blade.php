@extends('layout')
@section('title', 'Đơn hàng')
<link rel="stylesheet" href="{{asset('assets/css/progress.css')}}">
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Đơn hàng đang xữ lý</h4>
                </div>
                <div class=" row">

                    <div class="row" style="width: 100%">

                        <div class="card" style=" margin-left:1%; width:100%; ">
                            <ul class="list-group list-group-flush">

                                @foreach ($bill as $item)
                                <div class="card " style="width:100%">
                                    <div class="row d-flex justify-content-between px-3 top"
                                        style="margin: 1% 3% 0% 3% ">
                                        <div class="d-flex">
                                            <div class="avatar avatar-xxl">
                                                <img src="
                                                @if (strpos($item['Product']->urlimg, 'http') === 0)
                                                {{$item['Product']->urlimg}}
                                                @else
                                                https://tomoniglobal.com/{{$item['Product']->urlimg}}
                                                @endif" alt="..."
                                                    class="avatar-img rounded">
                                            </div>
                                            <h5>ORDER
                                                <span class="text-primary font-weight-bold">
                                                    <a href="{{route('orders.bills.getBillDetailById', $item->Codeorder)}}">{{$item->Codeorder}}
                                                    </a>
                                                </span>
                                                <div class="">
                                                    <p class="mb-0"><strong>Đơn giá:</strong>
                                                        {{number_format($item['Product']->price, 0)}} </p>
                                                    <p class="mb-0"><strong>Số lượng:</strong>
                                                        {{$item['Product']->quantity}}</p>
                                                </div>
                                            </h5>
                                        </div>
                                        <div class="d-flex flex-column text-sm-right">
                                            <p class="mb-0"><strong>Phương thức vận chuyển:</strong> @foreach ($item['Order']->Transport as $value)
                                                  {{$value->ship_method == 0 ? 'Đường biển':'Đường hàng không'}}
                                            @endforeach </p>
                                            <p class="mb-0"><strong>Trạng thái:</strong>
                                                @if ($item['Order']->state == 0 )
                                                Xác định hàng
                                                @elseif($item['Order']->state == 1)
                                                Gửi mail báo giá
                                                @elseif($item['Order']->state == 2)
                                                Đã cập nhập
                                                @elseif($item['Order']->state == 3)
                                                Đã báo giá
                                                @elseif($item['Order']->state == 4)
                                                Đã chấp nhận
                                                @elseif($item['Order']->state == 5)
                                                Đã thanh toán
                                                @elseif($item['Order']->state == 6)
                                                Đã gửi mail
                                                @elseif($item['Order']->state == 7)
                                                Đã mua hàng
                                                @elseif($item['Order']->state == 8)
                                                Đã kiểm tra
                                                @elseif($item['Order']->state == 9)
                                                Đang giao hàng
                                                @elseif($item['Order']->state == 10)
                                                Cập cảng Nhật
                                                @elseif($item['Order']->state == 11)
                                                Cập cảng Việt
                                                @elseif($item['Order']->state == 12)
                                                Đang phát hàng
                                                @elseif($item['Order']->state == 13)
                                                Đang nhận hàng
                                                @endif
                                            </p>
                                            <p class="mb-0"><strong>Jancode:</strong> {{$item['Product']->jan_code}}</p>
                                            <p><strong>Name:</strong> {{$item['Product']->ProductStandard['name']}}</p>
                                            <div>
                                                <a class="btn btn-danger" href="delete/{{$item->Codeorder}}" onclick="return confirm('Are you sure you want to delete this item?');" type="button">Remove Codeorder</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add class 'active' to progress -->
                                    <div class="row d-flex justify-content-center" style="margin-left:5%">
                                        <div class="col-12">
                                            <ul id="progressbar" class="text-center">
                                                @if ($item['Order']->state >= 0)
                                                <li class="active step0" style="width:7%"></li>
                                                @endif
                                        @if ($item['Order']->state >= 1)
                                                <li class="active step0" style="width:7%"></li>
                                                @endif
                                        @if ($item['Order']->state >= 2)
                                                <li class="active step0" style="width:7%"></li>
                                                @endif
                                        @if ($item['Order']->state >= 3)
                                                <li class="active step0" style="width:7%"></li>
                                                @endif
                                        @if ($item['Order']->state >= 4)
                                                <li class="active step0" style="width:7%"></li>
                                                @endif
                                        @if ($item['Order']->state >= 5)
                                                <li class="active step0" style="width:7%"></li>
                                                @endif
                                        @if ($item['Order']->state >= 6)
                                                <li class="active step0" style="width:7%"></li>
                                                @endif
                                        @if ($item['Order']->state >= 7)
                                                <li class="active step0" style="width:7%"></li>
                                                @endif
                                        @if ($item['Order']->state >= 8)
                                                <li class="active step0" style="width:7%"></li>
                                                @endif
                                        @if ($item['Order']->state >= 9)
                                                <li class="active step0" style="width:7%"></li>
                                                @endif
                                        @if ($item['Order']->state >= 10)
                                                <li class="active step0" style="width:7%"></li>
                                                @endif
                                        @if ($item['Order']->state >= 11)
                                                <li class="active step0" style="width:7%"></li>
                                                @endif
                                        @if ($item['Order']->state >= 12)
                                        <li class="active step0" style="width:7%"></li>
                                                @endif
                                        @if ($item['Order']->state >= 13)
                                        <li class="step0" style="width:7%"></li>
                                        @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between top" style="margin-left:-2%; margin-top:1%">
                                        @if ($item['Order']->state >= 0)
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Xác định hàng
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($item['Order']->state >= 1)
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Gửi mail báo giá
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($item['Order']->state >= 2)
                                        <div class="row d-flex icon-content">
                                            <img class="icon"
                                                src="https://www.flaticon.com/svg/static/icons/svg/1689/1689164.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đã cập nhập
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($item['Order']->state >= 3)
                                        <div class="row d-flex icon-content">
                                            <img class="icon"
                                                src="https://www.flaticon.com/svg/static/icons/svg/482/482527.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đã báo giá
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($item['Order']->state >= 4)
                                        <div class="row d-flex icon-content">
                                            <img class="icon"
                                                src="https://www.flaticon.com/svg/static/icons/svg/784/784719.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đã chấp nhận
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($item['Order']->state >= 5)
                                        <div class="row d-flex icon-content">
                                            <img class="icon"
                                                src="https://www.flaticon.com/svg/static/icons/svg/669/669844.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đã thanh toán
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($item['Order']->state >= 6)
                                        <div class="row d-flex icon-content">
                                            <img class="icon"
                                                src="https://www.flaticon.com/svg/static/icons/svg/91/91848.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đã gửi mail
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($item['Order']->state >= 7)
                                        <div class="row d-flex icon-content">
                                            <img class="icon"
                                                src="https://www.flaticon.com/svg/static/icons/svg/3770/3770695.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đã mua hàng
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($item['Order']->state >= 8)
                                        <div class="row d-flex icon-content">
                                            <img class="icon"
                                                src="https://www.flaticon.com/svg/static/icons/svg/753/753445.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đã kiểm tra
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($item['Order']->state >= 9)
                                        <div class="row d-flex icon-content">
                                            <img class="icon"
                                                src="https://www.flaticon.com/svg/static/icons/svg/709/709790.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đang giao hàng
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($item['Order']->state >= 10)
                                        <div class="row d-flex icon-content">
                                            <img class="icon"
                                                src="https://www.flaticon.com/svg/static/icons/svg/274/274073.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Cập cảng Nhật
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($item['Order']->state >= 11)
                                        <div class="row d-flex icon-content">
                                            <img class="icon"
                                                src="https://www.flaticon.com/svg/static/icons/svg/2510/2510359.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Cập cảng Việt
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($item['Order']->state >= 12)
                                        <div class="row d-flex icon-content">
                                            <img class="icon"
                                                src="https://www.flaticon.com/svg/static/icons/svg/2830/2830175.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đang phát hàng
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($item['Order']->state >= 13)
                                        <div class="row d-flex icon-content">
                                            <img class="icon"
                                                src="https://www.flaticon.com/svg/static/icons/svg/814/814987.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đang nhận hàng
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                </div>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
