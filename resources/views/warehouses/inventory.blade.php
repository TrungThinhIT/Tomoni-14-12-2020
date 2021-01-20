@extends('layout')
@section('title', 'Hàng tồn kho')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Hàng tồn kho</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>
                <!--  -->
                <div id="ItemInvoice" style="background-color: aliceblue;"></div>
                <div>
                    <div style="margin: 1% 1% 1% 1%;">
                        <form action="{{route('warehouses.inventory.index')}}">
                            <fieldset>
                                <div class="form-row" style=" margin-top: 1%;">
                                    <div>
                                        <button type="submit" class="btn btn-primary" style="margin-left: 2%;"
                                            onclick="Search()">Tìm kiếm</button>
                                    </div>
                                    <input type="text" class="form-control" value="{{$data['jan_code']}}"
                                        name="jan_code" id="jan_code" placeholder="Nhập mã sản phẩm"
                                        style="width: 10%;" />
                                    <div>
                                        <select type="text" class="form-control" name="status" id="status">
                                            <option value="">Tình trạng</option>
                                            <option value="1" {{$data['status'] == 1 ? 'selected':''}}>Tồn kho</option>
                                            <option value="2" {{$data['status'] == 2 ? 'selected':''}}>Hết Hàng</option>
                                            <option value="3" {{$data['status'] == 3 ? 'selected':''}}>Âm</option>
                                        </select></div>    
                                    <div>
                                        <button type="button" onclick="resetFormSearch()" class="btn btn-info ml-2"
                                            style="margin-left: 2%;">Reset</button>
                                        <script>
                                            function resetFormSearch() {
                                                document.getElementById("jan_code").value = "";
                                                document.getElementById("status").value = "";
                                            }

                                        </script>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <div style="float: right" class="mt-3">
                            {!! $data['inventories']->withQueryString()->links('commons.paginate') !!}</div>
                        <table id="example" class="table table-bordered table-striped"
                            style="margin-top: 1%; margin-right: 1%;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jancode</th>
                                    <th>Name</th>
                                    <th>Nhập hoá đơn</th>
                                    <th>Xuất</th>
                                    <th>Tồn kho</th>
                                    <th>Cân nặng thực tế</th>
                                    <th>Cân nặng theo thể tích</th>
                                    <th>Function</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @php $count = 1; @endphp
                                @foreach ($data['inventories'] as $item)
                                {{-- {{dd($item)}} --}}
                                <tr @if ($item[0]->weight <= 0 || $item[0]->width <= 0 || $item[0]->length <= 0 || $item[0]->height <= 0)
                                    class="table-danger"
                                @endif>
                                    <td>{{$data['inventories']->perPage()*($data['inventories']->currentPage()-1)+$count}}
                                    <td data-code="{{$item[0]->Jancode}}" class="view_transaction">{{$item[0]->Jancode}}</td>
                                    <td>{{$item[0]->name}}</td>
                                    <td>@if ($item[0]->name_2)
                                        {{$item[0]->totalQuantity}}
                                        @endif</td>
                                        <td>@if (count($item) > 1)
                                            {{$item[1]->totalQuantity}}
                                            @else
                                                @if ($item[0]->name_2)
                                                @else
                                                    {{$item[0]->totalQuantity}}
                                                @endif
                                            @endif</td>

                                            <td>
                                                {{$item[0]->TotalQuantity}}
                                                </td>
                                    <td>@if ($item[0]->weight)
                                        {{{number_format($item[0]->weight * $item[0]->TotalQuantity, 2)}}} @else 0
                                    @endif kg</td>
                                    <td>{{{number_format(($item[0]->width * $item[0]->length * $item[0]->height) / 1000000 * $item[0]->TotalQuantity, 2)}}} khối</td>
                                    <td><button type="button" data-code="{{$item[0]->Jancode}}" class="btn btn-success viewUpdate">Edit</button></td>
                                </tr>
                                @php $count ++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="modal" id="modalDetail">
                            <div class="modal-dialog modal-lg" style="min-width: 90%;">
                                <div class="modal-content">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        $('.view_transaction').click(function () {
            const jan_code = $(this).data('code');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                        .attr('content')
                },
                type: 'GET',
                url: "inventory" + '/' + jan_code,

                success: function (data) {
                    $('#modalDetail').modal('show');
                    $('.modal-content').html('').append(data);
                }
            });
        });

        $('.viewUpdate').click(function () {
            const jan_code = $(this).data('code');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                        .attr('content')
                },
                type: 'GET',
                url: "inventory" + '/detail/' + jan_code,

                success: function (data) {
                    $('#modalDetail').modal('show');
                    $('.modal-content').html('').append(data);
                }
            });
        });
    });

</script>
@endsection
