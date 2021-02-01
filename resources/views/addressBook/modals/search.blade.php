<table id="example" class="table table-bordered table-striped" style="margin-top: 1%; margin-right: 1%;">
    <thead>
        <tr>
            <th>No.</th>
            <th>AddCode</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Uname</th>
            <th>DeliveryTime</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody id="myTable">
        <?php $index =1?>
        @foreach ($list as $item)
        <tr>
            <td>{{$list->perPage()*($list->currentPage()-1)+$index}}
            <td>{{$item->addcode}}</td>
            <td id="address{{$item->id}}">{{$item->address}}</td>
            <td id="phone{{$item->id}}">{{$item->phonenumber}}</td>
            <td>{{$item->uname}}</td>
            <td id="time{{$item->id}}">{{$item->delivery_time}}</td>
            <td><a href="javascript:"><i id="{{$item->id}}" class="fas fa-edit view_addressBook"></i></a></td>
        </tr>
        <?php $index++?>
        @endforeach
    </tbody>
</table>

<div id="pagina" style="float: right" class="mt-3">
    {!! $list->withQueryString()->links('commons.paginate') !!}
</div>
<script>
    $('.pagination a').unbind('click').on('click', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getPosts(page);
    });

    function getPosts(page) {
        var uname = $('#uname').val();
        var codeorder = $('#addcode').val();
        var address = $('#address').val();
        var phone3 = $('#phone3').val();
        $.ajax({
            type: "GET",
            url: '/addressbook' + '?page=' + page,
            data: {
                uname: uname,
                codeorder: codeorder,
                address: address,
                phone: phone3,
            },
            success: function (data) {
                $('#data-table').html('').append(data);
            }
        })
    }
    $('.view_addressBook').click(function () {
        var id = $(this).attr('id');
        $.ajax({
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
            //         .attr('content')
            // },
            type: 'GET',
            url: "index/" + id,
            success: function (data) {
                console.log(data)
                $('#modalDetail').modal('show');
                $('.modal-content').html('').append(data);
            }
        });
    });

</script>
