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
                    <form>
                        <fieldset >
                            <div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                                <div class="col-md-2 mb-2" >
                                    <label for="validationDefault01">Mã nhà cung cấp</label>
                                    <input type="text" class="form-control" id="ucode" name="ucode" placeholder="Nhập mã nhà cung cấp"  required>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Tên nhà cung cấp</label>
                                    <input type="text" class="form-control" id="uname" name="uname" placeholder="Nhập tên nhà cung cấp"  required>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Số điện thoại</label>
                                    <input type="text" class="form-control" id="nphone" name="nphone" placeholder="Nhập số điện thoại"  required>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Email</label>
                                    <input type="text" class="form-control" id="umail" placeholder="umail"  required>
                                </div>
                                <div class="col-md-2 mb-2" >
                                    <label for="validationDefault01">Ngân hàng</label>
                                    <input type="text" class="form-control" id="ubank" placeholder="ubank"  required>
                                </div>
                                <div class="col-md-2 mb-2" >
                                    <label for="validationDefault01">Chi nhánh</label>
                                    <input type="text" class="form-control" id="ubranch" placeholder="Nhập chi nhánh"  required>
                                </div>

                            </div>
                            <div class="form-row" style="margin-left: 2%; margin-top: 1%;">
                                <div class="col-md-2 mb-2" >
                                    <label for="validationDefault01">Số tài khoản</label>
                                    <input type="text" class="form-control" id="uAccountNumber" name="uAcountNumber" placeholder="Nhập số tài khoản" required>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Tên tài khoản</label>
                                    <input type="text" class="form-control" id="uAcountName" name="uAcountName" placeholder="Nhập tên tài khoản"  required>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Địa chỉ</label>
                                    <input type="text" class="form-control" id="uadd" name="uadd" placeholder="Nhập địa chỉ"  required>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Ghi chú</label>
                                    <input type="text" class="form-control" id="unote" name="unote" placeholder="Nhập ghi chú"  required>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationDefault01">Xếp hạng</label>
                                    <select type="text" class="form-control" id="urank" name="urank"   required >
                                        <option value="" selected disabled>Please select</option>
                                        <option value="1">Vip 1</option>
                                        <option value="2">Vip 2</option>
                                        <option value="3">Startup</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2" style="margin-top: 1%;">
                                    <!-- <label for="validationDefault01">Hiện trạng hoá đơn</label> -->
                                    <button type="submit" class="btn btn-primary" >Add supplier</button>
                                </div>
                            </div>
                        </fieldset>
                        <table id="example" class="table table-bordered table-striped" style="margin-top: 1%;  ">
                            <thead>
                              <tr>
                                <th>Tên nhà cung cấp</th>
                                <th>Mã nhà cung cấp</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Đại chỉ</th>
                                <th>Ngân hàng</th>
                                <th>Chi nhánh</th>
                                <th>Số tài khoản</th>
                                <th>Tên tài khoản</th>
                                <th>Xếp hạng</th>
                                <th>Ghi chú</th>

                              </tr>
                            </thead>
                            <tbody id="myTable">
                              <tr>
                              <td >ABC</td>
                                <td >123</td>
                                <td >paid</td>
                                <td >Japan</td>
                                <td >Doe</td>
                                <td >ABC</td>
                                <td >1</td>
                                <td >10000</td>
                                <td >10000</td>
                                <td>
                                    <button type="button" class="btn btn-success px-3">Vip</button>
                                </td>
                                <td >2020-11-05</td>

                              </tr>
                              <tr>
                                  <td >ABC</td>
                                  <td >123</td>
                                  <td >paid</td>
                                  <td >Japan</td>
                                  <td >Doe</td>
                                  <td >ABC</td>
                                  <td >1</td>
                                  <td >10000</td>
                                  <td >10000</td>
                                  <td>
                                    <button type="button" class="btn btn-success px-3">Vip</button>
                                  </td>
                                  <td >2020-11-05</td>

                                </tr>
                                <tr>
                                  <td >ABC</td>
                                  <td >123</td>
                                  <td >paid</td>
                                  <td >Japan</td>
                                  <td >Doe</td>
                                  <td >ABC</td>
                                  <td >1</td>
                                  <td >10000</td>
                                  <td >10000</td>
                                  <td>
                                    <button type="button" class="btn btn-success px-3">Vip</button>
                                  </td>
                                  <td >2020-11-05</td>

                                </tr>
                                <tr>
                                  <td >ABC</td>
                                  <td >123</td>
                                  <td >paid</td>
                                  <td >Japan</td>
                                  <td >Doe</td>
                                  <td >ABC</td>
                                  <td >1</td>
                                  <td >10000</td>
                                  <td >10000</td>
                                  <td>
                                    <button type="button" class="btn btn-danger px-3">Startup</button>
                                  </td>
                                  <td >2020-11-05</td>

                                </tr>
                            </tbody>
                          </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
