<div class="modal-header">
    <h4 class="modal-title">Chi tiết nhà cung cấp </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<!-- Modal body -->
<div class="modal-body">
    <div class="form-row">
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Mã nhà cung cấp</label>
            <input type="text" disabled class="form-control" value="{{ $supplier->code_name }}" name="ecode" id="editcodename"
                placeholder="Mã nhà cung cấp">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Tên nhà cung cấp</label>
            <input class="form-control" value="{{$supplier->name}}" type="text" name="ename" id="editname"
                placeholder="Tên nhà cung cấp">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Số điện thoại</label>
            <input type="text" class="form-control" value="{{$supplier->phone}}" name="ephone" id="editphone"
                placeholder="Số điện thoại">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Email </label>
            <input type="text" class="form-control" value="{{$supplier->email}}" name="email" id="editemail" placeholder="Email">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Ngân hàng</label>
            <input type="text" class="form-control" value="{{$supplier->BankName}}" name="ebank" id="editbankname"
                placeholder="Ngân hàng">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Chi nhánh</label>
            <input type="text" class="form-control" value="{{$supplier->Branch}}" name="ebranch" id="editbranch"
                placeholder="Chi nhánh">
        </div>

    </div>
    <div class="form-row">
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Số tài khoản</label>
            <input class="form-control" value="{{$supplier->AccountNumber}}" type="text" name="eAccountNumber" id="editaccountnumber">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Tên tài khoản</label>
            <input class="form-control" value="{{$supplier->AccountName}}" type="text" name="eAccountName" id="editaccountname">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Địa chỉ</label>
            <input type="text" class="form-control" value="{{$supplier->address}}" name="eadd" id="editaddress" placeholder="Địa chỉ">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Ghi chú</label>
            <input type="text" class="form-control" value="{{$supplier->note}}" name="enote" id="editnote" placeholder="Ghi chú">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Xếp hạng</label>
            <select type="text" class="form-control" name="urank" id="editrank">
                <option value="0" {{ $supplier->rank == 0 ? 'selected':''}}>Startup</option>
                <option value="1" {{ $supplier->rank == 1 ? 'selected':''}}>Standard</option>
                <option value="2" {{ $supplier->rank == 2 ? 'selected':''}}>Business</option>
                <option value="3" {{ $supplier->rank == 3 ? 'selected':''}}>Vip</option>
            </select>

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
    var errors = ['ecode', 'ename', 'ephone', 'email', 'ebank', 'ebranch', 'eAccountNumber', 'eAccountName', 'eadd', 'enote', 'erank'];
    errors.forEach(function(item, index){
            $('span[id^="'+item+'"]').remove();
        });
        var ucode = $("#editcodename").val();
        var uname = $("#editname").val();
        var uphone = $("#editphone").val();
        var umail = $("#editemail").val();
        var ubank = $("#editbankname").val();
        var ubranch = $("#editbranch").val();
        var uAccountNumber = $("#editaccountnumber").val();
        var uAccountName = $("#editaccountname").val();
        var uadd = $("#editaddress").val();
        var unote = $("#editnote").val();
        var urank = $("#editrank").val();
        if (uname != null) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PUT',
                url: "management" + '/' + ucode,
                data: {
                    ecode: ucode,
                    ename: uname,
                    ephone: uphone,
                    email: umail,
                    ebank: ubank,
                    ebranch: ubranch,
                    eAccountNumber: uAccountNumber,
                    eAccountName: uAccountName,
                    eadd: uadd,
                    enote: unote,
                    erank: urank
                },
                success: function (response) {
                    console.log(response)
                    if(response ==1 ){
                        alert('Update success fully!');
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
