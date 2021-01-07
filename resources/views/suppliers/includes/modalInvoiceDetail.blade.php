<div class="modal-header">
    <h4 class="modal-title">Chi tiết hoá đơn </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<!-- Modal body -->
<div class="modal-body">
    <div class="form-row">
        <input type="text" id="idBillUpdate" value="{{$data['object']->Id}}" hidden disabled>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Số hoá đơn</label>
            <input type="text" class="form-control" value="{{ $data['object']->Invoice }}" id="numBillUpdate"
                placeholder="First name" onchange="update()">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Ngày hóa đơn</label>
            <input class="form-control" value="{{$data['object']->DateInvoice}}" type="date" id="dateBillUpdate" onchange="update()">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Tổng tiền hoá đơn</label>
            <input type="text" class="form-control" value="{{$data['object']->TotalPrice}}" id="sumBillUpdate"
                placeholder="First name" onchange="update()">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Chi phí mua hàng </label>
            <input type="text" class="form-control" value="{{$data['object']->PurchaseCosts}}" id="totalPriceBillUpdate"
                placeholder="First name" onchange="update()">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Thuế chi phí</label>
            <select type="text" class="form-control" id="taxBillUpdate" placeholder="First name" onchange="update()">
                <option value="10" {{$data['object']->TaxPurchaseCosts == 10 ? 'selected':''}}>10%</option>
                <option value="8" {{$data['object']->TaxPurchaseCosts == 8 ? 'selected':''}}>8%</option>
                <option value="5" {{$data['object']->TaxPurchaseCosts == 5 ? 'selected':''}}>5%</option>
            </select>
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Nhà cung cấp</label>
            <select type="text" class="form-control" id="supplierBillUpdate" onchange="update()">
                @foreach ($data['suppliers'] as $item)
                <option value="{{$item->code_name}}" {{$data['object']->Supplier == $item->code_name ? 'selected':''}}>
                    {{$item->name}}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="form-row">
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Hạn thanh toán</label>
            <input class="form-control" value="{{$data['object']->PaymentDate}}" type="date" id="PaymentDateBillUpdate" onchange="update()">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Ngày giao hàng</label>
            <input class="form-control" value="{{$data['object']->StockDate}}" type="date" value="2020-04-12"
                id="StockDateBillUpdate" onchange="update()">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Mã Tracking</label>
            <input type="text" class="form-control" value="{{$data['object']->TrackingNumber}}"
                id="TrackingNumberBillUpdate" placeholder="First name" onchange="update()">
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Hiện trạng hoá đơn</label>
            <select type="text" class="form-control" name="PaidInvoice" id="PaidInvoiceBillUpdate" onchange="update()">
                <option value="Paid" {{$data['object']->InvoiceStatus == 'Paid' ? 'selected':''}}>完</option>
                <option value="Unpaid" {{$data['object']->InvoiceStatus == 'Unpaid' ? 'selected':''}}>未</option>
                <option value="Cancel" {{$data['object']->InvoiceStatus == 'Cancel' ? 'selected':''}}>消</option>
            </select>
        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Loại hoá đơn</label>
            <select type="text" class="form-control" name="Typehoadon" id="TypehoadonBillUpdate" onchange="update()">
                <option value="Muahang" {{$data['object']->TypeInvoice == 'Muahang' ? 'selected':''}}>購入</option>
                <option value="TTH" {{$data['object']->TypeInvoice == 'TTH' ? 'selected':''}}>代行支払</option>
                <option value="Kinhphi" {{$data['object']->TypeInvoice == 'Kinhphi' ? 'selected':''}}>経費</option>
            </select>

        </div>
        <div class="col-md-2 mb-2">
            <label for="validationDefault01">Nhân viên</label>
            <select type="text" class="form-control" name="Buyer" id="BuyerBillUpdate" onchange="update()">
                <option value="倉山" {{$data['object']->Buyer == '倉山'? 'selected':''}}>倉山</option>
                <option value="ファム" {{$data['object']->Buyer == 'ファム'? 'selected':''}}>ファム</option>
                <option value="ダン" {{$data['object']->Buyer == 'ダン'? 'selected':''}}>ダン</option>
                <option value="タオ" {{$data['object']->Buyer == 'タオ'? 'selected':''}}>タオ</option>
                <option value="アン" {{$data['object']->Buyer == 'アン'? 'selected':''}}>アン</option>
            </select>
        </div>

    </div>
