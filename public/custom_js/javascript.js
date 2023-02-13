'use strict';

$(document).ready(function () {
    // $('#sidebar').sortable({
    //     axis: "y",
    // });
    // $(document).pjax('a', '#pjax');
    // $('aside li.nav-item a').on('click', function (e) {
    //     if ($(this).attr('href') != '#') {
    //         $('aside').find(".menu-open > .nav-treeview").not($(this).parents('.menu-open > .nav-treeview')).slideUp()
    //         $('aside').find(".menu-open").not($(this).parents('.menu-open')).removeClass("menu-is-opening menu-open");
    //         $('li a').removeClass("active");
    //         $(this).addClass("active");
    //     }
    //     $(this).parents('.nav-treeview').prevAll('.nav-link').addClass('active');

    // });
    var moduleActive = document.querySelector('aside .active');
    var parentModuleActive = moduleActive.parentNode.parentNode.parentNode;
    if (parentModuleActive.classList.contains('menu')) { // if parent module is menu
        parentModuleActive.classList.add('menu-open');
        parentModuleActive.querySelector('.nav-link').classList.add('active');
    }
    // document.querySelector('.active').closest('.nav-item menu > li').classList.add('is-active');
    // reloadPjax();
});

function reloadPjax() {
    const pathArray = window.location.pathname.split("/");
    let segment2 = pathArray[2];
    if (segment2 == undefined) {
        $.pjax.reload('#pjax');
    }

}

function handleSubmit(e, form, withPopup = true) {
    e.preventDefault();
    if (withPopup) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Please Confirm This Action",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, Confirmed!',
            reverseButtons: true

        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                showLoading();
            }
        });
    } else {
        form.submit();
        showLoading();
    }

}

function showLoading() {
    $("#spinner").addClass("show");
    $(form).closest('form').find('button').append('&ensp;<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
    $('form').find(':button').prop('disabled', true);
    setTimeout(function () {
        $("#spinner").removeClass("show");
        $(form).closest('form').find('button').append('&ensp;<i class="fa fa-spinner fa-spin"></i>').prop('disabled', false);
        $('form').find(':button').prop('disabled', false);
    }, 5000);
}

function dialogConfirmWithAjax(sureCallbackFunction, data, text = "Please Confirm This Action") {
    Swal.fire({
        title: 'Are you sure?',
        text: text,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Confirmed!',
        reverseButtons: true

    }).then((result) => {
        if (result.isConfirmed) {
            sureCallbackFunction(data);
        }
    });
}

function callAPIHelper(url, param, method, callback, passingData = null, isfile = false) {
    $.ajax({
        url: url,
        type: method,
        data: param,
        success: function (data) {
            callback(data, passingData);
        },
        error: function (xhr) {
            var errorString = '';
            $.each(xhr.responseJSON.errors, function (key, value) {
                errorString = value;
                return false;
            });
            showMessage('error', errorString);
        }
    });
}

function uploadFileExternal(file, callBack, passingData) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let formData = new FormData();
    formData.append('file', file, file.name);
    $.ajax({
        type: 'POST',
        url: '/file/uploadImageExternal',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            callBack(data, passingData);
        },
        error: function (xhr) {
            var errorString = '';
            $.each(xhr.responseJSON.errors, function (key, value) {
                errorString = value;
                return false;
            });
            showMessage('error', errorString);
        }
    });
}

function uploadFileStatic(file, input, calllback) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let formData = new FormData();
    formData.append('file', file, file.name);
    $.ajax({
        type: 'POST',
        url: '/file/uploadImageExternal',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            calllback(data, input);
        },
        error: function (xhr) {
            var errorString = '';
            $.each(xhr.responseJSON.errors, function (key, value) {
                errorString = value;
                return false;
            });
            showMessage('error', errorString);
        }
    });
}

function showSuccess(message = null) {
    swal.fire({
        icon: 'success',
        title: 'Success!',
        html: (message == null) ? 'Success!' : message
    });
}

function showError(error = null) {
    swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: (error == null) ? 'Error!' : error
    });
}

function getDataInForm(form) {
    var formData = new FormData(form);
    var data = {};
    for (var pair of formData.entries()) {
        if (pair[1] instanceof File) {
            if (pair[1].size > 0) {
                data[pair[0]] = pair[1];
            }
        } else {
            if (pair[1].length > 0) {
                data[pair[0]] = pair[1];
            }
        }
    }
    return data;
}

function findElementInArrayObjectByKeyValue(array, key, value) {
    return array.find(object => object[key] == value);
}

function isEmpty(str) {
    return (!str || str.length === 0);
}

function getDate() {
    let d = new Date();
    let month = d.getMonth() + 1;
    let day = d.getDate();
    return d.getFullYear() + '-' +
        (month < 10 ? '0' : '') + month + '-' +
        (day < 10 ? '0' : '') + day;
}

