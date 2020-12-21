@extends('layout')
@section('title', 'Hóa đơn đặt hàng')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Hoá đơn</h4>
                </div>
                <div class="card-body row">
                    <div class="card" style=" width:11%; padding: 1%; margin-left:1%">
                        <form action="{{route('orders.bills.create')}}" method="post">
                                @csrf
                            <div >
                            <div  >
                                <input class="form-control" value="{{ old('So_Hoadon')}}" type="text" name="So_Hoadon" placeholder="So_Hoadon" >
                                <span class="alert-danger-custom">{{$errors->first('So_Hoadon')}}</span>
                            </div>
{{--
                            <div  style="  margin-top: 3%;">
                                <input class="form-control" value="{{ old('PriceIn')}}" type="text" name="PriceIn" placeholder="Price In"  id="example-date-input">
                                <span class="alert-danger-custom">{{$errors->first('PriceIn')}}</span>
                            </div>

                            <div  style="  margin-top: 3%;">
                                <input class="form-control" value="{{ old('PriceOut')}}" type="text" name="PriceOut" placeholder="Price Out"  id="example-date-input">
                                <span class="alert-danger-custom">{{$errors->first('PriceOut')}}</span>
                            </div> --}}

                            <div  style="  margin-top: 3%;">
                                <input class="form-control" value="{{ old('Codeorder')}}" type="text" name="Codeorder" placeholder="Codeorder"  list='listcodeorder' onkeyup='searchCodeOrder(this)'> <datalist id='listcodeorder'></datalist>
                                <span class="alert-danger-custom">{{$errors->first('Codeorder')}}</span>
                            </div>

                            <div  style="  margin-top: 3%;">
                                <input class="form-control" value="{{ old('note')}}" type="text" name="note" placeholder="Note"  id="example-date-input">
                                <span class="alert-danger-custom">{{$errors->first('note')}}</span>
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </form>
                    </div>
                    <div class="card" style=" margin-left:1%; width:87%; padding:1%">
                        <div >
                            <form action="{{route('orders.bills.indexALl')}}">
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
                                            placeholder="Nhập So hoa don"
                                            style="width: 11%;"/>
                                        <div >
                                            <input class="form-control" type="date" value="{{$data['Date_Create']}}" name="Date_Create">
                                        </div>
                                        <input
                                            type="text"
                                            class="form-control ml-2"
                                            id="priceIn"
                                            placeholder="Nhập price in"
                                            style="width: 11%;"/>
                                        <input
                                            type="text"
                                            class="form-control ml-2"
                                            id="priceOut"
                                            placeholder="Nhập price out"
                                            style="width: 11%;"/>
                                    </fieldset>
                                </form>

                                <div style="float: right" class="mt-3">
                                    {!! $data['bills']->withQueryString()->links('commons.paginate') !!}</div>
                                <table class="table table-bordered table-striped" style="margin-top: 1%;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>So hoa don</th>
                                            <th>Price In</th>
                                            <th>Price Out</th>
                                            <th>Total</th>
                                            <th>Date Create</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        @foreach ($data['bills']->unique('So_Hoadon') as $item)
                                        <tr>
                                            <td>{{$item->Id}}</td>
                                            <td>
                                                <a href="{{route('orders.bills.getBillById', $item->So_Hoadon)}}">{{$item->So_Hoadon}}</a>
                                            </td>
                                            <td>{{$item->PriceIn}}</td>
                                            <td>
                                                {{$item->totalPriceOut}}
                                            </td>
                                            <td>{{$item->total}}</td>
                                            <td>{{Carbon\Carbon::parse($item->Date_Create)->format('d/m/Y')}}</td>
                                        </tr>
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
