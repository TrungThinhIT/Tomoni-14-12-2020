@extends('layout')
@section('title', 'Nhà cung cấp trả lại tiền')
@section('content')
<div class="main-panel">
    <div class="content content-documentation">
        <div class="container-fluid">
            <div class="card card-documentation">
                <div class="card-header bg-info-gradient text-white bubble-shadow">
                    <h4>Supplier trả tiền</h4>
                    <!-- <p class="mb-0 op-8">Documentation and examples for Bootstrap’s powerful, responsive navigation header, the navbar. Includes support for branding, navigation, and more, including support for our collapse plugin.</p> -->
                </div>
                <div class="card-body">
                    <div>
                        <div style="margin: 1% 1% 1% 1%;">
                            <form>
                                <fieldset >
                                    <div class="form-row" style=" margin-top: 1%;">
                                        <div >
                                            <input class="form-control" type="date"  id="dateInput">
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary" style="margin-left: 2%;" onclick="SearchTienThanhToan()">View</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                            <table class="table table-bordered table-striped" style="margin-top: 1%;">
                              <thead>
                                <tr>
                                  <th>DepositID</th>
                                  <th>Date</th>
                                  <th>Card</th>
                                  <th>Uname</th>
                                  <th>Price In</th>
                                  <th>Prince Out</th>
                                  <th>Type</th>
                                  <th>Note</th>
                                  <th>Del</th>

                                </tr>
                              </thead>
                              <tbody id="myTable">
                                <tr>
                                  <td>20-11-2020</td>
                                  <td>123</td>
                                  <td>paid</td>
                                  <td>
                                    <div  >
                                        <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Saiko"  required>
                                    </div>
                                  </td>
                                  <td>Doe</td>
                                  <td>ABC</td>
                                  <td>
                                    <div class="form-group">
                                        <select class="form-control" id="exampleFormControlSelect1">
                                          <option>1</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                        </select>
                                      </div>
                                 </td>
                                  <td>10000</td>
                                  <td>
                                    <button type="button" class="btn btn-danger px-3"><i class="fa fa-times" aria-hidden="true"></i></button>
                                  </td>
                                </tr>
                                <tr>
                                    <td>20-11-2020</td>
                                    <td>123</td>
                                    <td>paid</td>
                                    <td>
                                        <div  >
                                            <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Saiko"  required>
                                        </div>
                                      </td>
                                    <td>Doe</td>
                                    <td>ABC</td>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control" id="exampleFormControlSelect1">
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                            </select>
                                          </div>
                                     </td>
                                    <td>10000</td>
                                    <td>
                                        <button type="button" class="btn btn-danger px-3"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </td>

                                  </tr>
                                  <tr>
                                    <td>20-11-2020</td>
                                    <td>123</td>
                                    <td>paid</td>
                                    <td>
                                        <div  >
                                            <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="DT3" required>
                                        </div>
                                      </td>
                                    <td>Doe</td>
                                    <td>ABC</td>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control" id="exampleFormControlSelect1">
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                            </select>
                                          </div>
                                     </td>
                                    <td>10000</td>
                                    <td>
                                        <button type="button" class="btn btn-danger px-3"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </td>

                                  </tr>
                                  <tr>
                                    <td>20-11-2020</td>
                                    <td>123</td>
                                    <td>paid</td>
                                    <td>
                                        <div  >
                                            <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="DT3" required>
                                        </div>
                                      </td>
                                    <td>Doe</td>
                                    <td>ABC</td>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control" id="exampleFormControlSelect1">
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                            </select>
                                          </div>
                                     </td>
                                    <td>10000</td>
                                    <td>
                                        <button type="button" class="btn btn-danger px-3"><i class="fa fa-times" aria-hidden="true"></i></button>
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

</div>
@endsection
