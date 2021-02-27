<div class="modal-header">
    <h4 class="modal-title">DepositID {{ $deposit }} </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<!-- Modal body -->
<div class="modal-body" style="overflow: auto">
    <form action="">
        <div class="form-row">
            <div class="col">
                <label for="">Tổng = {{ number_format($sum) }}</label>
            </div>
            <div class="col">
                <button id="addRow" type="button" style="float:right" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <table class="table table-bordered table-striped" style="margin-top: 1%; ">
            <thead>
                <tr>
                    <th>Uname</th>
                    <th>Note</th>
                    <th>date_inprice</th>
                    <th>Price In</th>
                    <th>Sohoadon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="myTable2">
                <tr class="table-secondary">
                    <td>
                        <input style="border: none" type="text" name="uname" list="litsusername"
                            onkeyup="searchUser(this)">
                        <datalist id="litsusername"></datalist>
                    </td>
                    <td>
                        <input style="border: none" type="text">
                    </td>
                    <td>
                        <input style="border: none" type="date">
                    </td>
                    <td>
                        <input style="border: none" type="text">
                    </td>
                    <td>
                        <input style="border: none" type="text">
                    </td>
                    <td>
                        <button type="button" onClick="deleteRow(this)" class="btn btn-danger"><i
                                class="fa fa-trash"></i></button>
                    </td>
                </tr>

            </tbody>
        </table>
        <div>
            <input class="float-right btn btn-primary" type="submit" value="Submit">
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
<script>
    function deleteRow(row) {
        $(row).parent().parent().remove()
    }
    $(document).ready(function() {
        function searchUser(obj) {
            var text = $(obj).val();
            if (text.length > 1) {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('commons.search-user') }}",
                    data: {
                        uname: text
                    },
                    success: function(response) {
                        var len = response.length;
                        $("#litsusername").empty();
                        for (var i = 0; i < len; i++) {
                            var name = response[i]['uname'];
                            var name1 = response[i]['fname'];

                            $("#litsusername").append("<option value='" + name + "'>" + name1 +
                                "</option>");

                        }
                    }
                });
            };
        }
        $("#addRow").click(function() {
            $("#myTable2").append(
                '<tr class="table-secondary">' +
                '<td><input style="border: none" type="text" name="uname" list="litsusername" onkeyup="searchUser(this)">' +
                '</td>' +
                '<td><input style="border: none" type="text">' +
                '</td>' +
                '<td><input style="border: none" type="date">' +
                '</td>' +
                '<td><input style="border: none" type="text">' +
                '</td>' +
                '<td><input style="border: none" type="text">' +
                '</td>' +
                '<td>' +
                '<button type="button" onClick="deleteRow(this)" class="btn btn-danger">' +
                '<i class="fa fa-trash"></i></button>' +
                '</td>' +
                '</tr>'
            )
        })

    })

</script>
