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
            <input class="form-control" value="{{$product->weight}}" type="text" id="weight" placeholder="Cân nặng">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Chiều dài</label>
            <input type="text" class="form-control" value="{{$product->length}}" id="length"
                placeholder="Chiều dài">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Chiều rộng </label>
            <input type="text" class="form-control" value="{{$product->width}}" id="width"
                placeholder="Chiều rộng">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">chiều cao</label>
            <input type="text" class="form-control" value="{{$product->height}}" id="height"
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
        var weight = $('#weight').val();        
        var length = $('#length').val();
        var width = $('#width').val();
        var height = $('#height').val();
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
                        var newWeight = response.weight;
                        var quantity = $("#totalQuantity_" + jancode).text();
                        var totalNewWeight = newWeight * quantity;
                        var totalNewWeightKhoi = ((response.width * response.height * response.length) / 1000000) * quantity;
                        $("#weight_"+jancode).html(new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3}).format(totalNewWeight) + ' kg');
                        $("#weightKhoi_"+jancode).html(new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3}).format(totalNewWeightKhoi) + ' khối');
                        if(totalNewWeight > 0 && totalNewWeightKhoi > 0){
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
