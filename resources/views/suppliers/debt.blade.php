@extends('layout')
@section('title', 'Công nợ nhà cung cấp')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Hi im Công nợ NCC</h4>
                </div>
                <div class="card-body">
                    <div>
                        <div style="margin: 1% 1% 1% 1%;">
                            <form action="{{route('orders.customer-debt')}}">
                                <form action="{{route('orders.customer-debt')}}">
                                    <fieldset>
                                        <div class="form-row" style=" margin-top: 1%;">
                                            <div>
                                                <input class="form-control" type="date" value="" name="dateStart"
                                                    id="dateStart" placeholder="Date Start">
                                            </div>
                                            <div>
                                                <input class="form-control" type="date" value="" name="dateEnd"
                                                    id="dateEnd" placeholder="Date End">
                                            </div>
                                            <div>
                                                <input class="form-control" type="text" value="" name="uname" id="Uname"
                                                    placeholder="SupplierID" list='listsupplier'
                                                    onkeyup='searchSupplier(this)' required>
                                                <datalist id='listsupplier'></datalist>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary"
                                                    style="margin-left: 2%;">Search</button>
                                            </div>
                                            <div>
                                                <button type="button" onclick="resetFormSearch()"
                                                    class="btn btn-info ml-2" style="margin-left: 2%;">Reset</button>
                                                <script>
                                                    function resetFormSearch() {
                                                        document.getElementById("dateStart").value = "";
                                                        document.getElementById("dateEnd").value = "";
                                                    }

                                                </script>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <div style="float: left;" class="mt-2">
                                        <select type="text" name="record" onchange="this.form.submit()"
                                            class="form-control" style="width: 100%;">
                                            <option value="25" selected="">
                                                25</option>
                                            <option value="50">
                                                50</option>
                                            <option value="100">
                                                100</option>
                                            <option value="150">
                                                150</option>
                                        </select>
                                    </div>
                                </form>
                                {{-- <div style="float: right" class="mt-3">
                                {!! $data['customer']->withQueryString()->links('commons.paginate') !!}
                            </div> --}}
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

                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function searchSupplier(obj) {
        var supplier = obj.value;
        if (supplier.length >= 1) {
            $.ajax({
                type: 'GET',
                url: "{{route('commons.searchSupplier')}}",
                data: {
                    supplier: supplier
                },
                success: function (response) {
                    $("#listsupplier").empty();
                    $.each(response, function (index, value) {
                        $("#listsupplier").append(new Option(value.name,value.code_name));
                    })
                }
            });
        }
    }

</script>
@endsection
