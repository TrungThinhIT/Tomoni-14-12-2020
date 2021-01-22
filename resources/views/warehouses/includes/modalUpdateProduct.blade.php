<!-- Modal Header -->
<div class="modal-header">
    <h4 class="modal-title">Cập nhập sản phẩm </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<div class="col-12">
    <div class="form-row">
        <div class="col-md-3 mb-3">
            <label for="validationDefault01">Jancode</label>
            <input type="text" class="form-control" value="{{ $product->jan_code }}" id="jancode" readonly>
        </div>
        <div class="col-md-3 mb-3">
            <label for="validationDefault01">Câng nặng</label>
            <input class="form-control" value="{{$product->weight}}" type="number" id="weight" min="0" placeholder="Cân nặng">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Chiều dài</label>
            <input type="number" class="form-control" value="{{$product->length}}" id="length" min="0"
                placeholder="Chiều dài">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Chiều rộng </label>
            <input type="number" class="form-control" value="{{$product->width}}" id="width" min="0"
                placeholder="Chiều rộng">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">chiều cao</label>
            <input type="number" class="form-control" value="{{$product->height}}" id="height" min="0"
                placeholder="Chiều cao">
        </div>
    </div>
</div>

<!-- Modal footer -->
<div class="modal-footer">
    <div style="float: right;">
        <button type="button" class="btn btn-success" onclick="update()">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
<script>
    function update() {
        var jancode = $("#jancode").val();
        const weight = $('#weight').val();        
        const length = $('#length').val();
        const width = $('#width').val();
        const height = $('#height').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PUT',
                url: "inventory" + '/detail/' + jancode,
                data: {
                    weight: weight,
                    length: length,
                    width: width,
                    height: height
                },
                success: function (response) {
                    console.log(response);
                    if(response == 2){
                        alert('Có lỗi xẩy ra vui lòng thử lại!')
                    }else{
                        const newWeight = response.weight;
                        const quantity = $("#totalQuantity_" + jancode).text();
                        const totalNewWeight = newWeight * quantity;
                        const totalNewWeightKhoi = ((response.width * response.height * response.length) / 1000000) * quantity;
                        $("#weight_"+jancode).html(totalNewWeight.toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' kg');
                        $("#weightKhoi_"+jancode).html(totalNewWeightKhoi.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' khối');
                        if(response.weight > 0 && response.width > 0 && response.height > 0 && response.length > 0){
                            $('#' + jancode).removeClass('table-danger').addClass('');
                        }else{
                            $('#' + jancode).removeClass('').addClass('table-danger');
                        }
                        toastr.success('Cập nhập thông tin thành công.', 'Notifycation', {timeOut: 1000})
                    }
                }
            })
    }
</script>
