function closeRequest(_this) {
    let li_tag = $(_this).closest("li");
    let _report_id = $(li_tag).attr('id')
    let _token = $('meta[name="csrf-token"]').attr('content');
    param = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        report_id: _report_id
    };
    callAPIHelper("/closehelprequest/closeRequest", param, 'POST', successChangePassword);
}

function successCloseRequest(response) {
    if (response == true) {
        $(li_tag).remove();
        swal.fire({
            icon: 'success',
            title: 'Success!',
            html: `Close Success!`
        });
    } else {
        swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: `Close Fail!`
        });
    }
};
