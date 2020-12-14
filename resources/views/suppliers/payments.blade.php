@extends('layout')
@section('title', 'Tiền thanh toán nhà cung cấp')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Tiền thanh toán supplier</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>
                <div class="card-body">
                    <div>
                        <div style="margin: 1% 1% 1% 1%;">
                            <form>
                            <fieldset >
                                <div class="form-row" style=" margin-top: 1%;">
                                    <div >
                                        <button type="submit" class="btn btn-primary" style="margin-left: 2%;" onclick = "SearchTienThanhToan()">Tìm kiếm</button>
                                    </div>
                                    <div type="text" class="form-control" id="depositId" placeholder="Nhập số hoá đơn"  required style="width: 7%;" >
                                        <option>DepositID</option>
                                        <!-- <option>Ketchup</option>
                                        <option>Relish</option> -->
                                    </div>
                                    <input type="text" class="form-control" id="depositID" placeholder="Nhập số DepositID"  required style="width: 7%;" />
                                    <div  >
                                        <input class="form-control" type="date"  id="dateInput">
                                    </div>
                                    <div type="text" class="form-control" id="validationDefault01" placeholder="Nhập số hoá đơn"  required style="width: 7%;" >
                                        <option>Card</option>
                                        <!-- <option>Ketchup</option>
                                        <option>Relish</option> -->
                                    </div>
                                    <input type="text" class="form-control" id="cardItem" placeholder="Nhập Card"  required style="width: 10%;" />
                                    <div type="text" class="form-control" id="validationDefault01" placeholder="First name"  required style="width: 7%;" >
                                        <option>Name supplier</option>
                                        <!-- <option>Ketchup</option>
                                        <option>Relish</option> -->
                                    </div>
                                    <input type="text" class="form-control" id="nameSupp" placeholder="Nhập tên supplier"  required style="width: 10%;" />
                                    <div type="text" class="form-control" id="validationDefault01" placeholder="Nhập số hoá đơn"  required style="width: 7%;" >
                                        <option>Price In</option>
                                        <!-- <option>Ketchup</option>
                                        <option>Relish</option> -->
                                    </div>
                                    <input type="text" class="form-control" id="priceInput" placeholder="Nhập Card"  required style="width: 10%;" />
                                    <div type="text" class="form-control" id="validationDefault01" placeholder="Nhập số hoá đơn"  required style="width: 7%;" >
                                        <option>Prince Out</option>
                                        <!-- <option>Ketchup</option>
                                        <option>Relish</option> -->
                                    </div>
                                    <input type="text" class="form-control" id="priceOut" placeholder="Nhập Card"  required style="width: 5%;" />
                                    <select type="text" class="form-control" id="typeItem" placeholder="Nhập số hoá đơn"  required style="width: 10%;" >
                                        <option><Table>Type</Table></option>
                                        <option>Ketchup</option>
                                        <option>Relish</option>
                                    </select>
                                    <!-- <input type="text" class="form-control" id="validationDefault01" placeholder="Nhập số DepositID"  required style="width: 10%;" /> -->
                            </fieldset>
                            </form>
                            <table class="table table-bordered table-striped" style="margin-top: 1%;">
                              <thead>
                                <tr>
                                  <th>DepositID</th>
                                  <th>Date</th>
                                  <th>Card</th>
                                  <th>Name supplier</th>
                                  <th>Price In</th>
                                  <th>Prince Out</th>
                                  <th>Type</th>
                                  <th>Note</th>
                                  <th>Del</th>

                                </tr>
                              </thead>
                              <tbody id="myTable">
                                <tr>
                                  <td>20-11-2020</td>
                                  <td>123</td>
                                  <td>paid</td>
                                  <td>
                                        <div  >
                                            <input type="text" class="form-control" id="Weborder_4580525435045" placeholder="First name" value="Saiko"  required onchange = "UpdateInfoModalWO()">
                                        </div>
                                      </td>
                                  <td>Doe</td>
                                  <td>ABC</td>
                                  <td>
                                    <div class="form-group">
                                        <select class="form-control" id="typeSelected" onchange="UpdateInfoModalSelected()">
                                          <option>1</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                        </select>
                                      </div>
                                 </td>
                                  <td>10000</td>
                                  <td>
                                    <button type="button" class="btn btn-danger px-3"><i class="fa fa-times" aria-hidden="true"></i></button>
                                  </td>
                                </tr>
                                <tr>
                                    <td>20-11-2020</td>
                                    <td>123</td>
                                    <td>paid</td>
                                    <td>
                                        <div  >
                                            <input type="text" class="form-control" id="Weborder_4580525435045" placeholder="First name" value="Saiko"  required onchange = "UpdateInfoModalWO()">
                                        </div>
                                      </td>
                                    <td>Doe</td>
                                    <td>ABC</td>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control" id="slectedType">
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                            </select>
                                          </div>
                                     </td>
                                    <td>10000</td>
                                    <td>
                                        <button type="button" class="btn btn-danger px-3"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </td>

                                  </tr>
                                  <tr>
                                    <td>20-11-2020</td>
                                    <td>123</td>
                                    <td>paid</td>
                                    <td>
                                        <div  >
                                            <input type="text" class="form-control" id="Weborder_4580525435045" placeholder="First name" value="Saiko"  required onchange = "UpdateInfoModalWO()">
                                        </div>
                                      </td>
                                    <td>Doe</td>
                                    <td>ABC</td>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control" id="slectedType">
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                            </select>
                                          </div>
                                     </td>
                                    <td>10000</td>
                                    <td>
                                        <button type="button" class="btn btn-danger px-3"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </td>

                                  </tr>
                                  <tr>
                                    <td>20-11-2020</td>
                                    <td>123</td>
                                    <td>paid</td>
                                    <td>
                                        <div  >
                                            <input type="text" class="form-control" id="Weborder_4580525435045" placeholder="First name" value="Saiko"  required onchange = "UpdateInfoModalWO()">
                                        </div>
                                      </td>
                                    <td>Doe</td>
                                    <td>ABC</td>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control" id="slectedType">
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                            </select>
                                          </div>
                                     </td>
                                    <td>10000</td>
                                    <td>
                                        <button type="button" class="btn btn-danger px-3"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </td>

                                  </tr>
                              </tbody>
                            </table>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
