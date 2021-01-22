@extends('layout')
@section('title', 'Hóa đơn nhà cung cấp')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Invoice Detail {{$data['object']->Invoice}}</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <input type="text" id="idBillUpdate" value="{{$data['object']->Id}}" hidden disabled>
                        <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Số hoá đơn</label>
                            <input type="text" class="form-control" value="{{ $data['object']->Invoice }}"
                                id="numBillUpdate" placeholder="First name" onchange="update()">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Ngày hóa đơn</label>
                            <input class="form-control" value="{{$data['object']->DateInvoice}}" type="date"
                                id="dateBillUpdate" onchange="update()">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Tổng tiền hoá đơn</label>
                            <input type="text" class="form-control" value="{{$data['object']->TotalPrice}}"
                                id="sumBillUpdate" placeholder="First name" onchange="update()">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Chi phí mua hàng </label>
                            <input type="text" class="form-control" value="{{$data['object']->PurchaseCosts}}"
                                id="totalPriceBillUpdate" placeholder="First name" onchange="update()">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Thuế chi phí</label>
                            <select type="text" class="form-control" id="taxBillUpdate" placeholder="First name"
                                onchange="update()">
                                <option value="10" {{$data['object']->TaxPurchaseCosts == 10 ? 'selected':''}}>10%
                                </option>
                                <option value="8" {{$data['object']->TaxPurchaseCosts == 8 ? 'selected':''}}>8%</option>
                                <option value="5" {{$data['object']->TaxPurchaseCosts == 5 ? 'selected':''}}>5%</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Nhà cung cấp</label>
                            <select type="text" class="form-control" id="supplierBillUpdate" onchange="update()">
                                @foreach ($data['suppliers'] as $item)
                                <option value="{{$item->code_name}}"
                                    {{$data['object']->Supplier == $item->code_name ? 'selected':''}}>
                                    {{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Hạn thanh toán</label>
                            <input class="form-control" value="{{$data['object']->PaymentDate}}" type="date"
                                id="PaymentDateBillUpdate" onchange="update()">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Ngày giao hàng</label>
                            <input class="form-control" value="{{$data['object']->StockDate}}" type="date"
                                value="2020-04-12" id="StockDateBillUpdate" onchange="update()">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Mã Tracking</label>
                            <input type="text" class="form-control" value="{{$data['object']->TrackingNumber}}"
                                id="TrackingNumberBillUpdate" placeholder="First name" onchange="update()">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Hiện trạng hoá đơn</label>
                            <select type="text" class="form-control" name="PaidInvoice" id="PaidInvoiceBillUpdate"
                                onchange="update()">
                                <option value="Paid" {{$data['object']->InvoiceStatus == 'Paid' ? 'selected':''}}>完
                                </option>
                                <option value="Unpaid" {{$data['object']->InvoiceStatus == 'Unpaid' ? 'selected':''}}>未
                                </option>
                                <option value="Cancel" {{$data['object']->InvoiceStatus == 'Cancel' ? 'selected':''}}>消
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Loại hoá đơn</label>
                            <select type="text" class="form-control" name="Typehoadon" id="TypehoadonBillUpdate"
                                onchange="update()">
                                <option value="Muahang" {{$data['object']->TypeInvoice == 'Muahang' ? 'selected':''}}>購入
                                </option>
                                <option value="TTH" {{$data['object']->TypeInvoice == 'TTH' ? 'selected':''}}>代行支払
                                </option>
                                <option value="Kinhphi" {{$data['object']->TypeInvoice == 'Kinhphi' ? 'selected':''}}>経費
                                </option>
                            </select>

                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Nhân viên</label>
                            <select type="text" class="form-control" name="Buyer" id="BuyerBillUpdate"
                                onchange="update()">
                                <option value="倉山" {{$data['object']->Buyer == '倉山'? 'selected':''}}>倉山</option>
                                <option value="ファム" {{$data['object']->Buyer == 'ファム'? 'selected':''}}>ファム</option>
                                <option value="ダン" {{$data['object']->Buyer == 'ダン'? 'selected':''}}>ダン</option>
                                <option value="タオ" {{$data['object']->Buyer == 'タオ'? 'selected':''}}>タオ</option>
                                <option value="アン" {{$data['object']->Buyer == 'アン'? 'selected':''}}>アン</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Tổng tiền hoá đơn</label>
                            <input type="text" class="form-control" id="totalPriceAll" disabled readonly>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Tổng tiền chi tiết</label>
                            <input type="text" class="form-control" id="totalPriceDetail" disabled readonly>
                        </div>
                    </div>

                    <table id="TableDetaillBill" class="table table-bordered table-striped" style="margin-top: 1%;">
                        <thead>
                            <tr>
                                <th>Web order</th>
                                <th>JanCode</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>%Thuế</th>
                                <th>Function</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data['object']->detail as $item => $value)
                            <tr id="{{$value->Id}}">
                                <td>
                                    <div>
                                        <input type="text" class="form-control" value="{{$value->Codeorder}}"
                                            id="order_{{$value->Id}}" onchange="updateDetail(this);"
                                            placeholder="Code order" list='listcodeorder'
                                            onkeyup='search_ordercode(this)'> <datalist id='listcodeorder'></datalist>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <input type="text" class="form-control" value="{{$value->Jancode}}"
                                            name="janco_{{$value->Id}}" id="janco_{{$value->Id}}"
                                            onchange="updateDetail(this);" placeholder="Jan code" list='ujan_wh'
                                            onkeyup='search_jancode(this)'>
                                        <datalist id='ujan_wh'></datalist>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <input type="text" class="form-control" value="{{$value->Quantity}}"
                                            id="quant_{{$value->Id}}" placeholder="Quantity"
                                            onchange="updateDetail(this);">
                                    </div>
                                </td>
                                </td>
                                <td>
                                    <div>
                                        <input type="text" class="form-control" value="{{$value->Price}}"
                                            id="price_{{$value->Id}}" placeholder="Price"
                                            onchange="updateDetail(this);">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select type="text" class="form-control" id="taxco_{{$value->Id}}"
                                            onchange="updateDetail(this);" placeholder="Tax">
                                            <option value="10" {{$value->PriceTax == 10 ? 'selected':''}}>10%
                                            </option>
                                            <option value="8" {{$value->PriceTax == 8 ? 'selected':''}}>8%
                                            </option>
                                            <option value="5" {{$value->PriceTax == 5 ? 'selected':''}}>5%
                                            </option>
                                        </select>
                                    </div>
                                </td>
                                <td><button data-id="{{$value->Id}}" type="button" class="btn btn-danger" onclick="modalConfirmDelete(this)">Xoá</button></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="col-md-2 mb-2">
                        <button class="btn btn-primary" id="btnAddMore" type="button" data-toggle="modal"
                            data-target="#modalAddMore">Add More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modalAddMore">
    <div class="modal-dialog modal-lg" style="min-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm Chi tiết hoá đơn </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <table id="TableDetaillBillUpdate" class="table table-bordered table-striped" style="margin-top: 1%;">
                <thead>
                    <tr>
                        <th>Web order</th>
                        <th>JanCode</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>%Thuế</th>
                        <th>Function</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div>
                                <input type="text" class="form-control" name="Codeorder" id="acodeorder"
                                    placeholder="Codeorder" list='listcodeorder' onkeyup='search_ordercode(this)'>
                                <datalist id='listcodeorder'></datalist>
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="text" class="form-control" name="Jancode" id="ajancode"
                                    placeholder="Jancode" list='ujan_wh' onkeyup='search_jancode(this)'> <datalist
                                    id='ujan_wh'></datalist>
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="text" class="form-control" name="Quantity" id="aquantity"
                                    placeholder="Số lượng">
                            </div>
                        </td>
                        </td>
                        <td>
                            <div>
                                <input type="text" class="form-control" name="Price" id="aprice" placeholder="Đơn giá">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <select type="text" class="form-control" name="Tax" id="atax" placeholder="First name">
                                    <option value="10">10%</option>
                                    <option value="8">8%</option>
                                    <option value="5">5%</option>
                                </select>
                            </div>
                        </td>
                        <td><button type="button" class="btn btn-primary" onclick="AddMore()">Add More</button></td>
                    </tr>

                </tbody>
            </table>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div style="float: right;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    var priceInvoice  = {{$data['priceInvoice']}};
    var priceDetail = {{$data['priceDetail']}};

    document.getElementById('totalPriceAll').value = priceInvoice;
    document.getElementById('totalPriceDetail').value = priceDetail;

    function AddMore(){
        var errors = ['Jancode', 'Quantity', 'Price', 'Tax'];
    errors.forEach(function(item, index){
            $('span[id^="'+item+'"]').remove();
        });
        var invoice = $('#numBillUpdate').val();
        var codeorder = $('#acodeorder').val();
        var jancode = $('#ajancode').val();
        var quantity = $('#aquantity').val();
        var price = $('#aprice').val();
        var tax = $('#atax').val();
        var totalPrice = quantity * price;
        if(priceInvoice >= (priceDetail + totalPrice)){
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "invoice-more-detail/" + invoice,
                data: {
                    Invoice: invoice,
                    Codeorder: codeorder,
                    Jancode: jancode,
                    Quantity: quantity,
                    Price: price,
                    PriceTax: tax
                },
                success: function (response) {
                    console.log(response);
                    var Id = response.invoiceAdd.Id;               
                    var Codeorder = '';
                    response.invoiceAdd.Codeorder != null ? Codeorder = response.invoiceAdd.Codeorder:'';
                    var Jancode = response.invoiceAdd.Jancode;
                    var Quantity = response.invoiceAdd.Quantity;
                    var Price = response.invoiceAdd.Price;
                    const totalPrice = Quantity * Price;
                    const PriceTax = response.invoiceAdd.PriceTax;
                    if(response.totalPriceInvoice > response.totalPriceInvoiceDetail){
                        document.getElementById("btnAddMore").disabled = false;
                    }else{
                        document.getElementById("btnAddMore").disabled = true;
                    }
                    document.getElementById('totalPriceAll').value = response.totalPriceInvoice;
                    document.getElementById('totalPriceDetail').value = response.totalPriceInvoiceDetail;
                    $('#TableDetaillBill tbody').append("<tr id='" +Id + "'>" +
                                "<td>" +
                                    "<div>" +
                                        "<input type='text' class='form-control' value='"+ Codeorder +"'" +
                                            "id='order_" + Id + "' onchange='updateDetail(this);'" +
                                            "placeholder='Code order' list='listcodeorder'" +
                                            "onkeyup='search_ordercode(this)'>" + 
                                            "<datalist id='listcodeorder'></datalist>" +
                                    "</div>" +
                                "</td>" +
                                "<td>" +
                                    "<div>" +
                                        "<input type='text' class='form-control' value='"+ Jancode +"'" +
                                        "name='janco_'  id='janco_" + Id + "' onchange='updateDetail(this);'" +
                                            "placeholder='Jan code' list='ujan_wh' onkeyup='search_jancode(this)'>" +
                                        "<datalist id='ujan_wh'></datalist>" +
                                    "</div>" +
                                "</td>" +
                                "<td>" +
                                    "<div>" +
                                        "<input type='text' class='form-control' value='" +Quantity+ "'" +
                                            "id='quant_" + Id + "' placeholder='Quantity'" +
                                            "onchange='updateDetail(this);'>" +
                                    "</div>" +
                                "</td>" +
                                "</td>" +
                                "<td>" +
                                    "<div>" +
                                        "<input type='text' class='form-control' value='"+ Price +"'" +
                                            "id='price_" + Id + "' placeholder='Price'" +
                                            "onchange='updateDetail(this);'>" +
                                    "</div>" +
                                "</td>" +
                                "<td>" +
                                    "<div class='form-group'>" +
                                        "<select type='text' class='form-control' id='taxco_" + Id + "'" +
                                            "onchange='updateDetail(this);' placeholder='Tax'>" +
                                            '<option value="10"' + (PriceTax == 10 ? 'selected': '') +
                                            '>10%</option>' +
                                            '<option value="8"' + (PriceTax == 8 ? 'selected': '') +
                                            '>8%</option>' +
                                            '<option value="5"' + (PriceTax == 5 ? 'selected': '') +
                                            '>5%</option>' +
                                        "</select>" +
                                    "</div>" +
                                "</td>" +
                                "<td><button data-id='"+ Id +"' type='button' class='btn btn-danger' onclick='modalConfirmDelete(this)'>Xoá</button></td>" +
                            "</tr>");
                    toastr.success('Thêm mới thành công.', 'Notifycation', {
                        timeOut: 500
                    });
                    setTimeout(function(){
                        $('#modalAddMore').modal('hide');
                    document.getElementById('acodeorder').value = '';
                    document.getElementById('ajancode').value = '';
                    document.getElementById('aquantity').value = '';
                    document.getElementById('aprice').value = '';
                    document.getElementById('atax').value = '10';
                    },800); 
                },
                error:function (response){
                    console.log(response)
                    $.each(response.responseJSON.errors,function(field_name,error){
                        $(document).find('[name='+field_name+']').after('<span class="alert-danger-custom" id="'+field_name+'">' +error+ '</span>');
                    })
                }
            });
        }else{
            alert('Tổng chi tiền chi tiết lớn hơn tổng tiền hoá đơn, vui lòng thử lại!')
        }
    }

    if(priceInvoice > priceDetail){
        document.getElementById("btnAddMore").disabled = false;
    }else{
        document.getElementById("btnAddMore").disabled = true;
    }
    function update() {
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
            url: "" + id,
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
                if (response[0] == 1) {
                    priceInvoice = response[1];
                    priceDetail = response[2];
                    if(priceInvoice > priceDetail){
        document.getElementById("btnAddMore").disabled = false;
    }else{
        document.getElementById("btnAddMore").disabled = true;
    }
    document.getElementById('totalPriceAll').value = priceInvoice;
    document.getElementById('totalPriceDetail').value = priceDetail;
                    toastr.success('Cập nhập thành công.', 'Notifycation', {
                        timeOut: 500
                    })
                } else {
                    alert('Tổng tiền bé hơn hoá đơn chi tiết, vui lòng xem lại!');
                }
            },error:function (response){
                    console.log(response)
                    $.each(response.responseJSON.errors,function(field_name,error){
                        $(document).find('[name='+field_name+']').after('<span class="alert-danger-custom" id="'+field_name+'">' +error+ '</span>');
                    })
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
        var invoice = $('#numBillUpdate').val();
        $('span[id^="janco_'+id+'"]').remove();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'PUT',
            url: "detail/" + id,
            data: {
                Id: id,
                Invoice: invoice,
                codeorder: codeorder,
                Jancode: jancode,
                quantity: quantity,
                price: price,
                tax: tax
            },
            success: function (response) {
                if (response[0] == 1) {
                    priceDetail = response[1];
                    if(priceInvoice > priceDetail){
                    document.getElementById("btnAddMore").disabled = false;
                    }else{
                        document.getElementById("btnAddMore").disabled = true;
                    }
                    document.getElementById('totalPriceAll').value = priceInvoice;
                    document.getElementById('totalPriceDetail').value = priceDetail;
                    toastr.success('Cập nhập thành công.', 'Notifycation', {
                        timeOut: 500
                    })
                } else if(response[0] == 2){
                    alert('Tổng tiền lớn hơn hoá đơn, vui lòng xem lại!');
                }
            },error:function (response){
                var message = response.responseJSON.errors.Jancode;
                        $(document).find('[name=janco_'+id+']').after('<span class="alert-danger-custom" id="janco_'+id+'">' +message+ '</span>');
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

       

function modalConfirmDelete(event){
    const Id = $(event).data('id');
    Swal.fire({
        title: 'Bạn có chắc không?',
        text: "Thao tác này không thể hoàn lại!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có, đồng ý xoá!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Thông báo!',
                'Xoá thành công.',
                'success'
            ).then(
                $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'DELETE',
            url: "/suppliers/invoice/delete-detail/" + Id,
            success: function (response) {
                if (response[0] == 5) {
                    const quantity = response[1].Quantity;
                    const price = response[1].Price;
                    const totalPrice = quantity * price;
                    priceDetail = response[2];
                    document.getElementById('totalPriceDetail').value = response[2];
                    if(priceInvoice > priceDetail){
                        document.getElementById("btnAddMore").disabled = false;
                    }else{
                        document.getElementById("btnAddMore").disabled = true;
                    }
                    $("#"+ Id).remove();
                }
            }
        })
            );
        }
        })
}

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
@endsection