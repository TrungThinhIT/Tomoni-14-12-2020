<div class="modal-header">
    <h4 class="modal-title">Chi tiết sổ cái </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<!-- Modal body -->
<div class="modal-body">
    <div class="form-row">
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Số Id</label>
            <input class="form-control" value="{{$ledger->Id}}" disabled type="text" name="eId" id="eId">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Tên tài khoản</label>
            <input class="form-control" value="{{$ledger->Uname}}" type="text" name="eUname" id="eUname" placeholder="Tên tài khoản" list='litsusername' onkeyup='searchUser(this)'> <datalist id='litsusername'></datalist>
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Price In</label>
            <input type="text" class="form-control" value="{{$ledger->PriceIn}}" name="ePriceIn" id="ePriceIn" placeholder="Price In">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Price Out</label>
            <input type="text" class="form-control" value="{{$ledger->PriceOut}}" name="ePriceOut" id="ePriceOut" placeholder="Price Out">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Price delb</label>
            <input type="text" class="form-control" value="{{$ledger->Pricedelb}}" name="ePricedelb" id="ePricedelb" placeholder="Price delb">
        </div>
        <div class="col-md-2 mb-2" style="margin-top: 1%;">
            <button type="button" class="btn btn-primary" onclick="UpdateDetail()" >Update</button>
        </div>

    </div>
</div>

<!-- Modal footer -->
<div class="modal-footer">
    <div style="float: right;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
<script>
function UpdateDetail() {
    var errors = ['eUname', 'ePriceIn', 'ePriceOut', 'ePricedelb'];
    errors.forEach(function(item, index){
            $('span[id^="'+item+'"]').remove();
        });
        var eId = $("#eId").val();
        var eUname = $("#eUname").val();
        var ePriceIn = $("#ePriceIn").val();
        var ePriceOut = $("#ePriceOut").val();
        var ePricedelb = $("#ePricedelb").val();
        if (eId != null) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PUT',
                url: "ledgers/" + eId,
                data: {
                    eId: eId,
                    eUname: eUname,
                    ePriceIn: ePriceIn,
                    ePriceOut: ePriceOut,
                    ePricedelb: ePricedelb
                },
                success: function (response) {
                    console.log(response)
                    if(response == 1 ){
                        location.reload();
                    }else{
                        alert('Co loi say ra vui long thu lai')
                    }
                    },
                    error:function (response){
                    $.each(response.responseJSON.errors,function(field_name,error){
                        $(document).find('[name='+field_name+']').after('<span class="alert-danger-custom" id="'+field_name+'">' +error+ '</span>');
                        fields.push(field_name);
                    })
                }
                })
            }else
        if (uname == null) {
            alert("Please checkout input");
        }

    }
</script>
