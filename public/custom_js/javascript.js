$(document).ready(function () {
    // $('#sidebar').sortable({
    //     axis: "y",
    // });
    if (window.history && window.history.pushState) {

        // window.history.pushState('forward', null, './#forward');
        if ($('#spinner').length) {
            console.log('ready');
            $('#spinner').removeClass('show');
            $('#spinner').addClass('hide');
        }
        // $(window).on('popstate', function() {
        //     if($('#spinner').length) {
        //         console.log('ready');
        //         $('#spinner').removeClass('show');
        //         $('#spinner').addClass('hide');
        //     }
        // });

    }


    $(document).pjax('a', '#pjax');
    $('aside li.nav-item a').on('click', function (e) {
        if ($(this).attr('href') != '#') {
            $('aside').find(".menu-open > .nav-treeview").not($(this).parents('.menu-open > .nav-treeview')).slideUp()
            $('aside').find(".menu-open").not($(this).parents('.menu-open')).removeClass("menu-is-opening menu-open");
            $('li a').removeClass("active");
            $(this).addClass("active");
        }
        $(this).parents('.nav-treeview').prevAll('.nav-link').addClass('active');

    });
    reloadPjax();
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
                let submitBtn = $(form).closest('form').find('button').append('&ensp;<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
                $('form').find(':button').prop('disabled', true);
                $("#spinner").toggle("show");
            }
        });
    } else {
        form.submit();
        let submitBtn = $(form).closest('form').find('button').append('&ensp;<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
        $('form').find(':button').prop('disabled', true);
        $("#spinner").toggle("show");
    }

    if (e.result == true) {
        // $("#spinner").addClass("hide");
        console.log('end submit');
    }

}

function dialogConfirmWithAjax(sureCallbackFunction, data) {
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
            showError(errorString);
        }
    });
}

function uploadFile(file, callBack, passingData) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = new FormData();
    formData.append("file", file, file.name);
    $.ajax({
        type: 'POST',
        url: '/bannermanage/uploadImage',
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
            showError(errorString);
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

function removeVietnameseTones(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    // Some system encode vietnamese combining accent as individual utf-8 characters
    // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
    // Remove extra spaces
    // Bỏ các khoảng trắng liền nhau
    str = str.replace(/ + /g, " ");
    str = str.trim();
    // Remove punctuations
    // Bỏ dấu câu, kí tự đặc biệt
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g, " ");
    return str;
}

function serializeObject(obj) {
    var jsn = {};
    $.each(obj, function() {
        if (jsn[this.name]) {
            if (!jsn[this.name].push) {
                jsn[this.name] = [jsn[this.name]];
            }
            jsn[this.name].push(this.value || '');
        } else {
            jsn[this.name] = this.value || '';
        }
    });
    return jsn;
};