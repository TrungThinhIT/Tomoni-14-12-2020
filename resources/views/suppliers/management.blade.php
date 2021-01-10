@extends('layout')
@section('title', 'Quản lý nhà cung cấp')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Quản lý supplier</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>
                <div class="card-body">
                    <form action="{{route('supplier.management.create')}}" method="POST">
                        @csrf
                        <fieldset >
                            <div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                                <div class="col-md-2 mb-2" >
                                    <label for="validationDefault01">Mã nhà cung cấp</label>
                                    <input type="text" value="{{ old('ucode') }}" class="form-control" id="ucode" name="ucode" placeholder="Nhập mã nhà cung cấp"  >
                                    <span class="alert-danger-custom">{{$errors->first('ucode')}}</span>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Tên nhà cung cấp</label>
                                    <input type="text" value="{{ old('uname') }}" class="form-control" id="uname" name="uname" placeholder="Nhập tên nhà cung cấp"  >
                                    <span class="alert-danger-custom">{{$errors->first('uname')}}</span>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Số điện thoại</label>
                                    <input type="text" value="{{ old('uphone') }}" class="form-control" id="uphone" name="uphone" placeholder="Nhập số điện thoại"  >
                                    <span class="alert-danger-custom">{{$errors->first('uphone')}}</span>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Email</label>
                                    <input type="text" value="{{ old('umail') }}" class="form-control" name="umail" id="umail" placeholder="umail"  >
                                    <span class="alert-danger-custom">{{$errors->first('umail')}}</span>
                                </div>
                                <div class="col-md-2 mb-2" >
                                    <label for="validationDefault01">Ngân hàng</label>
                                    <input type="text" value="{{ old('ubank') }}" class="form-control" name="ubank" id="ubank" placeholder="ubank"  >
                                    <span class="alert-danger-custom">{{$errors->first('ubank')}}</span>
                                </div>
                                <div class="col-md-2 mb-2" >
                                    <label for="validationDefault01">Chi nhánh</label>
                                    <input type="text" value="{{ old('ubranch') }}" class="form-control" name="ubranch" id="ubranch" placeholder="Nhập chi nhánh"  >
                                    <span class="alert-danger-custom">{{$errors->first('ubranch')}}</span>
                                </div>

                            </div>
                            <div class="form-row" style="margin-left: 2%; margin-top: 1%;">
                                <div class="col-md-2 mb-2" >
                                    <label for="validationDefault01">Số tài khoản</label>
                                    <input type="text" value="{{ old('uAccountNumber') }}" class="form-control" id="uAccountNumber" name="uAccountNumber" placeholder="Nhập số tài khoản" >
                                    <span class="alert-danger-custom">{{$errors->first('uAccountNumber')}}</span>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Tên tài khoản</label>
                                    <input type="text" value="{{ old('uAccountName') }}" class="form-control" id="uAccountName" name="uAccountName" placeholder="Nhập tên tài khoản"  >
                                    <span class="alert-danger-custom">{{$errors->first('uAccountName')}}</span>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Địa chỉ</label>
                                    <input type="text" value="{{ old('uadd') }}" class="form-control" id="uadd" name="uadd" placeholder="Nhập địa chỉ"  >
                                    <span class="alert-danger-custom">{{$errors->first('uadd')}}</span>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Ghi chú</label>
                                    <input type="text" value="{{ old('unote') }}" class="form-control" id="unote" name="unote" placeholder="Nhập ghi chú"  >
                                    <span class="alert-danger-custom">{{$errors->first('unote')}}</span>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Xếp hạng</label>
                                    <select type="text" class="form-control" id="urank" name="urank">
                                        <option value="0" {{ old('urank') == 0 ? 'selected':''}}>Startup</option>
                                        <option value="1" {{ old('urank') == 1 ? 'selected':''}}>Standard</option>
                                        <option value="2" {{ old('urank') == 2 ? 'selected':''}}>Business</option>
                                        <option value="3" {{ old('urank') == 3 ? 'selected':''}}>Vip</option>
                                    </select>
                                    <span class="alert-danger-custom">{{$errors->first('urank')}}</span>
                                </div>
                                <div class="col-md-2 mb-2" style="margin-top: 1%;">
                                    <!-- <label for="validationDefault01">Hiện trạng hoá đơn</label> -->
                                    <button type="submit" class="btn btn-primary" >Add supplier</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                        <div style="float: right">
                            {!! $suppliers->withQueryString()->links('commons.paginate') !!}</div>
                        <table id="example" class="table table-bordered table-striped" style="margin-top: 1%;  ">
                            <thead>
                              <tr>
                                <th>Tên nhà cung cấp</th>
                                <th>Mã nhà cung cấp</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th style="min-width: 100px">Địa chỉ</th>
                                <th>Ngân hàng</th>
                                <th>Chi nhánh</th>
                                <th>Số tài khoản</th>
                                <th>Tên tài khoản</th>
                                <th>Xếp hạng</th>
                                <th>Ghi chú</th>

                              </tr>
                            </thead>
                            <tbody id="myTable">

                              @foreach ($suppliers as $item)
                              <tr>
                                <td >{{Str::limit($item->name, 30)}}</td>
                                  <td data-code="{{$item->code_name}}" class="view_transaction">{{$item->code_name}}</td>
                                  <td >{{$item->phone}}</td>
                                  <td style="max-width: 100px;">{{$item->email}}</td>
                                  <td >{{$item->address}}</td>
                                  <td >{{$item->BankName}}</td>
                                  <td >{{$item->Branch}}</td>
                                  <td >{{$item->AccountNumber}}</td>
                                  <td >{{$item->AccountName}}</td>
                                  <td style="text-align: center;
                                  vertical-align: middle;">
                                      @if ($item->is_startup)
                                      <button type="button" class="btn btn-success px-3">Startup</button>
                                      @elseif($item->is_standard)
                                      <button type="button" class="btn btn-success px-3">Standard</button>
                                      @elseif($item->is_business)
                                      <button type="button" class="btn btn-success px-3">Business</button>
                                      @elseif($item->is_vip)
                                      <button type="button" class="btn btn-success px-3">Vip</button>
                                      @endif
                                  </td>
                                  <td >{{$item->note}}</td>

                                </tr>
                              @endforeach

                            </tbody>
                          </table>

                        <div class="modal" id="modalDetail">
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
<script>
    $(document).ready(function() {
                                $('.view_transaction').click(function() {
                                    const code = $(this).data('code');
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                                .attr('content')
                                        },
                                        type: 'GET',
                                        url: "management" + '/' + code,

                                        success: function(data) {
                                            $('#modalDetail').modal('show');
                                            $('.modal-content').html('').append(data);
                                        }
                                    });
                                });
                            });
</script>
@endsection
