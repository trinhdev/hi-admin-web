"use strict";

$(document).ready(function () {
    if ($('#status-clock').is(':checked')) {
        $('#status-clock-date-time').show();
    }
    else {
        $('#status-clock-date-time').hide();
    }

    if ($('#is-new-show').is(':checked')) {
        $('#is-new-icon-show-date-time').show();
    }
    else {
        $('#is-new-icon-show-date-time').hide();
    }

    $('#show_from').datetimepicker({
        format: "YYYY-MM-DD HH:mm",
        useCurrent: false,
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
        }
    });

    $('#show_to').datetimepicker({
        format: "YYYY-MM-DD HH:mm",
        useCurrent: false,
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
        }
    });

    $('#new_from').datetimepicker({
        format: "YYYY-MM-DD HH:mm:SS",
        useCurrent: false,
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
        }
    });

    $('#new_to').datetimepicker({
        format: "YYYY-MM-DD HH:mm:SS",
        useCurrent: false,
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
        }
    });
});

$("#show_from").on("dp.change", function (e) {
    if ($('#show_to').data("DateTimePicker") != undefined) {
        $('#show_to').data("DateTimePicker").minDate(e.date);
    }
});

$("#show_to").on("dp.change", function (e) {
    if ($('#show_from').data("DateTimePicker") != undefined) {
        $('#show_from').data("DateTimePicker").maxDate(e.date);
    }
});

$("#new_from").on("dp.change", function (e) {
    if ($('#new_to').data("DateTimePicker") != undefined) {
        $('#new_to').data("DateTimePicker").minDate(e.date);
    }
});

$("#new_to").on("dp.change", function (e) {
    if ($('#new_from').data("DateTimePicker") != undefined) {
        $('#new_from').data("DateTimePicker").maxDate(e.date);
    }
});

$('input:radio[name="isDisplay"]').change(() => {
    if ($('#status-clock').is(':checked')) {
        $('#status-clock-date-time').show();
    }
    else {
        $('#status-clock-date-time').hide();
    }
});

$('input:checkbox[name="isNew"]').change(() => {
    if ($('#is-new-show').is(':checked')) {
        $('#is-new-icon-show-date-time').show();
    }
    else {
        $('#is-new-icon-show-date-time').hide();
    }
});

function readURL(value) {
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
            // callBack(data,passingData);
            if (data.url) {
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
        html: `Bạn có chắc muốn xóa sản phẩm <span class="badge bg-warning text-dark">${prod_name}</span>?`,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Huỷ',
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Đồng ý',
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

function cancelForm(url) {
    Swal.fire({
        title: 'Đóng biểu mẫu',
        html: `Các thông tin đã nhập sẽ không được lưu?`,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Huỷ',
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Đồng ý',
        reverseButtons: true

    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

function openDetail(detailData) {
    var data = [detailData];
    $("#product-modal-body").html('');
    $('#exampleModalCenter').modal();
    $("#product-detail-template").tmpl(data).appendTo("#product-modal-body");

}

function filterStatusPheDuyet() {
    var table = $('#icon-management').DataTable();
    var statusFilterArr = [];
    var pheduyetFilterArr = [];
    $("#filter-status input[name='status']").filter(function () {
        var status = $(this).val();
        if (this.checked) {
            statusFilterArr.push(status);
        }
        else {
            // statusFilterArr.remove(status);
            statusFilterArr = $.grep(statusFilterArr, function (value) {
                return value != status;
            });
        }
    });

    $("#filter-status input[name='pheduyet']").filter(function () {
        var pheduyet = $(this).val();
        if (this.checked) {
            pheduyetFilterArr.push(pheduyet);
        }
        else {
            // statusFilterArr.remove(status);
            pheduyetFilterArr = $.grep(pheduyetFilterArr, function (value) {
                return value != pheduyet;
            });
        }
    });

    if (statusFilterArr) {
        table.column(4).search(statusFilterArr.join('|'), true);
    }
    if (pheduyetFilterArr) {
        table.column(5).search(pheduyetFilterArr.join('|'), true);
    }
    table.draw();
    $('#filter-status').modal('toggle');
}

