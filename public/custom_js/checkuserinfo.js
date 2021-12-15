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
        var html ='';
        console.log(response);
        //SGH918117
        /*
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Collapsible Group Item #1
                    </button>
                </h5>
                </div>

                
            </div>
        </div>
        */
        response.data.forEach(element => {
            html += `<div class="card">
                        <div class="card-header" id="heading`+element.Id+`" data-toggle="collapse" data-target="#collapse`+element.Id+`" aria-expanded="true" aria-controls="collapse`+element.Id+`">
                            <span class="title"><b>ID: `+ element.Id+` - Contract: `+ element.Contract+` - Phone: `+element.Phone+` - `+element.FullName+`</b></span>
                            <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
                        </div>
                         <div id="collapse`+element.Id+`" class="collapse" aria-labelledby="heading`+element.Contract+`" data-parent="#showList">
                            <div class="card-body"> `;
            for (const [key, value] of Object.entries(element)) {
                html+=`<div>`+ key+`:` +value+`</div>`;
            }
            html+=`</div></div></div>`;
        });
       showList.innerHTML = html;
    }
}