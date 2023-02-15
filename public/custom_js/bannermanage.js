'use strict';

function onchangeTypeBanner(_this) {
    if (_this.value === 'promotion') {
        document.getElementById('path_2').style.display = 'block';
        document.getElementById('isShowHomeGroup').style.display = 'block';
    } else {
        document.getElementById('path_2').style.display = 'none';
        document.getElementById('isShowHomeGroup').style.display = 'none';
    }
}

function onchangeDirection() {
    document.getElementById('box_target').style.display = document.getElementById('has_target_route').checked ? 'block' : 'none';
}

function onchangeTargetRoute() {
    if ($('#direction_id').val()==='1') {
        $('#direction_url').attr('style', 'display: ');
    } else {
        $('#direction_url').attr('style', 'display: none !important');
    }
}

$('.img_viewable').click(function () {
    $('#full-image').attr('src', $(this).attr('src'));
    $('#img_view_modal').modal('show');
});

function resetData(input_tag, img_tag) {
    input_tag.value = null;
    img_tag.src = "/images/image_holder.png";
}

function responseImageStatic(res, input) {
    console.log(res);
    if (res.statusCode === 0 && res.data !== null) {
        const [file] = input.files;
        const input_name = 'img_' + input.name;
        console.log(input_name);
        document.getElementById(input_name).src = URL.createObjectURL(file);
        console.table(input_name + '_name', res.data.uploadedImageFileName)
        document.getElementById(input_name + '_name').value = res.data.uploadedImageFileName;
    } else {
        alert_float('error',res.message);
    }
}

function handleUploadImage(input) {
    const [file] = input.files;
    if (file.size > 700000) { // handle file
        resetData(input, null);
        alert_float('error','File is too big! Allowed memory size of 0.7MB');
        return false;
    };
    uploadFileStatic(file, input, responseImageStatic);
}

const getBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
});

function getDetailBanner(_this) {
    let row = _this.closest('tr');
    let infoRow = row.querySelector('.infoRow');
    window.location.href = `/bannermanage/edit/` + infoRow.getAttribute('data-id');
}

function callApiUpdateOderSuccess(response){
    console.log(response);
    if(response.statusCode != 0){
        alert_float('error',response.message);
    }else{
        showSuccess('Updated!');
    }
}

function updateOrdering(_thisInputTag){
    let row = _thisInputTag.closest('tr');
    let infoRow = row.querySelector('.infoRow');
    let updateParams = {
        eventId: infoRow.getAttribute('data-id'),
        ordering:_thisInputTag.value,
        _token: $('meta[name="csrf-token"]').attr('content')
    };
    callAPIHelper("/bannermanage/updateordering", updateParams, 'POST', callApiUpdateOderSuccess);
}

function changePublicDateTime(dateTimeInput){
    var form = $(dateTimeInput).closest('form');
    var show_from = $(form).find('input[name="show_from"]');
    var show_to = $(form).find('input[name="show_to"]');

    show_from.attr("max",show_to.val());
    show_to.attr("min",show_from.val());
}

