@extends('layout')
@section('css')

<style>
    .form-control {
        height: unset !important;
    }

    .alert {
        background-color: greenyellow !important;
        border-left: unset !important;
    }

    img :hover {
        box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5) !important;
    }

    .inputCustom {
        margin: 3px !important;

    }

    #custom {
        margin-right: -70px;
    }

</style>
@section('title', 'Hàng thực tế')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Hàng thực tế</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>
                <!--  -->
                <div id="ItemInvoice" style="background-color: aliceblue;"></div>
                <div>
                    <div style="margin: 1% 1% 1% 1%;">
                        {{-- @if (session('success'))
                        <div class="alert alert-success thongbaothanhcong">
                            {{session('success')}}
                    </div>
                    @endif --}}
                    @if (session('wrong'))
                    <div class="alert alert-danger">{{session('wrong')}}</div>v
                    @endif
                    <form runat="server" action="{{route('warehouses.productReality.store')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">CodeOrder</label>
                                    <input id="CodeOrder" value="{{old('CodeOrder')}}" type="text" class="form-control"
                                        name="CodeOrder" id="uinvoice" placeholder="Nhập CodeOrder">
                                    @error('CodeOrder')
                                    <div style="color: red">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Invoice</label>
                                    <input id="Invoice" data-type="currency" type="text" class="form-control"
                                        name="Invoice" placeholder="Nhập hoá đơn" value="{{old('Invoice')}}">
                                    @error('Invoice')
                                    <div style="color: red">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label for="validationDefault01">Container</label>
                                    <input id="Container" type="text" class="form-control" name="Container"
                                        placeholder="Nhập" value="{{old('Container')}}">
                                    @error('Container')
                                    <div style="color: red">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label for="validationDefault01">Quantity</label>
                                    <input id="quantity" type="number" min="1" name="quantity" class="form-control"
                                        value="{{old('quantity')}}">
                                    @error('quantity')
                                    <div style="color: red">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Uname</label>
                                    <select class="form-control" name="selectUname" id="selectUname">
                                        <option value="">-------Chọn-------</option>
                                        @foreach ($unames as $item)
                                        <option value="{{$item->id}}">{{$item->uname}}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input id="Uname" class="form-control" value="{{old('Uname')}}" type="text"
                                    name="Uname" placeholder="Nhập Uname"> --}}
                                    @error('selectUname')
                                    <div style="color: red">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="validationDefault01">Address</label>
                                    <select class="form-control" name="selectedAddress" id="selectedAddress">

                                    </select>
                                    {{-- <input type="text" id="address" name="address" class="form-control" --}}
                                    {{-- value="{{old('address')}}"> --}}
                                    @error('selectedAddress')
                                    <div style="color: red">{{$message}}</div>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-2 mb-2">
                                        <label for="validationDefault01">Delivery Date</label>
                                        <input type="date" id="DeliveryDate" name="DeliveryDate" class="form-control"
                                            value="{{old('DeliveryDate')}}">
                                @error('DeliveryDate')
                                <div style="color: red">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Delivery time</label>
                                <input id="DeliveryTime" type="time" min="1" name="DeliveryTime" class="form-control"
                                    value="{{old('DeliveryTime')}}">
                                @error('DeliveryTime')
                                <div style="color: red">{{$message}}</div>
                                @enderror
                            </div> --}}
                            <div class="col-md-4 mb-2">
                                <label for="validationDefault01">Image</label>
                                <input id="Image" type="file" name="Image" class="form-control"
                                    placeholder="Choose image">
                                @error('Image')
                                <div style=" color: red">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <img id="img" width="150px" height="150px" src="" hidden>
                            </div>
                            <div class="col-md-2 mb-2">
                                <input style="margin-top:13%" type="submit" id="BtnSubmit" name="submit"
                                    class="btn btn-primary" value="submit">
                            </div>
                </div>
            </div>
            </fieldset>

            </form>
            <hr>
            <div>
                <div id="formSearch" class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                    <div class="col-md-2" id="custom">
                        <button id="search" class="btn btn-primary">SEARCH</button>
                    </div>
                    <div class="col-md-2">
                        <input id="uname2" class="form-control inputCustom" type="text" name="uname2"
                            placeholder="Uname.....................">
                    </div>
                    <div class="col-md-2">
                        <input id="codeorder2" class="form-control inputCustom" type="text" name=" coderorder2"
                            placeholder="CoderOrder.....................">
                    </div>
                    <div class="col-md-2">
                        <input id="container2" class="form-control inputCustom" type="text" name="container2"
                            placeholder="Container.......................">
                    </div>
                    <div class="col-md-2">
                        <input id="invoice2" class="form-control inputCustom" type="text" name="invoice2"
                            placeholder="Invoice.............................">
                    </div>
                    <div class="col-md-1">
                        <input id="quantity2" class="form-control inputCustom" type="text" name="quantity"
                            placeholder="Quantity">
                    </div>
                    <div class="col-md-1">
                        <button id="excel" class="btn btn-success">EXCEL</button>
                    </div>
                    {{-- <div class="form-group">
                        <label for="validationDefault01">Uname</label>
                        <input class="form-control" type="text" name="uname2" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="validationDefault01">CodeOrder</label>
                        <input class="form-control" type="text" name="uname2" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="validationDefault01">Invoice</label>
                        <input class="form-control" type="text" name="uname2" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="validationDefault01">Container</label>
                        <input class="form-control" type="text" name="uname2" placeholder="">
                    </div>
                    <div class="form-group">
                        <div style="width: 50%">
                            <button class="btn btn-success form-control">EXCEL</button>
                            <button class="btn btn-primary form-control">SEARCH</button>
                        </div>
                    </div> --}}
                </div>
            </div>
            <table id="example" class="table table-bordered table-striped" style="margin-top: 1%; margin-right: 1%;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>CodeOrder</th>
                        <th>Uname</th>
                        <th>Invoice</th>
                        <th>Container</th>
                        <th>quantity</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Delivery time</th>
                    </tr>
                </thead>

                <tbody id="myTable">
                    @foreach ($product_reality as $item)

                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->codeorder}}</td>
                        <td>{{$item->uname}}</td>
                        <td>{{$item->invoice}}</td>
                        <td>{{$item->container}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->address}}</td>
                        <td class="modalImage"><a id="image" data-img="{{$item->imghoadongiaohang}}"
                                data-id="{{$item->id}}" href="javascript:"><img
                                    src="{{asset('thumnails/'.$item->imghoadongiaohang)}}" alt=""></a>
                        </td>
                        <td>{{$item->delivery_time}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div id="pagina" style="float: right" class="mt-3">
                {!! $product_reality->withQueryString()->links('commons.paginate') !!}
            </div>
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
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        $('#search').click(function () {
            // $('#example').empty();
            // $('#pagina').empty();
            var uname2 = $('#uname2').val();
            var codeorder2 = $('#codeorder2').val();
            var container2 = $('#container2').val();
            var invoice2 = $('#invoice2').val();
            var quantity2 = $('#quantity2').val();
            if (((uname2 == "") && (codeorder2 == "")) && ((container2 == "") && (invoice2 == "")) && (
                    quantity2 == "")) {
                toastr.error('Chưa nhập dữ liệu tìm kiếm', 'Notifacation', {
                    timeOut: 1000
                });
            } else {
                $.ajax({
                    type: 'GET',
                    url: './productReality/search',
                    cache: false,
                    data: {
                        uname2: uname2,
                        codeorder2: codeorder2,
                        container2: container2,
                        invoice2: invoice2,
                        quantity2: quantity2
                    },
                    success: function (data) {
                        console.log(data)
                        // if (data.data.length == 0) {
                        //     toastr.error('Không có dữ liệu', '', {
                        //         timeOut: 1000
                        //     })
                        // } else {
                        $('#example').remove();
                        $('#pagina').remove();
                        $('#formSearch').after(data)
                        // $.each(data, function (index, value) {
                        //     $.each(value.data, function (index, value) {
                        //         $('#example').append(
                        //             '<tr>' +
                        //             '<td>' + value.id + '</td>' +
                        //             '<td>' + value.coderorder +
                        //             '</td>' +
                        //             '<td>' + value.uname + '</td>' +
                        //             '<td>' + value.invoice + '</td>' +
                        //             '<td>' + value.container + '</td>' +
                        //             '<td>' + value.quantity + '</td>' +
                        //             '<td>' + value.address + '</td>' +
                        //             '<td class="modalImage"><a id="image" data-img="' +
                        //             value.imghoadongiaohang + '"' +
                        //             'data-id=' + value.id +
                        //             ' href="javascript:"><img alt src=' +
                        //             location.protocol + '//' + window
                        //             .location
                        //             .host + '/thumnails/' + value
                        //             .imghoadongiaohang + '></a>' +
                        //             '<td>' + value.delivery_time +
                        //             '</td>' +
                        //             +'</tr>'
                        //         )
                        //     })
                        // })

                        // data.paginate.links

                        // console.log('<nav><ul class="pagination">'
                        //         + data.paginate.links.slice(1, data.paginate.links.length-1).map(page => {
                        //             return `<li class="page-item"><a class="page-link" href="${page.url}">${page.label}</a></li>`
                        //         }).join('')
                        //     +'</ul></nav>')

                        // $('#pagina').append(
                        //     '<nav><ul class="pagination">'
                        //         + `<li class="page-item ${data.paginate.current_page <= 1 && 'disabled'}"><a class="page-link" href="${data.paginate.links[0].url}">${data.paginate.links[0].label}</a></li>`
                        //         + data.paginate.links.slice(1, data.paginate.links.length-1).map(page => {
                        //             return `<li class="page-item ${data.paginate.current_page == page.label && 'active'}"><a class="page-link" href="${page.url}">${page.label}</a></li>`
                        //         }).join('')
                        //         + `<li class="page-item ${data.paginate.current_page >= data.paginate.last_page && 'disabled'}"><a class="page-link" href="${data.paginate.links[data.paginate.links.length-1].url}">${data.paginate.links[data.paginate.links.length-1].label}</a></li>`
                        //     +'</ul></nav>'
                        // )
                        // }

                    }
                })
            }
        })
        $('#Image').change(function () {

            let reader = new FileReader();

            reader.onload = (e) => {
                $('img').removeAttr('hidden');
                $('#img').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });
        //lấy address 
        $('#selectUname').change(function () {
            var id = $(this).val();
            $('#selectedAddress').find('option').remove().end();
            $.ajax({
                type: 'GET',
                cache: false,
                url: 'productReality/getAddres/' + id,
                data: null,
                success: function (res) {
                    // console.log(res.data)
                    if (res.sum != 1) {
                        $('#selectedAddress').append(new Option(
                            "-------------Chọn-------------", ""))
                    }
                    $.each(res.data, function (index, value) {
                        if (value.add_default == 1) {
                            $('#selectedAddress').append(new Option(value.address,
                                value.id, true, true))
                        } else {
                            $('#hidden').removeAttr('hidden')
                            $('#selectedAddress').append(new Option(value.address,
                                value.id))
                        }
                    })

                }
            })
        })


        // setTimeout(function(){
        //     $('.thongbaothanhcong').
        // },2000)
        $('.modalImage').click(function (e) {
            const img = $(this).find('a').data('img');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                        .attr('content')
                },
                type: 'GET',
                url: "./productReality/img" + '/' + img,

                success: function (data) {
                    $('#modalDetail').modal('show');
                    $('.modal-content').html('').append(data);
                }
            });
        });

        // $('.viewUpdate').click(function () {
        //     const jan_code = $(this).data('code');
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
        //                 .attr('content')
        //         },
        //         type: 'GET',
        //         url: "inventory" + '/detail/' + jan_code,

        //         success: function (data) {
        //             $('#modalDetail').modal('show');
        //             $('.modal-content').html('').append(data);
        //         }
        //     });
        // });
    });

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@endsection
