function onchangeTypeBanner(_this){
    if(_this.value == 'promotion'){
        path_2.hidden = false;
    }else{
        path_2.hidden = true;
    }
}

async function handleUploadImage(_this,event){
    event.preventDefault();
    img_tag_name = 'img_'+_this.name;
    img_tag =  document.getElementById(img_tag_name);
    const [file] = _this.files;
    if (file) {
        if(file.size > 2050000){ // handle file
            resetData(_this,img_tag);
            showError("File is too big! Allowed memory size of 2MB");
            return false;
        };
        base64_img = await getBase64(file);
        base64_img = base64_img.replace(/^data:image\/[a-z]+;base64,/, "");

        uploadParam ={
            'imageFileName' : file.name,
            'encodedImage' : base64_img,
            _token:$('meta[name="csrf-token"]').attr('content')
        };
        callAPIHelper("/bannermanage/uploadImage",uploadParam,'POST',successCallUploadImage,{'img_tag':img_tag,'input_tag':_this,'file':file});
    }
}
function successCallUploadImage(response,passingdata){
    if(response.statusCode == 0){
        showSuccess(response.message);
        passingdata.img_tag.src = URL.createObjectURL(passingdata.file);
        passingdata.input_tag.text = response.uploadedImageFileName;
    }else{
        resetData(passingdata.input_tag,passingdata.img_tag);
        showError(response.message);
    }
}
function resetData(input_tag,img_tag){
    input_tag.value = null;
    img_tag.src = "";
}
const getBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
});