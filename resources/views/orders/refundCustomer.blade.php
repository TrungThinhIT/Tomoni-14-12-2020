@extends('layout')
@section('title', 'Hoàn tiền khách hàng')
@section('content')
    <div class="main-panel">
        <div class="content content-documentation">
            <div class="container-fluid">
                <div class="card card-documentation">
                    <div class="card-header bg-info-gradient text-white bubble-shadow">
                        <h4>Hoàn tiền khách hàng</h4>
                    </div>
                    <form action="{{ route('orders.refund-customer.store') }}" method="POST">
                        @csrf
                        <fieldset>
                            <div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">DepositID</label>
                                    <input value="{{ old('depositId') }}" type="text" class="form-control"
                                        name="depositId" id="depositId" placeholder="Nhập số DepositID">
                                    @error('depositId')
                                        <span class="alert-danger-custom">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="col-md-1 mb-1">
                                    <label for="validationDefault01">User name</label>
                                    <input class="form-control" value="{{ old('uname') }}" type="text" name="uname"
                                        id="uname" placeholder="User name" list="litsusername" onkeyup='searchUser(this)'>
                                    <datalist id='litsusername'></datalist>
                                    @error('uname')
                                        <span class="alert-danger-custom">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-1 mb-1">
                                    <label for="validationDefault01">Note</label>
                                    <input data-type="currency" value="{{ old('note') }}" type="text" class="form-control"
                                        name="note" id="note" placeholder="Nhập note">
                                    @error('note')
                                        <span class="alert-danger-custom">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-1">
                                    <label for="validationDefault01">Date Inprice</label>
                                    <input type="date" value="{{ old('dateInprice') }}" class="form-control"
                                        name="dateInprice" id="dateInprice" placeholder="Ngày nhập tiền">
                                    @error('dateInprice')
                                        <span class="alert-danger-custom">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-1 mb-1">
                                    <label for="validationDefault01">Price In</label>
                                    <input class="form-control" value="{{ old('priceIn') }}" type="number" name="priceIn"
                                        min="1" id="priceIn" placeholder="Price In">
                                    @error('priceIn')
                                        <span class="alert-danger-custom">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-1 mb-1">
                                    <label for="validationDefault01">Số hoá đơn</label>
                                    <input class="form-control" value="{{ old('SoHoadon') }}" type="text" name="SoHoadon"
                                        id="SoHoadon" placeholder="So hoa don" list="listbillcode"
                                        onkeyup='searchMaHoaDon(this)'> <datalist id='listbillcode'></datalist>
                                    @error('SoHoadon')
                                        <span class="alert-danger-custom">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Insert</button>
                                </div>
                                <div>
                                    <button type="button" onclick="resetFormInsert()" class="btn btn-info ml-2"
                                        style="margin-top: 20px;">Reset</button>
                                    <script>
                                        function resetFormInsert() {
                                            document.getElementById("depositId").value = "";
                                            document.getElementById("uname").value = "",
                                                document.getElementById("note").value = "",
                                                document.getElementById("dateInprice").value = "";
                                            // document.getElementById("dateInsert").value = "";
                                            document.getElementById("priceIn").value = "",
                                                document.getElementById("SoHoadon").value = "";
                                        }

                                    </script>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    {{-- modal --}}
                    {{-- modal share money --}}
                    <div id="shareMoney" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" style="min-width: 55%">
                            <div class="modal-content" id="detailsShare">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <div style="margin: 1% 1% 1% 1%;">
                                <form action="{{ route('orders.refund-customer.index') }}">
                                    <fieldset>
                                        <div class="form-row" style=" margin-top: 1%;">
                                            <div>
                                                <input class="form-control" value="{{ $uname }}" type="text"
                                                    name="Uname" list="litsusername" onkeyup="searchUser(this)" id="Uname" placeholder="User name">
                                            </div>
                                            <div>
                                                <input class="form-control" value="{{ $date_inprice }}" type="date"
                                                    name="date_inprice" id="date_inprice">
                                            </div>
                                            <div>
                                                <input class="form-control" value="{{ $date_end }}" type="date"
                                                    name="date_insert" id="date_insert">
                                            </div>
                                            <div>
                                                <input class="form-control" value="" type="text" name="Sohoadon"
                                                    id="Sohoadon" placeholder="Số hóa đơn">
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary"
                                                    style="margin-left: 2%;">Search</button>
                                            </div>
                                            <div>
                                                <button type="button" onclick="resetFormSearch()" class="btn btn-info ml-2"
                                                    style="margin-left: 2%;">Reset</button>
                                                <script>
                                                    function resetFormSearch() {
                                                        document.getElementById("Uname").value = "";
                                                        document.getElementById("date_inprice").value = "";
                                                        document.getElementById("date_insert").value = "";
                                                        document.getElementById("Sohoadon").value = "";
                                                    }

                                                </script>
                                            </div>
                                        </div>
                                    </fieldset>
                                    {{-- modal --}}
                                </form>
                                <div style="float: right" class="mt-3">
                                    {!! $data->withQueryString()->links('commons.paginate') !!}</div>
                                <table class="table table-bordered table-striped" style="margin-top: 1%;">
                                    <thead>
                                        <tr>
                                            <th>DepositID</th>
                                            <th>Uname</th>
                                            <th>Note</th>
                                            <th>date_inprice</th>
                                            <th>date_insert</th>
                                            <th>Price In</th>
                                            <th>Sohoadon</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->deposit }}</td>
                                                <td><input class="form-control" style="width:70%;max-height:60% !important"
                                                        onchange="update{{ $item->id }}()" type="text"
                                                        value="{{ $item->uname }}" list="litsusername"
                                                        onkeyup="searchUser(this)" id="us{{ $item->id }}">
                                                    <datalist id="litsusername"></datalist>
                                                </td>
                                                <td>{{ $item->note }}</td>
                                                <td>{{ $item->date_in }}</td>
                                                <td>{{ $item->date_insert }}</td>
                                                <td>{{ number_format($item->money) }}</td>
                                                <td><input onchange="update{{ $item->id }}()" class="form-control"
                                                        style="width:70%; max-height:60% !important"
                                                        onkeyup="searchMaHoaDon(this)" type="text"
                                                        value="{{ $item->billcode }}" id="shd{{ $item->id }}"
                                                        list="listbillcode">
                                                    <datalist id="listbillcode"></datalist>
                                                </td>
                                            </tr>
                                            <script>
                                                function update{{ $item->id }}() {
                                                    var id = {{ $item->id }};
                                                    var us = $("#us{{ $item->id }}").val();
                                                    var shd = $("#shd{{ $item->id }}").val();
                                                    $.ajax({
                                                        headers: {
                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                                                'content')
                                                        },
                                                        type: 'PUT',
                                                        url: "refund-customer/" + id,
                                                        data: {
                                                            uname: us,
                                                            sohoadon: shd
                                                        },
                                                        success: function(response) {
                                                            console.log(response)
                                                            if (response == "ErrorUname") {
                                                                toastr.warning(us + ' không tồn tại',
                                                                    'Notifycation', {
                                                                        timeOut: 1000
                                                                    })
                                                            } else if (response == "ErrorSHD") {
                                                                toastr.warning('Số hóa đơn ' + shd +
                                                                    ' không tồn tại', 'Notifycation', {
                                                                        timeOut: 1000
                                                                    })
                                                            } else {
                                                                toastr.success('Cập nhập thành công.',
                                                                    'Notifycation', {
                                                                        timeOut: 1000
                                                                    })
                                                            }
                                                        }
                                                    });
                                                }

                                            </script>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- modal --}}
                    <div class="modal" id="modalDetail">
                        <div class="modal-dialog modal-lg" style="min-width: 55%;">
                            <div class="modal-content" id="modal-details-deposit">
                                <!-- Modal Header -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $('#formSubmit').submit(function(e) {
            var sum = 0;
            var check = $("input[name='price[]']");
            var total = $("#total").val();
            var deposit = $("#deposit").val();
            $.each(check, function(index, value) {
                sum = sum + (Number(value.value))
            })
            if (!deposit) {
                toastr.warning('Chưa nhập DepositID', 'Báo lỗi', {
                    timeOut: 1000
                })
                return false
            }
            if (total) {
                if (Number(sum) != Number(total)) {
                    toastr.warning('Chi tiết không bằng tổng', 'Báo lỗi', {
                        timeOut: 1200
                    })
                    return false;
                } else {
                    // return true
                    var form = $(this);
                    var url = form.attr('action');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: form.serialize(),
                        success: function(data) {
                            $("#errors").empty()
                            if (data == "oke") {
                                toastr.success("Cập nhật thành công", "Notifications", {
                                    timeOut: 900
                                })
                                window.location.reload()
                            } else {
                                $("#errors").css("display", "block");
                                $.each(data, function(index, obj) {
                                    $.each(obj, function(index, value) {
                                        $("#errors").append(
                                            '<td class="text-danger" style="display:block">' +
                                            value + '</td>')
                                    })
                                })
                            }
                        },
                        error: function(error) {
                            console.log(error)
                        }
                    })
                    return false
                }
            } else {
                toastr.warning('Chưa nhập tổng tiền', 'Báo lỗi', {
                    timeOut: 1000
                })
                return false
            }
        })

        function deleteRow(row) {
            $(row).parent().parent().remove()
        }
        $("#delete").click(function() {
            $(this).parent().parent().remove()
        })

        function setDate(date) {
            $('#getDate').val(date)
        }

        function submitDeposit(value) {
            $('#deposit').val(value)
        }

        function bodyEmpty() {
            $("#errors").css("display", "none");
            $("#errors").empty();
            $("#litsusername").empty();
            $("#depositID").val('');
            $("#setDate").val('');
            $("#total").val('');
            $('#bodyForm').empty();
        }

        function addRow() {
            $('#bodyForm').append(
                '<tr class="table-secondary">' +
                '<td> <input style="border:none" name="uname[]" type="text"  onkeyup="searchUser(this)"  list="litsusername" > </td>' +
                '<td> <input style="border:none" name="note[]" type="text" > </td>' +
                '<td> <input style="border:none" name="price[]" type="number" min="1" ></td>' +
                '<td> <input style="border:none" name="hoadon[]" type="text" > </td>' +
                '<td> <button type="button" onclick=deleteRow(this)>Xóa</button> </td>' +
                '</tr>'
            )
        }

        function searchUser(obj) {
            var text = $(obj).val();
            if (text.length > 1) {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('commons.search-user') }}",
                    data: {
                        uname: text
                    },
                    success: function(response) {
                        var len = response.length;
                        $("#litsusername").empty();
                        for (var i = 0; i < len; i++) {
                            var name = response[i]['uname'];
                            var name1 = response[i]['fname'];

                            $("#litsusername").append("<option value='" + name + "'>" + name1 +
                                "</option>");

                        }
                    }
                });
            };
        }

        function searchMaHoaDon(obj) {
            var text = $(obj).val();
            if (text.length > 3) {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('commons.searchBillCode') }}",
                    data: {
                        BillCode: text
                    },
                    success: function(response) {
                        var len = response.length;
                        $("#listbillcode").empty();
                        for (var i = 0; i < len; i++) {
                            var name = response[i]['So_Hoadon'];

                            $("#listbillcode").append("<option value='" + name + "'>" + name +
                                "</option>");

                        }
                    }
                });
            };
        }
        $(".showDepositID").click(function() {
            var deposit = $(this).data('deposit');
            $.ajax({
                type: "GET",
                url: "./payment-customers/deposit/" + deposit,
                success: function(data) {
                    $('#modalDetail').modal('show');
                    $("#modal-details-deposit").html('').append(data);
                },
                error: function(error) {
                    console.log(error)
                }

            })
        })
        $(".shareMoney").click(function() {
            var deposit = $(this).data("deposit");
            var sum = $(this).data("sum");
            $.ajax({
                type: "GET",
                url: "./payment-customers/share-money/" + deposit,
                data: {
                    sum: sum
                },
                success: function(response) {
                    $("#shareMoney").modal("show");
                    $("#detailsShare").html("").append(response)
                }
            })
        })

    </script>
@endsection
