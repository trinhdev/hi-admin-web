"use strict";

$( document ).ready(function() {
    if($('#status-clock').is(':checked')) {
        $('#status-clock-date-time').show();
    }
    else {
        $('#status-clock-date-time').hide();
    }

    if($('#is-new-show').is(':checked')) {
        $('#is-new-icon-show-date-time').show();
    }
    else {
        $('#is-new-icon-show-date-time').hide();
    }

    const today = new Date();
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1)

    var show_from = $('#show_from').val() != "" ? new Date($('#show_from').val()) : false;
    var show_to = $('#show_to').val() != "" ? new Date($('#show_to').val()) : false;

    var show_from_picker = $('#show_from').datetimepicker({
        // date: moment(),
        format: "YYYY-MM-DD HH:mm",
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        },
        minDate: new Date(),
        maxDate: show_to,
        // useCurrent: true,
    }).data('DateTimePicker').date(today);

    var show_to_picker = $('#show_to').datetimepicker({
        format: "YYYY-MM-DD HH:mm",
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        },
        useCurrent: false,
        minDate: show_from
    }).data('DateTimePicker').date(tomorrow);

    var new_from = $('#new_from').val() != "" ? new Date($('#new_from').val()) : false;
    var new_to = $('#new_to').val() != "" ? new Date($('#new_to').val()) : false;

    $('#new_from').datetimepicker({
        format: "YYYY-MM-DD HH:mm:SS",
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        },
        minDate: new Date(),
        maxDate: new_to,
        defaultDate: new Date()
    });

    $('#new_to').datetimepicker({
        format: "YYYY-MM-DD HH:mm:SS",
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        },
        useCurrent: false,
        minDate: new_from,
        // date: new_to
    });
});

// $("#show_from").on("dp.change", function (e) {
//     show_to_picker.minDate(e.date);
// });      

// $("#show_to").on("dp.change", function (e) {
//     show_from_picker.maxDate(e.date);
// });

$("#new_from").on("dp.change", function (e) {
    $('#new_to').data("DateTimePicker").minDate(e.date);
});      

$("#new_to").on("dp.change", function (e) {
    $('#new_from').data("DateTimePicker").maxDate(e.date);
});

$('input:radio[name="isDisplay"]').change(() => {
    if($('#status-clock').is(':checked')) {
        $('#status-clock-date-time').show();
    }
    else {
        $('#status-clock-date-time').hide();
    } 
});

$('input:checkbox[name="isNew"]').change(() => {
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

