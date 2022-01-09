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
        // var base64_img = await getBase64(file);
        // var base64_img = base64_img.replace(/^data:image\/[a-z]+;base64,/, "");

        var uploadParam = {
            // 'imageFileName': file.name,
            // 'encodedImage': base64_img,
            file:file,
            _token: $('meta[name="csrf-token"]').attr('content')
        };
        uploadFile(file, successCallUploadImage, {
            'img_tag': img_tag,
            'input_tag': _this,
            'file': file
        });
        // callAPIHelper("/bannermanage/uploadImage", uploadParam, 'POST', successCallUploadImage, {
        //     'img_tag': img_tag,
        //     'input_tag': _this,
        //     'file': file
        // });
    }
}

function successCallUploadImage(response, passingdata) {
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
    window.location.href = `/bannermanage/edit/` + infoRow.getAttribute('data-id') + `/` + infoRow.getAttribute('data-type');
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
    }else{
        showSuccess('Updated!');
    }
}
function changePublicDateTime(dateTimeInput){
    var form = $(dateTimeInput).closest('form');
    var show_from = $(form).find('input[name="show_from"]');
    var show_to = $(form).find('input[name="show_to"]');

    show_from.attr("max",show_to.val());
    show_to.attr("min",show_from.val());
}

function viewBanner(_this){
    let row = _this.closest('tr');
    let infoRow = row.querySelector('.infoRow');

    callAPIHelper("/bannermanage/view/" + infoRow.getAttribute('data-id') + `/` + infoRow.getAttribute('data-type'),null,'GET',successGetViewBanner);
}

function successGetViewBanner(response){
    if(response.error != undefined){
        showError(response.error)
    }else{
        console.log(response);
        var banner = response.banner;
        var listTargetRoute = response.list_target_route;
        var listTypeBanner = response.list_type_banner;

        BannerDetail_titleVi.value  = banner.title_vi != undefined ? banner.title_vi : '';
        BannerDetail_titleEn.value = banner.title_en != undefined ? banner.title_en : '';
        var map_bannerType = findElementInArrayObjectByKeyValue(listTypeBanner, 'id', banner.bannerType);
        var map_directionId = findElementInArrayObjectByKeyValue(listTargetRoute, 'id', banner.direction_id);

        BannerDetail_bannerType.value = map_bannerType != undefined ? map_bannerType.name : banner.bannerType;

        BannerDetail_image.src = banner.image != undefined ? banner.image : '';
        if(banner.bannerType == 'promotion'){
            path_2.hidden = false;
            BannerDetail_thump_image.src = banner.thumb_image != undefined ? banner.thumb_image : '';
        }else{
            path_2.hidden = true;
        }

        BannerDetail_public_date_start.value = banner.public_date_start != undefined ? banner.public_date_start : '';
        BannerDetail_public_date_end.value = banner.public_date_end != undefined ? banner.public_date_end : '';

        //target route
        if(banner.direction_id != undefined || banner.direction_url != undefined){
            has_target_route.checked = true;
            box_target.hidden = false;
            BannerDetail_directionId.value = (map_directionId != undefined) ?  map_directionId.name : '';
            BannerDetail_directionURL.value = (banner.direction_url != undefined) ? banner.direction_url : '';
        }else{
            box_target.hidden = true;
            has_target_route.checked = false;
        }

        if(banner.is_highlight == 1){
            isHighlight.checked = true;
        }else{
            isHighlight.checked = false;
        }

        BannerDetail_link_to_edit.setAttribute('data-type', banner.bannerType);
        BannerDetail_link_to_edit.setAttribute('data-id', banner.bannerId);
        //end
        $('#showDetailBanner_Modal').modal('toggle');
    }
}
function editBanner(button){
    var bannerType = button.getAttribute('data-type');
    var bannerId = button.getAttribute('data-id');

    bannerType = (bannerType == 'bannerHome') ? 'highlight' : bannerType;
    var editBannerLink =  base_url+`/bannermanage/edit/` + bannerId + `/` + bannerType;
    window.location.href = editBannerLink;
}
function convertDetailBanner(element){
    var toDay = new Date();
    let subData = {
        bannerId: '',
        bannerType: '',
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
        date_created: '',
        created_by: '',
        modified_by: '',
        is_banner_expired: false
    };
    if (element.banner_id != undefined) {
        subData.bannerId = element.banner_id;
        subData.title_vi = element.banner_title != undefined ? element.banner_title : '';
        subData.bannerType = element.custom_data != undefined ? element.custom_data : '';
        subData.image = element.image_url != undefined ? element.image_url : '';
        subData.ordering = element.ordering != undefined ? element.ordering : '-1';
        subData.view_count = element.view_count != undefined ? element.view_count : '0';
        subData.direction_url = element.direction_url != undefined ? element.direction_url : '';
        subData.date_created = element.date_created;
        subData.is_banner_expired = element.is_selected ? false : true;
    } else {
        let public_date_end = new Date(element.public_date_end);
        subData.bannerId = element.event_id;
        subData.title_vi = element.title_vi != undefined ? element.title_vi : '';
        subData.bannerType = element.event_type != undefined ? element.event_type : '';
        if(subData.bannerType === 'promotion'){
            subData.image = element.thumb_image != undefined ? (URL_STATIC+'/upload/images/event/'+element.thumb_image) : element.image;
        }else{
            subData.image = element.image != undefined ? element.image : '';
        }
        subData.ordering = element.ordering != undefined ? element.ordering_on_home : '-1';
        subData.view_count = element.view_count != undefined ? element.view_count : '0';
        subData.direction_url = element.event_url != undefined ? element.event_url : '';
        subData.date_created = element.date_created;
        subData.is_banner_expired = (public_date_end < toDay) ? true : false;

        subData.created_by = element.created_by != undefined ? element.created_by : '';
        subData.public_date_start = element.public_date_start != undefined ? element.public_date_start : '';
        subData.public_date_end = element.public_date_end != undefined ? element.public_date_end : '';
        subData.modified_by = element.modified_by != undefined ? element.modified_by : '';
    }
    return subData;
}