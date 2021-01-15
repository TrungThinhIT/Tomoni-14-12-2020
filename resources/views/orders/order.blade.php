@extends('layout')
@section('title', 'Đơn hàng')
{{-- <link rel="stylesheet" href="{{asset('assets/css/progress.css')}}"> --}}
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Đơn hàng đang xữ lý</h4>
                    <a href="{{route('index')}}">Index</a>&nbsp; - &nbsp;<a href="{{route('orders.bills.getBillById', $data['bill']->first()->So_Hoadon)}}">{{$data['bill']->first()->So_Hoadon}}</a>
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
                                                        <p class="mb-0"><strong>Số thùng: </strong>{{$item['Product']->quantity / $item['Product']->item_in_box}}</p>
                                                        <p class="mb-0"><strong>Ngày đặt hàng: </strong>{{Carbon\Carbon::parse($item['Order']->dateget)->format('d/m/Y')}}</p>
                                                        <p class="mb-0"><strong>Ngày thanh toán: </strong>{{Carbon\Carbon::parse($item['Order']->date_payment)->format('d/m/Y')}}</p>
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
                                                <button class="btn btn-primary modalTranfer" data-codeorder="{{$item->Codeorder}}" type="button">Tranfer Codeorder</button>
                                            
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

                <div class="card card-documentation">
                    <div class="card-body">
                        <div id="checkScroll">
                            <div style="margin: 1% 1% 1% 1%;">
                                <form action="{{route('orders.bills.getBillById', $data['bill']->first()->So_Hoadon)}}" method="get">
                                    <fieldset >
                                        <div class="form-row" style=" margin-top: 1%;">
                                            <div class="col-md-2 mb-2">
                                                <label for="validationDefault01">Tổng tiền hoá đơn</label>
                                                <input name="startDate" value="{{$data['startDate']}}" class="form-control"
                                                    type="date" id="startDate">
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <label for="validationDefault01">Tổng tiền hoá đơn</label>
                                                <input name="endDate" class="form-control" value="{{$data['endDate']}}"
                                                    type="date" id="endDate">
                                            </div>
                                            <div style="margin-top: 1.7%">
                                            <button type="submit" class="btn btn-primary ml-2" style="margin-left: 2%;">Search</button>
                                            </div>
                                            <div style="margin-top: 1.7%">
                                                <button type="button" onclick="resetFormSearch()" class="btn btn-info ml-2" style="margin-left: 2%;">Reset</button>
                                                <script>
                                                    function resetFormSearch() {
                                                        document.getElementById("startDate").value = "";
                                                        document.getElementById("endDate").value = "";
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                                <div style="float: left" class="mt-3">Công nợ: {{number_format($data['priceDebt'], 0)}}</div>
                                <div style="float: right" class="mt-3">
                                    {!! $data['hien_mau']->withQueryString()->links('commons.paginateBillOrder') !!}</div>
                                <table class="table table-bordered table-striped" style="margin-top: 1%;" id="paginateScroll">
                                    <thead>
                                        <tr>
                                            <th>Stt</th>
                                            <th>Date Time</th>
                                            <th>Deposit</th>
                                            <th>Price In</th>
                                            <th>Price Debt</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        @php
                                        $count = 1;
                                        @endphp
            
                                        @foreach ($data['hien_mau'] as $item) 
                                        @php
                                            $allPriceIn = 0;
                                        @endphp
                                        <tr>
                                            <td>{{$data['hien_mau']->perPage()*($data['hien_mau']->currentPage()-1)+$count}}</td>
                                            <td data-date="{{$item[0]->dateget}}" class="view_transaction">{{Carbon\Carbon::parse($item[0]->dateget)->format('d/m/Y')}}</td>
                                            <td>@if (count($item) >= 2)
                                                @foreach ($item as $value)
                                                {{$value->depositID}} <br>
                                                @endforeach
                                            @else
                                            {{$item[0]->depositID}}
                                        @endif</td>
                                            <td>@if (count($item) >= 2)
                                                    @foreach ($item as $value)
                                                        @php
                                                            $allPriceIn += $value->price_in
                                                        @endphp
                                                    @endforeach                  
                                                    {{number_format($allPriceIn, 0)}}
                                                @else
                                                {{number_format($item[0]->price_in, 0)}}
                                            @endif</td>
                                            <td>@if (count($item) >= 2)
                                                @php
                                                $index = count($item) - 1;
                                                @endphp
                                                {{number_format($item[$index]->priceIn, 0)}}
                                            @else
                                            {{number_format($item[0]->priceIn, 0)}}
                                        @endif</td>
                                        </tr>
                                        @php $count++; @endphp
                                        @endforeach
                                    </tbody>
                                </div>
                                </table>
                              </div>
                        </div>
                    </div>
                </div>
                   
                    <div class="modal" id="modalDetail">
                        <div class="modal-dialog modal-lg" style="min-width: 40%;" >
                          <div class="modal-content">
    
                            <!-- Modal Header -->
    
    
                          </div>
                        </div>
                      </div> 

                      <div class="modal" id="modalTranfer">
                        <div class="modal-dialog modal-lg" style="min-width: 80%;" >
                          <div class="modal-content">
    
                            <!-- Modal Header -->
    
    
                          </div>
                        </div>
                      </div> 
            </div>
        </div>

    </div>
</div>
<script>
    const checkScroll = {{$data['checkScroll']}};
    
    var billcode = "{{$data['bill']->first()->So_Hoadon}}"
    if(checkScroll == 1){
        var elmnt = document.getElementById("checkScroll").scrollIntoView({ behavior: "smooth" });
    }
    $(document).ready(function() {
                                $('.view_transaction').click(function() {
                                    var date = $(this).data('date');
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                                .attr('content')
                                        },
                                        type: 'GET',
                                        url: "payment" + '/' + billcode,
                                        data: {
                                            date: date
                                        },
                                        success: function(data) {
                                            $('#modalDetail').modal('show');
                                            $('.modal-content').html('').append(data);
                                        }
                                    });
                                });

                                $('.modalTranfer').click(function() {
                                    var codeorder = $(this).data('codeorder');
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                                .attr('content')
                                        },
                                        type: 'GET',
                                        url: "tranfer" + '/' + codeorder,
                                        data: {
                                            billcode: billcode
                                        },
                                        success: function(data) {
                                            $('#modalDetail').modal('show');
                                            $('.modal-content').html('').append(data);
                                        }
                                    });
                                })
                            });
</script>
@endsection
