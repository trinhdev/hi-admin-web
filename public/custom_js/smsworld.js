
function getLogs(_this){
    let form = $(_this).closest('form');
    let date = new Date( $(form).find('input[name="date"]').val());
    let countryCode = $(form).find('input[name="country_code"]').val();
    let phone = $(form).find('input[name="phone"]').val();
    param = {
        _token:$('meta[name="csrf-token"]').attr('content')
    };
    if(phone != undefined && countryCode != undefined){
        param.PhoneNumber = countryCode+phone;
    };
    if(date != null && date != undefined && date != "Invalid Date"){
        param.Month = date.getMonth()+1;
        param.Year = date.getFullYear();
    };
    callAPIHelper("/smsworld/getlog",param,'POST',successCallGetListLog);
}

function successCallGetListLog(response){
    if(response.error != undefined){
        showLogs.innerHTML = '';
        showLogs.classList.remove('card');
        showError(response.error);
    }else{
        // showLogs.classList.add('card');
        var html = '';
        response.forEach(log => {
        //     html+=`<li class="position-relative booking">
        //     <div class="card-body media">
        //         <div class="media-body">
        //             <h5 class="mb-4">STT: `+log.STT+`</h5>
        //             <div class="mb-3">
        //                 <span class="mr-2 d-block d-sm-inline-block mb-2 mb-sm-0">Log Time:</span>
        //                 <span class="bg-light-green">`+log.Date+`</span>
        //             </div>
        //             <div class="mb-3">
        //                 <span class="mr-2 d-block d-sm-inline-block mb-2 mb-sm-0">Source:</span>
        //                 <span class="bg-light-green">`+log.Source+`</span>
        //             </div>
        //             <div class="mb-5">
        //                 <span class="mr-2 d-block d-sm-inline-block mb-1 mb-sm-0">Message:</span>
        //                 <span class="pr-2 mr-2">`+log.Message+`</span>
        //             </div>
        //         </div>
        //     </div></li>`;
        // });
        // html+='</ul>';
        html += `<div class="card">`;
        html +=`<div class="card-header" id="heading`+log.STT+`" data-toggle="collapse" data-target="#collapse`+log.STT+`" aria-expanded="true" aria-controls="collapse`+log.STT+`">
                    <span class="title"><b>STT : `+log.STT+`  - Phone: `+log.PhoneNumber+` -  Time: `+log.Date+`</b></span>
                    <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
                </div>`;
        html += ` <div id="collapse`+log.STT+`" class="collapse" data-parent="#showLogs">`;
        html += ` <div class="card-body">`;
        html += `<div>Source: `+log.Source+`</div>`;
        html += `<div>Message: `+log.Message+`</div>`;
        html += `</div>`;
        });
        showLogs.innerHTML = html;
    }
}