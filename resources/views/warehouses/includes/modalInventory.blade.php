<!-- Modal Header -->
<div class="modal-header">
    <h4 class="modal-title">Chi tiết hoá đơn </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div style="float: right" class="mt-3">
    {!! $inventory->withQueryString()->links('commons.paginate') !!}</div>
<table id="example" class="table table-bordered table-striped"
    style="margin-top: 1%;">
    <thead>
        <tr>
            <th>No.</th>
            <th>Status</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Total Quantity</th>
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
                Nhập
            @endif</td>
            <td>@if ($item->jan_code)
                {{$item->codeorder}}
            @else
            {{$item->Invoice}}
            @endif</td>
            <td>@if ($item->jan_code)
                {{number_format($item->quantity, 0)}}
            @else
            {{number_format($item->Quantity, 0)}}
            @endif</td>
            <td>{{number_format($item->debtQuantity, 0)}}</td>
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
<script>
    $('.pagination a').unbind('click').on('click', function(e) {
           e.preventDefault();
           var page = $(this).attr('href').split('page=')[1];
           getPosts(page);
     });
    
     function getPosts(page)
     {
          $.ajax({
               type: "GET",
               url: 'inventory/' + {{$item->Jancode}} + '?page='+ page,
               success: function (data) {
                    $('.modal-content').html('').append(data);
                }
            });
     }
  </script>