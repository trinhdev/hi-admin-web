$(document).ready(function () {
    initSelect();
    settings_on_search();
    $(document).on('pjax:end', function () {
        initSelect();
        const pathArray = window.location.pathname.split("/");
        let segment = pathArray[1]; //first uri param
        switch (segment) {
            case 'user':
                initUser();
                break;
            case 'modules':
                initModule();
                break;
            case 'groups':
                initGroup();
                break;
            case 'roles':
                initRoles();
                break;
            case 'groupmodule':
                initGroupModule();
                break;
            case 'manageotp':
                initManageOtp();
            case 'logactivities':
                initLogActivities();
                break;
            case 'settings':
                initSettings();
                settings_on_search();
                break;
            case 'hidepayment':
                initHidePaymentLogs();
                break;
            case '':
            case 'home':
                drawChart();
                break
        }

    });
    $(document).on('pjax:popstate', function (event) {
        event.preventDefault();
        $.pjax.reload('#pjax');
    });
    // $(document).on('pjax:error', function (event, xhr, textStatus, errorThrown, options) {
    //     $.pjax.reload('#pjax');
    // });

});

function initSelect() {
    $('form select').selectpicker();
}

function read(obj) {
    if ($(obj).hasClass("less")) {
        $(obj).removeClass("less");
        $(obj).html("Showmore");
    } else {
        $(obj).addClass("less");
        $(obj).html("Showless");
    }
    $(obj).parent().prev().toggle();
    $(obj).prev().toggle();
    return false;
}

function initModule() {
    $('#modules').DataTable({
        "processing": true,
        "serverSide": true,
        "select": true,
        "dataSrc": "tableData",
        "bDestroy": true,
        "scrollX": true,
        retrieve: true,
        "ajax": {
            url: "/modules/initDatatable"
        },
        "columns": [{
                data: 'id',
                name: "id",
                title: "Id"
            },
            {
                data: 'module_name',
                name: "module_name",
                title: "Module Name"
            },
            {
                data: "uri",
                name: "uri",
                title: "Uri"
            },
            {
                data: "group_module_id",
                name: "group_module_id",
                title: "Group Module"
            },
            {
                data: "status",
                name: "status",
                title: "Status"
            },
            {
                data: "created_at",
                name: "created_at",
                title: "Created at"
            },
            {
                data: "created_by",
                name: "created_by",
                title: "Created By"
            },
            {
                data: "updated_at",
                name: "updated_at",
                title: "Updated at"
            },
            {
                data: "updated_by",
                name: "updated_by",
                title: "Updated By"
            },
            {
                data: "action",
                name: "action",
                title: "Action",
                sortable: false
            }
        ],
        "language": {
            "emptyTable": "No Record..."
        },
        "initComplete": function (setting, json) {
            $('#modules').show();
        },
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
        searchDelay: 500
    });
}

function initGroupModule() {
    $('#group-module').DataTable({
        "processing": true,
        "serverSide": true,
        "select": true,
        "dataSrc": "tableData",
        "bDestroy": true,
        "scrollX": true,
        retrieve: true,
        "ajax": {
            url: "/groupmodule/initDatatable"
        },
        "columns": [{
                data: 'id',
                name: "id",
                title: "Id"
            },
            {
                data: 'group_module_name',
                name: "group_module_name",
                title: "Group Module Name"
            },
            {
                data: "created_at",
                name: "created_at",
                title: "Created at"
            },
            {
                data: "created_by",
                name: "created_by",
                title: "Created by"
            },
            {
                data: "updated_at",
                name: "updated_at",
                title: "Updated at"
            },
            {
                data: "updated_by",
                name: "updated_by",
                title: "Updated by"
            },
            {
                data: "action",
                name: "action",
                title: "Action"
            }
        ],
        "language": {
            "emptyTable": "No Record..."
        },
        "initComplete": function (setting, json) {
            $('#modules').show();
        },
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
        searchDelay: 500
    });
}

