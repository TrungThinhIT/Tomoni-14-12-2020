<div class="modal-header">
    <h4 class="modal-title">Chi tiết ngày thanh toán </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<!-- Modal body -->
<div class="modal-body">
    <table class="table table-bordered table-striped" style="margin-top: 1%;">
        <thead>
            <tr>
                <th>Stt</th>
                <th>Date Time</th>
                <th>Deposit</th>
                <th>Price In</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @php
            $count = 1;
            @endphp

            @foreach ($nap as $item)
            <tr>
                <td>{{$count}}</td>
                <td>{{Carbon\Carbon::parse($item->date_insert)->format('d/m/Y h:m:i')}}</td>
                <td>{{$item->depositID}}</td>
                <td>{{number_format($item->price_in, 0)}}</td>
            </tr>
            @php $count++; @endphp
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