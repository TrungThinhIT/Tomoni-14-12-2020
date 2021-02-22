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
                  <form action="{{route('supplier.payment.create')}}" method="POST">
                    @csrf
                    <fieldset >
                        <div class="form-row" style="margin-left: 2%; margin-top: 1%; margin-right: 1%;">
                            <div class="col-md-2 mb-2" >
                                <label for="validationDefault01">depositID</label>
                                <input type="text" value="{{ old('depositID') }}" class="form-control" id="depositID" name="depositID" placeholder="deposit ID"  >
                                <span class="alert-danger-custom">{{$errors->first('depositID')}}</span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">SupplierId</label>
                                <select name="SupplierId" id="SupplierId" class="form-control">
                                    @foreach ($data['suppliers'] as $item)
                                    <option value="{{$item->code_name}}"{{ old('SupplierId') == $item->code_name ? 'selected':'' }}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <span class="alert-danger-custom">{{$errors->first('SupplierId')}}</span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">dateget</label>
                                <input type="date" value="{{ old('dateget') }}" class="form-control" id="dateget" name="dateget" placeholder="Date get"  >
                                <span class="alert-danger-custom">{{$errors->first('dateget')}}</span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">date_insert</label>
                                <input type="date" value="{{ old('date_insert') }}" class="form-control" name="date_insert" id="date_insert" placeholder="date_insert"  >
                                <span class="alert-danger-custom">{{$errors->first('date_insert')}}</span>
                            </div>
                            <div class="col-md-2 mb-2" >
                                <label for="validationDefault01">price_in</label>
                                <input type="text" value="{{ old('price_in') }}" class="form-control" name="price_in" id="price_in" placeholder="price_in"  >
                                <span class="alert-danger-custom">{{$errors->first('price_in')}}</span>
                            </div>
                            <div class="col-md-2 mb-2" >
                                <label for="validationDefault01">price_out</label>
                                <input type="text" value="{{ old('price_out') }}" class="form-control" name="price_out" id="price_out" placeholder="price_out"  >
                                <span class="alert-danger-custom">{{$errors->first('price_out')}}</span>
                            </div>

                        </div>
                        <div class="form-row" style="margin-left: 2%; margin-top: 1%;">
                            <div class="col-md-2 mb-2" >
                                <label for="validationDefault01">type_price</label>
                                <input type="text" value="{{ old('type_price') }}" class="form-control" id="type_price" name="type_price" placeholder="Type price" >
                                <span class="alert-danger-custom">{{$errors->first('type_price')}}</span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">cardID</label>
                                <input type="text" value="{{ old('cardID') }}" class="form-control" id="cardID" name="cardID" placeholder="cardID"  >
                                <span class="alert-danger-custom">{{$errors->first('cardID')}}</span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">note</label>
                                <input type="text" value="{{ old('note') }}" class="form-control" id="note" name="note" placeholder="Note"  >
                                <span class="alert-danger-custom">{{$errors->first('note')}}</span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="validationDefault01">useradmin</label>
                                <input type="text" value="{{ old('useradmin') }}" class="form-control" id="useradmin" list="listUser" onkeyup="searchUser(this)" name="useradmin" placeholder="useradmin"  >
                                <span class="alert-danger-custom">{{$errors->first('useradmin')}}</span>
                                <datalist id="listUser"></datalist>
                            </div>
                            <div class="col-md-2 mb-2">
                              <label for="validationDefault01">Sohoadon</label>
                              <input type="text" value="{{ old('Sohoadon') }}" class="form-control" id="Sohoadon" name="Sohoadon" placeholder="Sohoadon" list="abcxyz" onkeyup="findBillCode(this)">
                                <datalist id="abcxyz"></datalist>
                              <span class="alert-danger-custom">{{$errors->first('Sohoadon')}}</span>
                          </div>
                            <div class="col-md-2 mb-2" style="margin-top: 1%;">
                                <!-- <label for="validationDefault01">Hiện trạng hoá đơn</label> -->
                                <button type="submit" class="btn btn-primary" >Add supplier</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                  <div>
                      <div style="margin: 1% 1% 1% 1%;">
                          <form action="{{route('supplier.payment.index')}}">
                              <fieldset>
                                  <div class="form-row" style=" margin-top: 1%;">
                                      <div>
                                        <select name="sSupplierId" id="sSupplierId" class="form-control">
                                            @foreach ($data['suppliers'] as $item)
                                            <option value="{{$item->code_name}}" {{$data['sSupplierId'] == $item->code_name ? 'selected':''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                      <div>
                                          <input class="form-control" value="{{$data['date_inprice']}}" type="date" name="date_inprice" id="sdate_inprice">
                                      </div>
                                      <div>
                                          <input class="form-control" value="{{$data['date_insert']}}" type="date" name="date_insert" id="sdate_insert">
                                      </div>
                                      <div>
                                          <input class="form-control" value="{{$data['Sohoadon']}}" type="text" name="Sohoadon" id="sSohoadon" placeholder="Số hóa đơn">
                                      </div>
                                      <div>
                                          <button type="submit" class="btn btn-primary" style="margin-left: 2%;">Search</button>
                                      </div>
                                      <div>
                                          <button type="button" onclick="resetFormSearch()" class="btn btn-info ml-2" style="margin-left: 2%;">Reset</button>
                                          <script>
                                              function resetFormSearch() {
                                                $('#sSupplierId').val('');
                                                $('#sdate_inprice').val('');
                                                $('#sdate_insert').val('');
                                                $('#sSohoadon').val('');
                                              }
                                          </script>
                                      </div>
                                  </div>
                              </fieldset>
                          </form>
                          <div style="float: right" class="mt-3">
                              {!! $data['payments']->withQueryString()->links('commons.paginate') !!}</div>
                          <table class="table table-bordered table-striped" style="margin-top: 1%;">
                              <thead>
                                  <tr>
                                      <th>DepositID</th>
                                      <th style="min-width: 200px;">SupplierId</th>
                                      <th style="min-width: 200px;">Note</th>
                                      <th>date_inprice</th>
                                      <th>date_insert</th>
                                      <th>Price In</th>
                                      <th>Sohoadon</th>
                                      <th>Function</th>
                                  </tr>
                              </thead>
                              <tbody id="myTable">
                                  @foreach ($data['payments'] as $item)
                                  <tr>
                                      <td>{{$item->depositID}}</td>
                                      <td>
                                          <div>
                                              <input type="text" class="form-control" id="supplierId{{$item->Id}}"
                                                  value="{{$item->SupplierId}}" onchange="update{{$item->Id}}()"
                                                  placeholder="User name" list="listsupplier" onkeyup='searchSupplier(this)'> <datalist id='listsupplier'></datalist>
                                          </div>
                                      </td>
                                      <td>{{$item->note}}</td>
                                      <td>{{$item->dateget}}</td>
                                      <td>{{$item->date_insert}}</td>
                                      <td>{{number_format($item->price_in, 0)}}</td>
                                      <td>
                                          <div>
                                              <input type="text" class="form-control" id="shd{{$item->Id}}"
                                                  value="{{$item->Sohoadon}}" onchange="update{{$item->Id}}()"
                                                  placeholder="So hoa don" list="listinvoice" onkeyup='searchInvoice(this)'> <datalist id='listinvoice'></datalist>
                                          </div>
                                      </td>
                                      <td>
                                          <a type="button" href="{{route('supplier.payment.delete', $item->Id)}}" onclick="return confirm('are you sure?')" class="btn btn-danger px-3"><i class="fa fa-times"
                                                  aria-hidden="true"></i></a>
                                      </td>
                                  </tr>
                                  <script>
                                      function update{{$item->Id}}() {
                                          var id = {{$item->Id}};
                                          var supplierId = $("#supplierId{{$item->Id}}").val();
                                          var shd = $("#shd{{$item->Id}}").val();
                                          $.ajax({
                                              headers: {
                                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                              },
                                              type: 'PUT',
                                              url: "payment/" + id,
                                              data: {
                                                SupplierId: supplierId,
                                                  Sohoadon: shd
                                              },
                                              success: function (response) {
                                                  toastr.success('Cập nhập thành công.', 'Notifycation', {timeOut: 1000})
                                              }
                                          });
                                      }
                                  </script>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>

</div>
<script>
    function searchSupplier(obj) {
                var supplier = obj.value;
                if(supplier.length > 1){
                    $.ajax({
				type: 'GET',
				url: "{{route('commons.searchSupplier')}}",
				data: {
                    supplier: supplier
				},
				success: function(response) {
                    var len = response.length;
                    $("#listsupplier").empty();
                for( var i = 0; i<len; i++){
                    var name = response[i]['code_name'];
                    var name2 = response[i]['name'];

                    $("#listsupplier").append("<option value='"+name+"'>"+name2+"</option>");

                }
				}
			    });
                }
        }
        function findBillCode(obj){
            var billcode = obj.value;
            if(billcode.length >=2){
                $.ajax({
                    type:"GET",
                    url:"{{route('commons.searchBillCodeSuplier')}}",
                    data:{  
                        BillCode:billcode
                    },
                    success:function(list){
                        $("#abcxyz").empty()
                        $.each(list,function(index,value){
                            $("#abcxyz").append(new Option(value.Supplier,value.Invoice))
                        })
                    },error:function(a){
                        console.log(a)
                    }
                })
            }

        }
    function searchInvoice(obj) {
                var invoice = obj.value;
                if(invoice.length > 1){
                    $.ajax({
				type: 'GET',
				url: "{{route('commons.searchInvoice')}}",
				data: {
                    invoice: invoice
				},
				success: function(response) {
                    var len = response.length;
                    $("#listinvoice").empty();
                for( var i = 0; i<len; i++){
                    var name = response[i]['Invoice'];
                    var name2 = response[i]['TotalPrice'];
                    var name3 = response[i]['Buyer'];

                    $("#listinvoice").append("<option value='"+name+"'>"+name2+" "+name3+"</option>");

                }
				}
			    });
                }
        }
        function searchUser(obj){
            var user = obj.value;
            if(user.length>=2){
                $.ajax({
                    type:"GET",
                    url:"{{route('commons.search-user')}}",
                    data: {
                        uname:user
                    },
                    success:function(response){
                        $("#listUser").empty();
                        $.each(response,function(index,value){
                            $("#listUser").append(new Option(value.Id,value.uname))
                        })
                    },error:function(error){
                        console.log(error)
                    }
                })
            }
        }
</script>
@endsection
