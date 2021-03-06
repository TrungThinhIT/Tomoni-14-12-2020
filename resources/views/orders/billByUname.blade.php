@extends('layout')
@section('title', 'Hóa đơn đặt hàng')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Hoá đơn của {{$data['Uname']}}</h4>
                    <a href="{{route('index')}}">Index</a>&nbsp; - &nbsp;<a href="{{route('orders.bills.indexAllByUname', $data['Uname'])}}">{{$data['Uname']}}</a>
                </div>
                <div class="card-body row">
                    <div class="card" style=" margin-left:1%; width:100%; padding:1%">
                        <div >
                            <form action="{{route('orders.bills.indexAllByUname', $data['Uname'])}}">
                                <fieldset >
                                    <div class="form-row" style=" margin-top: 1%;">
                                        <div >
                                            <button
                                                type="submit"
                                                class="btn btn-primary"
                                                style="margin-left: 2%;"
                                                >Tìm kiếm</button>
                                        </div>
                                        <input
                                            type="text"
                                            class="form-control ml-2"
                                            value="{{$data['So_Hoadon']}}"
                                            name="So_Hoadon"
                                            id="So_Hoadon"
                                            placeholder="Nhập So hoa don"
                                            style="width: 11%;"/>
                                        <div >
                                            <input class="form-control" type="date" value="{{$data['Date_Create']}}" name="Date_Create" id="Date_Create">
                                        </div>
                                        {{-- <input
                                            type="text"
                                            class="form-control ml-2"
                                            value="{{$data['PriceIn']}}"
                                            name="priceIn"
                                            id="priceIn"
                                            placeholder="Nhập price in"
                                            style="width: 11%;"/>
                                        <input
                                            type="text"
                                            class="form-control ml-2"
                                            value="{{$data['PriceOut']}}"
                                            name="priceOut"
                                            id="priceOut"
                                            placeholder="Nhập price out"
                                            style="width: 11%;"/> --}}
                                            <div>
                                                <button type="button" onclick="resetFormSearch()" class="btn btn-info ml-2" style="margin-left: 2%;">Reset</button>
                                                <script>
                                                    function resetFormSearch() {
                                                        document.getElementById("So_Hoadon").value = "";
                                                        document.getElementById("Date_Create").value = "";
                                                        document.getElementById("priceIn").value = "";
                                                        document.getElementById("priceOut").value = "";
                                                    }
                                                </script>
                                            </div>
                                    </fieldset>
                                </form>
                                <div style="float: left" class="mt-3"><p style="font-weight: bold"> Tổng công nợ:  {{number_format($data['sumDebt'], 0)}}&ensp;&ensp;</p></div>
                                <div style="float: right" class="mt-3">
                                    {!! $data['bills']->withQueryString()->links('commons.paginate') !!}</div>
                                <table class="table table-bordered table-striped" style="margin-top: 1%;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>So hoa don</th>
                                            <th>Uname</th>
                                            <th>Price In</th>
                                            <th>Price Out</th>
                                            <th>Total</th>
                                            <th>PriceBelb</th>
                                            <th>Date Create</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        @php $count = 1; @endphp
                                        @foreach ($data['bills']->unique('So_Hoadon') as $item)
                                        <tr>
                                            <td>{{$data['bills']->perPage()*($data['bills']->currentPage()-1)+$count}}</td>
                                            <td>
                                                <a href="{{route('orders.bills.getBillById', $item->So_Hoadon)}}">{{$item->So_Hoadon}}</a>
                                            </td>
                                            <td>{{$item['Order']->uname}}</td>
                                            <td>{{number_format($item->PriceIn, 0)}}</td>
                                            <td>
                                                {{number_format($item->totalPriceOut, 0)}}
                                            </td>
                                            <td>{{$item->total}}</td>
                                            <td>{{number_format($item->PriceIn - $item->totalPriceOut, 0)}}</td>
                                            <td>{{Carbon\Carbon::parse($item->Date_Create)->format('d/m/Y')}}</td>
                                        </tr>
                                        @php $count ++; @endphp
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
</div>
<script>
    function searchCodeOrder(obj) {
        var text = $(obj).val();
            if(text.length >3){
                $.ajax({
                type: 'GET',
                url: "{{route('commons.searchCodeOrder')}}",
                data: {
                    search_ordercode: text
                },
                success: function (response) {
                    var len = response.length;
                    $("#listcodeorder").empty();
                    for (var i = 0; i < len; i++) {
                        var name = response[i]['codeorder'];
                        var name1 = response[i]['quantity'];
                        var name2 = response[i]['total'];

                        $("#listcodeorder").append("<option value='" + name + "'>" + "Quantity: " + name1 + " Total: " + name2 +
                            "</option>");

                    }
                }
            });
            };
        }

        function searchBillCode(obj) {
            // debugger;
            var text = $(obj).val();
                if(text.length >3){
                    $.ajax({
				type: 'GET',
				url: "{{route('commons.searchBillCode')}}",
				data: {
                    BillCode: text
				},
				success: function(response) {
                    var len = response.length;
                    $("#listbillcode").empty();
                for( var i = 0; i<len; i++){
                    var name = response[i]['depositID'];
                    var name1 = response[i]['uname'];
                    var name2 = response[i]['date_inprice'];
                    var name3 = response[i]['date_insert'];

                    $("#listbillcode").append("<option value='"+name+"'>"+'Uname: '+ name1 + ' Ngày vào: '+ name2 + ' Ngày vô tiền: '+ name3 +"</option>");

                }
				}
			    });
                }
        }
</script>
@endsection
