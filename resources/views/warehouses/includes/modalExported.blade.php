<!-- Modal Header -->
<div class="modal-header">
    <h4 class="modal-title">Chi tiết hoá đơn </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
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