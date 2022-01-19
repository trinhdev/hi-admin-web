"use strict";
function validateDataPopup(event, form) {
    event.preventDefault();

    var passed = true;

    var formData = getDataInForm(form);
    if (!$(has_target_route).is(':checked')) {
        delete formData.direction_id;
    }
    var passed = checkSubmitPopup(formData);
    if (passed.status) {
        handleSubmit(event, form);
    } else {
        showError('Missing Field !!')
    }
}

function checkEnableSavePopup(form) {
    var formData = getDataInForm(form);
    if (checkSubmitPopup(formData).status) {
        $('form').find(':submit').prop('disabled', false);
    } else {
        $('form').find(':submit').prop('disabled', true);
    }
}

function getDataRequiredPopup() {
    var data = {
        'title_vi': true,
        'title_en': true,
        'templateType': true,
        'path_1': true,
        'img_path_1_name': true,
        'show_to': true,
        'show_from': true,
        'directionUrl': true
    };
    return data;
}
function checkSubmitPopup(formData) {
    const pathArray = window.location.pathname.split("/");
    let action = pathArray[2]; // action ['create','edit']
    if (action === 'edit') {
        return {
            status: true,
            data: null
        };
    }
    var data_required = getDataRequiredPopup();
    // if (formData.templateType == 'popup_custom_image_transparent') {
    //     data_required.path_2 = true;
    //     data_required.img_path_2_name = true;
    // }
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

        var uploadParam = {
            file:file,
            _token: $('meta[name="csrf-token"]').attr('content')
        };
        uploadFile(file, successCallUploadImagePopup, {
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