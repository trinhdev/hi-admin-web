"use strict";

$('input:radio[name="status"]').change(() => {
    if($('#status-clock').is(':checked')) {
        $('#status-clock-date-time').show();
    }
    else {
        $('#status-clock-date-time').hide();
    } 
});

$('input:checkbox[name="is_new_show"]').change(() => {
    if($('#is-new-show').is(':checked')) {
        $('#is-new-icon-show-date-time').show();
    }
    else {
        $('#is-new-icon-show-date-time').hide();
    } 
});

function readURL(value) {
    // console.log(value.val());
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var files = $(value)[0].files[0];
    var formData = new FormData();
    formData.append("file", files, files.name);
    $.ajax({
        type: 'POST',
        // datatype: 'JSON',
        url: '/iconmanagement/upload',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            console.log(data);
            // callBack(data,passingData);
            if(data.url) {
                $("#img_icon").attr('src', '/images/upload/' + data.url);
            }
        },
        error: function (xhr) {
            var errorString = '';
            $.each(xhr.responseJSON.errors, function (key, value) {
                errorString = value;
                return false;
            });
            showError(errorString);
        }
    });
}

function deleteProduct(prod_name) {
    Swal.fire({
        title: 'Xóa sản phẩm',
        text: `Bạn có chắc muốn xóa sản phẩm ${prod_name}?`,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Confirmed!',
        reverseButtons: true

    }).then((result) => {
        if (result.isConfirmed) {
            // form.submit();
            // let submitBtn = $(form).closest('form').find('button').append('&ensp;<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
            // $('form').find(':button').prop('disabled', true);
            // $("#spinner").addClass("show");
        }
    });
}

function openDetail(detailData) {
    console.log(detailData);
    var data = [detailData];
    $("#product-modal-body").html('');
    $('#exampleModalCenter').modal();
    $("#product-detail-template").tmpl(data).appendTo("#product-modal-body");
    
}

