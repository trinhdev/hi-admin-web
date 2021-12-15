function checkUserInfo(_this){
    let form = $(_this).closest('form');
    param = {
        _token:$('meta[name="csrf-token"]').attr('content'),
        input:$(form).find('input[name="input"]').val(),
    };
    callAPIHelper("/checkuserinfo/check",param,'POST',successCallCheckUserInfo);
}
function successCallCheckUserInfo(response){
    if(response.error != undefined){
        showList.classList.remove('card');
        showList.innerHTML = '';
        showError(response.error);
    }else{
        var html = '';
        console.log(response);
        //SGH918117
        response.data.forEach(element => {
            html += `<div class = "card card-body">`
            for (const [key, value] of Object.entries(element)) {
                html+=`<div>`+key+`:`+value+`</div>`
            }
            html+=`</div>`;
        });
       showList.innerHTML = html;
    }
}