function arrayColumn(inputArray, columnKey, indexKey) {
    function isArray(inputValue) {
        return Object.prototype.toString.call(inputValue) === '[object Array]';
    }

    // If input array is an object instead of an array,
    // convert it to an array.
    if (!isArray(inputArray)) {
        var newArray = [];
        for (var key in inputArray) {
            if (!inputArray.hasOwnProperty(key)) {
                continue;
            }
            newArray.push(inputArray[key]);
        }
        inputArray = newArray;
    }

    // Process the input array.
    var isReturnArray = (typeof indexKey === 'undefined' || indexKey === null);
    var outputArray = [];
    var outputObject = {};
    for (var inputIndex = 0; inputIndex < inputArray.length; inputIndex++) {
        var inputElement = inputArray[inputIndex];

        var outputElement;
        if (columnKey === null) {
            outputElement = inputElement;
        } else {
            if (isArray(inputElement)) {
                if (columnKey < 0 || columnKey >= inputElement.length) {
                    continue;
                }
            } else {
                if (!inputElement.hasOwnProperty(columnKey)) {
                    continue;
                }
            }

            outputElement = inputElement[columnKey];
        }

        if (isReturnArray) {
            outputArray.push(outputElement);
        } else {
            outputObject[inputElement[indexKey]] = outputElement;
        }
    }

    return (isReturnArray ? outputArray : outputObject);
}

function randomColor() {
    return Math.floor(Math.random() * 16777215).toString(16);
}

function showMessage(type, message) {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-bottom-right',
        onclick: null,
        showDuration: 1000,
        hideDuration: 1000,
        timeOut: 3000,
        extendedTimeOut: 1000,
        showEasing: 'swing',
        hideEasing: 'linear',
        showMethod: 'fadeIn',
        hideMethod: 'fadeOut',
    };

    let messageHeader = '';

    switch (type) {
        case 'error':
            messageHeader = 'Đã xảy ra lỗi !!!';
            break;
        case 'success':
            messageHeader = 'Thành công!';
            break;
        case 'warning':
            messageHeader = 'Cảnh báo!';
            break;
        default:
            type = 'error';
            messageHeader = 'Đã xảy ra lỗi !!!';
    }
    toastr[type](message, messageHeader);
}

(function ($, DataTable) {

    // Datatable global configuration
    // //cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Vietnamese.json
    /*jshint quotmark: double */
    $.extend(true, DataTable.defaults, {
        language: {
            "sProcessing": "Đang xử lý...",
            "sLengthMenu": "Hiển thị _MENU_ mục",
            "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
            "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
            "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
            "sInfoFiltered": "(được lọc từ _MAX_ mục)",
            "sInfoPostFix": "",
            "sSearch": "Tìm:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Đầu",
                "sPrevious": "Trước",
                "sNext": "Tiếp",
                "sLast": "Cuối"
            }
        }
    });

})(jQuery, jQuery.fn.dataTable);

$(function () {
    var start = moment().startOf('month');
    var end = moment().endOf('month');

    function cb(start, end) {
        $('#daterange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#daterange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
    cb(start, end);
});

function postPhone(urlPost) {
    $('#number_phone_import').change(function(e) {
        let data = new FormData($('#importExcel')[0]);
        $.ajax( {
            url: '/file/importPhone',
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $("#spinner").addClass("show");
            },
            success: function(response) {
                $("#spinner").removeClass("show");
                let res = [];
                let err = [];
                let pattern = /^(03|05|07|08|09)[\d, ]*$/;
                response.data.forEach((data) => {
                    data.forEach((item) => {
                        if(pattern.test(item) && item.length === 10) {
                            res.push(item);
                        }else {
                            err.push(item);
                        }
                    });
                });
                console.log(res.length);
                $('#number_phone').val(res.join(','));
                let successMessage = 'Nhập thành công <b>' + res.length + '</b> số điện thoại, ';
                if (err.length > 0) {
                    showMessage('warning',successMessage + 'các số sai định dạng bị bỏ qua gồm: ' + err.join(','));
                    return true;
                }
                showMessage('success',successMessage);
            },
            error: function (xhr) {
                var errorString = '';
                $("#spinner").removeClass("show");
                $.each(xhr.responseJSON.errors, function (key, value) {
                    errorString = value;
                    return false;
                });
                $('#importExcel').find('input:text, input:password, input:file, select, textarea').val('');
                $('#number_phone').val('');
                if (errorString.length !== 0) {
                    showMessage('error',errorString);
                } else {
                    showMessage('error','File quá lớn hoặc sai định dạng! Vui lòng kiểm tra lại. ');
                }
            }
        });
        e.preventDefault();
    });
    $('#submitPhone').on('click', function (event){
        $(this).attr('disabled','disabled');
        event.preventDefault();
        let data = $('#importExcel').serialize();
        $.ajax({
            url: urlPost,
            type: 'POST',
            dataType: 'json',
            data: data,
            cache: false,
            beforeSend: function(){
                $("#spinner").addClass("show");
            },
            success: (data) => {
                $("#spinner").removeClass("show");
                $('#push_phone_number_private').modal('toggle');
                $('#submitPhone').prop('disabled', false);
                var message = '';
                var count =0;
                $.each(data.data, function (key, value) {
                    message += (key+1) + '. ' + value.message + '<br>';
                    if(value.statusCode !== 0){
                        count++;
                    }
                });
                if(count>0) {
                    showMessage('error',message);
                } else {
                    showSuccess(message);
                }
            },
            error: function (xhr) {
                var errorString = '';
                $("#spinner").removeClass("show");
                $.each(xhr.responseJSON.errors, function (key, value) {
                    errorString = value;
                    return false;
                });
                showMessage("error",errorString);
                $('#submitPhone').prop('disabled', false);
            }
        });
    });
}
