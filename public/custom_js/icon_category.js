"use strict";

$( document ).ready(function() {
    if($('#status-clock').is(':checked')) {
        $('#status-clock-date-time').show();
    }
    else {
        $('#status-clock-date-time').hide();
    }

    if($('#is-new-show').is(':checked')) {
        console.log('test');
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
    if($('#show_to').data("DateTimePicker") != undefined) {
        $('#show_to').data("DateTimePicker").minDate(e.date);
    }
});      

$("#show_to").on("dp.change", function (e) {
    if($('#show_from').data("DateTimePicker") != undefined) {
        $('#show_from').data("DateTimePicker").maxDate(e.date);
    }
});

$("#new_from").on("dp.change", function (e) {
    if($('#new_to').data("DateTimePicker") != undefined) {
        $('#new_to').data("DateTimePicker").minDate(e.date);
    }
});      

$("#new_to").on("dp.change", function (e) {
    if($('#new_from').data("DateTimePicker") != undefined) {
        $('#new_from').data("DateTimePicker").maxDate(e.date);
    }
});

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

// $("#product-modal-body").html('');
// $('#exampleModalCenter').modal();
// $("#product-detail-template").tmpl(data).appendTo("#product-modal-body");

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

// lightSlider
$(document).ready(function() {
    $('#all-product').lightSlider({
        item: 5,
        loop: true,
        slideMove: 1,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        speed: 600,
        slideMargin: 15,
        enableDrag: false,
        enableTouch: false,
        pager: false
    });  
});

// Dragula CSS Release 3.2.0 from: https://github.com/bevacqua/dragula
dragula([document.getElementById('all-product'), document.getElementById('selected-product')], {
    direction: 'horizontal',
    copy: function (el, source) {
        return source === document.getElementById('all-product')
    },
    accepts: function (el, target) {
        return target !== document.getElementById('all-product')
    }
}).on('drop', (el, target, source, sibling) => {
    $(el).removeClass("lslide");
    $(el).removeClass("active");
    $(el).removeClass("gu-transit");
    $(el).addClass("col-sm-2");

    $(el).css('margin-right', 0);

    var spanElement = $(el).find("span:first");
    $(spanElement).removeClass("badge-light");
    $(spanElement).addClass("badge-dark");

    if($(el).find('span.position').length < 1) {
        $(el).append(`<h6><span class="badge badge-warning position">${$(el).index() + 1}</span></h6>`);
    }

    $(target).find("li").each((key, value) => {
        $(value).find("span.position").text($(value).index() + 1);
    });
});

function removeFromSelectedProduct(el) {
    var parent_ul = $($("#" + el).parent());
    $("#" + el).remove();
    console.log($($("#" + el).parent()).find("li"));
    parent_ul.find("li").each((key, value) => {
        $(value).find("span.position").text($(value).index() + 1);
    });
    
}

