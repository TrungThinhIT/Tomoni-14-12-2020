<div class="modal-header">
    <h4 class="modal-title">DepositID {{ $deposit }} </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<!-- Modal body -->
<div class="modal-body" style="overflow: auto">
    <form action="">
        <div>
            Tổng = {{ number_format($sum) }}
        </div>
        <table class="table table-bordered table-striped" style="margin-top: 1%; ">
            <thead>
                <tr>
                    <th>Uname</th>
                    <th>Note</th>
                    <th>date_inprice</th>
                    <th>Price In</th>
                    <th>Sohoadon</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <tr>
                    <td>
                        <input style="border: none" type="text">
                    </td>
                    <td>
                        <input style="border: none" type="text">
                    </td>
                    <td>
                        <input style="border: none" type="text">
                    </td>
                    <td>
                        <input style="border: none" type="text">
                    </td>
                </tr>

            </tbody>
        </table>
        <div>
            <input class="btn btn-primary" type="submit" value="Submit">
        </div>
    </form>
</div>
</div>
<!-- Modal footer -->
<div class="modal-footer">
    <div style="float: right;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
