@extends('layout')
@section('title', 'Hàng xuất')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Hàng Xuất</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>

                <!-- <fieldset >
                        <div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                            <div class="col-md-2 mb-2" >
                                <label for="validationDefault01">JanCode</label>
                                <input type="text" class="form-control" name="uinvoice" id="uinvoice" placeholder="Nhập số hoá đơn"  required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="uinvoice" id="uinvoice" placeholder="Nhập số hoá đơn"  required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Trọng lượng</label>
                                <input data-type="currency" type="text" class="form-control" name="uTotalPrice" id="uTotalPrice" placeholder="Nhập tổng tiền hoá đơn"  required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Thể tích </label>
                                <input type="text" class="form-control" name="uPurchaseCosts" id="uPurchaseCosts" placeholder="Chi phí mua hàng" value=0 required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Thuế chi phí</label>
                                <select type="text" class="form-control" id="TaxPurchaseCosts"   required >
                                    <option value="" selected disabled>Please select</option>
                                    <option value="10">10%</option>
                                    <option value="8">8%</option>
                                    <option value="5">5%</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Nhà cung cấp</label>
                                <select type="text" class="form-control" name="unamesupplier" id="unamesupplier"   required >
                                    <option value="" selected disabled>Please select</option>
                                    <option value="1">Nhà CC 1</option>
                                    <option value="2">Nhà CC 2</option>
                                    <option value="3">Nhà CC 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row" style="margin-left: 2%; margin-top: 1%;">
                            <div class="col-md-2 mb-2" >
                                <label for="validationDefault01">Ngày xuất hàng</label>
                                <input class="form-control" type="date" value="2020-04-12" name="PaymentDate" id="PaymentDate">
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Số lượng</label>
                                <input type="text" class="form-control" name="uTracking" id="uTracking" placeholder="Nhập mã tracking"  required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Đơn vị</label>
                                <select type="text" class="form-control" id="PaidInvoice"   required >
                                    <option value="" selected disabled>Please select</option>
                                    <option value="1">Item 1</option>
                                    <option value="2">Item 2</option>
                                    <option value="3">Item 3</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Kho hàng</label>
                                <select type="text" class="form-control" name="Typehoadon" id="Typehoadon"   required >
                                    <option value="" selected disabled>Please select</option>
                                    <option value="1">Item 1</option>
                                    <option value="2">Item 2</option>
                                    <option value="3">Item 3</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2" style="margin-top: 1%;">

                                <button type="submit" class="btn btn-primary" onclick="InsertInvoice()">Tạo </button>
                            </div>
                        </div>


                    </fieldset> -->



                <div id="ItemInvoice" style="background-color: aliceblue;"></div>
                <div>
                    <div style="margin: 1% 1% 1% 1%;">
                        <form>
                            <fieldset>
                                <div class="form-row" style=" margin-top: 1%;">
                                    <form action="{{route('warehouses.exported.index')}}" method="get">
                                        <div>
                                            <button type="submit" class="btn btn-primary" style="margin-left: 2%;"
                                                onclick="Search()">Tìm kiếm</button>
                                        </div>
                                        <input type="text" class="form-control" value="{{$data['jan_code']}}" name="jan_code" id="jan_code" placeholder="Nhập mã sản phẩm"
                                         style="width: 10%;" />
                                        <input type="text" class="form-control" value="{{$data['name']}}" name="name" id="name" placeholder="Tên sản phẩm"
                                         style="width: 10%;" />
                                         <div>
                                            <button type="button" onclick="resetFormSearch()" class="btn btn-info ml-2" style="margin-left: 2%;">Reset</button>
                                            <script>
                                                function resetFormSearch() {
                                                    document.getElementById("jan_code").value = "";
                                                    document.getElementById("name").value = "";
                                                }

                                            </script>
                                        </div>
                                        </form>                                    
                                </div>
                            </fieldset>
                        </form>
                        <div style="float: right" class="mt-3">
                            {!! $data['exporteds']->withQueryString()->links('commons.paginate') !!}</div>
                        <table id="example" class="table table-bordered table-striped" style="margin-top: 1%;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jancode</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @php $count = 1; @endphp
                                @foreach ($data['exporteds'] as $item)
                                <tr>
                                    <td>{{$data['exporteds']->perPage()*($data['exporteds']->currentPage()-1)+$count}}
                                    </td>
                                    <td data-code="{{$item->jan_code}}" class="view_transaction">{{$item->jan_code}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{number_format($item->totalQuantity, 0)}}</td>
                                    {{-- <td>
                                    <button type="button" class="btn btn-success px-3" id="issueBtn" ><i class="fa fa-check" aria-hidden="true"> </i> Đã xuất</button>
                                </td> --}}
                                </tr>
                                @php $count++; @endphp
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
    $(document).ready(function() {
                                $('.view_transaction').click(function() {
                                    const jan_code = $(this).data('code');
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                                .attr('content')
                                        },
                                        type: 'GET',
                                        url: "exported" + '/' + jan_code,

                                        success: function(data) {
                                            $('#modalDetail').modal('show');
                                            $('.modal-content').html('').append(data);
                                        }
                                    });
                                });
                            });
</script>
@endsection
