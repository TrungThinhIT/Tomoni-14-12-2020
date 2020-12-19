@extends('layout')
@section('title', 'Hàng xuất')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Hàng Xuất</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>

                    <!-- <fieldset >
                        <div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                            <div class="col-md-2 mb-2" >
                                <label for="validationDefault01">JanCode</label>
                                <input type="text" class="form-control" name="uinvoice" id="uinvoice" placeholder="Nhập số hoá đơn"  required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="uinvoice" id="uinvoice" placeholder="Nhập số hoá đơn"  required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Trọng lượng</label>
                                <input data-type="currency" type="text" class="form-control" name="uTotalPrice" id="uTotalPrice" placeholder="Nhập tổng tiền hoá đơn"  required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Thể tích </label>
                                <input type="text" class="form-control" name="uPurchaseCosts" id="uPurchaseCosts" placeholder="Chi phí mua hàng" value=0 required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Thuế chi phí</label>
                                <select type="text" class="form-control" id="TaxPurchaseCosts"   required >
                                    <option value="" selected disabled>Please select</option>
                                    <option value="10">10%</option>
                                    <option value="8">8%</option>
                                    <option value="5">5%</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Nhà cung cấp</label>
                                <select type="text" class="form-control" name="unamesupplier" id="unamesupplier"   required >
                                    <option value="" selected disabled>Please select</option>
                                    <option value="1">Nhà CC 1</option>
                                    <option value="2">Nhà CC 2</option>
                                    <option value="3">Nhà CC 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row" style="margin-left: 2%; margin-top: 1%;">
                            <div class="col-md-2 mb-2" >
                                <label for="validationDefault01">Ngày xuất hàng</label>
                                <input class="form-control" type="date" value="2020-04-12" name="PaymentDate" id="PaymentDate">
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Số lượng</label>
                                <input type="text" class="form-control" name="uTracking" id="uTracking" placeholder="Nhập mã tracking"  required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Đơn vị</label>
                                <select type="text" class="form-control" id="PaidInvoice"   required >
                                    <option value="" selected disabled>Please select</option>
                                    <option value="1">Item 1</option>
                                    <option value="2">Item 2</option>
                                    <option value="3">Item 3</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Kho hàng</label>
                                <select type="text" class="form-control" name="Typehoadon" id="Typehoadon"   required >
                                    <option value="" selected disabled>Please select</option>
                                    <option value="1">Item 1</option>
                                    <option value="2">Item 2</option>
                                    <option value="3">Item 3</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2" style="margin-top: 1%;">

                                <button type="submit" class="btn btn-primary" onclick="InsertInvoice()">Tạo </button>
                            </div>
                        </div>


                    </fieldset> -->



                <div id="ItemInvoice" style="background-color: aliceblue;"></div>
                <div>
                    <div style="margin: 1% 1% 1% 1%;">
                    <form>
                            <fieldset >
                                <div class="form-row" style=" margin-top: 1%;">
                                    <div >
                                        <button type="submit" class="btn btn-primary" style="margin-left: 2%;" onclick="Search()">Tìm kiếm</button>
                                    </div>
                                    <div type="text" class="form-control"  placeholder="Nhập mã sản phẩm"  required style="width: 10%;" >
                                        <option>Mã sản phẩm</option>
                                        <!-- <option>Ketchup</option>
                                        <option>Relish</option> -->
                                    </div>
                                    <input type="text" class="form-control" id="TenSP" placeholder="Nhập mã sản phẩm"  required style="width: 10%;" />
                                    <div type="text" class="form-control"  placeholder="Nhập mã tên sản phẩm"  required style="width: 10%;" >
                                        <option>Tên sản phẩm</option>
                                        <!-- <option>Ketchup</option>
                                        <option>Relish</option> -->
                                    </div>
                                    <input type="text" class="form-control" id="TenSP" placeholder="Tên sản phẩm"  required style="width: 10%;" />
                                    <select type="text" class="form-control" id="InfoItem" placeholder="First name"  required style="width: 10%;" >
                                        <option value="" selected disabled>Chọn nhà cung cấp</option>
                                        <option>Web order</option>
                                        <option>Ketchup</option>
                                        <option>Relish</option>
                                    </select>
                                    <select type="text" class="form-control" id="InfoItem" placeholder="First name"  required style="width: 10%;" >
                                        <option value="" selected disabled>Chọn phần trăm thuế</option>
                                        <option>8%</option>
                                        <option>10%</option>
                                        <option>12%</option>
                                    </select>
                                    <div type="text" class="form-control"  placeholder="Nhập mã tên sản phẩm"  required style="width: 10%;" >
                                        <option>Ngày nhập</option>
                                        <!-- <option>Ketchup</option>
                                        <option>Relish</option> -->
                                    </div>
                                    <div  >
                                        <input class="form-control" type="date" value="" id="DateEnd">
                                    </div>

                                    <!-- <div  >
                                        <input type="text" class="form-control" id="TextInfoItem" placeholder="Nhập tìm kiếm"  required style="" />
                                    </div>-->
                                    <!-- <div >
                                        <button type="submit" id="issueBtn" class="btn btn-danger" style="margin-left: 2%;">Xoá sản phẩm</button>
                                    </div>  -->

                                </div>
                            </fieldset>
                        </form>
                        <table id="example" class="table table-bordered table-striped" style="margin-top: 1%;">
                          <thead>
                            <tr>
                              <th></th>
                              <th>No.</th>
                              <th>Jancode</th>
                              <th>Tên sản phẩm</th>
                              <th>Trọng lượng</th>
                              <th>Thể tích</th>
                              <th>Số lượng</th>
                              <th>Thuế</th>
                              <th>Xuất xứ</th>
                              <th>Kho hàng</th>
                              <th>Ngày nhập</th>
                              <th>Ngày xuất</th>
                              <th>Trạng thái</th>

                            </tr>
                          </thead>
                        <tbody id="myTable">
                            <tr>
                                <td>
                                    <input type="checkbox" />
                                </td>
                                <td >1</td>
                                <td id="date">123456789</td>
                                <td id="date"> Viên giặt </td>
                                <td id="date">123456789</td>
                                <td id ="priceOut">202020</td>
                                <td id="congNo">1000000</td>
                                <td id="date">10%</td>
                                <td id="date">Japan</td>
                                <td id ="priceOut">Đà Nẵng</td>
                                <td id="congNo">20-11-2020</td>
                                <td id="congNo">20-12-2020</td>
                                <td>
                                    <button type="button" class="btn btn-success px-3" id="issueBtn" ><i class="fa fa-check" aria-hidden="true"> </i> Đã xuất</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" />
                                </td>
                                <td >1</td>
                                <td id="date">123456789</td>
                                <td id="date"> Viên giặt </td>
                                <td id="date">123456789</td>
                                <td id ="priceOut">202020</td>
                                <td id="congNo">1000000</td>
                                <td id="date">10%</td>
                                <td id="date">Japan</td>
                                <td id ="priceOut">Đà Nẵng</td>
                                <td id="congNo">20-11-2020</td>
                                <td id="congNo">20-12-2020</td>
                                <td>
                                    <button type="button" class="btn btn-success px-3" id="issueBtn" ><i class="fa fa-check" aria-hidden="true"> </i> Đã xuất</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" />
                                </td>
                                <td >1</td>
                                <td id="date">123456789</td>
                                <td id="date"> Viên giặt </td>
                                <td id="date">123456789</td>
                                <td id ="priceOut">202020</td>
                                <td id="congNo">1000000</td>
                                <td id="date">10%</td>
                                <td id="date">Japan</td>
                                <td id ="priceOut">Đà Nẵng</td>
                                <td id="congNo">20-11-2020</td>
                                <td id="congNo">20-12-2020</td>
                                <td>
                                    <button type="button" class="btn btn-success px-3" id="issueBtn" ><i class="fa fa-check" aria-hidden="true"> </i> Đã xuất</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" />
                                </td>
                                <td >1</td>
                                <td id="date">123456789</td>
                                <td id="date"> Viên giặt </td>
                                <td id="date">123456789</td>
                                <td id ="priceOut">202020</td>
                                <td id="congNo">1000000</td>
                                <td id="date">10%</td>
                                <td id="date">Japan</td>
                                <td id ="priceOut">Đà Nẵng</td>
                                <td id="congNo">20-11-2020</td>
                                <td id="congNo">20-12-2020</td>
                                <td>
                                    <button type="button" class="btn btn-success px-3" id="issueBtn" ><i class="fa fa-check" aria-hidden="true"> </i> Đã xuất</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                       <input type="checkbox" />
                                </td>
                                <td >1</td>
                                <td id="date">123456789</td>
                                <td id="date"> Viên giặt </td>
                                <td id="date">123456789</td>
                                <td id ="priceOut">202020</td>
                                <td id="congNo">1000000</td>
                                <td id="date">10%</td>
                                <td id="date">Japan</td>
                                <td id ="priceOut">Đà Nẵng</td>
                                <td id="congNo">20-11-2020</td>
                                <td id="congNo">20-12-2020</td>
                                <td>
                                    <button type="button" class="btn btn-success px-3" id="issueBtn" ><i class="fa fa-check" aria-hidden="true"> </i> Đã xuất</button>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                        <div class="modal" id="myModal">
                            <div class="modal-dialog modal-lg" style="min-width: 80%;" >
                              <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Chi tiết hoá đơn </h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="form-row" >
                                        <div class="col-md-2 mb-2" >
                                            <label for="validationDefault01">Số hoá đơn</label>
                                            <input type="text" class="form-control" id="numBill" placeholder="First name"  required>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="validationDefault01">Ngày hóa đơn</label>
                                            <input class="form-control" type="date" value="2020-04-12" id="dateBill">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="validationDefault01">Tổng tiền hoá đơn</label>
                                            <input type="text" class="form-control" id="sumB" placeholder="First name"  required>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="validationDefault01">Chi phí mua hàng </label>
                                            <input type="text" class="form-control" id="validationDefault01" placeholder="First name"  required>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="validationDefault01">Thuế chi phí</label>
                                            <select type="text" class="form-control" id="validationDefault01" placeholder="First name"  required >
                                                <option value="" selected disabled>Please select</option>
                                                <option value="1">Item 1</option>
                                                <option value="2">Item 2</option>
                                                <option value="3">Item 3</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="validationDefault01">Nhà cung cấp</label>
                                            <select type="text" class="form-control" id="validationDefault01" placeholder="First name"  required >
                                                <option value="" selected disabled>Please select</option>
                                                <option value="1">Item 1</option>
                                                <option value="2">Item 2</option>
                                                <option value="3">Item 3</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-row" >
                                        <div class="col-md-2 mb-2" >
                                            <label for="validationDefault01">Hạn thanh toán</label>
                                            <input class="form-control" type="date"  id="example-date-input">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="validationDefault01">Ngày giao hàng</label>
                                            <input class="form-control" type="date"  id="example-date-input">
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="validationDefault01">Mã Tracking</label>
                                            <input type="text" class="form-control" id="validationDefault01" placeholder="First name"  required>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="validationDefault01">Hiện trạng hoá đơn</label>
                                            <select type="text" class="form-control" id="validationDefault01"   required >
                                                <option value="" selected disabled>Please select</option>
                                                <option value="1">Item 1</option>
                                                <option value="2">Item 2</option>
                                                <option value="3">Item 3</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="validationDefault01">Loại hoá đơn</label>
                                            <select type="text" class="form-control" id="validationDefault01"   required >
                                                <option value="" selected disabled>Please select</option>
                                                <option value="1">Item 1</option>
                                                <option value="2">Item 2</option>
                                                <option value="3">Item 3</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label for="validationDefault01">Nhân viên</label>
                                            <select type="text" class="form-control" id="validationDefault01"   required >
                                                <option value="" selected disabled>Please select</option>
                                                <option value="1">Item 1</option>
                                                <option value="2">Item 2</option>
                                                <option value="3">Item 3</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <table id="example" class="table table-bordered table-striped" style="margin-top: 1%;">
                                    <thead>
                                      <tr>
                                        <th >No.</th>
                                        <th>Web order</th>
                                        <th>JanCode</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>%Thuế</th>

                                      </tr>
                                    </thead>
                                    <tbody id="myTable">
                                      <tr>
                                      <td >1</td>
                                      <td>
                                        <div  >
                                            <input type="text" class="form-control" id="Weborder_4580525435045" placeholder="First name" value="Saiko"  required onchange = "UpdateInfoModalWO()">
                                        </div>
                                      </td>
                                      <td>
                                        <div  >
                                            <input type="text" class="form-control" id="Jancode_4580525435045" placeholder="First name" value="Saiko"  required onchange = "UpdateInfoModalJC()">
                                        </div>
                                      </td>
                                        <td >Japan</td>
                                        <td>
                                            <div  >
                                                <input type="text" class="form-control" id="Quantity_4580525435045" placeholder="First name" value="Doe"  required onchange = "UpdateInfoModalQuantity()">
                                            </div>
                                        </td>
                                        </td>
                                        <td>
                                            <div  >
                                                <input type="text" class="form-control" id="Price_4580525435045" placeholder="First name" value="Saiko"  required onchange = "UpdateInfoModalDG()">
                                            </div>
                                          </td>
                                          <td>
                                    <div class="form-group">
                                        <select class="form-control" id="selected" onchange="UpdateInfoModalSelected()">
                                          <option>8%</option>
                                          <option>10%</option>
                                          <option>12%</option>

                                        </select>
                                      </div>
                                     </td>

                                      </tr>
                                      <tr>
                                          <td >1</td>
                                          <td>
                                            <div  >
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Saiko"  required>
                                            </div>
                                          </td>
                                          <td>
                                            <div  >
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Saiko"  required>
                                            </div>
                                          </td>
                                          <td >Japan</td>
                                          <td>
                                            <div  >
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Doe"  required>
                                            </div>
                                        </td>
                                          <td>
                                            <div  >
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Saiko"  required>
                                            </div>
                                          </td>
                                          <td>
                                    <div class="form-group">
                                        <select class="form-control" id="selected">
                                        <option>8%</option>
                                          <option>10%</option>
                                          <option>12%</option>
                                        </select>
                                      </div>
                                     </td>

                                        </tr>
                                        <tr>
                                          <td >1</td>
                                          <td>
                                            <div  >
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Saiko"  required>
                                            </div>
                                          </td>
                                          <td>
                                            <div  >
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Saiko"  required>
                                            </div>
                                          </td>
                                          <td >Japan</td>
                                          <td>
                                            <div  >
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Doe"  required>
                                            </div>
                                        </td>
                                          <td>
                                            <div  >
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Saiko"  required>
                                            </div>
                                          </td>
                                          <td>
                                    <div class="form-group">
                                        <select class="form-control" id="selected">
                                        <option>8%</option>
                                          <option>10%</option>
                                          <option>12%</option>
                                        </select>
                                      </div>
                                     </td>

                                        </tr>
                                        <tr>
                                          <td >1</td>
                                          <td>
                                            <div  >
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Saiko"  required>
                                            </div>
                                          </td>
                                          <td>
                                            <div  >
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Saiko"  required>
                                            </div>
                                          </td>
                                          <td >Japan</td>
                                          <td>
                                            <div  >
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Doe"  required>
                                            </div>
                                        </td>
                                          <td>
                                            <div  >
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Saiko"  required>
                                            </div>
                                          </td>
                                          <td>
                                    <div class="form-group">
                                        <select class="form-control" id="selected">
                                        <option>8%</option>
                                          <option>10%</option>
                                          <option>12%</option>
                                        </select>
                                      </div>
                                     </td>

                                        </tr>
                                    </tbody>
                                  </table>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <div style="float: right;">
                                    <!-- <button type="submit" class="btn btn-primary" >Load Item</button> -->
                                    <button type="submit" class="btn btn-danger" >View Note</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
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

</div>
@endsection
