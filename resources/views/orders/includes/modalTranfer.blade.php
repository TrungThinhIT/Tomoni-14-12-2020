<div class="modal-header">
    <h4 class="modal-title">Bảng Tranfer</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<!-- Modal body -->
<div class="modal-body">
    <table class="table table-bordered table-striped display" id="example" style="margin-top: 1%;">
        <thead>
            <tr>
                <th>Chọn số hoá đơn</th>
                <th>Số hoá đơn</th>
                <th>Uname</th>
                <th>Số lượng đơn hàng</th>
                <th>Ngày tạo hoá đơn</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bills as $item)
            <tr>
                <td><input type="checkbox" class="checkBoxTranfer" data-sohoadon="{{$item->So_Hoadon}}" name="sohoadon" id=""></td>
                <td>{{$item->So_Hoadon}}</td>
                <td>{{$item->uname}}</td>
                <td>{{$item->total}}</td>
                <td>{{$item->Date_Create}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal footer -->
<div class="modal-footer">
    <div style="float: right;">
        <button type="button" class="btn btn-primary" id="buttonUpdate" onclick="tranferCodeorder()">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
<script>
    var check = 0;
    var codeorder = "{{$codeorder}}";
    var billSelect = '';
    if(check == 0){
        $("#buttonUpdate").prop("disabled",true);
    }else{
        $("#buttonUpdate").prop("disabled",false);
    }
    $(document).ready(function(){
    $('.checkBoxTranfer').click(function() {

        $('.checkBoxTranfer').not(this).prop('checked', false);
    });

    $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                check = 1;
                $("#buttonUpdate").prop("disabled", false);
            }
            else if($(this).prop("checked") == false){
                check = 0;
                $("#buttonUpdate").prop("disabled",true);
            }
        });

        $('.checkBoxTranfer').click(function() {
                                    var sohoadon = $(this).data('sohoadon');
                                    billSelect = sohoadon;
        });
});

function tranferCodeorder(){
            $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                                .attr('content')
                                        },
                                        type: 'PUT',
                                        url: "tranfer" + '/' + codeorder,
                                        data: {
                                            sohoadon: billSelect
                                        },
                                        success: function(response) {
                                            console.log(response);
                                            if(response == 1){
                                                alert('Chúc mừng bạn di chuyển thành công')
                                                location.reload();
                                            }else if(response == 3){
                                                alert('Chúc mừng bạn di chuyển thành công')
                                                window.location.href="{{route('orders.bills.indexALl')}}"
                                            }else if(response == 2){
                                                alert('Có lỗi không xác định')
                                            }
                                        }
                                    });
        }
</script>