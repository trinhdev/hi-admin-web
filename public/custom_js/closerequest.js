function closeRequest(_this) {
    let li_tag = $(_this).closest("li");
    let _report_id = $(li_tag).attr('id')
    let _token = $('meta[name="csrf-token"]').attr('content');
    param = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        report_id: _report_id
    };
    callAPIHelper("/closehelprequest/closeRequest", param, 'POST', successCloseRequest,li_tag);
}
function getListReport(_this){
    let form = $(_this).closest('form');
    param = {
        _token:$('meta[name="csrf-token"]').attr('content'),
        contractNo:$(form).find('input[name="contractNo"]').val()
    };
    callAPIHelper("/closehelprequest/getListReportByContract",param,'POST',successCallGetListReport);
}
function successCallGetListReport(response){
    if(response.error != undefined){
        showListReport.classList.remove('card');
        showListReport.innerHTML = '';
        showError(response.error);
    }else{
        showListReport.classList.add('card');
        var listColor = ['warning','info','primary','sucess'];
        var html = `<div class="card-header"> Contract : `+response.contract+`</div>
        <ul class="list-unstyled">`;
        for (const [key, report] of Object.entries(response.data) ){
            html += `<li class="position-relative booking" id ="`+report.reportId+`">
            <div class="card-body media">
                <div class="media-body">
                    <h5 class="mb-4">ID: `+report.reportId;
                    for (const [key2, step] of Object.entries(report.stepStatus)) {
                        html += `<span class="badge badge-`+listColor[key2]+` ml-3">`+step.name+`</span>`
                    };
                    html+= `</h5>
                    <div class="mb-3">
                        <span class="mr-2 d-block d-sm-inline-block mb-2 mb-sm-0">Report Type:</span>
                        <span class="bg-light-green">`+report.reportType+` -`+report.reportName+`</span>
                    </div>
                    <div class="mb-3">
                        <span class="mr-2 d-block d-sm-inline-block mb-2 mb-sm-0">Sub Type name:</span>
                        <span class="bg-light-green">`+report.subTypeName+`</span>
                    </div>

                    <div class="mb-5">
                        <span class="mr-2 d-block d-sm-inline-block mb-1 mb-sm-0">Note:</span>
                        <span class="pr-2 mr-2">`+report.note+`</span>
                    </div>
                </div>
            </div>`;
            // if(report.reportType === 'HT-KYTHUAT' && report.isShowBtnCancel == 1){
            html+=`
            <div class="card-footer text-center">
                <a onclick="dialogConfirmWithAjax(closeRequest,this)" type="button"class="btn btn-danger mr-2"><i class="far fa-times-circle mr-2"></i>Close</a>
            </div>`;
            // }
        html+=`</li></ul>`;
        };
        showListReport.innerHTML = html;
    }
}
function successCloseRequest(response,li_tag) {
    if (response == true) {
        $(li_tag).remove();
        swal.fire({
            icon: 'success',
            title: 'Success!',
            html: `Close Success!`
        });
    } else {
        swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: `Close Fail!`
        });
    }
};