</div>
<table id="TableDetaillBillUpdate" class="table table-bordered table-striped" style="margin-top: 1%;">
    <thead>
        <tr>
            <th>Web order</th>
            <th>JanCode</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>%Thuế</th>

        </tr>
    </thead>
    <tbody id="myTable">

        @foreach ($data['object']->detail as $item => $value)
        <tr id="{{$value->Id}}">
            <td>
                <div>
                    <input type="text" class="form-control" value="{{$value->Codeorder}}" id="order_{{$value->Id}}"
                        onchange="updateDetail(this);" placeholder="First name" list='listcodeorder'
                        onkeyup='search_ordercode(this)'> <datalist id='listcodeorder'></datalist>
                </div>
            </td>
            <td>
                <div>
                    <input type="text" class="form-control" value="{{$value->Jancode}}" id="janco_{{$value->Id}}"
                        onchange="updateDetail(this);" placeholder="First name" list='ujan_wh'
                        onkeyup='search_jancode(this)'> <datalist id='ujan_wh'></datalist>
                </div>
            </td>
            <td>
                <div>
                    <input type="text" class="form-control" value="{{$value->Quantity}}" id="quant_{{$value->Id}}"
                        placeholder="First name" onchange="updateDetail(this);">
                </div>
            </td>
            </td>
            <td>
                <div>
                    <input type="text" class="form-control" value="{{$value->Price}}" id="price_{{$value->Id}}"
                        placeholder="First name" onchange="updateDetail(this);">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <select type="text" class="form-control" id="taxco_{{$value->Id}}" onchange="updateDetail(this);"
                        placeholder="First name">
                        <option value="10" {{$value->TaxPurchaseCosts == 10 ? 'selected':''}}>10%</option>
                        <option value="8" {{$value->TaxPurchaseCosts == 8 ? 'selected':''}}>8%</option>
                        <option value="5" {{$value->TaxPurchaseCosts == 5 ? 'selected':''}}>5%</option>
                    </select>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

