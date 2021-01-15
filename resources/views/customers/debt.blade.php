@extends('commons_customer.layout')
@section('title', 'Công nợ khách hàng')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Hi im Cong no khach hang</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>
                <div class="card-body">
                    <div>
                        <div style="margin: 1% 1% 1% 1%;">
                            <div style="float: left;" class="mt-2">
                                <button type="button" class="btn btn-primary" onclick="window.location.href='debt/export'">Export</button>
                            </div>
                            <form action="{{route('customer.debt.index')}}">
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
                                            {{$item->codeorder}}
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
@endsection
