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
            showMessage('error',errorString);
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
            showMessage('error',errorString);
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
            showMessage('error',errorString);
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

/**
 * Source: http://stackoverflow.com/a/33841999/1402846
 *
 * This function is (almost) equivalent to array_column() in PHP (http://php.net/manual/function.array-column.php).
 *
 * Differences between this function and PHP's array_column():
 * <ul>
 *     <li>If <code>indexKey</code> is not found in an element of the input array, the behaviour of this function is undefined.
 *     In PHP's array_column(), the element will be put into the end of the array. It is possible in PHP because PHP does not
 *     distinguish between arrays and dictionaries, but it is not possible in JavaScript because Arrays and Objects are different.
 *
 *     <li>Associative arrays (dictionaries) in PHP are ordered, JavaScript objects are not (http://stackoverflow.com/a/5525820/14028460.
 *     Do not make assumptions on the ordering of the keys in JavaScript objects.
 *
 *     <li>If the value of an element at <code>inputKey</code> is not a string, the result of this function and the PHP function
 *     doesn't make much sense. For example, in PHP,
 *     <code>
 *          $records = array(
 *              array('id' => true, 'last_name' => 'Doe')
 *          );
 *          array_column($records, 'last_name', 'id');
 *     </code>
 *     gives <code>Array([1] => Doe)</code>, or maybe <code>Array([0] => Doe)</code> due to a bug ({@link https://bugs.php.net/bug.php?id=68553}). But, in JavaScript,
 *     <code>
 *          var records = [
 *              {id: true, last_name: 'Doe'},
 *          ];
 *          arrayColumn(records, 'last_name', 'id');
 *     </code>
 *     gives <code>{true: "Doe"}</code>. Therefore, it is strongly advised to make sure that the value at <code>indexKey</code> of
 *     each input element is a string.
 * </ul>
 *
 * @param {Array|Object} inputArray             The input array, it must either contain objects only or arrays only.
 *                                              If it is an object instead of an array, it would be converted to an array first.
 * @param {int|string|null} columnKey           If the input array contains objects, this parameter is the key in each object.
 *                                              If the input array contains arrays, this parameter is the index in each array.
 *                                              If the key or index is not valid, this element is skipped.
 *                                              This parameter may also be <code>null</code>.
 * @param {int|string|null} [indexKey=null]     If the input array contains objects, this parameter must be a valid key in each object.
 *                                              If the input array contains arrays, this parameter must be a valid index in each array.
 *                                              If it is not a valid key or index, the behaviour is undefined.
 *                                              This parameter may also be <code>null</code>.
 * @returns {Array|Object}                      If <code>indexKey</code> is <code>null</code>, this function returns an array which is parallel
 *                                              to the input array. For each element <code>elem</code> in the input array, the element in the
 *                                              output array would be <code>elem[columnKey]</code>, or just <code>elem</code> if <code>columnKey</code>
 *                                              is <code>null</code>.
 *                                              If <code>indexKey</code> is <b>not</b> <code>null</code>, this function returns an object.
 *                                              For each element <code>elem</code> in the input array, the output object would contain an
 *                                              element <code>elem[columnKey]</code>, or just <code>elem</code> if <code>columnKey</code>
 *                                              is <code>null</code>, at the key <code>elem[indexKey]</code>. If the value of <code>elem[indexKey]</code>
 *                                              of some elements in the input array are duplicated, the element in the return object would
 *                                              correspond to the element nearest to the end of the input array.
 * @example
 * var records = [
 *      {id: 2135, first_name: 'John',  last_name: 'Doe'},
 *      {id: 3245, first_name: 'Sally', last_name: 'Smith'},
 *      {id: 5342, first_name: 'Jane',  last_name: 'Jones'},
 *      {id: 5623, first_name: 'Peter', last_name: 'Doe'}
 * ];
 * var first_names = arrayColumn(records, 'first_name');
 * >> ["John", "Sally", "Jane", "Peter"]
 * var last_names = arrayColumn(records, 'last_name', 'id');
 * >> {2135: "Doe", 3245: "Smith", 5342: "Jones", 5623: "Doe"}
 * var persons = arrayColumn(records, null, 'id');
 * >> {
 *      2135: {id: 2135, first_name: 'John',  last_name: 'Doe'},
 *      3245: {id: 3245, first_name: 'Sally', last_name: 'Smith'},
 *      5342: {id: 5342, first_name: 'Jane',  last_name: 'Jones'},
 *      5623: {id: 5623, first_name: 'Peter', last_name: 'Doe'}
 *    }
 */
 function arrayColumn(inputArray, columnKey, indexKey)
 {
     function isArray(inputValue)
     {
         return Object.prototype.toString.call(inputValue) === '[object Array]';
     }

     // If input array is an object instead of an array,
     // convert it to an array.
     if(!isArray(inputArray))
     {
         var newArray = [];
         for(var key in inputArray)
         {
             if(!inputArray.hasOwnProperty(key))
             {
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
     for(var inputIndex = 0; inputIndex < inputArray.length; inputIndex++)
     {
         var inputElement = inputArray[inputIndex];

         var outputElement;
         if(columnKey === null)
         {
             outputElement = inputElement;
         }
         else
         {
             if(isArray(inputElement))
             {
                 if(columnKey < 0 || columnKey >= inputElement.length)
                 {
                     continue;
                 }
             }
             else
             {
                 if(!inputElement.hasOwnProperty(columnKey))
                 {
                     continue;
                 }
             }

             outputElement = inputElement[columnKey];
         }

         if(isReturnArray)
         {
             outputArray.push(outputElement);
         }
         else
         {
             outputObject[inputElement[indexKey]] = outputElement;
         }
     }

     return (isReturnArray ? outputArray : outputObject);
 }

function randomColor() {
    return Math.floor(Math.random()*16777215).toString(16);
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

$(function() {
    var start = moment().subtract(6, 'days');
    var end = moment();

    function cb(start, end) {
        $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
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
