@extends('layout')
@section('title', 'Sổ cái')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Sổ cái</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>
                <div class="card-body row">
                        <div class="card" style=" width:10%; padding: 1%; margin-left:1%">
                            <form action="{{route('orders.ledgers.create')}}" method="post">
                                @csrf
                            <div >
                            <div  >
                                <input class="form-control" value="{{ old('Uname')}}" type="text" name="Uname" placeholder="Nhập User Name"  id="example-date-input" list='litsusername' onkeyup='searchUser(this)' required> <datalist id='litsusername'></datalist>
                                <span class="alert-danger-custom">{{$errors->first('Uname')}}</span>
                            </div>

                            <div  style="  margin-top: 3%;">
                                <input class="form-control" value="{{ old('PriceIn')}}" type="text" name="PriceIn" placeholder="Price In"  id="example-date-input">
                                <span class="alert-danger-custom">{{$errors->first('PriceIn')}}</span>
                            </div>

                            <div  style="  margin-top: 3%;">
                                <input class="form-control" value="{{ old('PriceOut')}}" type="text" name="PriceOut" placeholder="Price Out"  id="example-date-input">
                                <span class="alert-danger-custom">{{$errors->first('PriceOut')}}</span>
                            </div>

                            <div  style="  margin-top: 3%;">
                                <input class="form-control" value="{{ old('Pricedelb')}}" type="text" name="Pricedelb" placeholder="Price delb"  id="example-date-input">
                                <span class="alert-danger-custom">{{$errors->first('Pricedelb')}}</span>
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </form>
                        </div>
                    <div class="card" style=" margin-left:1%; width:87%; padding:1%">
                        <div >
                        <form>
                            <fieldset >
                                <div class="form-row" style=" margin-top: 1%;">
                                    <form action="" method="get">
                                        <div >
                                            <button type="submit" class="btn btn-primary" style="margin-left: 2%;">Tìm kiếm</button>
                                        </div>
                                        <input type="text" class="form-control ml-2" value="{{ $data['Uname'] }}" name="Uname" placeholder="Nhập User Name" style="width: 15%;" />
                                        <input type="text" class="form-control ml-2" value="{{ $data['PriceIn'] }}" name="PriceIn" placeholder="Nhập Price In" style="width: 15%;" />
                                        <input type="text" class="form-control ml-2" value="{{ $data['PriceOut'] }}" name="PriceOut" placeholder="Nhập Price Out" style="width: 15%;" />
                                        <input type="text" class="form-control ml-2" value="{{ $data['Pricedelb'] }}" name="Pricedelb" placeholder="Nhập Price Delb" style="width: 15%;" />
                                    </form>
                            </fieldset>
                            </form>
                            <div style="float: right">
                                {!! $data['ledgers']->withQueryString()->links('commons.paginate') !!}</div>
                            <table class="table table-bordered table-striped" style="margin-top: 1%;">
                              <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Username</th>
                                  <th>Price In</th>
                                  <th>Price Out</th>
                                  <th>Công Nợ</th>
                                  <th>Chức năng</th>
                                </tr>
                              </thead>
                              <tbody id="myTable">
                                @foreach ($data['ledgers'] as $item)
                                <tr>
                                    <td>{{$item->Id}}</td>
                                    <td ><a href="{{route('orders.order')}}">{{$item->Uname}}</a></td>
                                    <td>{{$item->PriceIn}}</td>
                                    <td>{{$item->PriceOut}}</td>
                                    <td>{{$item->Pricedelb}}</td>
                                    <td>
                                        <a href="#" data-id="{{$item->Id}}" class="view_transaction" type="button"><i class="fas fa-pen-alt fa-2x"></i></a>
                                        |
                                        <a href="#" onclick="functionDelete{{$item->Id}}()" type="button"><i class="far fa-trash-alt fa-2x" style="color: red"></i></a>
                                    </td>
                                  </tr>
                                  <script>
                                      var Id = {{$item->Id}};
                                    function functionDelete{{$item->Id}}() {
                                      var txt;
                                      if (confirm("Press a button delete!")) {
                                        window.location.href= 'ledgers/delete' +'/' + {{$item->Id}};
                                      }
                                    }
                                    </script>
                                @endforeach
                              </tbody>
                            </table>
                            <div class="modal" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" style="min-width: 80%;" >
                                  <div class="modal-content">

                                    <!-- Modal Header -->


                                  </div>
                                </div>
                              </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
                                $('.view_transaction').click(function() {
                                    const id = $(this).data('id');
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                                .attr('content')
                                        },
                                        type: 'GET',
                                        url: "ledgers" + '/' + id,

                                        success: function(data) {
                                            $('#modalDetail').modal('show');
                                            $('.modal-content').html('').append(data);
                                        }
                                    });
                                });
                            });

    function searchUser(obj) {
        var text = $(obj).val();
            if(text.length > 1){
                $.ajax({
                type: 'GET',
                url: "{{route('commons.search-user')}}",
                data: {
                    uname: text
                },
                success: function (response) {
                    var len = response.length;
                    $("#litsusername").empty();
                    for (var i = 0; i < len; i++) {
                        var name = response[i]['uname'];
                        var name1 = response[i]['fname'];

                        $("#litsusername").append("<option value='" + name + "'>" + name1 +
                            "</option>");

                    }
                }
            });
            };
    }
</script>
@endsection
