<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Navbar | Atlantis Bootstrap Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- Fonts and icons -->
	<script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>


	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{asset('assets/css/fonts.min.css')}}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});

	</script>

	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/atlantis.min.css')}}">
	<link href="{{asset('assets/styles.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/prism.css')}}" rel="stylesheet" />
</head>
<body>
    <div class="main-header">
        <div class="logo-header" data-background-color="light-blue2">
            <a href="../index.php" class="logo">
                <img src="../../assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="icon-menu"></i>
                </span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
        <nav class="navbar navbar-header navbar-expand-lg" data-background-color="light-blue2">
            <div class="container-fluid">
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    <!-- <li class="nav-item">
                        <a href="../../examples/demo1" class="nav-link">
                            Live server
                        </a>
                    </li> -->
                </ul>
            </div>
        </nav>
    </div>
    <div class="sidebar sidebar-style-2">
        <div class="sidebar-background"></div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-info" class="">
                    <li class="nav-item active">
                        <a >
                            <i class="fas fa-home"></i>
                            <p>Introduction</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Components</h4>
                    </li>
                    <li class="nav-item dropdown"  style="color:#44a5f1" >
                        <a class="nav-link dropdown-toggle" href="../components/alerts.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <span class="letter-icon">S</span>
                            <p>Supplier</p>
                        </a>
                        <ul  class="dropdown-menu  departments"  style="color:#44a5f1" aria-labelledby="navbarDropdownMenuLink">
                            <li style="color:#44a5f1"><a class="dropdown-item" href="../components/hoaDonSupp.php">Hoá đơn supplier</a></li>
                            <li style="color:#44a5f1"><a class="dropdown-item" href="../components/tienThanhToanSupp.php">Tiền thanh toán supplier</a></li>
                            <li style="color:#44a5f1"><a class="dropdown-item" href="../components/quanLySupplier.php">Quản lý supplier</a></li>
                            <li style="color:#44a5f1"><a class="dropdown-item" href="../components/supplierTraTien.php">Supplier trả lại tiền</a></li>
                            <li style="color:#44a5f1"><a class="dropdown-item" href="../components/congNoNCCC.php">Công nợ  NCCC</a></li>
                        </ul>
                    </li>
                    <!-- <select type="text" id="validationDefault01" placeholder="Nhập số hoá đơn"  required style="" >
                        <option>Type</option>
                        <option>Ketchup</option>
                        <option>Relish</option>
                    </select> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="../components/componentOrder.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <span class="letter-icon">O</span>
                            <p>Order</p>
                        </a>
                        <ul class="dropdown-menu departments" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="../components/hoaDon.php">Hoá đơn</a></li>
                            <li><a class="dropdown-item" href="../components/soCai.php">Sổ cái</a></li>
                            <li><a class="dropdown-item" href="../components/webOrder.php">Web order</a></li>
                            <li><a class="dropdown-item" href="../components/tienKhachThanhToan.php">Tiền khách thanh toán</a></li>
                            <li><a class="dropdown-item" href="../components/congNoKhachHang.php">Công nợ khách hàng</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="../components/componentWarehouse.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <span class="letter-icon">W</span>
                            <p>Warehouses</p>
                        </a>
                        <ul class="dropdown-menu departments" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="../components/hangNhap.php">Hàng Nhập </a></li>
                            <li><a class="dropdown-item" href="../components/hangXuat.php">Hàng xuất</a></li>
                            <li><a class="dropdown-item" href="../components/hangTonKho.php">Tồn kho</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
	<div class="wrapper">

		<div class="main-panel">
			<div class="content content-documentation">
				<div class="container-fluid">
					<div class="card card-documentation">
						<div class="card-header bg-info-gradient text-white bubble-shadow">
							<h4>Hoá đơn nhà cung cấp</h4>
							<!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
						</div>

							<fieldset >
								<div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
									<div class="col-md-2 mb-2" >
										<label for="validationDefault01">Số hoá đơn</label>
										<input type="text" class="form-control" name="uinvoice" id="uinvoice" placeholder="Nhập số hoá đơn"  required>
									</div>
									<div class="col-md-2 mb-2">
										<label for="validationDefault01">Ngày hóa đơn</label>
										<input class="form-control" type="date"  name="Dateinvoice" id="Dateinvoice">
									</div>
									<div class="col-md-2 mb-2">
										<label for="validationDefault01">Tổng tiền hoá đơn</label>
										<input data-type="currency" type="text" class="form-control" name="uTotalPrice" id="uTotalPrice" placeholder="Nhập tổng tiền hoá đơn"  required>
									</div>
									<div class="col-md-2 mb-2">
										<label for="validationDefault01">Chi phí mua hàng </label>
										<input type="text" class="form-control" name="uPurchaseCosts" id="uPurchaseCosts" placeholder="Chi phí mua hàng" value=0 required>
									</div>
									<div class="col-md-1 mb-2">
										<label for="validationDefault01">Thuế chi phí</label>
										<select type="text" class="form-control" id="TaxPurchaseCosts"   required >
											<option value="" selected disabled>Please select</option>
											<option value="10">10%</option>
    										<option value="8">8%</option>
    										<option value="5">5%</option>
										</select>
									</div>
									<div class="col-md-1 mb-2">
										<label for="validationDefault01">Nhà cung cấp</label>
										<select type="text" class="form-control" name="unamesupplier" id="unamesupplier"   required >
											<option value="" selected disabled>Please select</option>
											<option value="1">Item 1</option>
    										<option value="2">Item 2</option>
    										<option value="3">Item 3</option>
										</select>
									</div>
									<div class="col-md-1 mb-2">
										<label for="validationDefault01">Nhân viên</label>
										<select type="text" class="form-control" name="Buyer" id="Buyer"   required >
											<option value="" selected disabled>Please select</option>
											<option value="1">Item 1</option>
    										<option value="2">Item 2</option>
    										<option value="3">Item 3</option>
										</select>
									</div>
								</div>
								<div class="form-row" style="margin-left: 2%; margin-top: 1%;">
									<div class="col-md-2 mb-2" >
										<label for="validationDefault01">Hạn thanh toán</label>
										<input class="form-control" type="date"  name="PaymentDate" id="PaymentDate">
									</div>
									<div class="col-md-2 mb-2">
										<label for="validationDefault01">Ngày giao hàng</label>
										<input class="form-control" type="date"  name="StockDate" id="StockDate">
									</div>
									<div class="col-md-2 mb-2">
										<label for="validationDefault01">Mã Tracking</label>
										<input type="text" class="form-control" name="uTracking" id="uTracking" placeholder="Nhập mã tracking"  required>
									</div>
									<div class="col-md-2 mb-2">
										<label for="validationDefault01">Hiện trạng hoá đơn</label>
										<select type="text" class="form-control" id="PaidInvoice"   required >
											<option value="" selected disabled>Please select</option>
											<option value="1">Item 1</option>
    										<option value="2">Item 2</option>
    										<option value="3">Item 3</option>
										</select>
									</div>
									<div class="col-md-2 mb-2">
										<label for="validationDefault01">Loại hoá đơn</label>
										<select type="text" class="form-control" name="Typehoadon" id="Typehoadon"   required >
											<option value="" selected disabled>Please select</option>
											<option value="1">Item 1</option>
    										<option value="2">Item 2</option>
    										<option value="3">Item 3</option>
										</select>
									</div>
									<div class="col-md-2 mb-2" style="margin-top: 1%;">
										<!-- <label for="validationDefault01">Hiện trạng hoá đơn</label> -->
										<button type="submit" class="btn btn-primary" onclick="InsertInvoice()">Submit</button>
									</div>
								</div>


							</fieldset>



						<div class="card" id="ItemInvoice" style="background-color: aliceblue; margin-bottom: unset; margin-top:1%"></div>
						<div>
						<div class="card" id="ItemInvoice2" style="background-color: aliceblue; margin-bottom: unset;"></div>
						<div>
							<div style="margin: 1% 1% 1% 1%;">
								<form>
									<fieldset >
										<div class="form-row" style=" margin-top: 1%;">
											<div >
												<button type="submit" class="btn btn-primary" style="margin-left: 2%;" onclick="Search()">Tìm kiếm</button>
											</div>
											<div type="text" class="form-control"  placeholder="Nhập số hoá đơn"  required style="width: 10%;" >
												<option>Số hoá đơn</option>
												<!-- <option>Ketchup</option>
												<option>Relish</option> -->
											</div>
											<input type="text" class="form-control" id="TypeSearch" placeholder="Nhập số hoá đơn"  required style="width: 10%;" />
											<select type="text" class="form-control" id="Supplier" placeholder="First name"  required style="width: 10%;" >
												<option>(株)アベルネツト　ジギヨウブ</option>
												<option>(株)7&S</option>
												<option>Relish</option>
											</select>
											<input type="text" class="form-control" id="TenSP" placeholder="Tên sản phẩm"  required style="width: 10%;" />
											<select type="text" class="form-control" id="InfoItem" placeholder="First name"  required style="width: 10%;" >
												<option>Web order</option>
												<option>Ketchup</option>
												<option>Relish</option>
											</select>
											<input type="text" class="form-control" id="TextInfoItem" placeholder="Nhập tìm kiếm"  required style="width: 10%;" />
											<div  >
												<input class="form-control" type="date"  id="DateStart">
											</div>
											<div  >
												<input class="form-control" type="date"  id="DateEnd">
											</div>
											<div  >
												<input type="text" class="form-control" id="TextInfoItem" placeholder="Nhập tìm kiếm"  required style="" />
											</div>
											<div >
												<button type="submit" class="btn btn-primary" style="margin-left: 2%;">Tìm kiếm</button>
											</div>

										</div>
									</fieldset>
								</form>
								<table id="example" class="table table-bordered table-striped" style="margin-top: 1%; margin-right: 1%;">
								  <thead>
									<tr>
									  <th>Ngày hoá đơn</th>
									  <th>Số hoá đơn</th>
									  <th>Hiện trạng hoá đơn</th>
									  <th>Nhà cung cấp</th>
									  <th>Web order</th>
									  <th>Jancode</th>
									  <th>Tên sản phẩm</th>
									  <th>Số lượng</th>
									  <th>Đơn giá</th>
									  <th>Tổng tiền hoá đơn</th>
									  <th>Hạn thanh toán</th>
									  <th>Ngày giao hàng</th>
									</tr>
								  </thead>
								<tbody id="myTable">
									<tr><td data-toggle="modal" data-target="#myModal">12312</td></tr>

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
													<input class="form-control" type="date"  id="dateBill">
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
													<input class="form-control" type="date" value="2020-04-12" id="example-date-input">
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
	</div>
