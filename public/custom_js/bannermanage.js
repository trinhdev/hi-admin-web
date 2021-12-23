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
        // if (target_route.value === 'url_open_in_app' || target_route.value === 'url_open_out_app') {
        //     box_target.classList.add('border');
        //     box_target.classList.add('box-target');
           
        // } else {
        //     box_target.hidden = true;
        // }
    } else {
        // box_target.classList.remove('box-target');
        // box_target.classList.remove('border');
        box_target.hidden = true;
    }
}

$(".img_viewable").click(function () {
    $("#full-image").attr("src", $(this).attr("src"));
    $('#img_view_modal').modal('show');
});
async function handleUploadImage(_this, event) {
    event.preventDefault();
    img_tag_name = 'img_' + _this.name;
    if (img_tag_name == 'img_path_2') {
        path_2_required_alert.hidden = true;
    }
    img_tag = document.getElementById(img_tag_name);
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
        base64_img = await getBase64(file);
        base64_img = base64_img.replace(/^data:image\/[a-z]+;base64,/, "");

        uploadParam = {
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
    if (response.statusCode == 0 && response.data != null) {
        passingdata.img_tag.src = URL.createObjectURL(passingdata.file);
       document.getElementById(passingdata.img_tag.id+'_name').value = response.data.uploadedImageFileName
    } else {
        resetData(passingdata.input_tag, passingdata.img_tag);
        document.getElementById(passingdata.img_tag.id+'_name').value = "";
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
    data_required = getDataRequired();
    var passed = true;
    formData = getDataInForm(form);
    if (!$(has_target_route).is(':checked')) {
        delete data.target_route;
    }
    if (formData.bannerType == 'promotion') {
        if (formData.path_2 == undefined) {
            passed = false;
            path_2_required_alert.hidden = false;
        } else {
            path_2_required_alert.hidden = true;
        }
    }
    if (formData.target_route === 'url_open_in_app' || formData.target_route === 'url_open_out_app') {
        if (formData.direction_url == undefined) {
            passed = false;
            direction_url_required_alert.hidden = false;
        } else {
            direction_url_required_alert.hidden = true;
        }
    }
    if (passed) {
        handleSubmit(event, form);
    }
}

function checkEnableSave(form) {
    data_required = getDataRequired();
    formData = getDataInForm(form);
    let intersection = Object.keys(data_required).filter(x => !Object.keys(formData).includes(x));
    if (intersection.length === 0) {
        $('form').find(':submit').prop('disabled', false);
        return false;
    } else {
        $('form').find(':submit').prop('disabled', true);
        return true;
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
        'object':true,
        'object_type':true
    };
    return data;
}
function callApiGetListBanner(show_from = null,show_to = null,bannerType = null){
    uploadParam = {
        public_date_from : show_from,
        public_date_to : show_to,
        bannerType : bannerType
    };
    callAPIHelper("/bannermanage/initDatatable", uploadParam, 'GET', initBannerManage);
}
function filterData(){
    // $('#banner_manage').DataTable().destroy();
    $('#banner_manage').DataTable().clear();
    callApiGetListBanner(show_from.value, show_to.value, show_at.value);
}
function getDetailBanner(_this){
    let row = _this.closest('tr');
    let infoRow = row.querySelector('.infoRow');
    getParam = {
        bannerId : infoRow.innerHTML,
        bannerType : infoRow.getAttribute('data-type')
    };
    window.location.href= `/bannermanage/edit/`+infoRow.innerHTML+`/`+infoRow.getAttribute('data-type');
}