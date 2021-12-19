function onchangeTypeBanner(_this) {
    if (_this.value == 'promotion') {
        path_2.hidden = false;
    } else {
        path_2.hidden = true;
    }
}

function onchangeDirection() {
    console.log($(has_target_route).is(':checked'));
    if ($(has_target_route).is(':checked')) {
        if (target_route.value === 'url_open_in_app' || target_route.value === 'url_open_out_app') {
            direction_url.hidden = false;
        } else {
            direction_url.hidden = true;
        }
    }else{
        direction_url.hidden = true;
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
    if (response.statusCode == 0) {
        passingdata.img_tag.src = URL.createObjectURL(passingdata.file);
        passingdata.input_tag.text = response.uploadedImageFileName;
    } else {
        resetData(passingdata.input_tag, passingdata.img_tag);
        showError(response.message);
    }
}

function resetData(input_tag, img_tag) {
    input_tag.value = null;
    img_tag.src = "";
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
    if (formData.show_at == 'promotion') {
        if (formData.path_2 == undefined) {
            passed = false;
            path_2_required_alert.hidden = false;
        } else {
            path_2_required_alert.hidden = true;
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

function getDataInForm(form) {
    var formData = new FormData(form);
    var data = {};
    for (var pair of formData.entries()) {
        if (pair[1] instanceof File) {
            if (pair[1].size > 0) {
                data[pair[0]] = pair[1];
            }
        } else {
            if (pair[1].length > 0) {
                data[pair[0]] = pair[1];
            }
        }
    }
    return data;
}

function getDataRequired() {
    var data = {
        'title_vi': true,
        'title_en': true,
        'show_from': true,
        'show_to': true,
        'show_at': true,
    };
    return data;
}