function methodAjaxBanner() {
    $('body').on('click', '#addBanner', function (e) {
        e.preventDefault();
        $('#showDetailBanner_Modal').modal('toggle');
        document.getElementById('formBanner').reset();
        $('#event_type option').attr('disabled', false);
        $('#direction_id').val('1').change();
        $('#event_type').val('highlight').change();
        $('#img_path_2').attr('src', '/images/image_holder.png');
        $('#img_path_1').attr('src', '/images/image_holder.png');
        window.urlMethod = '/bannermanage/store';
    });

    $('body').on('click', '#button_form_export', function (e) {
        e.preventDefault();
        $('#show_form_export').modal('toggle');
        document.getElementById('formExport').reset();
        let id = $(this).data('id');
        document.getElementById("formExport").action = "/bannermanage/export/" + id;
    });

    $('body').on('click', '#updateBannerFconnect', function (e) {
        e.preventDefault();
        $('#showFormUpdateFconnect_Modal').modal('toggle');
        document.getElementById('formUpdateBanner').reset();
        $('#event_type option').attr('disabled', false);
        $('#img_path_2').attr('src', '/images/image_holder.png');
        $('#img_path_1').attr('src', '/images/image_holder.png');
        window.urlMethod = '/bannermanage/update-banner-fconnect';
    });

    $('body').on('click', '#detailBanner', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        let url = '/bannermanage/show/'+id;
        $.ajax({
            url: url,
            type:'GET',
            success: function (response){
                console.log(response);
                for (const [key, value] of Object.entries(response.banner)) {
                    $('#' + key).val(value);
                    if(key==='image') {
                        $('#img_path_1_name').val(value);
                        $('#img_path_1').attr('src', value);
                    }
                    if(key==='thumb_image') {
                        $('#img_path_2_name').val(value);
                        $('#img_path_2').attr('src', value);
                    }
                    if(key==='event_type' || key==='direction_id') {
                        $('#event_type option').attr('disabled', false);
                        $('#'+key).trigger('change');
                        $('#event_type option:not(:selected)').attr('disabled', true);
                        if(key==='direction_id' && value === '') {
                            $('#has_target_route').prop('checked', false);
                        }else {
                            $('#has_target_route').prop('checked', true);
                            onchangeTargetRoute();
                        }
                        onchangeDirection();
                    }
                }
                $('#showDetailBanner_Modal').modal('toggle');
                window.urlMethod = '/bannermanage/update/'+id;
            },
            error: function (xhr) {
                var errorString = '';
                $.each(xhr.responseJSON.errors, function (key, value) {
                    errorString = value;
                    return false;
                });
                alert_float('error', errorString);
                console.log(data);
            }
        });
    });

    $('body').on('click', '#submitAjax', function (e){
        $(this).attr('disabled','disabled');
        e.preventDefault();
        let data = $('#formBanner').serialize();
        $.ajax({
            url: urlMethod,
            type: 'POST',
            dataType: 'json',
            data: data,
            cache: false,
            success: (data) => {
                if(data.data.statusCode === 0){
                    $('#showDetailBanner_Modal').modal('toggle');
                    alert_float('success', data.data.message);
                    $('#submitAjax').prop('disabled', false);
                    var table = $('#banner_manage').DataTable();
                    table.ajax.reload();
                }else{
                    alert_float("error", data.data.message);
                    $('#submitAjax').prop('disabled', false);
                }
            },
            error: function (xhr) {
                var errorString = '';
                $('#submitAjax').prop('disabled', false);
                $.each(xhr.responseJSON.errors, function (key, value) {
                    errorString = value;
                    return false;
                });
                alert_float(errorString);
                $('#submitAjax').prop('disabled', false);
            }
        });
    });
    $('body').on('click', '#submitAjaxUpdate', function (e){
        $(this).attr('disabled','disabled');
        e.preventDefault();
        let data = $('#formUpdateBanner').serialize();
        $.ajax({
            url: urlMethod,
            type: 'POST',
            dataType: 'json',
            data: data,
            cache: false,
            success: (data) => {
                console.log(data);
                if(data.statusCode === 0){
                    $('#showFormUpdateFconnect_Modal').modal('toggle');
                    alert_float('success', data.message);
                    $('#submitAjaxUpdate').prop('disabled', false);
                    var table = $('#banner_manage').DataTable();
                    table.ajax.reload();
                }else{
                    alert_float('error', data.message);
                    $('#submitAjaxUpdate').prop('disabled', false);
                }
            },
            error: function (xhr) {
                var errorString = '';
                $('#submitAjaxUpdate').prop('disabled', false);
                $.each(xhr.responseJSON.errors, function (key, value) {
                    errorString = value;
                    return false;
                });
                alert_float(errorString);
                $('#submitAjaxUpdate').prop('disabled', false);
            }
        });
    });

    $('body').on('click', '#submitAjaxExport', function (e){
        $('#show_form_export').modal('toggle');
    });
}
