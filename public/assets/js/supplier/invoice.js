$(document).ready(function () {
    debugger;
    $("#12312312313131232312").validate({
        rules: {
            uinvoice: {
                required: true,
                maxlength: 255
            },
            Dateinvoice: {
                required: true
            },
            uTotalPrice: {
                required: true
            }
        },
        messages: {
            uinvoice: {
                required: "Xin vui lòng nhập tên!",
                minlength: "Tên quá ngắn!"
            },
            Dateinvoice: {
                required: "Xin vui lòng nhập tên tài khoản!"
            }
        }
    });
});