function initUser() {
    $('#userTable').DataTable({
        "processing": true,
        "serverSide": true,
        "select": true,
        "dataSrc": "tableData",
        "bDestroy": true,
        responsive: true,
        "scrollX": true,
        retrieve: true,
        "ajax": {
            url: "user/initDatatable"
        },
        "columns": [{
                data: "id",
                name: "id",
                title: "Id"
            },
            {
                data: "name",
                name: "name",
                title: "Name"
            },
            {
                data: "email",
                name: "email",
                title: "Email"
            },
            {
                data: "role_id",
                name: "role_id",
                title: "Role"
            },
            {
                data: "created_at",
                name: "created_at",
                title: "Created at"
            },
            {
                data: "action",
                name: "action",
                title: "Action",
                sortable: false
            }
        ],
        "language": {
            "emptyTable": "No Record..."
        },
        "initComplete": function (setting, json) {
            console.log(json);
            $('#userTable').show();
        },
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
        searchDelay: 500,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ]
    });
}

function initGroup() {
    $('#groupTable').DataTable({
        "order": [
            [0, "desc"]
        ],
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        "bDestroy": true,
        "scrollX": true,
        retrieve: true,
        ajax: {
            url: base_url + '/groups/getList',
        },
        searchDelay: 500,
        columns: [{
                data: 'id'
            },
            {
                data: 'group_name'
            },
            {
                data: 'created_by'
            },
            {
                data: "action",
                name: "action",
                title: "Action",
                sortable: false
            }
        ],
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
    });
}

function initRoles() {
    $('#rolesTable').DataTable({
        "order": [
            [0, "desc"]
        ],
        responsive: true,
        searchDelay: 500,
        processing: true,
        "bDestroy": true,
        serverSide: true,
        "scrollX": true,
        retrieve: true,
        ajax: {
            url: base_url + '/roles/getList',
        },
        searchDelay: 500,
        columns: [{
                data: 'id'
            },
            {
                data: 'role_name'
            },
            {
                data: 'created_by'
            },
            {
                data: "action",
                name: "action",
                title: "Action",
                sortable: false
            }
        ],
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
    });
}

