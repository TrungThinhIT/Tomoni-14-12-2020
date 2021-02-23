@extends('layout')
@section('title', 'Khách hàng thanh toán')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Khách hàng thanh toán</h4>
                </div>
                <form action="{{route('orders.payment-customers.insert')}}" method="POST">
                    @csrf
                    <fieldset>
                        <div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">DepositID</label>
                                <input value="{{ old('depositId') }}" type="text" class="form-control" name="depositId"
                                    id="depositId" placeholder="Nhập số DepositID">
                                <span class="alert-danger-custom">{{$errors->first('depositId')}}</span>
                            </div>
                            <div class="col-md-1 mb-1">
                                <label for="validationDefault01">User name</label>
                                <input class="form-control" value="{{ old('uname') }}" type="text" name="uname"
                                    id="uname" placeholder="User name" list="litsusername" onkeyup='searchUser(this)'>
                                <datalist id='litsusername'></datalist>
                                <span class="alert-danger-custom">{{$errors->first('uname')}}</span>
                            </div>
                            <div class="col-md-1 mb-1">
                                <label for="validationDefault01">Note</label>
                                <input data-type="currency" value="{{ old('note') }}" type="text" class="form-control"
                                    name="note" id="note" placeholder="Nhập note">
                                <span class="alert-danger-custom">{{$errors->first('note')}}</span>
                            </div>
                            <div class="col-md-2 mb-1">
                                <label for="validationDefault01">Date Inprice</label>
                                <input type="date" value="{{ old('dateInprice') }}" class="form-control"
                                    name="dateInprice" id="dateInprice" placeholder="Ngày nhập tiền">
                                <span class="alert-danger-custom">{{$errors->first('dateInprice')}}</span>
                            </div>
                            <div class="col-md-1 mb-1">
                                <label for="validationDefault01">Price In</label>
                                <input class="form-control" value="{{ old('priceIn') }}" type="text" name="priceIn"
                                    id="priceIn" placeholder="Price In">
                                <span class="alert-danger-custom">{{$errors->first('priceIn')}}</span>
                            </div>
                            <div class="col-md-1 mb-1">
                                <label for="validationDefault01">Số hoá đơn</label>
                                <input class="form-control" value="{{ old('SoHoadon') }}" type="text" name="SoHoadon"
                                    id="SoHoadon" placeholder="So hoa don" list="listbillcode"
                                    onkeyup='searchMaHoaDon(this)'> <datalist id='listbillcode'></datalist>
                                <span class="alert-danger-custom">{{$errors->first('SoHoadon')}}</span>
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
                                        document.getElementById("dateInsert").value = "";
                                        document.getElementById("priceIn").value = "",
                                            document.getElementById("SoHoadon").value = "";
                                    }

                                </script>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary ml-2" onclick="bodyEmpty()" style="margin-top:20px;"
                                    data-toggle="modal" data-target=".bd-example-modal-lg">Import</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                {{-- modal --}}
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            {{-- header --}}
                            <div class="modal-header">
                                <h5 class="modal-title">Thêm nhiều</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {{-- body  --}}
                            <div class="modal-body">
                                <div class="row overflow:auto">
                                    <tr >
                                        <div class="col-3">
                                            <label for="">DepositID</label>
                                            <td><input class="form-control" type="text" id="depositID" onchange="submitDeposit(this.value)"></td>
                                            <span class="text-danger" id="errorID"></span>
                                        </div>
                                        <div class="col-3">
                                            <label for="">Total</label>
                                            <td><input id="total" class="form-control" type="number" min="1"></td>
                                        </div>
                                        <div class="col-3">
                                            <label for="">Date Price</label>
                                            <td><input class="form-control" type="date" id="setDate" onchange="setDate(this.value)"></td>
                                        </div>
                                        <div class="col-2 mt-4 ">
                                            <button class="btn btn-primary" onclick="addRow()">Insert</button>
                                        </div>
                                    </tr>
                                </div>
                                <hr>
                                <div id="errors" style="height:90px;overflow: auto;display:none">
                                   
                                </div>
                                <div style="overflow: auto">
                                    <form id="formSubmit" action="{{route('orders.payment-customers.addUname')}}" method="POST">
                                        @csrf
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th >Uname</th>
                                                    <th >Note</th>
                                                    <th >Price In</th>
                                                    <th >Sohoadon</th>
                                                </tr>
                                            </thead>
                                            <tbody id="bodyForm">
                                                <input id="deposit" name="deposit" type="text" hidden>
                                                <input type="date" name="getDate" id="getDate" hidden >
                                            </tbody>
                                            
                                        </table>
                                        <input class="float-right btn btn-primary" id="checkSubmit" type="submit" value="Submit">
                                     </form>
                                </div>
                            </div>
                            {{-- footer --}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn btn-primary">Submit</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <div style="margin: 1% 1% 1% 1%;">
                            <form action="{{route('orders.payment-customers.index')}}">
                                <fieldset>
                                    <div class="form-row" style=" margin-top: 1%;">
                                        <div>
                                            <input class="form-control" value="{{$data['Uname']}}" type="text"
                                                name="Uname" id="Uname" placeholder="User name">
                                        </div>
                                        <div>
                                            <input class="form-control" value="{{$data['date_inprice']}}" type="date"
                                                name="date_inprice" id="date_inprice">
                                        </div>
                                        <div>
                                            <input class="form-control" value="{{$data['date_insert']}}" type="date"
                                                name="date_insert" id="date_insert">
                                        </div>
                                        <div>
                                            <input class="form-control" value="{{$data['Sohoadon']}}" type="text"
                                                name="Sohoadon" id="Sohoadon" placeholder="Số hóa đơn">
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
                                {!! $data['PCustomers']->withQueryString()->links('commons.paginate') !!}</div>
                            <table class="table table-bordered table-striped" style="margin-top: 1%;">
                                <thead>
                                    <tr>
                                        <th>DepositID</th>
                                        <th style="min-width: 200px;">Uname</th>
                                        <th style="min-width: 200px;">Note</th>
                                        <th>date_inprice</th>
                                        <th>date_insert</th>
                                        <th>Price In</th>
                                        <th>Sohoadon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach ($data['PCustomers'] as $item)
                                    @php
                                        $sum = 0;
                                    @endphp
                                    <tr>
                                        <td data-deposit=@if (count($item)>=2)
                                            @foreach ($item as $ite)
                                                {{$ite->depositID}}
                                                @break
                                            @endforeach
                                        @else
                                            {{$item[0]->depositID}}
                                        @endif 
                                        @if(count($item)>=2)
                                        {{"class=showDepositID"}}
                                        @endif >
                                        @if (count($item)>=2)
                                            @foreach ($item as $ite)
                                                {{$ite->depositID}}
                                                @break
                                            @endforeach
                                        @else
                                            {{$item[0]->depositID}}
                                        @endif</td>
                                        <td>
                                            <div 
                                                 @if ((count($item)>=2))
                                                    @foreach ($item as $ite)
                                                         {{"id=changeUname".$ite->depositID}}
                                                     @endforeach
                                                @endif
                                            >
                                                @if (count($item)>=2)
                                                @foreach ($item as $ite)
                                                {{$ite->uname.','}}
                                                @endforeach
                                                @else
                                                    <input type="text" class="form-control" id="us{{$item[0]->Id}}"
                                                    value="{{$item[0]->uname}}" onchange="update{{$item[0]->Id}}()"
                                                    placeholder="User name" list="litsusername"
                                                    onkeyup='searchUser(this)'> <datalist id='litsusername'></datalist>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if (count($item)>=2)
                                                @foreach ($item as $ite)
                                                @if($ite->note!=null)
                                                    {{$ite->note.','}}
                                                @endif
                                                @endforeach
                                            @else
                                            {{$item[0]->note}}
                                            @endif
                                        </td>
                                        <td>{{$item[0]->dateget}}</td>
                                        <td>{{$item[0]->date_insert}}</td>
                                        <td> @if (count($item)>=2)
                                            @foreach ($item as $ite)
                                               @php
                                                   $sum +=$ite->price_in
                                               @endphp
                                            @endforeach
                                            {{number_format($sum)}}
                                        @else
                                        {{number_format($item[0]->price_in, 0)}}
                                        @endif
                                           </td>
                                        <td>
                                            <div
                                                @if ((count($item)>=2))
                                                   @foreach ($item as $ite)
                                                        {{"id=changeHoadon".$ite->depositID}}
                                                    @endforeach
                                                @endif
                                            >
                                                @if (count($item)>=2)
                                                    @foreach ($item as $ite)
                                                    @if($ite->Sohoadon!="")
                                                        {{$ite->Sohoadon.','}}
                                                    @endif
                                                    @endforeach
                                                @else
                                                    <input type="text" class="form-control" id="shd{{$item[0]->Id}}"
                                                        value="{{$item[0]->Sohoadon}}" onchange="update{{$item[0]->Id}}()"
                                                        placeholder="So hoa don" list="listbillcode"
                                                        onkeyup='searchMaHoaDon(this)'> <datalist
                                                        id='listbillcode'></datalist>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary" data-despoit=" 
                                            @foreach ($item as $ite)
                                                {{$ite->depositID}}
                                                @break
                                            @endforeach">Edit</button>
                                        </td>
                                    </tr>
                                    <script>
                                        function update{{$item[0]->Id}}() {
                                            var id = {{$item[0]-> Id}};
                                            var us = $("#us{{$item[0]->Id}}").val();
                                            var shd = $("#shd{{$item[0]->Id}}").val();
                                            $.ajax({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                type: 'PUT',
                                                url: "payment-customers/" + id,
                                                data: {
                                                    uname: us,
                                                    sohoadon: shd
                                                },
                                                success: function (response) {
                                                    if(response=="ErrorUname"){
                                                        toastr.warning(us+' không tồn tại','Notifycation',{timeOut:1000})
                                                    }else if(response=="ErrorSHD"){
                                                        toastr.warning('Số hóa đơn '+shd+' không tồn tại','Notifycation',{timeOut:1000})
                                                    }else{
                                                        toastr.success('Cập nhập thành công.', 'Notifycation', {
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
                <div class="modal" id="modalDetail">
                    <div class="modal-dialog modal-lg" style="min-width: 40%;" >
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
    $('#formSubmit').submit(function(e){
        var sum = 0;
        var check = $("input[name='price[]']");
        var total = $("#total").val();
        var deposit = $("#deposit").val();
        $.each(check,function(index,value){
            sum=sum+(Number(value.value))
        })
        if(!deposit){
            toastr.warning('Chưa nhập DepositID','Báo lỗi',{timeOut:1000})
            return false
        }
        if(total){
            if(Number(sum)!=Number(total)){
            toastr.warning('Chi tiết không bằng tổng','Báo lỗi',{timeOut:1200})
            return false;
            }else{
                // return true
                var form = $(this);
                var url = form.attr('action');
                $.ajax({
                    type:"POST",
                    url:url,
                    data:form.serialize(),
                    success:function(data){
                        $("#errors").empty()
                        if(data=="oke"){
                            toastr.success("Cập nhật thành công","Notifications",{timeOut:900})
                            window.location.reload()
                        }else{
                            $("#errors").css("display","block");
                            $.each(data,function(index,obj){
                                $.each(obj,function(index,value){
                                    console.log(value)
                                    $("#errors").append('<td class="text-danger" style="display:block">'+value+'</td>')
                                })
                            })
                        }
                    },error:function(error){
                        console.log(error)
                    }
                })
                return false
            }
        }else{
            toastr.warning('Chưa nhập tổng tiền','Báo lỗi',{timeOut:1000})
            return false
        }
    })
    function deleteRow(row){
        $(row).parent().parent().remove()
    }
    $("#delete").click(function(){
        $(this).parent().parent().remove()
    })
    function setDate(date){
        $('#getDate').val(date)
    }
    function submitDeposit(value){
        $('#deposit').val(value)
    }
    function bodyEmpty(){
        $("#errors").css("display","none");
        $("#errors").empty();
        $("#litsusername").empty();
        $("#depositID").val('');
        $("#setDate").val('');
        $("#total").val('');
        $('#bodyForm').empty();
    }
    function addRow(){
        $('#bodyForm').append(
            '<tr>'+
                '<td> <input name="uname[]" type="text"  onkeyup="searchUser(this)"  list="litsusername" > </td>'+
                '<td> <input name="note[]" type="text" > </td>'+
                '<td> <input name="price[]" type="number" min="1" ></td>'+
                '<td> <input name="hoadon[]" type="text" > </td>'+
                '<td> <button type="button" onclick=deleteRow(this)>Xóa</button> </td>'+
            '</tr>'
            )
    }
   
    function searchUser(obj) {
        var text = $(obj).val();
        if (text.length > 1) {
            $.ajax({
                type: 'GET',
                url: "{{route('commons.search-user')}}",
                data: {
                    uname: text
                },
                success: function (response) {
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
                url: "{{route('commons.searchBillCode')}}",
                data: {
                    BillCode: text
                },
                success: function (response) {
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
    $(".showDepositID").click(function(){
        var deposit = $(this).data('deposit');
        $.ajax({
            type:"GET",
            url:"./payment-customers/deposit/"+deposit,
            success:function(data){
                $('#modalDetail').modal('show');
                $("#modal-details-deposit").html('').append(data);
            },error:function(error){
                console.log(error)
            }
          
        })
       
    })
</script>
@endsection
