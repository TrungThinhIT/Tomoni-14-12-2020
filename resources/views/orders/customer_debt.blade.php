@extends('layout')
@section('title', 'Công nợ khách hàng')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Hi im Cong no khach hang</h4>
                </div>
                <div class="card-body">
                    <div>
                        <div style="margin: 1% 1% 1% 1%;">
                            <form action="{{route('orders.customer-debt')}}">
                                <fieldset>
                                    <div class="form-row" style=" margin-top: 1%;">
                                        @if($data['uname'])
                                        <div>
                                            <input class="form-control" type="date" value="{{$data['dateStart']}}" name="dateStart" id="dateStart" placeholder="Date Start">
                                        </div>
                                        <div>
                                            <input class="form-control" type="date" value="{{$data['dateEnd']}}" name="dateEnd" id="dateEnd" placeholder="Date End">
                                        </div>
                                        @endif
                                        <div>
                                            <input class="form-control" type="text" value="{{$data['uname']}}" name="uname" id="Uname" placeholder="User name" list='litsusername' onkeyup='searchUser(this)' required> <datalist id='litsusername'></datalist>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary" style="margin-left: 2%;">Search</button>
                                        </div>
                                        @if($data['uname'])
                                        <div>
                                            <button type="button" onclick="resetFormSearch()" class="btn btn-info ml-2" style="margin-left: 2%;">Reset</button>
                                            <script>
                                                function resetFormSearch() {
                                                    document.getElementById("dateStart").value = "";
                                                    document.getElementById("dateEnd").value = "";
                                                }
                                            </script>
                                        </div>
                                        @endif
                                    </div>
                                </fieldset>
                                <br>

                            <div style="float: left;" class="mt-2">
                                <select type="text" name="record" onchange="this.form.submit()" class="form-control"
                                    style="width: 100%;">
                                    @foreach ($array = [25, 50, 100, 150] as $item)
                                    <option value="{{$item}}" {{$data['record'] == $item ? 'selected' : '' }}>
                                        {{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                            </form>
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
                                            <a href="{{route('orders.bills.getBillDetailById', $item->Codeorder)}}">{{$item->Codeorder}}</a>
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
</script>
@endsection
