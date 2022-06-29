'use strict';
function showHide() {
    $('.select2').select2();
    $('#timeline').daterangepicker({
        autoApply: true,
        autoUpdateInput: true,
        timePicker: true,
        timePicker24Hour: true,
        timePickerSeconds: true,
        timePickerIncrement: 1,
        locale: {
            format: 'YYYY-MM-DD HH:mm:ss'
        }
    });

    $('input[name="timeline"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm:ss') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm:ss'));
    });

    $('input[name="timeline"]').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

    $('#templateType_popup').on('change', function () {
        if ($('#templateType_popup').val() === 'popup_image_transparent' || $('#templateType_popup').val() === 'popup_image_full_screen') {
            $('#directionId_popup').attr('style', 'display: none !important');
            $('#buttonImage').attr('style', 'display: none !important');
            $('#form_directionUrl').attr('style', 'display: none !important');
        } else {
            $('#directionId_popup').attr('style', 'display: inline');
            $('#buttonImage').attr('style', 'display: inline');
            $('#form_directionUrl').attr('style', 'display: ');
        }
    });

    $('#type_popup').on('change', function () {
        if ($('#type_popup').val() === 'popup_image_transparent' || $('#type_popup').val() === 'popup_image_full_screen') {
            $('#iconButtonUrl').attr('style', 'display: none !important');
        } else {
            $('#iconButtonUrl').attr('style', 'display: inline');
        }
    });

    $('#repeatTime').on('change', function () {
        let repeatTime = $('#repeatTime').val();
        if (repeatTime === 'other') {
            $('#other_min').show();
        } else {
            $('#other_min').hide();
        }
    });

    $('#actionType_popup').on('change', function () {
        let type_direction = $('#actionType_popup').val();
        if (type_direction === 'url_open_out_app' || type_direction === 'url_open_in_app') {
            $('#dataAction_popup').prop('readonly', false);
            $('#dataAction_popup').val('https://example.com');
        } else {
            $('#dataAction_popup').prop('readonly', true);
            $('#dataAction_popup').val($('#actionType_popup').find(':selected').text());
        }
    });

    $('#directionId_popup').on('change', function () {
        let type_direction = $('#directionId_popup').val();
        if (type_direction === 'url_open_out_app' || type_direction === 'url_open_in_app') {
            $('#form_directionUrl').show();
        } else {
            $('#form_directionUrl').hide();
        }
    });
}
function resetData(input_tag, img_tag) {
    input_tag.value = null;
    img_tag.src = "/images/image_holder.png";
}

function clearForm() {
    $('#popupModal select').prop('selectedIndex', 0).change();
}

function checkSubmitPopup(formData) {
    let data_required = {
        'titleVi': true,
        'titleEn': true,
        'templateType': true,
        'image_popup_name': true,
    };

    if (formData.templateType !== 'popup_image_transparent' && formData.templateType !== 'popup_image_full_screen') {
        data_required.buttonImage_popup_name = true;
        data_required.directionId = true;
        if (formData.directionId === 'url_open_out_app' || formData.directionId === 'url_open_in_app') {
            data_required.directionId = true;
        }
    }
    let intersection = Object.keys(data_required).filter(x => !Object.keys(formData).includes(x));
    let result = {};
    if (intersection.length === 0) {
        result.status = true;
        result.data = null;
    } else {
        result.status = false;
        result.data = intersection;
    }
    return result;
}

function getDetailPersonalMaps(idPersonalMaps) {
    $.ajax({
        type: 'POST',
        url: '/popupmanage/getDetailPersonalMaps',
        data: {'personalID': idPersonalMaps.getAttribute('personalID')},
        cache: false,
        success: (data) => {
            $('#object').val(data['pushedObject']).change();
            $('#repeatTime').val(data['showOnceTime']).change();
        },
        error: function (xhr) {
            let errorString = '';
            $.each(xhr.responseJSON.errors, function (key, value) {
                errorString = value;
                return false;
            });
            showError(errorString);
        }
    });
    $('#popupModal').modal();
}
function validateDataPopup(event, form) {
    event.preventDefault();
    let formData = getDataInForm(form);
    var passed = checkSubmitPopup(formData);
    if (passed.status) {
        handleSubmit(event, form);
    } else {
        showError('Missing Field !!')
    }
    handleSubmit(event, form);
}

