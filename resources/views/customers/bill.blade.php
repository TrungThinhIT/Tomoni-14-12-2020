@extends('commons_customer.layout')
@section('title', 'Hóa đơn đặt hàng')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Hoá đơn của {{$data['Uname']}}</h4>
                </div>
                <div class="card-body row">
                    <div class="card" style=" margin-left:1%; width:100%; padding:1%">
                        <div >
                            <form action="{{route('customer.bill.index', $data['Uname'])}}">
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
                                                <a href="{{route('customer.bill.order', $item->So_Hoadon)}}">{{$item->So_Hoadon}}</a>
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
@endsection
