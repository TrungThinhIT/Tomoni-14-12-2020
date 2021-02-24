<div class="modal-header">
    <h4 class="modal-title">Chi tiết deposit <b>{{$id}}</b> </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<!-- Modal body -->
<div class="modal-body" style="overflow: auto">
    <table class="table table-bordered table-striped" style="margin-top: 1%; ">
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
            @foreach ($lists as $item)
            <tr>
                <td>{{$item->depositID}}</td>
                <td>
                    <div>
                        <input type="text" class="form-control" style="width: auto" id="us{{$item->Id}}"
                            value="{{$item->uname}}" onchange="update{{$item->Id}}()" placeholder="User name"
                            list="litsusername" onkeyup="searchUser(this)">
                        <datalist id="litsusername"></datalist>
                    </div>
                </td>
                <td>{{$item->note}}</td>
                <td>{{($item->dateget)}}</td>
                <td>{{($item->date_insert)}}</td>
                <td>{{($item->price_in)}}</td>
                <td> <input type="text" class="form-control" style="width: auto" id="shd{{$item->Id}}"
                        value="{{$item->Sohoadon}}" onchange="update{{$item->Id}}()" placeholder="So hoa don"
                        list="listbillcode" onkeyup='searchMaHoaDon(this)'>
                    <datalist id='listbillcode'></datalist></td>
            </tr>
            <script>
                function update{{$item->Id}}() {
                    var id = {{$item-> Id}};
                    var us = $("#us{{$item->Id}}").val();
                    var shd = $("#shd{{$item->Id}}").val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: "payment-customers/deposit/" + id,
                        data: {
                            uname: us,
                            sohoadon: shd
                        },
                        success: function (response) {
                            if(response==2){
                                toastr.warning(us+' không tồn tại','Notifycation',{timeOut:1000})
                            }
                            if(response.length>1){
                                var text = "";
                                var hoadon = ""
                                var deposit=""
                                $.each(response,function(index,value){
                                    text+= value.uname+',';
                                    if(value.Sohoadon==null){
                                        hoadon+="";
                                    }else{
                                        hoadon +=value.Sohoadon+',';
                                    }
                                    deposit = value.depositID
                                })
                                $("#changeUname"+deposit).text(text)
                                $("#changeHoadon"+deposit).text(hoadon)
                            }
                            toastr.success('Cập nhập thành công.', 'Notifycation', {
                            timeOut: 1000
                            })
                        }
                    });
                }
            </script>
            @endforeach
        </tbody>
</div>
</table>
</div>

<!-- Modal footer -->
<div class="modal-footer">
    <div style="float: right;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
<script>
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
    $(".showDepositID").click(function () {
        var deposit = $(this).data('deposit');
        $.ajax({
            type: "GET",
            url: "./payment-customers/deposit/" + deposit,
            success: function (data) {
                // console.log(data)
                $('#modalDetail').modal('show');
                $("#modal-details-deposit").html('').append(data);
            },
            error: function (error) {
                console.log(error)
            }

        })

    })

</script>