<!-- Modal footer -->
<div class="modal-footer">
    <div style="float: right;">
        <!-- <button type="submit" class="btn btn-primary" >Load Item</button> -->
        <button type="button" class="btn btn-danger" onclick="InsertRowBillUpdate()">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
    <script>
        function update(){
            var id = $('#idBillUpdate').val();
            var invoice = $('#numBillUpdate').val();
            var date = $('#dateBillUpdate').val();
            var sum = $('#sumBillUpdate').val();
            var totalPrice = $('#totalPriceBillUpdate').val();
            var tax = $('#taxBillUpdate').val();
            var supplier = $('#supplierBillUpdate').val();
            var paymentDate = $('#PaymentDateBillUpdate').val();
            var stockDate = $('#StockDateBillUpdate').val();
            var trackingNumber = $('#TrackingNumberBillUpdate').val();
            var paidInvoce = $('#PaidInvoiceBillUpdate').val();
            var typeHoadon = $('#TypehoadonBillUpdate').val();
            var buyer = $('#BuyerBillUpdate').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PUT',
                url: "invoice/" + id,
                data: {
                    Invoice: invoice,
                    TypeInvoice: typeHoadon,
                    TotalPrice: sum,
                    PurchaseCosts: totalPrice,
                    TaxPurchaseCosts: tax,
                    InvoiceStatus: paidInvoce,
                    Supplier: supplier,
                    PaymentDate: paymentDate,
                    StockDate: stockDate,
                    DateInvoice: date,
                    Buyer: buyer,
                    TrackingNumber: trackingNumber
                },
                success: function (response) {
                    if(response == 1){
                        toastr.success('Cập nhập thành công.', 'Notifycation', {
                        timeOut: 500
                    })
                    }else{
                        alert('Tổng tiền bé hơn hoá đơn chi tiết, vui lòng xem lại!');
                    }
                }
            });
        }

        function updateDetail(item) {
            var idRaw = item.id;
            var id = idRaw.slice(6);
            var codeorder = $("#order_" + id).val();
            var jancode = $("#janco_" + id).val();
            var quantity = $("#quant_" + id).val();
            var price = $("#price_" + id).val();
            var tax = $('#taxco_' + id).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PUT',
                url: "invoice/detail/" + id,
                data: {
                    codeorder: codeorder,
                    jancode: jancode,
                    quantity: quantity,
                    price: price,
                    tax: tax
                },
                success: function (response) {
                    if(response == 1){
                        toastr.success('Cập nhập thành công.', 'Notifycation', {
                        timeOut: 500
                    })
                    }else{
                        alert('Tổng tiền lớn hơn hoá đơn, vui lòng xem lại!');
                    }
                }
            });
        }
        BillDetailCount = 0;
        total = 0;

        function Insert() {
            var table = document.getElementById("TableDetaillBillUpdate");
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            cell1.innerHTML = "<td> <div> <input type='text' class='form-control' id='codeOrderBillUpdate_" +
                BillDetailCount +
                "' list='listcodeorder' onkeyup='search_ordercode(this)' required> <datalist id='listcodeorder'></datalist> </div> </td>";
            cell2.innerHTML = "<td> <div> <input type='text' class='form-control' id='janCodeBillUpdate_" +
                BillDetailCount +
                "'list='ujan_wh' onkeyup='search_jancode(this)' required> <datalist id='ujan_wh'></datalist> </div> </td>";
            cell3.innerHTML = "<td> <div>  <input type='text' class='form-control' id='nameProductBillUpdate_" +
                BillDetailCount + "'> </input> </div> </td>";
            cell4.innerHTML = "<td> <div>  <input type='text' class='form-control' id='quantityBillUpdate_" +
                BillDetailCount + "'> </input> </div> </td>";
            cell5.innerHTML = "<td> <div>  <input type='text' class='form-control' id='priceBillUpdate_" +
                BillDetailCount + "'> </input> </div> </td>";
            cell5.innerHTML = "<td> <div>  <input type='text' class='form-control' id='priceBillUpdate_" +
                BillDetailCount + "'> </input> </div> </td>";
            cell6.innerHTML =
                "<td> <div class='form-group'> <select type='text' class='form-control' id='TaxPrurchaseCostsBillUpdate_" +
                BillDetailCount +
                "'> <option value='10'>10%</option> <option value='8'>8%</option> <option value='5'>5%</option></select> </div> </td>";
            BillDetailCount = BillDetailCount - 1;
        };

        function search_ordercode(obj) {
            var text = $(obj).val();
            if (text.length > 3) {
                $.ajax({
                    type: 'GET',
                    url: "{{route('commons.searchCodeOrder')}}",
                    data: {
                        search_ordercode: text
                    },
                    success: function (response) {
                        var len = response.length;
                        $("#listcodeorder").empty();
                        for (var i = 0; i < len; i++) {
                            var name = response[i]['codeorder'];
                            var name1 = response[i]['quantity'];
                            var name2 = response[i]['total'];

                            $("#listcodeorder").append("<option value='" + name + "'>" + "Quantity: " +
                                name1 + " Total: " + name2 +
                                "</option>");

                        }
                    }
                });
            };
        }

        function search_jancode(obj) {
            var text = $(obj).val();
            if (text.length > 3) {
                $.ajax({
                    type: 'GET',
                    url: "{{route('commons.searchCodeJan')}}",
                    data: {
                        search_jancode: text
                    },
                    success: function (response) {
                        var len = response.length;
                        $("#ujan_wh").empty();
                        for (var i = 0; i < len; i++) {
                            var name = response[i]['jan_code'];
                            var name2 = response[i]['name'];

                            $("#ujan_wh").append("<option value='" + name + "'>" + name2 + "</option>");

                        }
                    }
                });
            }
        }

    </script>
</div>
