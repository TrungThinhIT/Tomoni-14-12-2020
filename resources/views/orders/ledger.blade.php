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
                        <div >
                        <div  >
                            <input class="form-control" type="date"  id="example-date-input">
                        </div>

                        <div  style="  margin-top: 3%;">
                            <input class="form-control" type="date"  id="example-date-input">
                        </div>
                        </div>

                        <div  style="  margin-top: 3%;">
                            <select type="text" class="form-control" id="validationDefault01" placeholder="Nhập số hoá đơn"  required style="" >
                                <option>Type</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                            </select>
                        </div>

                        <input type="text" class="form-control" id="userName" placeholder="Nhập User Name"  required style="margin-top: 3%;" />
                    </div>
                    <div class="card" style=" margin-left:1%; width:87%; padding:1%">
                        <div >
                        <form>
                            <fieldset >
                                <div class="form-row" style=" margin-top: 1%;">
                                    <div >
                                        <button type="submit" class="btn btn-primary" style="margin-left: 2%;" onclick="SearchSoCai()">Tìm kiếm</button>
                                    </div>
                                    <div type="text" class="form-control" id="validationDefault01" placeholder="Nhập số hoá đơn"  required style="width: 7%;" >
                                        <option>User name</option>
                                        <!-- <option>Ketchup</option>
                                        <option>Relish</option> -->
                                    </div>
                                    <input type="text" class="form-control" id="userName" placeholder="Nhập User Name"  required style="width: 10%;" />
                                    <div  >
                                        <input class="form-control" type="date"  id="dateInput">
                                    </div>
                                    <div type="text" class="form-control" id="validationDefault01" placeholder="Nhập số hoá đơn"  required style="width: 7%;" >
                                        <option>Price In</option>
                                        <!-- <option>Ketchup</option>
                                        <option>Relish</option> -->
                                    </div>
                                    <input type="text" class="form-control" id="priceIn" placeholder="Nhập price in"  required style="width: 10%;" />
                                    <div type="text" class="form-control" id="validationDefault01" placeholder="First name"  required style="width: 7%;" >
                                        <option>Price Out</option>
                                        <!-- <option>Ketchup</option>
                                        <option>Relish</option> -->
                                    </div>
                                    <input type="text" class="form-control" id="priceOut" placeholder="Nhập price out"  required style="width: 10%;" />
                                    <div type="text" class="form-control" id="validationDefault01" placeholder="Nhập số hoá đơn"  required style="width: 7%;" >
                                        <option>Công nợ</option>
                                        <!-- <option>Ketchup</option>
                                        <option>Relish</option> -->
                                    </div>
                                    <input type="text" class="form-control" id="congNo" placeholder="Nhập Card"  required style="width: 10%;" />
                                    <!-- <div type="text" class="form-control" id="validationDefault01" placeholder="Nhập số hoá đơn"  required style="width: 5%;" >
                                        <option>Prince Out</option>
                                        <option>Ketchup</option>
                                        <option>Relish</option>
                                    </div>
                                    <input type="text" class="form-control" id="validationDefault01" placeholder="Nhập Card"  required style="width: 10%;" />
                                    <select type="text" class="form-control" id="validationDefault01" placeholder="Nhập số hoá đơn"  required style="width: 10%;" >
                                        <option><Table>Type</Table></option>
                                        <option>Ketchup</option>
                                        <option>Relish</option>
                                    </select> -->
                                    <!-- <input type="text" class="form-control" id="validationDefault01" placeholder="Nhập số DepositID"  required style="width: 10%;" /> -->
                            </fieldset>
                            </form>
                            <table class="table table-bordered table-striped" style="margin-top: 1%;">
                              <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Username</th>
                                  <th>Date</th>
                                  <th>Price In</th>
                                  <th>Price Out</th>
                                  <th>Công Nợ</th>


                                </tr>
                              </thead>
                              <tbody id="myTable">
                                <tr>
                                  <td>20-11-2020</td>
                                  <td ><a href="{{route('order.order')}}">123</a></td>
                                  <td>paid</td>
                                  <td>
                                    <div  >
                                        <input type="text" class="form-control" id="PriceIn" placeholder="First name" value="Saiko"  required onchange="UpdateInfoModalPriceIn()">
                                    </div>
                                  </td>
                                  <td>Doe</td>
                                  <td>ABC</td>
                                </tr>
                                <tr>
                                    <td>20-11-2020</td>
                                    <td><a href="../components/hoaDon.php">123</a></td>
                                    <td>paid</td>
                                    <td>
                                        <div  >
                                            <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Saiko"  required>
                                        </div>
                                      </td>
                                    <td>Doe</td>
                                    <td>ABC</td>
                                  </tr>
                                  <tr>
                                    <td>20-11-2020</td>
                                    <td><a href="../components/hoaDon.php">123</a></td>
                                    <td>paid</td>
                                    <td>
                                        <div  >
                                            <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="DT3" required>
                                        </div>
                                      </td>
                                    <td>Doe</td>
                                    <td>ABC</td>
                                  </tr>
                                  <tr>
                                    <td>20-11-2020</td>
                                    <td><a href="../components/hoaDon.php">123</a></td>
                                    <td>paid</td>
                                    <td>
                                        <div  >
                                            <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="DT3" required>
                                        </div>
                                      </td>
                                    <td>Doe</td>
                                    <td>ABC</td>
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
