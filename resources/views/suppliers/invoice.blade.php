@extends('layout')
@section('title', 'Hóa đơn nhà cung cấp')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Hoá đơn nhà cung cấp</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>

                <form>
                    <fieldset>
                        <div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Số hoá đơn</label>
                                <input value="{{ old('uinvoice') }}" type="text" class="form-control" name="uinvoice"
                                    id="uinvoice" placeholder="Nhập số hoá đơn">
                                <span class="alert-danger-custom">{{$errors->first('uinvoice')}}</span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Ngày hóa đơn</label>
                                <input class="form-control" value="{{ old('Dateinvoice') }}" type="date"
                                    name="Dateinvoice" id="Dateinvoice">
                                <span class="alert-danger-custom">{{$errors->first('Dateinvoice')}}</span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Tổng tiền hoá đơn</label>
                                <input data-type="currency" type="text" class="form-control" name="uTotalPrice"
                                    id="uTotalPrice" placeholder="Nhập tổng tiền hoá đơn">
                                <span class="alert-danger-custom">{{$errors->first('uinvoice')}}</span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Chi phí mua hàng </label>
                                <input type="text" class="form-control" name="uPurchaseCosts" id="uPurchaseCosts"
                                    placeholder="Chi phí mua hàng" value=0>
                                <span class="alert-danger-custom">{{$errors->first('uinvoice')}}</span>
                            </div>
                            <div class="col-md-1 mb-2">
                                <label for="validationDefault01">Thuế chi phí</label>
                                <select type="text" class="form-control" name="TaxPurchaseCosts" id="TaxPurchaseCosts">
                                    <option value="10">10%</option>
                                    <option value="8">8%</option>
                                    <option value="5">5%</option>
                                </select>
                                <span class="alert-danger-custom">{{$errors->first('TaxPurchaseCosts')}}</span>
                            </div>
                            <div class="col-md-1 mb-2">
                                <label for="validationDefault01">Nhà cung cấp</label>
                                <select type="text" class="form-control" name="unamesupplier" id="unamesupplier">
                                    @foreach ($data['suppliers'] as $item)
                                    <option value="{{$item->code_name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <span class="alert-danger-custom">{{$errors->first('unamesupplier')}}</span>
                            </div>
                            <div class="col-md-1 mb-2">
                                <label for="validationDefault01">Nhân viên</label>
                                <select type="text" class="form-control" name="Buyer" id="Buyer">
                                    <option value="倉山">倉山</option>
                                    <option value="ファム">ファム</option>
                                    <option value="ダン">ダン</option>
                                    <option value="タオ">タオ</option>
                                    <option value="アン">アン</option>
                                </select>
                                <span class="alert-danger-custom">{{$errors->first('Buyer')}}</span>
                            </div>
                        </div>
                        <div class="form-row" style="margin-left: 2%; margin-top: 1%;">
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Hạn thanh toán</label>
                                <input class="form-control" type="date" name="PaymentDate" id="PaymentDate">
                                <span class="alert-danger-custom">{{$errors->first('PaymentDate')}}</span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Ngày giao hàng</label>
                                <input class="form-control" type="date" name="StockDate" id="StockDate">
                                <span class="alert-danger-custom">{{$errors->first('StockDate')}}</span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Mã Tracking</label>
                                <input type="text" class="form-control" name="uTracking" id="uTracking"
                                    placeholder="Nhập mã tracking">
                                <span class="alert-danger-custom">{{$errors->first('uTracking')}}</span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Hiện trạng hoá đơn</label>
                                <select type="text" class="form-control" name="PaidInvoice" id="PaidInvoice">
                                    <option value="Paid">完</option>
                                    <option value="Unpaid">未</option>
                                    <option value="Cancel">消</option>
                                </select>
                                <span class="alert-danger-custom">{{$errors->first('PaidInvoice')}}</span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">Loại hoá đơn</label>
                                <select type="text" class="form-control" name="Typehoadon" id="Typehoadon">
                                    <option value="Muahang">購入</option>
                                    <option value="TTH">代行支払</option>
                                    <option value="Kinhphi">経費</option>
                                </select>
                                <span class="alert-danger-custom">{{$errors->first('Typehoadon')}}</span>
                            </div>
                            <div class="col-md-2 mb-2" style="margin-top: 1%;">
                                <!-- <label for="validationDefault01">Hiện trạng hoá đơn</label> -->
                                <button type="button" id="BtnSubmit" name="add-hd" class="btn btn-primary"
                                    onclick="Insert_Invoice()">Submit</button>
                            </div>
                        </div>


                    </fieldset>

                </form>
            </fieldset>
                <div class="card" id="ItemInvoice" style="background-color: aliceblue; margin-bottom: unset; margin-top:1%"></div>
                <div class="card" id="ItemInvoiceAdd1" style="background-color: aliceblue; margin-bottom: unset; margin-top:1%"></div>
                <div class="card" id="ItemInvoiceAdd2" style="background-color: aliceblue; margin-bottom: unset; margin-top:1%"></div>
                <div class="card" id="ItemInvoiceAdd3" style="background-color: aliceblue; margin-bottom: unset; margin-top:1%"></div>
                <div class="card" id="ItemInvoiceAdd4" style="background-color: aliceblue; margin-bottom: unset; margin-top:1%"></div>
                <div class="card" id="ItemInvoiceAdd5" style="background-color: aliceblue; margin-bottom: unset; margin-top:1%"></div>
                <div class="card" id="ItemInvoiceAdd6" style="background-color: aliceblue; margin-bottom: unset; margin-top:1%"></div>
                <div class="card" id="ItemInvoiceAdd7" style="background-color: aliceblue; margin-bottom: unset; margin-top:1%"></div>
                <div class="card" id="ItemInvoiceAdd8" style="background-color: aliceblue; margin-bottom: unset; margin-top:1%"></div>
                <div class="card" id="ItemInvoiceAdd9" style="background-color: aliceblue; margin-bottom: unset; margin-top:1%"></div>
            </fieldset>
                <div>
                    <div style="margin: 1% 1% 1% 1%;">
                        <form action="{{route('supplier.invoice')}}" method="GET">
                            <fieldset>
                                <div class="form-row" style=" margin-top: 1%;">
                                    {{-- <div type="text" class="form-control" placeholder="Nhập số hoá đơn"
                                            style="width: 10%;">
                                            <option>Số hoá đơn</option>
                                            <!-- <option>Ketchup</option>
                                        <option>Relish</option> -->
                                        </div> --}}
                                    <input value="{{ $data['uinvoice'] }}" name="uinvoice" type="text"
                                        class="form-control" id="uinvoiceSearch" placeholder="Nhập số hoá đơn"
                                        style="width: 10%;" />
                                    <select type="text" name="supplier" class="form-control" id="Supplier"
                                        placeholder="First name" style="width: 10%;">
                                        <option value="">Nhà cung cấp</option>
                                        @foreach ($data['suppliers'] as $item)
                                        <option value="{{$item->code_name}}"
                                            {{$data['supplier'] == $item->code_name ? 'selected':''}}>
                                            {{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" value="{{ $data['productName'] }}" name="productName"
                                        class="form-control" id="productName" placeholder="Tên sản phẩm"
                                        style="width: 10%;" />
                                    <input type="text" value="{{$data['webOrder']}}" name="webOrder"
                                        class="form-control" id="webOrder" placeholder="Web order"
                                        style="width: 10%;" />
                                    <div>
                                        <input name="paymentDate" value="{{$data['paymentDate']}}" class="form-control"
                                            type="date" id="paymentDate">
                                    </div>
                                    <div>
                                        <input name="stockDate" value="{{$data['stockDate']}}" class="form-control"
                                            type="date" id="stockDate">
                                    </div>
                                    <div>
                                        <input type="text" value="{{$data['janCode']}}" name="janCode"
                                            class="form-control" id="janCode" placeholder="Jan code" style="" />
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary" style="margin-left: 2%;">Tìm
                                            kiếm</button>
                                    </div>
                                    <div>
                                        <button type="button" onclick="resetFormSearch()" class="btn btn-info"
                                            style="margin-left: 1em; ">Xóa tìm kiếm</button>
                                    </div>

                                    <script>
                                        function resetFormSearch() {
                                            document.getElementById("uinvoiceSearch").value = "";
                                            document.getElementById("Supplier").value = "";
                                            document.getElementById("productName").value = "";
                                            document.getElementById("webOrder").value = "";
                                            document.getElementById("paymentDate").value = "";
                                            document.getElementById("stockDate").value = "";
                                            document.getElementById("janCode").value = ""
                                        }

                                    </script>
                                </div>
                            </fieldset>
                            <br>

                            <div style="float: left;">
                                <select type="text" name="record" onchange="this.form.submit()" class="form-control"
                                    style="width: 100%;">
                                    @foreach ($array = [10, 30, 50] as $item)
                                    <option value="{{$item}}" {{$data['record'] == $item ? 'selected' : '' }}>
                                        {{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        <div style="float: right">
                            {!! $data['invoices']->withQueryString()->links('commons.paginate') !!}</div>
                        <table id="example" class="table table-bordered table-striped"
                            style="margin-top: 1%; margin-right: 1%;">
                            <thead>
                                <tr>
                                    <th>Ngày hoá đơn</th>
                                    <th>Số hoá đơn</th>
                                    <th>Hiện trạng hoá đơn</th>
                                    <th>Nhà cung cấp</th>
                                    <th>Web order</th>
                                    <th>Jancode</th>
                                    <th>Name</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Tổng tiền hoá đơn</th>
                                    <th>Ngày giao hàng</th>
                                    <th>Hạn thanh toán</th>
                                </tr>
                            </thead>

                            <tbody id="myTable">
                                @foreach ($data['invoices'] as $invoice => $value)
                                <tr>
                                    <th>{{$value->DateInvoice}}</th>
                                    <td data-id="{{$value->Invoice}}" class="view_transaction">{{$value->Invoice}}
                                    </td>
                                    <td>{{$value->TypeInvoice}}</td>
                                    <td>{{$value->Supplier}}</td>
                                    <td>@foreach ($value['detail'] as $item)
                                        {{$item->Codeorder}}
                                        @endforeach</td>
                                    <td>@foreach ($value['detail'] as $item)
                                        {{$item->Jancode}}
                                        @endforeach</td>
                                        <td>
                                             @foreach ($value['detail'] as $name)
                                                 {{$name->product->name}}
                                             @endforeach
                                        </td>
                                    <td>@foreach ($value['detail'] as $item)
                                        {{$item->Quantity}}
                                        @endforeach</td>
                                    <td>@foreach ($value['detail'] as $item)
                                        {{$item->Price}}
                                        @endforeach</td>
                                    <td>{{$value->TotalPrice}}</td>
                                    <td>{{$value->PaymentDate}}</td>
                                    <td>{{$value->StockDate}}</td>
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
    </div>
</div>

</div>
</div>
<script type="text/javascript">
    var HTML = "";
    var JanCount = 1;
    var TotalPrice = 0;

    // function DetailBillUpdate() {
    //     var numberBillUpdate = $("#numBillUpdate").val();
    //     var dateBillUpdate = $("#dateBillUpdate").val();
    //     var sumBillUpdate = $("#sumBillUpdate").val().replace(",", "");
    //     var totalPriceBillUpdate = $("#totalPriceBillUpdate").val().replace(",", "");
    //     var taxBillUpdate = $("#taxBillUpdate").val();
    //     var supplierBillUpdate = $("#supplierBillUpdate").val();
    //     var PaymentDateBillUpdate = $("#PaymentDateBillUpdate").val();
    //     var StockDateBillUpdate = $("#StockDateBillUpdate").val();
    //     var TrackingNumberBillUpdate = $("#TrackingNumberBillUpdate").val();
    //     var PaidInvoiceBillUpdate = $("#PaidInvoiceBillUpdate").val();
    //     var TypehoadonBillUpdate = $("#TypehoadonBillUpdate").val();
    //     var BuyerBillUpdate = $("#BuyerBillUpdate").val();
    //         $.ajax({
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 },
    //                 type: 'POST',
    //                 url: "invoice/" + "/" + numberBillUpdate,
    //                 data: {
    //                     numberBillUpdate: numberBillUpdate,
    //                     dateBillUpdate: dateBillUpdate,
    //                     sumBillUpdate: sumBillUpdate,
    //                     totalPriceBillUpdate: totalPriceBillUpdate,
    //                     taxBillUpdate: taxBillUpdate,
    //                     supplierBillUpdate: supplierBillUpdate,
    //                     PaymentDateBillUpdate: PaymentDateBillUpdate,
    //                     StockDateBillUpdate: StockDateBillUpdate,
    //                     TrackingNumberBillUpdate: TrackingNumberBillUpdate,
    //                     PaidInvoiceBillUpdate: PaidInvoiceBillUpdate,
    //                     TypehoadonBillUpdate
    //                 },
    //                 success: function (response) {
    //                     if (response == 1) {
    //                         location.reload();
    //                     }
    //                     if (response == 2) {
    //                         location.reload();
    //                     }
    //                 }
    //             });
    // }

    $(document).ready(function() {
                                $('.view_transaction').click(function() {
                                    const id = $(this).data('id');
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                                .attr('content')
                                        },
                                        type: 'GET',
                                        url: "invoice" + '/' + id,

                                        success: function(data) {
                                            $('#modalDetail').modal('show');
                                            $('.modal-content').html('').append(data);
                                        }
                                    });
                                });
                            });

    function Insert_Invoice() {
        document.getElementById("BtnSubmit").disabled = true;
        document.getElementById("unamesupplier").disabled = true;
        document.getElementById("uTotalPrice").disabled = true;
        document.getElementById("uinvoice").disabled = true;
        document.getElementById("uPurchaseCosts").disabled = true;
        document.getElementById("TaxPurchaseCosts").disabled = true;
        document.getElementById("PaymentDate").disabled = true;
        document.getElementById("StockDate").disabled = true;
        document.getElementById("PaidInvoice").disabled = true;
        document.getElementById("Typehoadon").disabled = true;
        document.getElementById("Buyer").disabled = true;
        document.getElementById("Dateinvoice").disabled = true;
        document.getElementById("uTracking").disabled = true;
        var Invoice = $("#uinvoice").val();
        var TotalPrice = $("#uTotalPrice").val().replace(",", "").replace(",", "");
        var PurchaseCosts = $("#uPurchaseCosts").val().replace(",", "").replace(",", "");
        var TaxPurchaseCosts = $("#TaxPurchaseCosts").val();
        var UnameSupplier = $("#unamesupplier").val();
        var PaymentDate = $("#PaymentDate").val();
        var StockDate = $("#StockDate").val();
        var PaidInvoice = $("#PaidInvoice").val();
        var Typehoadon = $("#Typehoadon").val();
        var Buyer = $("#Buyer").val();
        var Dateinvoice = $("#Dateinvoice").val();
        var Trackingnumber = $("#uTracking").val();

        console.log(Invoice, TotalPrice, PurchaseCosts, TaxPurchaseCosts, UnameSupplier, PaymentDate, StockDate,
            Dateinvoice, PaidInvoice, Typehoadon);
        if ((Invoice.length > 3) && (TotalPrice.length > 3) && (Dateinvoice.length > 7) && (PaymentDate.length > 7) && (
                StockDate.length > 7)) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "invoice",
                data: {
                    Insert_Invoice: Invoice,
                    TotalPrice: TotalPrice,
                    PurchaseCosts: PurchaseCosts,
                    TaxPurchaseCosts: TaxPurchaseCosts,
                    UnameSupplier: UnameSupplier,
                    PaymentDate: PaymentDate,
                    StockDate: StockDate,
                    PaidInvoice: PaidInvoice,
                    Typehoadon: Typehoadon,
                    Buyer: Buyer,
                    Dateinvoice: Dateinvoice,
                    Trackingnumber: Trackingnumber
                },
                success: function (response) {
                    console.log(response)
                    if (response == 1) {
                        $("#ItemInvoice").html(
                            "<fieldset >" +
				"<div class='form-row' style='margin-left: 2%;margin-right: 1%;'>" +
					"<div class='col-md-2 mb-2' >" +
						"<label for='validationDefault01'>Codeorde*</label>" +
						"<input type='text' class='form-control' id='codeorder_" + JanCount + "'" +
                            "list='listcodeorder"+ JanCount + "'" +
                            " onkeyup='search_ordercode(this)' required>" +
                            "<datalist id='listcodeorder" + JanCount + "'" + "></datalist>" +
					"</div>" +
					"<div class='col-md-2 mb-2'>" +
						"<label for='validationDefault01'>Jancode*</label>" +
						"<input type='text' class='form-control' id='Jancode_" + JanCount + "'" +
                            "class='input'  onkeyup='search_jancode()' list='ujan_wh" + JanCount + "'" +
                            " required>" +
                            "<datalist id='ujan_wh" + JanCount + "'" + "></datalist>" +
					"</div>" +
					"<div class='col-md-1 mb-1'>" +
						"<label for='validationDefault01'>Số lượng*</label>" +
						"<input type='text' class='form-control' id='so_luong_" +
                            JanCount + "'" + "required>" +
					"</div>" +
					"<div class='col-md-1 mb-1'>" +
						"<label for='validationDefault01'>Đơn giá*</label>" +
						"<input type='text' class='form-control' id='don_gia_" +
                            JanCount + "'" + "required>" +
					"</div>" +
					"<div class='col-md-2 mb-2'>" +
					"<label for='validationDefault01'>% Thuế*</label>" +
						"<select type='text' class='form-control' id='thue_jancode_" + JanCount + "'" +
                            "required>" +
                            "   <option value='10'>10%</option>" +
                            "<option value='8'>8%</option>" +
                            "<option value='5'>5%</option>" +
						"</select>" +
					"</div>" +
					"<div class='col-md-1 paddbtm20'>"+

                        "<label>Thêm<span class='require'>*</span></label>" +
                                "<div>" +
                                    "<button name='add-hd' id='InsertJan_"+JanCount+"' class='btn btn-danger fh-btn' onclick='Insert_JancodeToInvoice()'>Add</button>"+
                            "</div>"+
				"</div>" +

                "<div class='col-md-1 paddbtm20' id='Add_Jancode_"+JanCount+"'>"+
                            "</div>"+
			"</fieldset>"
                        );
                    }
                }
            });
        } else
        if (Invoice.length <= 3) {
            alert("Format Invoice: 'XXXXX'");
        }
        if (TotalPrice.length < 2) {
            alert("Total Price Err");
        }
        if (PaymentDate.length < 7) {
            alert("Payment Day Err!");
        }
        if (StockDate.length < 7) {
            alert("Stock Date Err!");
        }
        if (Dateinvoice.length < 7) {
            alert("Stock Date Err!");
        }

    }

    function Insert_JancodeToInvoice() {
        var uTotalPrice = $("#uTotalPrice").val();
        var CodeorderItem = $("#codeorder_" + JanCount).val();
        var Jancode = $("#Jancode_" + JanCount).val();
        var Quantity = $("#so_luong_" + JanCount).val().replace(",", "");
        var Price = $("#don_gia_" + JanCount).val().replace(",", "");
        var PriceTax = $("#thue_jancode_" + JanCount).val();
        var Invoice = $("#uinvoice").val();

        console.log(uTotalPrice, (Quantity * Price) + TotalPrice)

        if (uTotalPrice < (Quantity * Price) + TotalPrice) {
            alert('Tổng giá cao hơn tổng tiền hóa đơn')
        } else if (uTotalPrice == (Quantity * Price) + TotalPrice) {
            alert('Chúc mừng bạn nhập thành công')
            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "invoice-detail",
                    data: {
                        CodeorderItem: CodeorderItem,
                        Jancode: Jancode,
                        Quantity: Quantity,
                        Price: Price,
                        Invoice: Invoice,
                        PriceTax: PriceTax
                    },
                    success: function (response) {
                        if (response == 1) {
                            location.reload();
                        }
                        if (response == 2) {
                            location.reload();
                        }
                    }
                });
        } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "invoice-detail",
                    data: {
                        CodeorderItem: CodeorderItem,
                        Jancode: Jancode,
                        Quantity: Quantity,
                        Price: Price,
                        Invoice: Invoice,
                        PriceTax: PriceTax
                    },
                    success: function (response) {
                        if (response == 1) {
                            $("#Add_Jancode_" + JanCount).html(
                                "<label>Nữa<span class='require'>*</span></label>" +
                                "<div>" +
                                    "<button name='add-hd' id='MoreJan_"+JanCount+"' class='btn btn-primary fh-btn' onclick='AddJancode()'>More</button>"+
                                "</div>"
                            );
                            document.getElementById("InsertJan_" + JanCount).disabled = true;

        document.getElementById("codeorder_"+JanCount).disabled = true;
        document.getElementById("Jancode_"+JanCount).disabled = true;
        document.getElementById("so_luong_"+JanCount).disabled = true;
        document.getElementById("don_gia_"+JanCount).disabled = true;
        document.getElementById("thue_jancode_"+JanCount).disabled = true;

                            TotalPrice = TotalPrice + (Quantity * Price)
                        }
                        if (response == 2) {
                            location.reload();
                        }
                    }
                });
        }
    }

    function AddJancode() {
        document.getElementById("MoreJan_" + JanCount).disabled = true;
        JanCount = JanCount + 1;
        var ItemJancode =
        "<fieldset >" +
				"<div class='form-row' style='margin-left: 2%;margin-right: 1%;'>" +
					"<div class='col-md-2 mb-2' >" +
						"<label for='validationDefault01'>Codeorde*</label>" +
						"<input type='text' class='form-control' id='codeorder_" + JanCount + "'" +
                            "list='listcodeorder"+ JanCount + "'" +
                            " onkeyup='search_ordercode(this)' required>" +
                            "<datalist id='listcodeorder" + JanCount + "'" + "></datalist>" +
					"</div>" +
					"<div class='col-md-2 mb-2'>" +
						"<label for='validationDefault01'>Jancode*</label>" +
						"<input type='text' class='form-control' id='Jancode_" + JanCount + "'" +
                            "class='input'  onkeyup='search_jancode()' list='ujan_wh" + JanCount + "'" +
                            " required>" +
                            "<datalist id='ujan_wh" + JanCount + "'" + "></datalist>" +
					"</div>" +
					"<div class='col-md-1 mb-1'>" +
						"<label for='validationDefault01'>Số lượng*</label>" +
						"<input type='text' class='form-control' id='so_luong_" +
                            JanCount + "'" + "required>" +
					"</div>" +
					"<div class='col-md-1 mb-1'>" +
						"<label for='validationDefault01'>Đơn giá*</label>" +
						"<input type='text' class='form-control' id='don_gia_" +
                            JanCount + "'" + "required>" +
					"</div>" +
					"<div class='col-md-2 mb-2'>" +
					"<label for='validationDefault01'>% Thuế*</label>" +
						"<select type='text' class='form-control' id='thue_jancode_" + JanCount + "'" +
                            "required>" +
                            "   <option value='10'>10%</option>" +
                            "<option value='8'>8%</option>" +
                            "<option value='5'>5%</option>" +
						"</select>" +
					"</div>" +
					"<div class='col-md-1 paddbtm20'>"+

                        "<label>Thêm<span class='require'>*</span></label>" +
                                "<div>" +
                                    "<button name='add-hd' id='InsertJan_"+JanCount+"' class='btn btn-danger fh-btn' onclick='Insert_JancodeToInvoice()'>Add</button>"+
                            "</div>"+
				"</div>" +

                "<div class='col-md-1 paddbtm20' id='Add_Jancode_"+JanCount+"'>"+
                            "</div>"+
			"</fieldset>";
        HTML = ItemJancode;

        document.getElementById("ItemInvoiceAdd" + JanCount).innerHTML = HTML;
    }

    function search_ordercode(obj) {
        var text = $(obj).val();
            if(text.length >3){
                $.ajax({
                type: 'GET',
                url: "list-code-order",
                data: {
                    search_ordercode: text
                },
                success: function (response) {
                    var len = response.length;
                    $("#listcodeorder"+JanCount).empty();
                    for (var i = 0; i < len; i++) {
                        var name = response[i]['codeorder'];
                        var name1 = response[i]['quantity'];
                        var name2 = response[i]['total'];

                        $("#listcodeorder"+JanCount).append("<option value='" + name + "'>" + "Quantity: " + name1 + " Total: " + name2 +
                            "</option>");

                    }
                }
            });
            };
    }

    function search_jancode(obj) {
            var text = $("#Jancode_"+JanCount).val();
                if(text.length >3){
                    $.ajax({
				type: 'GET',
				url: "list-code-jan",
				data: {
                    search_jancode: text
				},
				success: function(response) {
                    var len = response.length;
                    $("#ujan_wh"+JanCount).empty();
                for( var i = 0; i<len; i++){
                    var name = response[i]['jan_code'];
                    var name2 = response[i]['name'];

                    $("#ujan_wh"+JanCount).append("<option value='"+name+"'>"+name2+"</option>");

                }
				}
			    });
                }
        }

</script>
@endsection
