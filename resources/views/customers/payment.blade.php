@extends('commons_customer.layout')
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
                            <form action="{{route('customer.payment.index')}}">
                                <fieldset>
                                    <div class="form-row" style=" margin-top: 1%;">
                                        <div>
                                            <input class="form-control" value="{{$data['dateget']}}" type="date" name="dateget" id="dateget">
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
                                                    document.getElementById("dateget").value = "";
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
                                        <th>date_inprice</th>
                                        <th>date_insert</th>
                                        <th>Price In</th>
                                  {{-- <th>Prince Out</th>
                                  <th>type_price</th>
                                  <th>cardID</th>
                                  <th>note</th>
                                  <th>useradmin</th> --}}
                                        <th>Sohoadon</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach ($data['PCustomers'] as $item)
                                    <tr>
                                        <td>{{$item->depositID}}</td>
                                        <td>{{$item->dateget}}</td>
                                        <td>{{$item->date_insert}}</td>
                                        <td>{{number_format($item->price_in, 0)}}</td>
                                        {{-- <td>
                                            {{$item->price_out}}
                                        </td>
                                        <td>{{$item->type_price}}</td>
                                        <td>{{$item->cardID}}</td>
                                        <td>{{$item->note}}</td>
                                        <td>{{$item->useradmin}}</td> --}}
                                        <td>
                                            <div>
                                                <input type="text" class="form-control" id="shd{{$item->Id}}" readonly
                                                    value="{{$item->Sohoadon}}" >
                                            </div>
                                        </td>
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
@endsection
