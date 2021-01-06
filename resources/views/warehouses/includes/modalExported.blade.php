<!-- Modal Header -->
<div class="modal-header">
    <h4 class="modal-title">Chi tiết hoá đơn </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

{{-- <!-- Modal body -->
<div class="modal-body">
    <div class="form-row">
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Số hoá đơn</label>
            <input type="text" class="form-control" id="numBill"
                placeholder="First name" required>
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Ngày hóa đơn</label>
            <input class="form-control" type="date" value="2020-04-12"
                id="dateBill">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Tổng tiền hoá đơn</label>
            <input type="text" class="form-control" id="sumB"
                placeholder="First name" required>
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Chi phí mua hàng </label>
            <input type="text" class="form-control" id="validationDefault01"
                placeholder="First name" required>
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Thuế chi phí</label>
            <select type="text" class="form-control" id="validationDefault01"
                placeholder="First name" required>
                <option value="" selected disabled>Please select</option>
                <option value="1">Item 1</option>
                <option value="2">Item 2</option>
                <option value="3">Item 3</option>
            </select>
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Nhà cung cấp</label>
            <select type="text" class="form-control" id="validationDefault01"
                placeholder="First name" required>
                <option value="" selected disabled>Please select</option>
                <option value="1">Item 1</option>
                <option value="2">Item 2</option>
                <option value="3">Item 3</option>
            </select>
        </div>

    </div>
    <div class="form-row">
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Hạn thanh toán</label>
            <input class="form-control" type="date" id="example-date-input">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Ngày giao hàng</label>
            <input class="form-control" type="date" id="example-date-input">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Mã Tracking</label>
            <input type="text" class="form-control" id="validationDefault01"
                placeholder="First name" required>
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Hiện trạng hoá đơn</label>
            <select type="text" class="form-control" id="validationDefault01"
                required>
                <option value="" selected disabled>Please select</option>
                <option value="1">Item 1</option>
                <option value="2">Item 2</option>
                <option value="3">Item 3</option>
            </select>
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Loại hoá đơn</label>
            <select type="text" class="form-control" id="validationDefault01"
                required>
                <option value="" selected disabled>Please select</option>
                <option value="1">Item 1</option>
                <option value="2">Item 2</option>
                <option value="3">Item 3</option>
            </select>
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Nhân viên</label>
            <select type="text" class="form-control" id="validationDefault01"
                required>
                <option value="" selected disabled>Please select</option>
                <option value="1">Item 1</option>
                <option value="2">Item 2</option>
                <option value="3">Item 3</option>
            </select>
        </div>

    </div>
</div> --}}
<table id="example" class="table table-bordered table-striped"
    style="margin-top: 1%;">
    <thead>
        <tr>
            <th>No.</th>
            <th>Codeorder</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody id="myTable">
        @php $count = 1; @endphp
        @foreach ($exported as $item)
        <tr>
            <td>{{$count}}
            </td>
            <td>{{$item->Codeorder}}</td>
            <td>{{number_format($item->price, 0)}}</td>
            <td>{{$item->quantity}}</td>
        </tr>
        @php $count ++; @endphp
        @endforeach
    </tbody>
</table>

<!-- Modal footer -->
<div class="modal-footer">
    <div style="float: right;">
        <!-- <button type="submit" class="btn btn-primary" >Load Item</button> -->
        {{-- <button type="submit" class="btn btn-danger">View Note</button> --}}
        <button type="button" class="btn btn-secondary"
            data-dismiss="modal">Close</button>
    </div>
</div>