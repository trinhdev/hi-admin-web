
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
        showError(response.error);
    }else{
        var html = '';
        response.forEach(log => {
            html+=`<li class="position-relative booking">
            <div class="media">
                <div class="media-body">
                    <h5 class="mb-4">STT: `+log.STT+`</h5>
                    <div class="mb-3">
                        <span class="mr-2 d-block d-sm-inline-block mb-2 mb-sm-0">Log Time:</span>
                        <span class="bg-light-green">`+log.Date+`</span>
                    </div>
                    <div class="mb-3">
                        <span class="mr-2 d-block d-sm-inline-block mb-2 mb-sm-0">Source:</span>
                        <span class="bg-light-green">`+log.Source+`</span>
                    </div>
                    <div class="mb-5">
                        <span class="mr-2 d-block d-sm-inline-block mb-1 mb-sm-0">Message:</span>
                        <span class="pr-2 mr-2">`+log.Message+`</span>
                    </div>
                </div>
            </div>`;
        });
        showLogs.innerHTML = html;
    }
}