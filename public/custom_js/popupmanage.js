"use strict";
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
$('input[name="timeline"]').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm:ss') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm:ss'));
});

$('input[name="timeline"]').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
});
$('#listTypePopup').on("change", function () {
    let type_popup = $('#listTypePopup').val();
    console.log(type_popup);
    if (type_popup == 'popup_image_transparent' || type_popup == 'popup_image_full_screen') {
        $('#dieuhuong').hide();
        $('#path_2').hide();
    } else {
        $('#dieuhuong').show();
        $('#path_2').show();
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
})
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
    if (checkSubmitPopup(formData).status) {
        $('form').find(':submit').prop('disabled', false);
    } else {
        $('form').find(':submit').prop('disabled', true);
    }
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
    var data_required = {
        'titleVi': true,
        'titleEn': true,
        'templateType': true,
        // 'path_1': true,
        'img_path_1_name': true,
        // 'object': true,
        // 'objecttype': true
    };

    if (formData.templateType != 'popup_image_transparent' && formData.templateType != 'popup_image_full_screen' ) {
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
            file:file,
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
function filterData() {
    // $('#banner_manage').DataTable().destroy();
    $('#popup_manage').DataTable().clear();
    callApiGetListPopup(show_from.value, show_to.value, show_at.value);
}

function callApiGetListPopup(show_from = null, show_to = null, popupType = null) {
    var uploadParam = {
        public_date_from: show_from,
        public_date_to: show_to,
        popupType: popupType,
        _token: $('meta[name="csrf-token"]').attr('content')
    };

    callAPIHelper("/popupmanage/initDatatable", uploadParam, 'GET', initPopupManage);
}
function convertDetailPopup(element){
    var toDay = new Date();
    let subData = {
        popupId: '',
        popupType: '',
        public_date_start: '',
        public_date_end: '',
        title_vi: '',
        title_en: '',
        direction_id: '',
        direction_url: '',
        image: '',
        thumb_image: '',
        ordering: '-1',
        view_count: 0,
        date_created: '',
        created_by: '',
        modified_by: '',
    };
    console.log(element);
    if (element.id != undefined) {
        subData.popupId = element.id;
        subData.title_vi = element.titleVi != undefined ? element.titleVi : '';
        subData.templateType = element.templateType != undefined ? element.templateType : '';
        subData.image = element.image_url != undefined ? element.image_url : '';
        subData.ordering = element.ordering != undefined ? element.ordering : '-1';
        subData.view_count = element.view_count != undefined ? element.view_count : '0';
        subData.direction_url = element.direction_url != undefined ? element.direction_url : '';
        subData.date_created = element.dateCreated;
    } else {
        let public_date_end = new Date(element.public_date_end);
        subData.popupId = element.id;
        subData.title_vi = element.titleVi != undefined ? element.titleVi : '';
        subData.templateType = element.templateType != undefined ? element.templateType : '';
        // if(subData.bannerType === 'promotion'){
        //     subData.image = element.thumb_image != undefined ? (URL_STATIC+'/upload/images/event/'+element.thumb_image) : element.image;
        // }else{
        //     subData.image = element.image != undefined ? element.image : '';
        // }
        subData.image = ''
        subData.ordering = element.ordering != undefined ? element.ordering_on_home : '-1';
        subData.view_count = element.view_count != undefined ? element.view_count : '0';
        subData.direction_url = element.event_url != undefined ? element.event_url : '';
        subData.date_created = element.dateCreated;
        subData.is_banner_expired = (public_date_end < toDay) ? true : false;

        subData.created_by = element.created_by != undefined ? element.created_by : '';
        subData.public_date_start = element.public_date_start != undefined ? element.public_date_start : '';
        subData.public_date_end = element.public_date_end != undefined ? element.public_date_end : '';
        subData.modified_by = element.modified_by != undefined ? element.modified_by : '';
    }

    if(element.cms_note != undefined && !isEmpty(element.cms_note)){
        var JSONcms_note = JSON.parse(element.cms_note);
        subData.created_by = (JSONcms_note.created_by != undefined ) ? JSONcms_note.created_by : '';
        subData.modified_by =  (JSONcms_note.modified_by != undefined ) ? JSONcms_note.modified_by : '';
    }else{
        // console.log(element.cms_note);
        subData.created_by = '';
        subData.modified_by = '';
    }
    console.log(subData);
    return subData;
}