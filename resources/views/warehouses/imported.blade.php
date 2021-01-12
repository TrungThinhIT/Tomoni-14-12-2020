@extends('layout')
@section('title', 'Hàng nhập')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">

                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Hàng nhập</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>
                <div id="ItemInvoice" style="background-color: aliceblue;"></div>
                <div>
                    <div style="margin: 1% 1% 1% 1%;">
                        <form action="{{route('warehouses.imported.index')}}" method="GET">
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
                                        <button type="button" onclick="resetFormSearch()" class="btn btn-info ml-2"
                                            style="margin-left: 2%;">Reset</button>
                                        <script>
                                            function resetFormSearch() {
                                                document.getElementById("jan_code").value = "";
                                            }

                                        </script>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <div style="float: right" class="mt-3">
                            {!! $data['importeds']->withQueryString()->links('commons.paginate') !!}</div>
                        <table id="example" class="table table-bordered table-striped"
                            style="margin-top: 1%;  margin-right: 1%;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>So hoa don</th>
                                    <th>Jancode</th>
                                    <th>Name</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>


                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @php $count = 1; @endphp
                                @foreach ($data['importeds'] as $item)
                                <tr>
                                    <td>{{$data['importeds']->perPage()*($data['importeds']->currentPage()-1)+$count}}
                                    </td>
                                    <td>{{$item->Invoice}}</td>
                                    <td data-code="{{$item->Jancode}}" class="view_transaction">{{$item->Jancode}}</td>
                                    <td>{{ $item['product']->name }}</td>
                                    <td>{{$item->totalQuantity}}</td>
                                    <td>{{$item->totalPrice}}</td>
                                </tr>
                                @php $count ++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="modal" id="modalDetail">
                            <div class="modal-dialog modal-lg" style="min-width: 80%;">
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
                url: "imported" + '/' + jan_code,

                success: function (data) {
                    $('#modalDetail').modal('show');
                    $('.modal-content').html('').append(data);
                }
            });
        });
    });

</script>
@endsection