function checkEnableSavePopup(form) {
    let formData = getDataInForm(form);
    console.log(checkSubmitPopup(formData).status);
    if (checkSubmitPopup(formData).status) {
        $('form').find(':submit').prop('disabled', false);
    } else {
        $('form').find(':submit').prop('disabled', true);
    }
}


async function handleUploadImagePopup(_this, event) {
    event.preventDefault();
    let img_tag_name = _this.name + '_popup';
    let img_tag = document.getElementById(img_tag_name);
    if (_this.value === '') {
        resetData(_this, img_tag);
    }
    const [file] = _this.files;
    if (file) {
        if (file.size > 2050000) { // handle file
            resetData(_this, img_tag);
            showError("File is too big! Allowed memory size of 2MB");
            return false;
        }
        uploadFileExternal(file, successCallUploadImagePopup, {
            'img_tag': img_tag,
            'input_tag': _this,
            'file': file
        });
    }
}

function successCallUploadImagePopup(response, passingdata) {
    if (response.statusCode === 0 && response.data !== null) {
        passingdata.img_tag.src = URL.createObjectURL(passingdata.file);
        document.getElementById(passingdata.img_tag.id + '_name').value = response.data.uploadedImageFileName;
        checkEnableSavePopup(passingdata.input_tag.closest('form'));
    } else {
        resetData(passingdata.input_tag, passingdata.img_tag);
        document.getElementById(passingdata.img_tag.id + '_name').value = "";
        showError(response.message);
    }
}

function actionAjaxPopup() {
    $('body').on('click', '#detailPopup', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: 'popupmanage/detail/' + id,
            type:'GET',
            data: {
                id: id
            }, success: function (response){
                console.table(response);
                for (const [key, value] of Object.entries(response)) {
                    if(key==='image' || key==='buttonImage') {
                        $('#'+key+'_popup').attr("src",URL_STATIC + "/upload/images/event/" + value);
                        $('#'+key+'_popup_name').val(value);
                    }else if(key==='templateType' || key==='directionId') {
                        $('#'+key+'_popup').val(value);
                        $('#'+key+'_popup').trigger('change');
                    } else {
                        $('#'+key+'_popup').val(value);
                    }
                }
                $('#show_detail_popup').modal('toggle');
            }
        });
    });

    $('body').on('click', '#push_popup_public', function (event) {
        event.preventDefault();
        var form = document.querySelector('#formAction');
        document.getElementById('formAction').reset();
        document.getElementById('image_popup').attributes[1].value = '/images/image_holder.png';
        document.getElementById('buttonImage_popup').attributes[1].value = '/images/image_holder.png';
        const data = Object.fromEntries(new FormData(form).entries());
        $('#show_detail_popup').modal('toggle');
        $(form).on('submit', function (e){
            e.preventDefault();
            $.ajax({
                url: 'popupmanage/save',
                type:'POST',
                data: { data: data },
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                }
            });
        });
    });
}

function pushTemplateAjaxPopup() {
    $('body').on('click', '#push_popup_public', function (e) {
        e.preventDefault();
        $('#popupModal').modal('toggle');
        $('#formPopup').on('click', '#submitButton', function (e){
            e.preventDefault();
            const form = document.querySelector('#formPopup');
            const data = Object.fromEntries(new FormData(form).entries());
            let url = $(form).data('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                cache: false,
                success: (data) => {
                    if(data.data.statusCode === 0){
                        $('#popupModal').modal('toggle');
                        showSuccess('Thành công');
                    }else{
                        showError(data.data.message);
                    }
                },
                error: function (xhr) {
                    var errorString = '';
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        errorString = value;
                        return false;
                    });
                    showError(errorString);
                    console.log(data);
                }
            });
        });
    });
}

