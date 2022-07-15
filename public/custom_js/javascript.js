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
    if(parentModuleActive.classList.contains('menu')){ // if parent module is menu
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
    if(withPopup){
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
    }else{
        form.submit();
        showLoading();
    }

}
function showLoading(){
    $("#spinner").addClass("show");
    $(form).closest('form').find('button').append('&ensp;<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
    $('form').find(':button').prop('disabled', true);
    setTimeout(function() {
        $("#spinner").removeClass("show");
        $(form).closest('form').find('button').append('&ensp;<i class="fa fa-spinner fa-spin"></i>').prop('disabled', false);
        $('form').find(':button').prop('disabled', false);
      },5000);
}
function dialogConfirmWithAjax(sureCallbackFunction, data, text="Please Confirm This Action") {
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
            showError(errorString);
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
    formData.append('file', file,file.name);
    $.ajax({
        type: 'POST',
        url: '/file/uploadImageExternal',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            callBack(data,passingData);
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

function uploadFileStatic(file,input, calllback) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let formData = new FormData();
    formData.append('file', file,file.name);
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

function findElementInArrayObjectByKeyValue(array ,key, value){
    return array.find(object => object[key] == value);
}

function isEmpty(str) {
    return (!str || str.length === 0 );
}

function getDate() {
    let d = new Date();
    let month = d.getMonth()+1;
    let day = d.getDate();
    return d.getFullYear() + '-' +
        (month<10 ? '0' : '') + month + '-' +
        (day<10 ? '0' : '') + day;
}
