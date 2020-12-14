@extends('layout')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Chi tiết đơn hàng</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>
                <div class="card-body row">
                    <div style=" margin-left:1%; width:100%; padding:1%">
                        <table class="table table-bordered table-head-bg-info table-bordered-bd-info">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>1</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>1</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <td colspan="2" rowspan="4" >
                                        <div style="height:250px; overflow-y: scroll">
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            <div>XA_Anh 2019-10-18 14:28:46 : Đã cập nhật số lượng ( 4 ): 300</div>
                                            </div>
                                        <div class=" row" style="margin: 1%;">
                                            <input style="width: 70%; margin-right:1%" type="text" class="form-control" name="note" id="note" placeholder="Nhập ghi chú"  required onchange="UpdateInfoModalNote()">
                                            <button type="submit" class="btn btn-primary" >Gửi</button>
                                        </div>
                                    </td>
                                    <td>Tổng</td>
                                    <td>2</td>
                                    <td>123</td>
                                </tr>
                                <tr>
                                    <td>Phí dịch vụ</td>
                                    <td colspan="2">
                                         <div >
                                            <input style="width: 70%; margin-right:1%" type="text" class="form-control"  name="uTracking"  id="Price" value="0"  placeholder="Nhập phí dịch vụ"  required onchange="UpdateInfoModalPrice()" >
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipping nội địa:</td>
                                    <td colspan="2">
                                         <div >
                                            <input style="width: 70%; margin-right:1%" type="text" class="form-control" name="uTracking"  id="Shipping" value="0"  placeholder="Nhập shipping nội địa"  required onchange=" UpdateInfoModalShipping()">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tracking number</td>
                                    <td colspan="2">
                                         <div >
                                            <input style="width: 70%; margin-right:1%" type="text" class="form-control" name="uTracking" id="uTracking" value="0"  placeholder="Nhập tracking number"  required onchange="UpdateInfoModalTracking()">
                                        </div>
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
@endsection
