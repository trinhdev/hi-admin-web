"use strict";
function onchangeTypeBanner(_this) {
    if (_this.value == 'promotion') {
        path_2.hidden = false;
    } else {
        path_2.hidden = true;
    }
}

function onchangeDirection() {
    if ($(has_target_route).is(':checked')) {
        box_target.hidden = false;
        box_target.classList.add('border');
        box_target.classList.add('box-target');
    } else {
        box_target.classList.remove('box-target');
        box_target.classList.remove('border');
        box_target.hidden = true;
    }
}

$(".img_viewable").click(function () {
    $("#full-image").attr("src", $(this).attr("src"));
    $('#img_view_modal').modal('show');
});
async function handleUploadImage(_this, event) {
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
        var base64_img = await getBase64(file);
        var base64_img = base64_img.replace(/^data:image\/[a-z]+;base64,/, "");

        var uploadParam = {
            'imageFileName': file.name,
            'encodedImage': base64_img,
            _token: $('meta[name="csrf-token"]').attr('content')
        };
        callAPIHelper("/bannermanage/uploadImage", uploadParam, 'POST', successCallUploadImage, {
            'img_tag': img_tag,
            'input_tag': _this,
            'file': file
        });
    }
}

function successCallUploadImage(response, passingdata) {
    console.log(response);
    if (response.statusCode == 0 && response.data != null) {
        passingdata.img_tag.src = URL.createObjectURL(passingdata.file);
        document.getElementById(passingdata.img_tag.id + '_name').value = response.data.uploadedImageFileName;
        checkEnableSave(passingdata.input_tag.closest('form'));
    } else {
        resetData(passingdata.input_tag, passingdata.img_tag);
        document.getElementById(passingdata.img_tag.id + '_name').value = "";
        showError(response.message);
    }
}

function resetData(input_tag, img_tag) {
    input_tag.value = null;
    img_tag.src = "/images/image_holder.png";
}
const getBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
});

function validateData(event, form) {
    event.preventDefault();

    var passed = true;

    var formData = getDataInForm(form);
    if (!$(has_target_route).is(':checked')) {
        delete formData.direction_id;
    }
    var passed = checkSubmit(formData);
    if (passed.status) {
        handleSubmit(event, form);
    } else {
        showError('Missing Field !!')
    }
}

function checkEnableSave(form) {
    var formData = getDataInForm(form);
    if (checkSubmit(formData).status) {
        $('form').find(':submit').prop('disabled', false);
    } else {
        $('form').find(':submit').prop('disabled', true);
    }
}

function getDataRequired() {
    var data = {
        'title_vi': true,
        'title_en': true,
        'show_from': true,
        'show_to': true,
        'bannerType': true,
        'path_1': true,
        'img_path_1_name': true,
        'object': true,
        'object_type': true
    };
    return data;
}
function checkSubmit(formData) {
    const pathArray = window.location.pathname.split("/");
    let action = pathArray[2]; // action ['create','edit']
    if(action === 'edit'){
        return {
            status:true,
            data:null
        };
    }
    var data_required = getDataRequired();
    if ($(has_target_route).is(':checked')) {
        data_required.direction_id = true;
        if (formData.direction_id === 'url_open_in_app' || formData.direction_id === 'url_open_out_app') {
            data_required.direction_url = true;
        }
    }
    if (formData.bannerType == 'promotion') {
        data_required.path_2 = true;
        data_required.img_path_2_name = true;
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

function callApiGetListBanner(show_from = null, show_to = null, bannerType = null) {
    var uploadParam = {
        public_date_from: show_from,
        public_date_to: show_to,
        bannerType: bannerType,
        _token: $('meta[name="csrf-token"]').attr('content')
    };
    callAPIHelper("/bannermanage/initDatatable", uploadParam, 'GET', initBannerManage);
}

function filterData() {
    // $('#banner_manage').DataTable().destroy();
    $('#banner_manage').DataTable().clear();
    callApiGetListBanner(show_from.value, show_to.value, show_at.value);
}

function getDetailBanner(_this) {
    let row = _this.closest('tr');
    let infoRow = row.querySelector('.infoRow');
    window.location.href = `/bannermanage/edit/` + infoRow.innerHTML + `/` + infoRow.getAttribute('data-type');
}

function changeFormatDateTimeLocal(dateInput) {
    var date = new Date(dateInput);
    var str = "";
    if (date != null && date != undefined && date != "Invalid Date") {
        var day = date.getDate();
        if (day < 10) {
            day = "0" + day;
        }
        var month = date.getMonth() + 1;
        if (month < 10) {
            month = "0" + month;
        }
        var year = date.getFullYear();
        str = year + "-" + month + "-" + day;
    };
    str += ` ${date.getHours().toString().padStart(2, '0')}:${
        date.getMinutes().toString().padStart(2, '0')}:${
            date.getSeconds().toString().padStart(2, '0')}`;
    return str;
}

function updateOrdering(_thisInputTag){
    let row = _thisInputTag.closest('tr');
    let infoRow = row.querySelector('.infoRow');
    let updateParams = {
        bannerId: infoRow.innerHTML,
        bannerType: infoRow.getAttribute('data-type'),
        ordering:_thisInputTag.value,
        _token: $('meta[name="csrf-token"]').attr('content')
    };
    callAPIHelper("/bannermanage/updateordering", updateParams, 'POST', callApiUpdateOderSuccess);
}

function callApiUpdateOderSuccess(response){
    if(response.statusCode != 0){
        showError(response.message);
    }
}