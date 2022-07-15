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
    if ($('#target_route').val()==='1') {
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

// function successCallUploadImage(response, passingdata) {
//     if (response.statusCode === 0 && response.data !== null) {
//         passingdata.img_tag.src = URL.createObjectURL(passingdata.file);
//         document.getElementById(passingdata.img_tag.id + '_name').value = response.data.uploadedImageFileName;
//     } else {
//         resetData(passingdata.input_tag, passingdata.img_tag);
//         document.getElementById(passingdata.img_tag.id + '_name').value = '';
//         showError(response.message);
//     }
// }

// function handleUploadImage(_this, event) {
//     event.preventDefault();
//     let img_tag_name = 'img_' + _this.name;
//     if (img_tag_name === 'img_path_2') {
//         path_2_required_alert.hidden = true;
//     }
//     let img_tag = document.getElementById(img_tag_name);
//     if (_this.value === '') {
//         resetData(_this, img_tag);
//     }
//     const [file] = _this.files;
//     if (file) {
//         if (file.size > 2050000) { // handle file
//             resetData(_this, img_tag);
//             showError('File is too big! Allowed memory size of 2MB');
//             return false;
//         };
//         uploadFileExternal(file, successCallUploadImage, {
//             'img_tag': img_tag,
//             'input_tag': _this,
//             'file': file
//         });
//     }
// }

function responseImageStatic(res, input) {
    console.log(res);
    if (res.statusCode === 0 && res.data !== null) {
        const [file] = input.files;
        const input_name = 'img_' + input.name;
        document.getElementById(input_name).src = URL.createObjectURL(file);
        console.table(input_name + '_name', res.data.uploadedImageFileName)
        document.getElementById(input_name + '_name').value = res.data.uploadedImageFileName;
    } else {
        showError(res.message);
    }
}

function handleUploadImage(input) {
    const [file] = input.files;
    if (file.size > 2050000) { // handle file
        resetData(input, null);
        showError('File is too big! Allowed memory size of 2MB');
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
        eventId: infoRow.getAttribute('data-id'),
        ordering:_thisInputTag.value,
        _token: $('meta[name="csrf-token"]').attr('content')
    };
    callAPIHelper("/bannermanage/updateordering", updateParams, 'POST', callApiUpdateOderSuccess);
}

function callApiUpdateOderSuccess(response){
    console.log(response);
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



function successGetViewBanner(response){
    if(response.error !== undefined){
        showError(response.error)
    }else{
        console.log(response);
        var banner = response.banner;
        var listTargetRoute = response.list_target_route;
        var listTypeBanner = response.list_type_banner;

        BannerDetail_titleVi.value  = banner.title_vi != undefined ? banner.title_vi : '';
        BannerDetail_titleEn.value = banner.title_en != undefined ? banner.title_en : '';
        var map_bannerType = findElementInArrayObjectByKeyValue(listTypeBanner, 'id', banner.event_type);
        var map_directionId = findElementInArrayObjectByKeyValue(listTargetRoute, 'id', banner.direction_id);

        BannerDetail_bannerType.value = map_bannerType != undefined ? map_bannerType.name : banner.event_type;

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
        if(banner.direction_id || banner.direction_url ){
            has_target_route.checked = true;
            box_target.hidden = false;
            BannerDetail_directionId.value = (map_directionId != undefined) ?  map_directionId.name : '';
            BannerDetail_directionURL.value = (banner.direction_url != undefined) ? banner.direction_url : '';
        }else{
            box_target.hidden = true;
            has_target_route.checked = false;
        }

        if(banner.is_show_home == 1){
            isShowHome.checked = true;
        }else{
            isShowHome.checked = false;
        }

        BannerDetail_link_to_edit.setAttribute('data-type', banner.bannerType);
        BannerDetail_link_to_edit.setAttribute('data-id', banner.bannerId);
        //end
        $('#showDetailBanner_Modal').modal('toggle');
    }
}

function viewBanner(_this){
    let row = _this.closest('tr');
    let infoRow = row.querySelector('.infoRow');

    callAPIHelper("/bannermanage/view/" + infoRow.getAttribute('data-id'),null,'GET',successGetViewBanner);
}

function editBanner(button){
    var bannerId = button.getAttribute('data-id');
    var editBannerLink =  base_url+`/bannermanage/edit/` + bannerId;
    window.location.href = editBannerLink;
}
