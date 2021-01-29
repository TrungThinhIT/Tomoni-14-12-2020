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
@section('title', 'Sổ địa chỉ')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Sổ địa chỉ</h4>
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
                        <div class="alert alert-danger" style="background-color: red !important">{{session('wrong')}}
                        </div>v
                        @endif
                        <form runat="server" action="{{route('addressBook.index.store')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                                    <div class="col-md-2 mb-2">
                                        <label for="validationDefault01">Uname</label>
                                        <select class="form-control" name="selectUname" id="selectUname">
                                            <option value="">---------Chọn----------</option>
                                            @foreach ($users as $item)
                                            <option value="{{$item->Id}}">{{$item->uname}}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input id="Uname" value="{{old('Uname')}}" type="text" class="form-control"
                                        name="Uname"> --}}
                                        @error('selectUname')
                                        <div style="color: red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label for="validationDefault01">City</label>
                                        <select class="form-control" name="City" id="selectCity">
                                            <option value="">---------Chọn----------</option>
                                            @foreach ($citys as $item)
                                            <option value="{{$item->matp}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input id="Address" class="form-control" value="{{old('Address')}}"
                                        type="text"
                                        name="Address" placeholder="Nhập Uname"> --}}
                                        @error('City')
                                        <div style="color: red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label for="validationDefault01">District</label>
                                        <select class="form-control" name="District" id="selectDistrict">

                                        </select>
                                        {{-- <input id="Address" class="form-control" value="{{old('Address')}}"
                                        type="text"
                                        name="Address" placeholder="Nhập Uname"> --}}
                                        @error('District')
                                        <div style="color: red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label for="validationDefault01">Ward</label>
                                        <select class="form-control" name="Ward" id="Ward">
                                        </select>
                                        {{-- <input id="Address" class="form-control" value="{{old('Address')}}"
                                        type="text"
                                        name="Address" placeholder="Nhập Uname"> --}}
                                        @error('Ward')
                                        <div style="color: red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label for="validationDefault01">Street Home</label>

                                        <input id="Address" class="form-control" value="{{old('StreetHome')}}"
                                            type="text" name="StreetHome">
                                        @error('StreetHome')
                                        <div style="color: red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label for="validationDefault01">Phone</label>
                                        <input id="Phone" data-type="currency" type="text" class="form-control"
                                            name="Phone" placeholder="" value="{{old('Phone')}}">
                                        @error('Phone')
                                        <div style="color: red">{{$message}}</div>
                                        @enderror
                                    </div>


                                    <div class="col-md-2 mb-2">
                                        <label for="validationDefault01">Delivery time</label>
                                        <input id="DeliveryTime" type="time" name="DeliveryTime" class="form-control"
                                            value="{{old('DeliveryTime')}}">
                                        @error('DeliveryTime')
                                        <div style="color: red">{{$message}}</div>
                                        @enderror
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
                        <div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                            <div class="form-group">
                                <label for="validationDefault01">Uname</label>
                                <select class="form-control" name="selectUname2" id="selectUname2">
                                    <option value="">----------</option>
                                    @foreach ($unames as $item)
                                    <option value="{{$item->Id}}">{{$item->uname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="validationDefault01">Uname</label>
                                <select class="form-control" name="selectUname2" id="selectUname2">
                                    <option value="">----------</option>
                                    @foreach ($unames as $item)
                                    <option value="{{$item->Id}}">{{$item->uname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="validationDefault01">Uname</label>
                                <select class="form-control" name="selectUname2" id="selectUname2">
                                    <option value="">----------</option>
                                    @foreach ($unames as $item)
                                    <option value="{{$item->Id}}">{{$item->uname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div style="width: 50%">
                                    <button class="form-control btn btn-primary">SEARCH</button>
                                    <button class="form-control btn btn-success">aaa</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <table id="example" class="table table-bordered table-striped"
                        style="margin-top: 1%; margin-right: 1%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>AddCode</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Uname</th>
                                <th>DeliveryTime</th>

                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="myTable">
                            @foreach ($list as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->addcode}}</td>
                                <td id="address{{$item->id}}">{{$item->address}}</td>
                                <td id="phone{{$item->id}}">{{$item->phonenumber}}</td>
                                <td>{{$item->uname}}</td>
                                <td id="time{{$item->id}}">{{$item->delivery_time}}</td>
                                <td><a href="javascript:"><i id="{{$item->id}}"
                                            class="fas fa-edit view_addressBook"></i></a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div id="pagina" style="float: right" class="mt-3">
                        {!! $list->withQueryString()->links('commons.paginate') !!}
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#search').click(function (e) {
            alert($('input[name="search"]').val());

            $('#example').empty();
            $('#pagina').empty();
            e.preventDefault();

        })
        $('#Image').change(function () {

            let reader = new FileReader();

            reader.onload = (e) => {
                $('img').removeAttr('hidden');
                $('#img').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        });
        $('#selectCity').change(function () {
            $('#selectDistrict').find('option').remove().end();
            $('#Ward').find('option').remove().end();
            var id = $(this).val();
            $.ajax({
                type: "GET",
                cache: false,
                url: id,
                success: function (res) {
                    console.log(res)
                    $('#selectDistrict').append(new Option("Chọn quận/huyện", ""))
                    $.each(res, function (index, value) {
                        $('#selectDistrict').append(new Option(value.name, value
                            .maqh))
                    })
                }
            })
        })
        $('#selectDistrict').change(function () {
            $('#Ward').find('option').remove().end();
            var id = $(this).val();
            $.ajax({
                type: "GET",
                cache: false,
                url: "district/" + id,
                success: function (res) {
                    console.log(res)
                    $("#Ward").append(new Option("Chọn xã/phường/", ""))
                    $.each(res, function (index, value) {
                        $('#Ward').append(new Option(value.name, value
                            .xaid))
                    })
                }
            })
        })

        $('.view_addressBook').click(function () {
            var id = $(this).attr('id');
            $.ajax({
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                //         .attr('content')
                // },
                type: 'GET',
                url: "index/" + id,
                success: function (data) {
                    console.log(data)
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
