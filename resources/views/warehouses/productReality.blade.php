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
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                        @endif
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
                                        <input id="CodeOrder" value="{{old('CodeOrder')}}" type="text"
                                            class="form-control" name="CodeOrder" id="uinvoice"
                                            placeholder="Nhập CodeOrder">
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
                                    <input id="DeliveryTime" type="time" min="1" name="DeliveryTime"
                                        class="form-control" value="{{old('DeliveryTime')}}">
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
                <div style="float: right" class="mt-3">
                </div>
                <table id="example" class="table table-bordered table-striped"
                    style="margin-top: 1%; margin-right: 1%;">
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
                            <td><img src="{{asset('images/'.$item->imghoadongiaohang)}}" alt="">
                            </td>
                            <td>{{$item->delivery_time}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div style="float: right" class="mt-3">
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
                    console.log(res)
                    $.each(res, function (index, value) {
                        if (value.add_default == 1) {
                            $('#selectedAddress').append(new Option(value.address,
                                value.id, true, true))
                        } else {
                            $('#selectedAddress').append(new Option(value.address,
                                value.id))
                        }
                    })

                }
            })
        })
        // $('.view_transaction').click(function () {
        //     const jan_code = $(this).data('code');
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
        //                 .attr('content')
        //         },
        //         type: 'GET',
        //         url: "inventory" + '/' + jan_code,

        //         success: function (data) {
        //             $('#modalDetail').modal('show');
        //             $('.modal-content').html('').append(data);
        //         }
        //     });
        // });

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
