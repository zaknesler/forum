$(function() {
    function swalConfirmSubmit(element)
    {
        $(element).on('submit', function (e) {
            e.preventDefault();
            swal({
                title: "Are you sure?",
                type: "warning",
                showCancelButton: true,
                closeOnCancel: true,
                closeOnConfirm: true,
                confirmButtonColor: "#3498db",
                cancelButtonColor: "#95a5a6"
            }, function(isConfirm) {
                if (isConfirm) {
                    $(element).unbind().submit();
                }
            });
        });
    }

    function swalConfirmClick(element)
    {
        $(element).on('click', function (e) {
            e.preventDefault();
            swal({
                title: "Are you sure?",
                type: "warning",
                showCancelButton: true,
                closeOnCancel: true,
                closeOnConfirm: true,
                confirmButtonColor: "#3498db",
                cancelButtonColor: "#95a5a6"
            }, function(isConfirm) {
                if (isConfirm) {
                    $(element).unbind().click();
                }
            });
        });
    }

    swalConfirmSubmit("#swal-confirm-submit");
    swalConfirmClick("#swal-confirm-click");
});
