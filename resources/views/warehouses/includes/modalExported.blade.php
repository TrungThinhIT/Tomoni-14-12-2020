<!-- Modal Header -->
<div class="modal-header">
    <h4 class="modal-title">Chi tiết hoá đơn </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div style="float: right" class="mt-3">
    {!! $exported->withQueryString()->links('commons.paginate_level2') !!}</div>
<div class="row">
    <div class="col-8">
        <table id="example" class="table table-bordered table-striped"
    style="margin-top: 1%;">
    <thead>
        <tr>
            <th>No.</th>
            <th>Codeorder</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Item in box</th>
        </tr>
    </thead>
    <tbody id="myTable">
        @php $count = 1; @endphp
        @foreach ($exported as $item)
        <tr>
            <td>{{$exported->perPage()*($exported->currentPage()-1)+$count}}
            </td>
            <td>{{$item->Codeorder}}</td>
            <td>{{number_format($item->price, 0)}}</td>
            <td>{{$item->quantity}}</td>
            <td>{{$item->item_in_box}}</td>
        </tr>
        @php $count ++; @endphp
        @endforeach
    </tbody>
</table>
    </div>
    <div class="col-4">
        <td colspan="1" rowspan="4">
            <div style="height:250px; overflow-y: scroll" id="log">

            </div>
            <div class=" row" style="margin: 1%;">
                <input style="width: 80%; margin-right:1%" type="text" class="form-control"
                    name="note" id="note" placeholder="Nhập ghi chú">
                <button type="button" onclick="addLog()"
                    class="btn btn-primary">Gửi</button>
            </div>
        </td>
    </div>
</div>

<!-- Modal footer -->
<div class="modal-footer">
    <div style="float: right;">
        <!-- <button type="submit" class="btn btn-primary" >Load Item</button> -->
        {{-- <button type="submit" class="btn btn-danger">View Note</button> --}}
        <button type="button" class="btn btn-secondary"
            data-dismiss="modal">Close</button>
    </div>
</div>
<script>
    var jancode = {{$item->jan_code}};
    $(document).ready(function () {
        $.ajax({
            type: 'get',
            url: 'exported/load-note/' + jancode,
            success: function (response) {
                $('#log').append(response);
                $('#log').scrollTop(1000000);
            }
        })
    });

    $('#note').keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            addLog();
        }
    });

    function addLog() {
        var note = $("#note").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "exported/note-export/" + jancode,
                data: {
                    note: note
                },
                success: function (response) {
                    $("#note").val('');
                    $(document).ready(function () {
                        $.ajax({
                            type: 'get',
                            url: 'exported/load-note/' + jancode,
                            success: function (response) {
                                toastr.success('Note thành công.', 'Notifycation', {timeOut: 1000});
                                $("#remove").remove();
                                $('#log').append(response);
                                $('#log').scrollTop(1000000);
                            }
                        })
                    });
                }
            })
    }

    $('.level-2 .pagination a').unbind('click').on('click', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getPosts(page);
    });

    function getPosts(page) {
        $.ajax({
            type: "GET",
            url: 'exported/' + jancode + '?page=' + page,
            success: function (data) {
                $('.modal-content').html('').append(data);
            }
        })
    }
</script>