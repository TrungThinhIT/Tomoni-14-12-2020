<table id="example" class="table table-bordered table-striped" style="margin-top: 1%; margin-right: 1%;">
    <thead>
        <tr>
            <th>No.</th>
            <th>CodeOrder</th>
            <th>Uname</th>
            <th>Invoice</th>
            <th>Bill</th>
            <th>Container</th>
            <th>quantity</th>
            <th>Address</th>
            <th>Image</th>
            <th>Delivery time</th>
        </tr>
    </thead>

    <tbody id="myTable">
        <?php $index=1 ?>
        @foreach ($product_reality as $item)
        <tr>
            <td>{{$product_reality->perPage()*($product_reality->currentPage()-1)+$index}}
            <td>{{$item->codeorder}}</td>
            <td>{{$item->uname}}</td>
            <td>{{$item->invoice}}</td>
            <td>@if ($item->InvoiceBill)
                {{$item->InvoiceBill->So_Hoadon}}
                @endif</td>
            <td>{{$item->container}}</td>
            <td>{{$item->quantity}}</td>
            <td>{{$item->address}}</td>
            <td class="modalImage"><a id="image" data-img="{{$item->imghoadongiaohang}}" data-id="{{$item->id}}"
                    href="javascript:"><img src="{{asset('thumnails/'.$item->imghoadongiaohang)}}" alt=""></a>
            </td>
            <td>{{$item->delivery_time}}</td>
        </tr>
        <?php $index++?>
        @endforeach

    </tbody>
</table>
<div id="pagina" style="float: right" class="mt-3">
    {!! $product_reality->withQueryString()->links('commons.paginate') !!}
</div>
<script>
    $('.pagination a').unbind('click').on('click', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getPosts(page);
    });

    function getPosts(page) {
        var uname = $('#uname2').val();
        var codeorder = $('#codeorder2').val();
        var container = $('#container2').val();
        var invoice = $('#invoice2').val();
        var quantity = $('#quantity2').val();
        $.ajax({
            type: "GET",
            url: 'productReality/get-table/' + '?page=' + page,
            data: {
                uname: uname,
                codeorder: codeorder,
                container: container,
                invoice: invoice,
                quantity: quantity
            },
            success: function (data) {
                $('#data-table').html('').append(data);
            }
        })
    }
    $('.modalImage').click(function (e) {
        const img = $(this).find('a').data('img');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                    .attr('content')
            },
            type: 'GET',
            url: "./productReality/img" + '/' + img,

            success: function (data) {
                $('#modalDetail').modal('show');
                $('.modal-content').html('').append(data);
            }
        });
    });

</script>
