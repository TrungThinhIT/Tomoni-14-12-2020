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
                    <div class="alert alert-danger">{{session('wrong')}}</div>
                    @endif
                    <form runat="server" action="{{route('warehouses.productReality.store')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">CodeOrder</label>
                                    <input id="CodeOrder" value="{{old('CodeOrder')}}" type="text" list="listcodeOrders"
                                        class="form-control" name="CodeOrder" id="invoice"
                                        onkeyup="searchCodeOrder(this)" placeholder="Nhập CodeOrder">
                                    <datalist id="listcodeOrders">

                                    </datalist>
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
                        </fieldset>
                </div>
                </form>
                <hr>
                <div>
                    <form id="submit" action="{{ route('warehouses.productReality.get-table') }}" method="GET">
                        <div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                            <div class="col-md-2" id="custom">
                                <input id="search" type="submit" class="btn btn-primary" value="SEARCH">
                            </div>
                            <div class="col-md-2">
                                <input id="uname2" class="form-control inputCustom" type="text" name="uname"
                                    placeholder="Uname.....................">
                            </div>
                            <div class="col-md-2">
                                <input id="codeorder2" class="form-control inputCustom" type="text" name=" codeorder"
                                    placeholder="CoderOrder.....................">
                            </div>
                            <div class="col-md-2">
                                <input id="container2" class="form-control inputCustom" type="text" name="container"
                                    placeholder="Container.......................">
                            </div>
                            <div class="col-md-2">
                                <input id="invoice2" class="form-control inputCustom" type="text" name="invoice"
                                    placeholder="Invoice.............................">
                            </div>
                            <div class="col-md-1">
                                <input id="quantity2" class="form-control inputCustom" type="text" name="quantity"
                                    placeholder="Quantity">
                            </div>
                            <input type="text" name="export" value="true" hidden>
                            <div class="col-md-1">
                                <button id="excel" type="button" class="btn btn-success">EXCEL</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="data-table"></div>
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
        $.ajax({
            url: "productReality/get-table",
            context: document.body,
            success: function (data) {
                $('#data-table').append(data);
            }
        });
    });
    $('#excel').click(function () {
        document.forms["submit"].submit();
    })

    function searchCodeOrder(obj) {
        var text = $(obj).val();
        if (text.length >= 3) {
            $.ajax({
                type: 'GET',
                url: "./productReality/getCodeOrder",
                data: {
                    search_ordercode: text
                },
                success: function (response) {
                    // console.log(response.anhmv)
                    $('#listcodeOrders').empty()
                    $.each(response, function (index, value) {
                        $('#listcodeOrders').append(new Option("Quantity: " + value.quantity + ' ' +
                            "Total: " + value.total, value.codeorder))
                    })
                }
            });
        }
    }
    $("#submit").submit(function (e) {
        e.preventDefault();
        var uname = $('#uname2').val();
        var codeorder = $('#codeorder2').val();
        var container = $('#container2').val();
        var invoice = $('#invoice2').val();
        var quantity = $('#quantity2').val();
        $.ajax({
            type: "GET",
            url: "/warehouses/productReality/get-table",
            data: {
                uname: uname,
                codeorder: codeorder,
                container: container,
                invoice: invoice,
                quantity: quantity
            },
            success: function (data) {
                $('#data-table').html('').append(data);
            }, 
            error: function (result) {
                alert('error');
            }
        });
    });

    $(document).ready(function () {
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
                            $('#selectedAddress').append(new Option(value
                                .address,
                                value.id, true, true))
                        } else {
                            $('#hidden').removeAttr('hidden')
                            $('#selectedAddress').append(new Option(value
                                .address,
                                value.id))
                        }
                    })

                }
            })
        })
    });

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@endsection
