"use strict";

function showHide() {
    let type_popup = $('#listTypePopup').val();
    if (type_popup == 'popup_image_transparent' || type_popup == 'popup_image_full_screen') {
        $('#dieuhuong').hide();
        $('#path_2').hide();
        $('#directionUrl').hide();
    } else {
        $('#dieuhuong').show();
        $('#path_2').show();
        $('#directionUrl').show();
    }
    let type_direction = $('#directionId').val();
    if (type_direction == 'url_open_out_app' || type_direction == 'url_open_in_app') {
        $('#form_directionUrl').show();
    } else {
        $('#form_directionUrl').hide();
    }

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

    })
    $('input[name="timeline"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm:ss') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm:ss'));
    });

    $('input[name="timeline"]').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
    $('#listTypePopup').on("change", function () {
        let type_popup = $('#listTypePopup').val();
        if (type_popup == 'popup_image_transparent' || type_popup == 'popup_image_full_screen') {
            $('#dieuhuong').hide();
            $('#path_2').hide();
            $('#directionUrl').hide();
        } else {
            $('#dieuhuong').show();
            $('#path_2').show();
            $('#directionUrl').show();
        }
    })
    $('#repeatTime').on("change", function () {
        let repeatTime = $('#repeatTime').val();
        if (repeatTime == 'other') {
            $('#other_min').show();
        } else {
            $('#other_min').hide();
        }
    })
    $('#directionId').on("change", function () {
        let type_direction = $('#directionId').val();
        if (type_direction == 'url_open_out_app' || type_direction == 'url_open_in_app') {
            $('#form_directionUrl').show();
        } else {
            $('#form_directionUrl').hide();
        }
    });
}
$('#templatPersonList').DataTable({
    "order": [[1, "desc"]],
});
function clearForm() {
    $('#popupModal select').prop('selectedIndex', 0).change();
}

function getDetailPersonalMaps(idPersonalMaps) {
    $.ajax({
        type: 'POST',
        url: '/popupmanage/getDetailPersonalMaps',
        data: {'personalID': idPersonalMaps.getAttribute("personalID")},
        cache: false,
        success: (data) => {
            $("#object").val(data['pushedObject']).change();
            $("#repeatTime").val(data['showOnceTime']).change();
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
    $("#popupModal").modal()
}
function validateDataPopup(event, form) {
    event.preventDefault();

    var passed = true;

    var formData = getDataInForm(form);
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

function checkSubmitPopup(formData) {
    const pathArray = window.location.pathname.split("/");
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
        'img_path_1_name': true,
    };

    if (formData.templateType != 'popup_image_transparent' && formData.templateType != 'popup_image_full_screen') {
        // data_required.path_2 = true;
        data_required.img_path_2_name = true;
        data_required.directionId = true;
        if (formData.directionId == 'url_open_out_app' || formData.directionId == 'url_open_in_app') {
            data_required.directionUrl = true;
        }
    }
    let intersection = Object.keys(data_required).filter(x => !Object.keys(formData).includes(x));
    var result = {};
    if (intersection.length === 0) {
        result.status = true;
        result.data = null;
    } else {
        result.status = false;
        result.data = intersection;
    }
    return result;
}


async function handleUploadImagePopup(_this, event) {
    event.preventDefault();
    var img_tag_name = 'img_' + _this.name;
    if (img_tag_name == 'img_path_2') {
        path_2_required_alert.hidden = true;
    }
    var img_tag = document.getElementById(img_tag_name);
    if (_this.value == '') {
        resetData(_this, img_tag);
    }
    const [file] = _this.files;
    if (file) {
        if (file.size > 2050000) { // handle file
            resetData(_this, img_tag);
            showError("File is too big! Allowed memory size of 2MB");
            return false;
        };
        // var base64_img = await getBase64(file);
        // var base64_img = base64_img.replace(/^data:image\/[a-z]+;base64,/, "");

        var uploadParam = {
            // 'imageFileName': file.name,
            // 'encodedImage': base64_img,
            file: file,
            _token: $('meta[name="csrf-token"]').attr('content')
        };
        uploadFileExternal(file, successCallUploadImagePopup, {
            'img_tag': img_tag,
            'input_tag': _this,
            'file': file
        });
    }
}

function successCallUploadImagePopup(response, passingdata) {
    if (response.statusCode == 0 && response.data != null) {
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
                let modalBody = $('#show_detail_popup').find('#modal-detail-popup');
                let html = '';
                for (const [key, value] of Object.entries(response)) {
                    if(value && typeof value === 'string') {
                        if(key === 'templatePersonalMaps'){
                            value.value = null
                        }
                        html+=`<div class="form-group text-monospace text-capitalize"><b>`+ key+`:</b>     ` +value+`</div>`;
                    }
                }
                $(modalBody).html(html)
                $('#show_detail_popup').modal('toggle');
            }
        })
    });
}

function pushAjaxPopup() {
    $('body').on('click', '#push_popup_public', function (event) {
        $('#popupModal').modal('toggle');
        $('#formPopup').on('click', '#submitButton', function (e){
            const form = document.querySelector('#formPopup');
            const data = Object.fromEntries(new FormData(form).entries());
            let url = $(form).data('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                cache: false,
                success: (data) => {
                    if(data.data.statusCode == 0){
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
        })
    });
}

function pushAjaxPopupPrivate() {
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
                    if(data.data.statusCode == 0){
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
        })
    });
}