</body>
<script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/chart.js/chart.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<!-- <script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script> -->
<script type="{{asset('text/javascript" src="assets/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
<script type="{{asset('text/javascript" src="assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}" charset="utf-8"></script>
<script src="{{asset('assets/js/plugin/chart-circle/circles.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/atlantis.min.js')}}"></script>
<script src="{{asset('assets/prism.js')}}"></script>
<script src="{{asset('assets/prism-normalize-whitespace.min.js')}}"></script>
<script type="text/javascript">
	// Optional
	Prism.plugins.NormalizeWhitespace.setDefaults({
		'remove-trailing': true,
		'remove-indent': true,
		'left-trim': true,
		'right-trim': true,
	});



	// $(document).ready(function(){
	// 	Creat_HoaDon()
	// });
	// handle links with @href started with '#' only
	$(document).on('click', 'a[href^="#"]', function(e) {
		// target element id
		var id = $(this).attr('href');

		// target element
		var $id = $(id);
		if ($id.length === 0) {
			return;
		}

		// prevent standard hash navigation (avoid blinking in IE)
		e.preventDefault();

		// top position relative to the document
		var pos = $id.offset().top - 80;

		// animated top scrolling
		$('body, html').animate({scrollTop: pos});
	});





	function Creat_HoaDon()
		{
			var Invoice = $("#uinvoice").val();
			console.log(Invoice);
			$.ajax({
				type: 'POST',
				url: "php/Manage_hoadon.php",
				data: {
                    Insert_Invoice : Invoice

				},
				success: function(response) {
					console.log(response);
					var obj = JSON.parse(response);
					//Matp,title,typeTP
					for(item of obj.QH){
						let Matp = item.Matp
						let title = item.Title
						let typeTP = item.TypeTP
						$('#myTable').append(
							`
							<tr>
								<td data-toggle="modal" data-target="#myModal">
									${Matp}
								</td >
								<td data-toggle="modal" data-target="#myModal">
									${title}
								</td>
								<td data-toggle="modal" data-target="#myModal">
									${typeTP}
								</td>
							</tr>
							`
						)
					}
				}
			    });
	}
	function InsertInvoice(){
		var Invoice = $("#uinvoice").val();
        var TotalPrice = $("#uTotalPrice").val().replace(",","").replace(",","");
        var PurchaseCosts = $("#uPurchaseCosts").val().replace(",","").replace(",","");
        var TaxPurchaseCosts = $("#TaxPurchaseCosts").val();
        var UnameSupplier = $("#unamesupplier").val();
        var PaymentDate = $("#PaymentDate").val();
        var StockDate = $("#StockDate").val();
        var PaidInvoice = $("#PaidInvoice").val();
        var Typehoadon = $("#Typehoadon").val();
        var Buyer = $("#Buyer").val();
        var Dateinvoice = $("#Dateinvoice").val();
        var Trackingnumber = $("#uTracking").val();

		console.log(Invoice,TotalPrice,PurchaseCosts,TaxPurchaseCosts,UnameSupplier,PaymentDate,StockDate,Dateinvoice,PaidInvoice,Typehoadon);
		if((Invoice.length>3) && (TotalPrice.length>3) && (Dateinvoice.length>7) && (PaymentDate.length>7) && (StockDate.length>7)){
		$('#ItemInvoice').html(
			`<fieldset >
				<div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%; margin-bottom: unset;">
					<div class="col-md-1 mb-1" >
						<label for="validationDefault01">Codeorde*</label>
						<input type="text" class="form-control" name="codeorder_1" id="codeorder_1" placeholder="Nhập codeorde"  required>
					</div>
					<div class="col-md-2 mb-2">
						<label for="validationDefault01">Tên sản phẩm*</label>
						<input type="text" class="form-control" name="Janecode_1" id="Janecode_1" placeholder="Nhập tên sản phẩm" required>
					</div>
					<div class="col-md-2 mb-2">
						<label for="validationDefault01">Jancode*</label>
						<input type="text" class="form-control" name="uinvoice" id="so_luong_1" placeholder="Nhập jancode*"  required>
					</div>
					<div class="col-md-1 mb-1">
						<label for="validationDefault01">Số lượng*</label>
						<input type="text" class="form-control" name="uTotalPrice" id="uTotalPrice" placeholder="Nhập số lượng"  required>
					</div>
					<div class="col-md-1 mb-1">
						<label for="validationDefault01">Đơn giá*</label>
						<input type="text" class="form-control" name="uPurchaseCosts" id="don_gia_1" placeholder="Chi đơn giá" value=0 required>
					</div>
					<div class="col-md-1 mb-2">
					<label for="validationDefault01">% Thuế*</label>
						<select type="text" class="form-control" id="thue_jancode_1"   required >
							<option value="" selected disabled>Please select</option>
							<option value="10">10%</option>
    						<option value="8">8%</option>
    						<option value="5">5%</option>
						</select>
					</div>
					<div class="col-md-1 mb-2" style=" margin-top: 1%;">
						<button type="submit" class="btn btn-primary">追加</button>
					</div>
					<div class="col-md-1 mb-1" style=" margin-top: 1%">
						<button type="button" class="btn btn-warning px-3" onclick="NewInsertInvoice()" ><i class="fas fa-plus"></i> </button>
					</div>

				</div>
			</fieldset>
			`
		)
		}
		else
        if(Invoice.length<=3)
           {alert("Format Invoice: 'XXXXX'");}
        if(TotalPrice.length<2)
           {alert("Total Price Err");}
        if(PaymentDate.length<7)
           {alert("Payment Day Err!");}
        if(StockDate.length<7)
           {alert("Stock Date Err!");}
        if(Dateinvoice.length<7)
           {alert("Stock Date Err!");}
	}
	function UpdateInfoModalWO(){
		var WebOrder = $("#Weborder_4580525435045").val();
		var JanCode = $("#Jancode_4580525435045").val();
		var Quantity = $("#Quantity_4580525435045").val();
		var Price = $("#Price_4580525435045").val();

		// console.log(WebOrder, JanCode, Quantity, Price)

		$("#Weborder_4580525435045").change(
			console.log(WebOrder, JanCode, Quantity, Price),
			alert(`DONE CHANGE: ${WebOrder} ! ` )
		)
	}
	function UpdateInfoModalJC(){
		var WebOrder = $("#Weborder_4580525435045").val();
		var JanCode = $("#Jancode_4580525435045").val();
		var Quantity = $("#Quantity_4580525435045").val();
		var Price = $("#Price_4580525435045").val();

		// console.log(WebOrder, JanCode, Quantity, Price)

		$("#Jancode_4580525435045").change(
			console.log(WebOrder, JanCode, Quantity, Price),
			alert(`DONE CHANGE: ${JanCode} ! ` )
		)
	}

	function UpdateInfoModalQuantity(){
		var WebOrder = $("#Weborder_4580525435045").val();
		var JanCode = $("#Jancode_4580525435045").val();
		var Quantity = $("#Quantity_4580525435045").val();
		var Price = $("#Price_4580525435045").val();

		// console.log(WebOrder, JanCode, Quantity, Price)


		$("#Quantity_4580525435045").change(
			console.log(WebOrder, JanCode, Quantity, Price),
			alert(`DONE CHANGE: ${Quantity} ! ` )
		)

	}

	function UpdateInfoModalDG(){
		var WebOrder = $("#Weborder_4580525435045").val();
		var JanCode = $("#Jancode_4580525435045").val();
		var Quantity = $("#Quantity_4580525435045").val();
		var Price = $("#Price_4580525435045").val();

		// console.log(WebOrder, JanCode, Quantity, Price)
		$("#Price_4580525435045").change(
			console.log(WebOrder, JanCode, Quantity, Price),
			alert(`DONE CHANGE: ${Price} ! ` )
		)

	}
	function UpdateInfoModalSelected(){
		var Selected = $("#selected").val();


		// console.log(WebOrder, JanCode, Quantity, Price)
		$("#selected").change(
			console.log(Selected),
			alert(`DONE CHANGE: ${Selected} ! ` )
		)
	}


	function Search(){
		var TypeSearch = $("#TypeSearch").val();
		var Supplier = $("#Supplier").val();
		var TenSP= $("#TenSP").val();
		var InfoItem = $("#InfoItem").val();
		var TextInfoItem = $("#TextInfoItem").val();
		var DateStart = $("#DateStart").val();
		var DateEnd = $("#DateEnd").val();

		console.log(TypeSearch,Supplier, TenSP, InfoItem, TextInfoItem, DateStart, DateEnd )
		// $.ajax({
		// 	type:'POST',
		// 	url:"php/Accountant_hoadon.php",
		// 	data: {
		// 		TypeSearch : TypeSearch,
		// 		Supplier : Supplier,
		// 		InfoItem : InfoItem,
		// 		TextInfoItem : TextInfoItem,
		// 		DateStart : DateStart,
		// 		DateEnd : DateEnd,
		// 		TenSP:TenSP,
		// 	},
		// 	success: function(response) {
        //             console.log(response);
        //             $("#showhoadon").html(response);
        //             //console.log(response);
		// 	}

		// });

    }

	function NewInsertInvoice(){
		$('#ItemInvoice2').html(
			`<fieldset >
				<div class="form-row" style="margin-left: 2%;margin-right: 1%;">
					<div class="col-md-1 mb-1" >
						<label for="validationDefault01">Codeorde*</label>
						<input type="text" class="form-control" name="codeorder_1" id="codeorder_1" placeholder="Nhập codeorde"  required>
					</div>
					<div class="col-md-2 mb-2">
						<label for="validationDefault01">Tên sản phẩm*</label>
						<input type="text" class="form-control" name="Janecode_1" id="Janecode_1" placeholder="Nhập tên sản phẩm" required>
					</div>
					<div class="col-md-2 mb-2">
						<label for="validationDefault01">Jancode*</label>
						<input type="text" class="form-control" name="uinvoice" id="so_luong_1" placeholder="Nhập jancode*"  required>
					</div>
					<div class="col-md-1 mb-1">
						<label for="validationDefault01">Số lượng*</label>
						<input type="text" class="form-control" name="uTotalPrice" id="uTotalPrice" placeholder="Nhập số lượng"  required>
					</div>
					<div class="col-md-1 mb-1">
						<label for="validationDefault01">Đơn giá*</label>
						<input type="text" class="form-control" name="uPurchaseCosts" id="don_gia_1" placeholder="Chi đơn giá" value=0 required>
					</div>
					<div class="col-md-1 mb-2">
					<label for="validationDefault01">% Thuế*</label>
						<select type="text" class="form-control" id="thue_jancode_1"   required >
							<option value="" selected disabled>Please select</option>
							<option value="10">10%</option>
    						<option value="8">8%</option>
    						<option value="5">5%</option>
						</select>
					</div>
					<div class="col-md-1 mb-2" style=" margin-top: 1%;">
						<button type="submit" class="btn btn-primary">追加</button>
					</div>
				</div>
			</fieldset>`
		)}

</script>
</html>
