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
            $('#directionId_popup').hide();
            $('#buttonImage').hide();
            $('#buttonActionValue_popup').hide();
        } else {
            $('#directionId_popup').show();
            $('#buttonImage').show();
            $('#buttonActionValue_popup').show();
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

    $('#directionId_popup').on('change', function () {
        let type_direction = $('#directionId_popup').val();
        if (type_direction === 'url_open_out_app' || type_direction === 'url_open_in_app') {
            $('#form_directionUrl').show();
        } else {
            $('#form_directionUrl').hide();
        }
    });
}

function clearForm() {
    $('#popupModal select').prop('selectedIndex', 0).change();
}

function checkSubmitPopup(formData) {
    let pathArray = window.location.pathname.split('/');
    let action = pathArray[2];
    if (action === 'edit') {
        return {
            status: true,
            data: null
        };
    }
    var data_required = {
        'titleVi': true,
        'titleEn': true,
        'templateType': true,
        'image_popup_name': true,
    };

    if (formData.templateType !== 'popup_image_transparent' && formData.templateType !== 'popup_image_full_screen') {
        // data_required.path_2 = true;
        data_required.buttonImage_popup_name = true;
        data_required.directionId = true;
        console.log(formData.directionId);
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
    var formData = getDataInForm(form);
    console.log(checkSubmitPopup(formData).status);
    if (checkSubmitPopup(formData).status) {
        $('form').find(':submit').prop('disabled', false);
    } else {
        $('form').find(':submit').prop('disabled', true);
    }
}


async function handleUploadImagePopup(_this, event) {
    event.preventDefault();
    var img_tag_name = _this.name + '_popup';
    if (img_tag_name == 'buttonImage') {
        path_2_required_alert.hidden = true;
    }
    var img_tag = document.getElementById(img_tag_name);
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
                for (const [key, value] of Object.entries(response)) {
                    if(key==='image' || key==='buttonImage') {
                        $('#'+key+'_popup').attr("src",URL_STATIC + "/upload/images/event/" + value);
                        $('#'+key+'_popup_name').val(value);
                    }else {
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
        document.getElementById('image_popup').attributes[1].value = '';
        document.getElementById('buttonImage_popup').attributes[1].value = '';
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

function pushAjaxPopup() {
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

function methodAjaxPopupPrivate() {
    $('body').on('click', '#push_popup_private', function () {
        $('#popupModalPrivate').modal('toggle');
        $('#formPopupPrivate').on('click', '#submitButton', function (e){
            const form = document.querySelector('#formPopupPrivate');
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

    $('body').on('click', '#delete_popup', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: 'popupmanage/deletePrivate',
            type:'POST',
            data: {
                id: id
            }, success: function (response){
                for (const [key, value] of Object.entries(response)) {
                    if(key==='image' || key==='buttonImage') {
                        $('#'+key+'_popup').attr("src",URL_STATIC + "/upload/images/event/" + value);
                        $('#'+key+'_popup_name').val(value);
                    }else {
                        $('#'+key+'_popup').val(value);
                    }
                }
                $('#show_detail_popup').modal('toggle');
            }
        });
    });

    $('body').on('click', '#import_phone_popup', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: 'popupmanage/importPrivate',
            type:'POST',
            data: {
                id: id
            }, success: function (response){
                for (const [key, value] of Object.entries(response)) {
                    if(key==='image' || key==='buttonImage') {
                        $('#'+key+'_popup').attr("src",URL_STATIC + "/upload/images/event/" + value);
                        $('#'+key+'_popup_name').val(value);
                    }else {
                        $('#'+key+'_popup').val(value);
                    }
                }
                $('#show_detail_popup').modal('toggle');
            }
        });
    });
}