function handlePushPopUpPrivate() {
    $('body').on('click', '#submit', function (event){
        $(this).attr('disabled','disabled');
        event.preventDefault();
        let data = $('#formActionPrivate').serialize();
        $.ajax({
            url: urlMethod,
            type: 'POST',
            dataType: 'json',
            data: data,
            cache: false,
            success: (data) => {
                if(data.data.statusCode === 0){
                    $('#push_popup_private').modal('toggle');
                    showSuccess(data.data.message);
                    $('#submit').prop('disabled', false);
                    var table = $('#popup_private_table').DataTable();
                    table.ajax.reload();
                }else{
                    showError(data.data.message);
                    $('#submit').prop('disabled', false);
                }
            },
            error: function (xhr) {
                var errorString = '';
                $.each(xhr.responseJSON.errors, function (key, value) {
                    errorString = value;
                    return false;
                });
                showError(errorString);
                $('#submit').prop('disabled', false);
            }
        });
    });
}

function methodAjaxPopupPrivate() {
    $('body').on('click', '#push_popup_private_form', function (e) {
        e.preventDefault();
        $('#push_popup_private').modal('toggle');
        document.getElementById('timeline').value = getDate() + " 00:00:00" + " - " + getDate() + " 23:59:59";
        document.getElementById('iconUrl_popup').attributes[1].value = '/images/image_holder.png';
        document.getElementById('iconButtonUrl_popup').attributes[1].value = '/images/image_holder.png';
        window.urlMethod = '/popup-private/addPrivate';
    });

    $('body').on('click', '#detailPopup', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '/popup-private/getByIdPrivate/',
            type:'GET',
            data: {
                id: id
            }, success: function (response){
                $('#number_phone').val('');
                for (const [key, value] of Object.entries(response[0])) {
                    if(key==='dateBegin') {
                        $('#timeline').val(value);
                    }
                    if(key==='dateEnd') {
                        let timeline_current = $('#timeline').val();
                        let timeline = timeline_current + ' - ' + value;
                        $('#timeline').val(timeline);
                    }
                    if(key==='iconUrl' || key==='iconButtonUrl') {
                        $('#' + key + '_popup').attr('src', URL_STATIC + '/upload/images/event/' + value);
                        $('#' + key + '_popup_name').val(value);
                    }
                    if(key==='type' || key==='actionType') {
                        $('#'+key+'_popup').val(value);
                        $('#'+key+'_popup').trigger('change');
                    }
                    else {
                        $('#'+key+'_popup').val(value);
                    }
                }
                $('#push_popup_private').modal('toggle');
                window.urlMethod = '/popup-private/updatePrivate';
            }
        });


    });
}

function deletePopUpPrivate(data){
    let check_delete = $(data).data('check-delete');
    let check_dateEnd = $(data).data('dateend');
    let id = $(data).data('id');
    if(check_dateEnd < getDate()) {
        showError('Popup hết hiệu lực, vui lòng cập nhật ngày hết hạn!')
        return false;
    }
    $.ajax({
        url: '/popup-private/deletePrivate',
        type:'POST',
        data: {
            id: id,
            check: check_delete,
        }, success: function (response){
            showSuccess(response.message);
            var table = $('#popup_private_table').DataTable();
            table.ajax.reload();
        },
        error: function (xhr) {
            var errorString = '';
            $.each(xhr.responseJSON.errors, function (key, value) {
                errorString = value;
                return false;
            });
            showError(errorString);
            console.log(data);
        }
    });
}
function checkStatusPopUpPrivate(){
    $.ajax({
        url: '/popup-private/check',
        type:'POST',
        success: function (){
            var table = $('#popup_private_table').DataTable();
            table.ajax.reload();
        },
        error: function (xhr) {
            var errorString = '';
            $.each(xhr.responseJSON.errors, function (key, value) {
                errorString = value;
                return false;
            });
            console.log(errorString);
        }
    });
}



