<!-- Modal Header -->
<div class="modal-header">
    <h4 class="modal-title">Cập nhập địa chỉ </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<?php 
// dd($checkWard,$listWard);
// var_dump(explode(',',$data->address))?>
<div class="modal-body">
    <div class="col-12">
        <div class="form-row">
            <div class="col-md-1 mb-3">
                @csrf
                <label for="validationDefault01">id</label>
                <input type="text" class="form-control" value="{{$data->id}}" id="id" readonly>
            </div>

            <div class="col-md-2 mb-2">
                <label for="validationDefault01">City</label>
                {{-- <input type="text" class="form-control" value="{{$data->address}}" id="City" min="0"
                placeholder="Chiều dài"> --}}
                <select class="form-control" name="selectCity" id="selectCity2">
                    @foreach ($listCity as $item)

                    <option value="{{$item->matp}}" @if ($item->matp==$checkCity->matp)
                        {{"selected"}}
                        @endif>{{$item->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-2 mb-2">
                <label for="validationDefault01">District </label>
                <select class="form-control" name="selectDistrict" id="selectDistrict2">
                    @foreach ($listDistrict as $item)
                    <option value="{{$item->maqh}}" @if ($item->maqh==$checkDistrict->maqh)
                        {{"selected"}}
                        @endif>{{$item->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-2 mb-2">
                <label for="validationDefault01">Ward</label>
                <select class="form-control" name="Ward" id="Ward2">
                    @foreach ($listWard as $item)
                    <option value="{{$item->xaid}}" @if ($item->xaid==$checkWard->xaid)
                        {{"selected"}}
                        @endif>{{$item->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-2 mb-2">
                <label for="validationDefault01">Street</label>
                <input type="text" class="form-control" id="street" name="street" value="{{$arr[3]}}">
            </div>
            <div class="col-md-2 mb-3">
                <label for="validationDefault01">phone</label>
                <input class="form-control" value="{{$data->phonenumber}}" type="text" id="phone">
            </div>
            <div class="col-md-2 mb-3">
                <label for="validationDefault01">Delivery Time</label>
                <input class="form-control" value="{{$data->delivery_time}}" type="time" id="time">
            </div>
            <div class="col-md-2 mb-2">
                <label for="validationDefault01">Address Default</label>
                <input type="checkbox" class="form-control" name="checkbox" id="checkbox" @if ($data->add_default)
                checked
                @endif>
            </div>

        </div>
    </div>

    <!-- Modal footer -->
    <div class="modal-footer">
        <div style="float: right;">
            <button type="button" class="btn btn-success" id="update">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#selectCity2').change(function () {
                $('#selectDistrict2').find('option').remove().end();
                $('#Ward2').find('option').remove().end();
                var id = $(this).val();
                $.ajax({
                    type: "GET",
                    cache: false,
                    url: id,
                    success: function (res) {
                        console.log(res)
                        $('#selectDistrict2').append(new Option("Chọn quận/huyện", ""))
                        $.each(res, function (index, value) {
                            $('#selectDistrict2').append(new Option(value.name,
                                value
                                .maqh))
                        })
                    }
                })

            })
            $('#selectDistrict2').change(function () {
                $('#Ward2').find('option').remove().end();
                var id = $(this).val();
                $.ajax({
                    type: "GET",
                    cache: false,
                    url: "district/" + id,
                    success: function (res) {
                        console.log(res)
                        $("#Ward2").append(new Option("Chọn xã/phường/", ""))
                        $.each(res, function (index, value) {
                            $('#Ward2').append(new Option(value.name, value
                                .xaid))
                        })
                    }
                })
            })
        })


        $('#update').click(function () {
            var idAddress = $('#id').val();
            var selectCity = $("#selectCity2").val();
            const selectDistrict = $('#selectDistrict2').val();
            const ward = $('#Ward2').val();
            const street = $('#street').val();
            const phone = $('#phone').val();
            var checkbox;
            var time = $('#time').val();
            if ($('#checkbox').is(':checked')) {
                checkbox = 1;
            } else {
                checkbox = 0;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PUT',
                url: './index/' + idAddress,
                data: {
                    selectCity: selectCity,
                    selectDistrict: selectDistrict,
                    ward: ward,
                    street: street,
                    phone: phone,
                    checkbox: checkbox,
                    time: time
                },
                success: function (response) {
                    console.log(response);
                    $("#address" + idAddress).text(response.address)
                    $("#phone" + idAddress).text(response.phone)
                    $("#time" + idAddress).text(response.time)
                    toastr.success('Cập nhật thành công', 'Notifycation', {
                        timOut: 1000
                    })
                    // if (response == 2) {
                    //     alert('Có lỗi xẩy ra vui lòng thử lại!')
                    // } else {
                    //     const newWeight = response.weight;
                    //     const quantity = $("#totalQuantity_" + jancode).text();
                    //     const totalNewWeight = newWeight * quantity;
                    //     const totalNewWeightKhoi = ((response.width * response.height * response
                    //             .length) /
                    //         1000000) * quantity;
                    //     $("#weight_" + jancode).html(totalNewWeight.toFixed(2).toString().replace(
                    //         /(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' kg');
                    //     $("#weightKhoi_" + jancode).html(totalNewWeightKhoi.toFixed(2).replace(
                    //         /(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' khối');
                    //     if (response.weight > 0 && response.width > 0 && response.height > 0 &&
                    //         response
                    //         .length > 0) {
                    //         $('#' + jancode).removeClass('table-danger').addClass('');
                    //     } else {
                    //         $('#' + jancode).removeClass('').addClass('table-danger');
                    //     }
                    //     toastr.success('Cập nhập thông tin thành công.', 'Notifycation', {
                    //         timeOut: 1000
                    //     })
                    // }
                }
            })
        })

    </script>
