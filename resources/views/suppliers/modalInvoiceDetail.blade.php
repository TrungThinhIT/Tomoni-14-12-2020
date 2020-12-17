<div class="modal-header">
    <h4 class="modal-title">Chi tiết hoá đơn </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
  </div>

  <!-- Modal body -->
  <div class="modal-body">
      <div class="form-row" >
          <div class="col-md-2 mb-2" >
              <label for="validationDefault01">Số hoá đơn</label>
              <input type="text" class="form-control" value="{{ $data['object']->Invoice }}" id="numBillUpdate" placeholder="First name"  required>
          </div>
          <div class="col-md-2 mb-2">
              <label for="validationDefault01">Ngày hóa đơn</label>
              <input class="form-control" value="{{$data['object']->DateInvoice}}" type="date"  id="dateBillUpdate">
          </div>
          <div class="col-md-2 mb-2">
              <label for="validationDefault01">Tổng tiền hoá đơn</label>
              <input type="text" class="form-control" value="{{$data['object']->TotalPrice}}" id="sumBillUpdate" placeholder="First name"  required>
          </div>
          <div class="col-md-2 mb-2">
              <label for="validationDefault01">Chi phí mua hàng </label>
              <input type="text" class="form-control" value="{{$data['object']->PurchaseCosts}}" id="totalPriceBillUpdate" placeholder="First name"  required>
          </div>
          <div class="col-md-2 mb-2">
              <label for="validationDefault01">Thuế chi phí</label>
              <select type="text" class="form-control" id="taxBillUpdate" placeholder="First name"  required >
                <option value="10" {{$data['object']->TaxPurchaseCosts == 10 ? 'selected':''}}>10%</option>
                <option value="8" {{$data['object']->TaxPurchaseCosts == 8 ? 'selected':''}}>8%</option>
                <option value="5" {{$data['object']->TaxPurchaseCosts == 5 ? 'selected':''}}>5%</option>
              </select>
          </div>
          <div class="col-md-2 mb-2">
              <label for="validationDefault01">Nhà cung cấp</label>
              <select type="text" class="form-control" id="supplierBillUpdate">
                @foreach ($data['suppliers'] as $item)
                <option value="{{$item->code_name}}" {{$data['object']->Supplier == $item->code_name ? 'selected':''}}>{{$item->name}}</option>
                @endforeach
            </select>
          </div>

      </div>
      <div class="form-row" >
          <div class="col-md-2 mb-2" >
              <label for="validationDefault01">Hạn thanh toán</label>
              <input class="form-control" value="{{$data['object']->PaymentDate}}" type="date"  id="PaymentDateBillUpdate">
          </div>
          <div class="col-md-2 mb-2">
              <label for="validationDefault01">Ngày giao hàng</label>
              <input class="form-control" value="{{$data['object']->StockDate}}" type="date" value="2020-04-12" id="StockDateBillUpdate">
          </div>
          <div class="col-md-2 mb-2">
              <label for="validationDefault01">Mã Tracking</label>
              <input type="text" class="form-control" value="{{$data['object']->TrackingNumber}}" id="TrackingNumberBillUpdate" placeholder="First name"  required>
          </div>
          <div class="col-md-2 mb-2">
              <label for="validationDefault01">Hiện trạng hoá đơn</label>
              <select type="text" class="form-control" name="PaidInvoice" id="PaidInvoiceBillUpdate">
                <option value="Paid" {{$data['object']->InvoiceStatus == 'Paid' ? 'selected':''}}>完</option>
                <option value="Unpaid" {{$data['object']->InvoiceStatus == 'Unpaid' ? 'selected':''}}>未</option>
                <option value="Cancel" {{$data['object']->InvoiceStatus == 'Cancel' ? 'selected':''}}>消</option>
            </select>
          </div>
          <div class="col-md-2 mb-2">
              <label for="validationDefault01">Loại hoá đơn</label>
              <select type="text" class="form-control" name="Typehoadon" id="TypehoadonBillUpdate">
                <option value="Muahang" {{$data['object']->TypeInvoice == 'Muahang' ? 'selected':''}}>購入</option>
                <option value="TTH" {{$data['object']->TypeInvoice == 'TTH' ? 'selected':''}}>代行支払</option>
                <option value="Kinhphi" {{$data['object']->TypeInvoice == 'Kinhphi' ? 'selected':''}}>経費</option>
            </select>

          </div>
          <div class="col-md-2 mb-2">
              <label for="validationDefault01">Nhân viên</label>
              <select type="text" class="form-control" name="Buyer" id="BuyerBillUpdate">
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
        <tr>
            <td>
              <div  >
                  <input type="text" class="form-control" value="{{$value->Codeorder}}" id="codeOrderBillUpdate_{{$value->Id}}" placeholder="First name" list='listcodeorder' onkeyup='search_ordercode(this)' required> <datalist id='listcodeorder'></datalist>
              </div>
            </td>
            <td>
              <div  >
                  <input type="text" class="form-control" value="{{$value->Jancode}}" id="janCodeBillUpdate_{{$value->Id}}" placeholder="First name"  list='ujan_wh' onkeyup='search_jancode(this)' required> <datalist id='ujan_wh'></datalist>
              </div>
            </td>
              <td>
                  <div  >
                      <input type="text" class="form-control" value="{{$value->Quantity}}" id="quantityBillUpdate_{{$value->Id}}" placeholder="First name"  required onchange = "UpdateInfoModalQuantity()">
                  </div>
              </td>
              </td>
              <td>
                  <div  >
                      <input type="text" class="form-control" value="{{$value->Price}}" id="priceBillUpdate_{{$value->Id}}" placeholder="First name" required onchange = "UpdateInfoModalDG()">
                  </div>
                </td>
                <td>
          <div class="form-group">
            <select type="text" class="form-control" id="TaxPrurchaseCostsBillUpdate_{{$value->Id}}" placeholder="First name"  required >
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
      <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
    </div>
    <script>
        BillDetailCount = 0;
        total = 0;

        function InsertRowBillUpdate(){
            total = "{{$data['total']}}";
            alert(total)
        }

        function Insert() {
          var table = document.getElementById("TableDetaillBillUpdate");
          var row = table.insertRow(-1);
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          var cell4 = row.insertCell(3);
          var cell5 = row.insertCell(4);
          var cell6 = row.insertCell(5);
          cell1.innerHTML = "<td> <div> <input type='text' class='form-control' id='codeOrderBillUpdate_" + BillDetailCount +
                            "' list='listcodeorder' onkeyup='search_ordercode(this)' required> <datalist id='listcodeorder'></datalist> </div> </td>";
          cell2.innerHTML = "<td> <div> <input type='text' class='form-control' id='janCodeBillUpdate_"+ BillDetailCount + "'list='ujan_wh' onkeyup='search_jancode(this)' required> <datalist id='ujan_wh'></datalist> </div> </td>";
          cell3.innerHTML = "<td> <div>  <input type='text' class='form-control' id='nameProductBillUpdate_"+BillDetailCount+"'> </input> </div> </td>";
          cell4.innerHTML = "<td> <div>  <input type='text' class='form-control' id='quantityBillUpdate_"+BillDetailCount+"'> </input> </div> </td>";
          cell5.innerHTML = "<td> <div>  <input type='text' class='form-control' id='priceBillUpdate_"+BillDetailCount+"'> </input> </div> </td>";
          cell5.innerHTML = "<td> <div>  <input type='text' class='form-control' id='priceBillUpdate_"+BillDetailCount+"'> </input> </div> </td>";
          cell6.innerHTML = "<td> <div class='form-group'> <select type='text' class='form-control' id='TaxPrurchaseCostsBillUpdate_"+BillDetailCount+"'> <option value='10'>10%</option> <option value='8'>8%</option> <option value='5'>5%</option></select> </div> </td>";
          BillDetailCount = BillDetailCount -1;
        };

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
                    $("#listcodeorder" + BillDetailCount).empty();
                    for (var i = 0; i < len; i++) {
                        var name = response[i]['codeorder'];

                        $("#listcodeorder").append("<option value='" + name + "'>" + name +
                            "</option>");

                    }
                }
            });
            };
    }

    function search_jancode(obj) {
            var text = $(obj).val();
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

                    $("#ujan_wh").append("<option value='"+name+"'>"+name+"</option>");

                }
				}
			    });
                }
        }
        </script>
  </div>
