@extends('layout')
@section('title', 'Đơn hàng')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Đơn hàng đang xữ lý</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful,
                    responsive navigation header, the navbar. Includes support for branding,
                    navigation, and more, including support for our collapse plugin.</p> -->
                </div>
                <div class=" row">

                    <div class="row" style="width: 100%">

                        <div class="card" style=" margin-left:1%; width:100%; ">

                            <div class="card-header">

                                <div style="float: right; display:flex">
                                    <div >
                                        <button type="submit" class="btn btn-warning" id="search_type" onclick="SearchDonHang()">Tìm kiếm</button>
                                    </div>
                                    <div class="col-md-2 mb-3" style="padding: unset;">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="uinvoice"
                                            id="title_2"
                                            placeholder="Nhập mã hàng"
                                            required="required">
                                    </div>
                                    <div class="col-md-4 mb-3" style="padding: unset;">

                                        <select
                                            type="text"
                                            class="form-control"
                                            id="search_type2"
                                            required="required">
                                            <option value="" selected="selected" disabled="disabled">Please select</option>
                                            <option value="Code order">Code order</option>
                                            <option value="JanCode">JanCode</option>
                                            <option value="Uname">Uname</option>
                                            <option value="Product name">Product name</option>
                                            <option value="Invoice">Invoice</option>
                                            <option value="None">None</option>
                                            <option value="Pone">Pone</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3" style="padding: unset;">
                                        <select
                                            type="text"
                                            class="form-control"
                                            id="fil_type"
                                            required="required">
                                            <option value="" selected="selected" disabled="disabled">Please select</option>
                                            <option value="Đã xác định hàng">Đã xác định hàng</option>
                                            <option value="Đã gửi mail báo giá">Đã gửi mail báo giá</option>
                                            <option value="Đã cập nhập">Đã cập nhập</option>
                                            <option value="Đã báo giá">Đã báo giá</option>
                                            <option value="Đã chấp nhận">Đã chấp nhận</option>
                                            <option value="Đã thanh toán">Đã thanh toán</option>
                                            <option value="Đã gửi mail mua hàng">Đã gửi mail mua hàng</option>
                                            <option value="Đã mua hàng">Đã mua hàng</option>
                                            <option value="Đã kiểm hàng">Đã kiểm hàng</option>
                                            <option value="Đang giao hàng">Đang giao hàng</option>
                                            <option value="Cập cảng Nhật">Cập cảng Nhật</option>
                                            <option value="Cập cảng Việt">Cập cảng Việt</option>
                                            <option value="Đang phát hàng">Đang phát hàng</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <ul class="list-group list-group-flush">

                                @foreach ($bill as $item)
                                <div class="card " style="width:100%">
                                    <div class="row d-flex justify-content-between px-3 top" style="margin: 1% 3% 0% 3% ">
                                        <div class="d-flex">
                                            <div class="avatar avatar-xxl">
                                                <img
                                                    src="https://tshop.r10s.jp/adidas/cabinet/201905w/f34978-1.jpg?downsize=300:*"
                                                    alt="..."
                                                    class="avatar-img rounded">
                                            </div>
                                            <h5>ORDER
                                                <span class="text-primary font-weight-bold">
                                                    <a href="../components/donHangDetail.php">{{$item->Codeorder}}
                                                    </a>
                                                </span>
                                                <div class="">
                                                    <p class="mb-0"><strong>Đơn giá:</strong> 3,045</p>
                                                    <p class="mb-0"><strong>Số lượng:</strong> 450</p>
                                                </div>
                                            </h5>
                                        </div>
                                        <div class="d-flex flex-column text-sm-right">
                                            <p class="mb-0"><strong>Phương thức vận chuyển:</strong> Đường biển</p>
                                            <p class="mb-0"><strong>Trạng thái:</strong> Đã kiểm hàng</p>
                                            <p class="mb-0"><strong>Jancode:</strong>49506950656</p>
                                            <p><strong>Name:</strong> Giày nike</p>
                                        </div>
                                    </div>
                                    <!-- Add class 'active' to progress -->
                                    <div class="row d-flex justify-content-center" style="margin-left:5%">
                                        <div class="col-12">
                                            <ul id="progressbar" class="text-center" >
                                                <li class="active step0" style="width:7%" ></li>
                                                <li class="active step0" style="width:7%"></li>
                                                <li class="active step0" style="width:7%"></li>
                                                <li class="active step0" style="width:7%"></li>
                                                <li class="active step0" style="width:7%"></li>
                                                <li class="active step0" style="width:7%"></li>
                                                <li class="active step0" style="width:7%"></li>
                                                <li class="active step0" style="width:7%"></li>
                                                <li class="active step0" style="width:7%"></li>
                                                <li class="active step0" style="width:7%"></li>
                                                <li class="active step0" style="width:7%"></li>
                                                <li class="active step0" style="width:7%"></li>
                                                <li class="step0" style="width:7%"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between top" style="margin-left:-2%; margin-top:1%">
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Xác định hàng
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Gửi mail báo giá
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://www.flaticon.com/svg/static/icons/svg/1689/1689164.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đã cập nhập
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://www.flaticon.com/svg/static/icons/svg/482/482527.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đã báo giá
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://www.flaticon.com/svg/static/icons/svg/784/784719.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đã chấp nhận
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://www.flaticon.com/svg/static/icons/svg/669/669844.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đã thanh toán
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://www.flaticon.com/svg/static/icons/svg/91/91848.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đã gửi mail
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://www.flaticon.com/svg/static/icons/svg/3770/3770695.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đã mua hàng
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://www.flaticon.com/svg/static/icons/svg/753/753445.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đã kiểm tra
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://www.flaticon.com/svg/static/icons/svg/709/709790.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đang giao hàng
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://www.flaticon.com/svg/static/icons/svg/274/274073.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Cập cảng Nhật
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://www.flaticon.com/svg/static/icons/svg/2510/2510359.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Cập cảng Việt
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://www.flaticon.com/svg/static/icons/svg/2830/2830175.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đang phát hàng
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row d-flex icon-content">
                                            <img class="icon" src="https://www.flaticon.com/svg/static/icons/svg/814/814987.svg">
                                            <div class="d-flex flex-column">
                                                <p class="font-weight-bold">Order
                                                    <br>Đang nhận hàng
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
