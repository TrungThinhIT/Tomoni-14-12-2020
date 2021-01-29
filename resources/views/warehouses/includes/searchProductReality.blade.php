<table id="example" class="table table-bordered table-striped" style="margin-top: 1%; margin-right: 1%;">
    <thead>
        <tr>
            <th>No.</th>
            <th>CodeOrder</th>
            <th>Uname</th>
            <th>Invoice</th>
            <th>Container</th>
            <th>quantity</th>
            <th>Address</th>
            <th>Image</th>
            <th>Delivery time</th>
        </tr>
    </thead>

    <tbody id="myTable">
        @foreach ($search as $item)

        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->codeorder}}</td>
            <td>{{$item->uname}}</td>
            <td>{{$item->invoice}}</td>
            <td>{{$item->container}}</td>
            <td>{{$item->quantity}}</td>
            <td>{{$item->address}}</td>
            <td class="modalImage"><a id="image" data-img="{{$item->imghoadongiaohang}}"
                    data-id="{{$item->id}}" href="javascript:"><img
                        src="{{asset('thumnails/'.$item->imghoadongiaohang)}}" alt=""></a>
            </td>
            <td>{{$item->delivery_time}}</td>
        </tr>
        @endforeach

    </tbody>
</table>
<div id="pagina" style="float: right" class="mt-3">
    {!! $search->withQueryString()->links('commons.paginate') !!}
</div>