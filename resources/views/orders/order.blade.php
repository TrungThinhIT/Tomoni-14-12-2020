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
                                @foreach ($data['bill'] as $item)
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
                                                <a class="btn btn-danger" href="{{route('orders.bills.deleteBillCode', $item->Id)}}" onclick="return confirm('Are you sure you want to delete this item?');" type="button">Remove Codeorder</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </ul>

                        </div>

                    </div>

                </div>
                
                <div class="card " style="width:100%">
                    <div style="float: right" class="mt-3">
                        {!! $data['customer']->withQueryString()->links('commons.paginate') !!}</div>
                    <table class="table table-bordered table-striped" style="margin-top: 1%;">
                        <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Action</th>
                                <th>Date Time</th>
                                <th>Deposit</th>
                                <th>Price In</th>
                                <th>Price Out</th>
                                <th>Price Debt</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php
                            $count = 1;
                            $deDebt = 0;
                            @endphp

                            @foreach ($data['customer'] as $item)
                            <tr>
                                <td>{{$data['customer']->perPage()*($data['customer']->currentPage()-1)+$count}}</td>
                                <td>@if ($item->depositID)
                                    Nạp
                                @else
                                    Mua
                                @endif</td>
                                <td>@if ($item->depositID)
                                    {{Carbon\Carbon::parse($item->dateget)->format('d/m/Y')}}
                                @else
                                    {{Carbon\Carbon::parse($item->dateget)->format('d/m/Y h:m:i')}}
                                @endif</td>
                                <td>@if ($item->depositID)
                                    {{$item->depositID}}
                                @else
                                    <a href="{{route('orders.bills.getBillDetailById', $item->codeorder)}}">{{$item->codeorder}}</a>
                                @endif</td>
                                <td>@if ($item->depositID)
                                    {{number_format($item->price_in)}}
                                @endif</td>
                                <td>@if (!($item->depositID))
                                    {{number_format($item->total_all)}}
                                @endif</td>
                                <td>{{number_format($item->deDebt, 0)}}</td>
                            </tr>
                            @php $count++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                    </div>
            </div>
        </div>

    </div>
</div>
@endsection
