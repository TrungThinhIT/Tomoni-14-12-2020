<!-- Modal Header -->
<div class="modal-header">
    <h4 class="modal-title">Hàng tồn kho </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
    <div>

<div class="row">
<div class="col-8"><table id="example" class="table table-bordered table-striped" style="margin-top: 1%;"> 
    <div style="float: left" class="ml-3 mt-3">
        <form>
            <fieldset>
                <div class="form-row" style=" margin-top: 1%;">
                    <div>
                        <select type="text" class="form-control" id="searchStatus">
                            <option value="">Tình trạng</option>
                            <option value="1" {{$status == 1 ? 'selected':''}}>Xuất order</option>
                            <option value="2" {{$status == 2 ? 'selected':''}}>Trả lại hàng mua</option>
                        </select></div>    
                    <div>
                        <button type="button" onclick="search()" class="btn btn-primary ml-2"
                            style="margin-left: 2%;">Search</button>
                        <button type="button" onclick="resetFormSearch()" class="btn btn-info ml-2"
                            style="margin-left: 2%;">Reset</button>
                        <script>
                            function resetFormSearch() {
                                document.getElementById("searchStatus").value = "";
                            }
                        </script>
                    </div>
                </div>
            </fieldset>
        </form> 
    </div>  
    <div style="float: right" class="mt-3">
        {!! $inventory->withQueryString()->links('commons.paginate_level2') !!}</div>
        </div>
    <thead>
        <tr>
            <th>No.</th>
            <th>Status</th>
            <th>Description</th>
            <th>Uname</th>
            <th style="min-width: 140px">Quantity</th>
            <th>Total Quantity</th>
            <th>Item In Box</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody id="myTable">
        @php $count = 1; @endphp
        @foreach ($inventory as $item)
        <tr>
            <td>{{$inventory->perPage()*($inventory->currentPage()-1)+$count}}
            </td>
            <td>@if ($item->jan_code)
                Xuất
                @else
                Nhập hoá đơn
                @endif</td>
            <td>@if ($item->jan_code)
                    {{$item->codeorder}}
                @else
                {{$item->Invoice}}
                @endif</td>
                <td></td>
            <td>@if ($item->jan_code)
                {{number_format($item->quantity, 0)}}
                @else
                {{number_format($item->Quantity, 0)}}
                @endif</td>
            <td>{{number_format($item->debtQuantity, 0)}}</td>
            <td>{{$item->item_in_box}}</td>
            <td>@if ($item->jan_code)
                {{Carbon\Carbon::parse($item->Date_Create)->format('d/m/Y h:m:i')}}
                @else
                {{$item->Dateinsert}}
                @endif</td>
        </tr>
        @if ($item->jan_code)
            @if (count($item->Product->Inventory) > 0)
                @foreach ($item->Product->Inventory->sortByDesc('created_at') as $item)
                    @if ($status == 1)
                        @if ($item->action == 'Xuất order')
                        <tr>
                            <td></td>
                        <td>{{$item->action}}</td>
                        <td>{{$item->codeorder}}</td>
                        <td>{{$item->uname}}</td>               
                        <td>{{$item->quantityUpdate}}</td>  
                        <td>{{$item->quantityUpdate - $item->quantityCurrent}}</td>     
                        <td></td>
                        <td>{{Carbon\Carbon::parse($item->created_at)->format('d/m/Y h:m:i')}}</td>
                        </tr> 
                        @endif
                    @elseif($status == 2)
                        @if ($item->action == 'Trả lại hàng mua')
                        <tr>
                            <td></td>
                        <td>{{$item->action}}</td>
                        <td>{{$item->codeorder}}</td>
                        <td>{{$item->uname}}</td>               
                        <td>{{$item->quantityUpdate}}</td>  
                        <td>{{$item->quantityUpdate - $item->quantityCurrent}}</td>     
                        <td></td>
                        <td>{{Carbon\Carbon::parse($item->created_at)->format('d/m/Y h:m:i')}}</td>
                        </tr>
                        @endif
                    @else
                    <tr>
                        <td></td>
                    <td>{{$item->action}}</td>
                    <td>{{$item->codeorder}}</td>
                    <td>{{$item->uname}}</td>               
                    <td>{{$item->quantityUpdate}}</td>  
                    <td>{{$item->quantityUpdate - $item->quantityCurrent}}</td>     
                    <td></td>
                    <td>{{Carbon\Carbon::parse($item->created_at)->format('d/m/Y h:m:i')}}</td>
                    </tr> 
                    @endif
                @endforeach
            @endif
        @endif
        @php $count ++; @endphp
        @endforeach
    </tbody>
</table></div>

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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
<script>
    var jancode = {{$jancode}};
    $(document).ready(function () {
        $.ajax({
            type: 'get',
            url: 'inventory/load-note/' + jancode,
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
                url: "inventory/note-inventory/" + jancode,
                data: {
                    note: note
                },
                success: function (response) {
                    $("#note").val('');
                    $(document).ready(function () {
                        $.ajax({
                            type: 'get',
                            url: 'inventory/load-note/' + jancode,
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
        var status = $('#searchStatus').val();
        $.ajax({
            type: "GET",
            url: 'inventory/' + jancode + '?page=' + page + '&status=' + status,
            success: function (data) {
                $('.modal-content').html('').append(data);
            }
        })
    }

    function search(){
        var status = $('#searchStatus').val();
        $.ajax({
            type: "GET",
            url: 'inventory/' + jancode + '?status=' + status,
            success: function (data) {
                $('.modal-content').html('').append(data);
            }
        })
    }

</script>