function initLogActivities() {
    $('#logTable').DataTable({
        "order": [
            [0, "desc"]
        ],
        responsive: true,
        searchDelay: 500,
        processing: true,
        "bDestroy": true,
        serverSide: true,
        "scrollX": true,
        retrieve: true,
        ajax: {
            url: base_url + '/logactivities/initDatatable',
        },
        searchDelay: 500,
        columns: [{
                data: 'id',
            },
            {
                data: 'user_id',
                className: "text-center"
            },
            {
                data: 'email',
                className: "text-center"
            },
            {
                data: 'user_role',
                className: "text-center"
            },
            {
                data: 'method',
                className: "text-center"
            },
            {
                data: 'url'
            },
            {
                data: 'created_at',
                class: 'font-weight-bold'
            },
            {
                data: 'param',
                render: function (data, type, full) {
                    var showChar = 200;
                    var ellipsestext = "...";
                    var moretext = "Show More";
                    var lesstext = "Show Less";
                    var contentt = JSON.stringify(data);
                    var content = contentt.replace(/["]+/g, '').substring(0, contentt.length - 1);
                    if (content.length > showChar) {
                        var c = content.substr(0, showChar);
                        var h = content.substr(showChar, content.length - showChar);
                        var html = c + '<span class="moreellipses">' + ellipsestext + '</span><span class="morecontent"><span style="display:none">' + h + '</span>&nbsp;&nbsp;<a onclick="read(this)" class="morelink" style="cursor: pointer;">' + moretext + '</a></span>'; //here call the read() function
                        return html.toString();
                    }
                    return data;
                }
            },
            {
                data: 'ip',
                className: "text-center",
            },
            {
                data: 'agent'
            }
        ],
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
    });
}

function initManageOtp() {
    $('#manage-otp').DataTable({
        "processing": true,
        "serverSide": true,
        "select": true,
        "dataSrc": "tableData",
        "bDestroy": true,
        "scrollX": true,
        retrieve: true,
        "ajax": {
            url: "/modules/initDatatable"
        },
        "columns": [{
                data: 'otp',
                name: "otp",
                title: "OTP"
            },
            {
                data: 'otp_time',
                name: "otp_time",
                title: "Time OTP"
            },
            {
                data: "phone",
                name: "phone",
                title: "Phone number"
            },
            {
                data: "status",
                name: "status",
                title: "Status"
            },
            {
                data: "created_at",
                name: "created_at",
                title: "Created at"
            },
            {
                data: "created_by",
                name: "created_by",
                title: "Created By"
            },
            {
                data: "updated_at",
                name: "updated_at",
                title: "Updated at"
            },
            {
                data: "updated_by",
                name: "updated_by",
                title: "Updated By"
            },
            {
                data: "action",
                name: "action",
                title: "Action",
                sortable: false
            }
        ],
        "language": {
            "emptyTable": "No Record..."
        },
        "initComplete": function (setting, json) {
            $('#manage-otp').show();
        },
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
        searchDelay: 500
    });
}

function initSettings() {
    $('#settings').DataTable({
        "processing": true,
        "serverSide": true,
        "select": true,
        "dataSrc": "tableData",
        "bDestroy": true,
        "scrollX": true,
        "retrieve": true,
        // "autoWidth": false,
        "fixedColumns": true,
        "ajax": {
            url: "/settings/initDatatable"
        },
        "columnDefs": [
            { "width": 20, "targets": 2 },
        ],
        "columns": [{
                data: 'id',
                name: "id",
                title: "Id"
            },
            {
                data: 'name',
                name: "name",
                title: "Unique name"
            },
            {
                data: "value",
                name: "value",
                title: "Value",
                render: function(data, type, row) {
                    const htmlEntities = {
                        "&": "&amp;",
                        "<": "&lt;",
                        ">": "&gt;",
                        '"': "&quot;",
                        "'": "&apos;"
                    };
                    var value = JSON.parse(String(data).replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"'));
                    var template = badgeArrayView(value);
                    return template;
                },
                width: 20
            },
            {
                data: "created_at",
                name: "created_at",
                title: "Created at"
            },
            {
                data: "created_by",
                name: "created_by",
                title: "Created By"
            },
            {
                data: "updated_at",
                name: "updated_at",
                title: "Updated at"
            },
            {
                data: "updated_by",
                name: "updated_by",
                title: "Updated By"
            },
            {
                data: "action",
                name: "action",
                title: "Action",
                sortable: false
            }
        ],
        "language": {
            "emptyTable": "No Record..."
        },
        "initComplete": function (setting, json) {
            $('#settings').show();
        },
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
        searchDelay: 500
    });
}

function initHidePaymentLogs() {
    $('#hide-payment').DataTable({
        "processing": true,
        "serverSide": true,
        "select": true,
        "dataSrc": "tableData",
        "bDestroy": true,
        "scrollX": true,
        "pageLength": 5,
        "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
        "order": [[ 6, "desc" ]],
        retrieve: true,
        "ajax": {
            url: "/hidepayment/initDatatable"
        },
        "columns": [{
                data: 'id',
                name: "id",
                title: "Id"
            },
            {
                data: 'version',
                name: "version",
                title: "Version"
            },
            {
                data: "isUpStoreAndroid",
                name: "isUpStoreAndroid",
                title: "Android",
                render: function(data, type, row) {
                    return (data == "0") ? "Show Payment" : "Hide Payment";
                },
            },
            {
                data: "isUpStoreIos",
                name: "isUpStoreIos",
                title: "IOS",
                render: function(data, type, row) {
                    return (data == "0") ? "Show Payment" : "Hide Payment";
                },
            },
            {
                data: "api_status",
                name: "api_status",
                title: "API status"
            },
            {
                data: "error_mesg",
                name: "error_mesg",
                title: "Error message"
            },
            {
                data: "created_at",
                name: "created_at",
                title: "Created at"
            },
            {
                data: "created_by",
                name: "created_by",
                title: "Created By"
            },
        ],
        "language": {
            "emptyTable": "No Record..."
        },
        "initComplete": function (setting, json) {
            $('#hide-payment').show();
        },
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
        searchDelay: 500
    });
}

function badgeArrayView(arrayInput) {
    var badge = ['bg-primary', 'bg-secondary', 'bg-success', 'bg-danger', 'bg-warning text-dark', 'bg-info text-dark', 'bg-light text-dark', 'bg-dark'];
    var count_badge = 0;
    var template = ``;
    $.map( arrayInput, function( n, i ) {
        if (count_badge == badge.length) {
            count_badge = 0;
        }
        template += `<span class="badge ${badge[count_badge]}">${JSON.stringify(n)}</span> `;
        count_badge++;
    });
    return template;
}

function settings_on_search() {
    $('form .bs-searchbox input').keyup(function(e) {
        if (e.which == 13) {
            var search = $(".bs-searchbox input").val();
            $("#value").append($('<option>', {
                value: search,
                text: search
            }));
            $('#value').selectpicker('refresh');
            $('#value').selectpicker('selectAll');
        }
    });

    $('#value').on('changed.bs.select', function (e) {
        $("#hidden-value").val('[' + $("#value").val().join() + ']');
    });
}
