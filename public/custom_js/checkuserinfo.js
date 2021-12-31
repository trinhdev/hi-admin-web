function checkUserInfo(_this){
    let form = $(_this).closest('form');
    param = {
        _token:$('meta[name="csrf-token"]').attr('content'),
        input:$(form).find('input[name="input"]').val(),
    };
    window.location.href="/checkuserinfo?info=check";
    // callAPIHelper("/checkuserinfo/check",param,'GET',successCallCheckUserInfo);
}
function successCallCheckUserInfo(response){
    if(response.error != undefined){
        showList.classList.remove('card');
        showList.innerHTML = '';
        showError(response.error);
    }else{
        var html ='';
        var arrRemove = ['Id','Contract','FullName','Address','Location','Birthday','Phone','Email']
        response.data.forEach(element => {
            html += `<div class="card">
                        <div class="card-header collapsed" id="heading`+element.Id+`" data-toggle="collapse" data-target="#collapse`+element.Id+`" aria-expanded="true" aria-controls="collapse`+element.Id+`">
                            <span class="title"><b>ID: `+ element.Id+` - Contract: `+ element.Contract+` - Phone: `+element.Phone+` - `+element.FullName+`</b></span>
                            <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
                        </div>
                         <div id="collapse`+element.Id+`" class="collapse" aria-labelledby="heading`+element.Contract+`" data-parent="#showList">
                            <div class="card-body"> `;
            // for (const [key, value] of Object.entries(element)) {
            //     html+=`<div><b><i>`+ key+`:</b></i>     ` +value+`</div>`;
            // }
            arrRemove.forEach(key => {
                html+=`<div><b><i>`+key+`:</b></i>     ` +element[key]+`</div>`;
            });
            html+=`</div></div></div>`;
        });
       showList.innerHTML = html;
    }
}