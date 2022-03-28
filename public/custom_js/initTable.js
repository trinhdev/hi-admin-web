$(document).ready(function () {
    initSelect();
    settings_on_search();
    // $(document).on('pjax:end', function () {
    initSelect();
    const pathArray = window.location.pathname.split("/");
    let segment = pathArray[1]; //first uri param
    let segment2 = pathArray[2];
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
        case 'bannermanage':
            callApiGetListBanner();
            break;
        case 'checkuserinfo':
            initCheckUserInfo();
            break;
        case 'smsworld':
            initSmsWorld();
            break;
        case 'checklistmanage':
            initCheckListManage();
            break;
        case 'iconmanagement':
            initIconmanagement();
            break;
        case 'closehelprequest':
            initCloseHelpReqest();
            break;
        case 'iconcategory':
            initIconcategory();
            break;
        case 'iconconfig':
            initIconconfig();
            break;
        case 'iconapproved':
            initIconapproved();
        case 'ftel-phone':
            initFtelPhone();
            break;
        case '':
        case 'home':
            drawChart();
            break;
    }


    // });
    // $(document).on('pjax:popstate', function (event) {
    //     event.preventDefault();
    //     $.pjax.reload('#pjax');
    // });
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
            title: 'No.',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
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
            title: 'No.',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
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
            title: 'No.',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
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
            $('#userTable').show();
        },
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
        searchDelay: 500,
    });
}

function initGroup() {
    $('#groupTable').DataTable({
        "order": [
            [1, "desc"]
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
            title: 'No.',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
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
            [1, "desc"]
        ],
        responsive: true,
        processing: true,
        "bDestroy": true,
        "dataSrc": "tableData",
        serverSide: true,
        "scrollX": true,
        retrieve: true,
        ajax: {
            url: base_url + '/roles/getList',
        },
        columns: [{
            title: 'No.',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
            data: 'id',
        },
        {
            data: 'role_name',
        },
        {
            data: 'created_by',
        },
        {
            data: "action",
            name: "action",
            title: "Action",
            sortable: false
        }
        ],
        "initComplete": function (setting, json) {
            $('#rolesTable').show();
        },
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
        searchDelay: 500,
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
            title: 'No.',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
            data: 'id',
        },
        {
            data: 'user_id',
            className: "text-center"
        },
        {
            data: 'user.email',
            className: "text-center"
        },
        {
            data: 'user.role.role_name',
            className: "text-center",
            searchable: false
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
            title: 'No.',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
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
        "columnDefs": [{
            "width": 20,
            "targets": 2
        },],
        "columns": [{
            title: 'No.',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
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
            render: function (data, type, row) {
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
        "lengthMenu": [5, 10, 25, 50, 75, 100],
        orderMulti: true,
        "order": [
            [7, "desc"]
        ],
        retrieve: true,
        "ajax": {
            url: "/hidepayment/initDatatable"
        },
        "columns": [{
            title: 'No.',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
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
            data: 'isUpStoreAndroid',
            name: "isUpStoreAndroid",
            title: "Platform",
            render: function (data, type, row) {
                var platform = '';
                if (row.isUpStoreAndroid) {
                    platform += `<span class="badge badge-primary" style="margin-right: 5px">Android</span>`;
                }

                if (row.isUpStoreIos) {
                    platform += `<span class="badge badge-secondary" style="margin-right: 5px">IOS</span>`;
                }
                return platform;
            }
        },
        {
            data: "isUpStoreIos",
            name: "isUpStoreIos",
            title: "Action",
            render: function (data, type, row) {
                var action = '';

                if (row.isUpStoreAndroid == '1') {
                    action += `<span class="badge badge-danger" style="margin-right: 5px">Hide Android</span>`;
                }

                if (row.isUpStoreAndroid == '0') {
                    action += `<span class="badge badge-success" style="margin-right: 5px">Show Android</span>`;
                }

                if (row.isUpStoreIos == '1') {
                    action += `<span class="badge badge-danger" style="margin-right: 5px">Hide IOS</span>`;
                }

                if (row.isUpStoreIos == '0') {
                    action += `<span class="badge badge-success" style="margin-right: 5px">Show IOS</span>`;
                }
                return action;
            }
        },
        {
            data: "user.name",
            name: "user.name",
            title: "Created By",
        },
        {
            data: "error_mesg",
            name: "error_mesg",
            title: "Status",
            render: function (data, type, row) {
                return (data == 'Thành công') ? `<span class="badge bg-success">${data}</span>` : `<span class="badge bg-danger">${data}</span>`;
            }
        },
        {
            data: "created_at",
            name: "created_at",
            title: "Created at"
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

function initBannerManage(response) {
    var dataTable = [];
    var activeBanner = [];
    var unactiveBanner = [];
    var flagAcl = false;
    var stt = 1;
    response.data.forEach(element => {
        let subData = convertDetailBanner(element);
        (subData.is_banner_expired) ? unactiveBanner.push(subData) : activeBanner.push(subData);
    });
    activeBanner = activeBanner.sort(function (first, seccond) {
        return new Date(seccond.date_created) - new Date(first.date_created);
    });
    unactiveBanner.sort(function (first, seccond) {
        return new Date(seccond.date_created) - new Date(first.date_created);
    });
    dataTable = activeBanner.concat(unactiveBanner);
    var columnData = [{
        title: 'STT',
        className: 'text-center',
        render: function (data, type, row, meta) {
            return `<span class ="infoRow" data-type="` + row.bannerType + `" data-id = "` + row.bannerId + `">` + parseInt(meta.row + 1) + `</span>`;
        },
        className: 'text-center'
    },
    {
        data: 'title_vi',
        title: "Tiêu Đề"
    },
    {
        data: 'image',
        title: "Ảnh Banner",
        "render": function (data, type, row) {
            return `<img src="` + data + `"  style="width:150px" onerror="this.onerror=null;this.src='/images/img_404.svg';"  onclick ="window.open('` + data + `').focus()"/>`;
        },
        "sortable": false,
        className: 'text-center'
    },
    // {
    //     data :'direction_url',
    //     title: "Direction URL",
    //     "render": function(data, type, row) {
    //         return `<a href="`+data+`" target="_blank">`+data+`</a>`;
    //     }
    // },
    {
        data: 'bannerType',
        title: 'Loại Banner',
        className: 'text-center'
    },
    {
        data: 'public_date_start',
        title: 'Ngày Hiển Thị'
    },
    {
        data: 'public_date_end',
        title: 'Ngày kết thúc'
    },
    {
        data: 'is_banner_expired',
        title: 'Trạng Thái',
        render: function (data, type, row) {
            let is_show = (data) ? 'Hết hạn' : 'Còn hạn';
            let badge = (data) ? 'badge badge-danger' : 'badge badge-success';
            return `<h4 class="` + badge + `">` + is_show + `</h4>`;
        },
        className: 'text-center'
    },
    {
        data: 'ordering',
        title: 'Độ ưu tiên',
        "render": function (data, type, row) {
            let disable = row.is_banner_expired ? 'disabled' : '';
            return `<input type="number" onchange="updateOrdering(this)" style="width:50px" value="` + data + `" ` + disable + `/>`;
        },
        "sortable": false,
        className: 'text-center'
    },
    {
        data: 'view_count',
        title: 'Số lượt click',
        className: 'text-center'
    },
    {
        data: 'date_created',
        title: 'Ngày tạo'
    },
    {
        data: 'created_by',
        title: 'Người Tạo'
    },
    {
        data: 'modified_by',
        title: 'Người cập nhật'
    }
    ];

    if (response.isAdmin === true) {
        flagAcl = true;
    } else {
        var aclCurrentModule = response.aclCurrentModule;
        if (aclCurrentModule.update == 1) {
            flagAcl = true;
        }
    }
    if (flagAcl) {
        columnData.push({
            title: 'Hành Động',
            render: function (data, type, row) {
                var bannerType = row.bannerType;
                if (bannerType == 'highlight') {
                    bannerType = 'bannerHome';
                };
                var exists = 0 != $('#show_at option[value="' + bannerType + '"]').length;
                if (exists === false) return "";
                return `<div style="display:flex; justify-content:center">
                    <a style="float: left; margin-right: 5px" type="button" onclick="viewBanner(this)" class="btn btn-sm fas fa-eye btn-icon bg-primary"></a>
                   <a style="" type="button" onclick="getDetailBanner(this)" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>
                    `;
                // return `<a style="" type="button" onclick="getDetailBanner(this)" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>`;
            },
            "sortable": false
        });
    } else {
        columnData.push({
            title: 'Hành Động',
            render: function (data, type, row) {
                if (row.bannerType === 'event_normal') return "";
                return `<div></div>`;
            },
            className: 'text-center',
            "sortable": false
        });
    };
    $('#banner_manage').DataTable({
        // "bAutoWidth": false,
        // "autoWidth":false,
        data: dataTable,
        "processing": true,
        "select": true,
        responsive: true,
        "bDestroy": true,
        "scrollX": true,
        "columns": columnData,
        // "order": [[9, "desc"]],
        columnDefs: [{
            width: '5%',
            targets: 0
        }, //stt
        // { width: '10%', targets: 1 }, // 1 bannerId
        {
            width: '10%',
            targets: 1
        }, // 2 Title
        {
            width: '15%',
            targets: 2
        }, // 3 Image
        // { width: '10%', targets: 3 }, // 4 direction URL
        {
            width: '5%',
            targets: 3
        }, // 5 Banner Type,
        {
            width: '10%',
            targets: 4
        }, // 6 public date start
        {
            width: '10%',
            targets: 5
        }, // 7 public date end
        {
            width: '3%',
            targets: 6
        }, // is expired
        {
            width: '5%',
            targets: 7
        }, // 8 ordering
        {
            width: '5%',
            targets: 8
        }, // 9 view count
        {
            width: '10%',
            targets: 9
        }, // 10 create at
        {
            width: '7%',
            targets: 10
        }, // 11 create by
        {
            width: '7%',
            targets: 11
        }, // 11 create by
        {
            width: '10%',
            targets: 12
        }, // 12 Action
        ],
        language: {
            "lengthMenu": "Hiển thị _MENU_ dòng mỗi trang",
            "zeroRecords": "Không có dữ liệu",
            "info": "Trang _PAGE_ / _PAGES_ của _TOTAL_ dữ liệu",
            "infoEmpty": "Không có dữ liệu",
            "paginate": {
                "first": "Đầu",
                "last": "Cuối",
                "next": "Sau",
                "previous": "Trước"
            },
            "search": "Tìm kiếm:",
        }
        // "fnRowCallback": function(row, data, iDisplayIndex, iDisplayIndexFull) {
        //     if(data.is_banner_expired){
        //         $('td', row).css('background-color', 'rgb(255 108 94 / 51%)');
        //     }
        // }
    });
}

function initCheckUserInfo() {
    var columnData = [{
        title: 'No.',
        render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        },
    },
    {
        data: 'Id',
        title: 'ID'
    },
    {
        data: 'FullName',
        title: 'Full Name'
    },
    {
        data: 'Contract',
        title: 'Contract'
    },
    {
        data: 'Phone',
        title: 'Phone'
    },
    {
        title: 'Action',
        data: 'Id',
        render: function (data, type, row) {
            var tmp = JSON.stringify(row);
            return `<div><button class="btn btn-sm fas fa-eye btn-icon bg-olive" onclick='viewUserInfo(` + tmp + `)'></button?</div>`;
        },
        className: 'text-center',
        "sortable": false
    }
    ];
    $('#checkuserinfo_table').DataTable({
        data: data,
        "processing": true,
        "select": true,
        responsive: true,
        "bDestroy": true,
        "scrollX": true,
        "columns": columnData,
        "language": {
            "emptyTable": "No Record..."
        },
    });
};

function initSmsWorld() {
    var columnData = [{
        data: 'STT',
        title: 'No.'
    },
    {
        data: 'Date',
        title: 'Date'
    },
    {
        data: 'Source',
        title: 'Source'
    },
    {
        data: 'Message',
        title: 'Message'
    },
    {
        data: 'PhoneNumber',
        title: 'Phone Number'
    }
    ];
    $('#smsworld_table').DataTable({
        data: data,
        "processing": true,
        "select": true,
        responsive: true,
        "bDestroy": true,
        "scrollX": true,
        "columns": columnData,
        "language": {
            "emptyTable": "No Record..."
        },
    });
};

function initCheckListManage() {
    var columnData = [
        // {
        //     title:'No.',
        //     render: function(data,type, row ,meta){
        //         return meta.row + 1;
        //     },
        //     className: 'text-center'
        // },
        {
            title: 'No.',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
            data: 'ID',
            title: 'ID'
        },
        {
            data: 'HD',
            title: 'Contract'
        },
        {
            data: 'action',
            title: 'Action',
            render: function (data, type, row) {
                var html = `<form  action=` + route_checklistmanage + ` method="POST" onsubmit="handleSubmit(event,this)">
                    <input type="hidden" name="_token" value=` + crsf + ` />
                    <input type="text" class="form-control" name="checkListId" hidden value="` + row.ID + `">
                    <button class="btn btn-sm btn-outline-success"><i class="fa fa-check" aria-hidden="true"></i></button>
                </form>`;
                return html;
            }
        }
    ]
    $('#checklistManage_table').dataTable({
        data: listCheckList,
        "processing": true,
        "select": true,
        responsive: true,
        "bDestroy": true,
        "scrollX": true,
        "columns": columnData,
        "language": {
            "emptyTable": "No Record..."
        },
    });
}

function initIconmanagement() {
    var today = new Date();
    today.setMinutes(today.getMinutes() - 1);
    today.setSeconds(0);
    console.log(today);

    var tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);
    tomorrow.setHours(0, 0, 0, 0);

    var icon_management_table = $('#icon-management').DataTable({
        "processing": true,
        "select": true,
        "bDestroy": true,
        "scrollX": true,
        "scrollCollapse": true,
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50, 75, 100],
        "orderMulti": true,
        "order": [[1, "desc"]],
        "retrieve": true,
        "serverSide": true,
        "ajax": {
            url: "/iconmanagement/initDatatable"
        },
        "data": [],
        "columnDefs": [
            {
                "searchable": false,
                "targets": [0, 2, 6]
            },
            {
                "targets": [1],
                "visible": false,
                "searchable": false
            },
        ],
        "columns": [{
            title: "STT",
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
            data: 'productId',
            name: 'productId'
        },
        {
            data: 'iconUrl',
            name: "iconUrl",
            title: "Hình ảnh",
            render: function (data, type, row) {
                return `<img class="img-thumbnail" src="${(data) ? data : '/images/image_logo.png'}" style="width: 80px">`;
            },
            className: 'text-center',
        },
        {
            data: 'productNameVi',
            name: "productNameVi",
            title: "Tên sản phẩm - VN",
            className: 'text-center',
        },
        {
            data: 'productNameEn',
            name: "productNameEn",
            title: "Tên sản phẩm - EN",
            className: 'text-center',
        },
        {
            data: "isDisplay",
            name: "isDisplay",
            title: "Trạng thái",
            render: function (data, type, row) {
                var html = '';
                if ('isDisplay' in row) {
                    switch (row['isDisplay']) {
                        case "0":
                            html = `<div class="df-switch">
                                    <button type="button" class="btn btn-lg btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="off" disabled>
                                        <div class="inner-handle"></div>
                                        <div class="handle"></div>
                                    </button>
                                </div>`;
                            break;
                        case "1":
                            html = `<div class="df-switch">
                                    <button type="button" class="btn btn-lg btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off" disabled>
                                        <div class="inner-handle"></div>
                                        <div class="handle"></div>
                                    </button>
                                </div>`;
                            break;
                        case "2":
                            html = (row['displayBeginDay']) ? `Hẹn ngày bật <span class="badge badge-warning">${row['displayBeginDay']}</span>` : '';
                            break;
                        default:
                    }
                }
                return html;
            },
            className: 'text-center',
        },
        {
            title: 'Action',
            data: 'productId',
            render: function (data, type, row) {
                var productName = row.productNameVi.replace(/(\r\n|\n|\r)/gm, " ");
                // console.log();
                var row_data = JSON.stringify(row).replace(/(\r\n|\n|\r)/gm, " ");
                return `<div>
                <button style="float: left; margin-right: 5px" class="btn btn-primary btn-sm" onClick="openDetail('/iconmanagement/detail/${data}')" data-toggle="tooltip" data-placement="top" title="Xem chi tiết"><i class="far fa-eye"></i></button>
                            <a style="float: left; margin-right: 5px" href="/iconmanagement/edit/${data}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="far fa-edit"></i></a>
                            <button style="float: left;" type="submit" class="btn btn-danger btn-sm delete-button" data-toggle="tooltip" data-placement="top" title="Xóa" onClick="deleteButton('${row_data}', '${productName}', '/iconmanagement/destroy', '')"><i class="fas fa-trash"></i></button>
                        </div>`;
            },
            className: 'text-center',
            "sortable": false
        }
        ],
        "language": {
            "emptyTable": "No Record..."
        },
        "initComplete": function (setting, json) {
            $('#icon-management-home').show();
        },
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
        // searchDelay: 500,
        "searchCols": [
            null,
            null,
            null,
            { "regex": true },
            { "regex": true },
            null,
            null,
            null,
            null
        ],
    });

    $('#show_from').datetimepicker({
        format: "YYYY-MM-DD HH:mm:ss",
        useCurrent: false,
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        },
        minDate: ($('#show_from').val()) ? new Date($('#show_from').val()) : today,
        maxDate: ($('#show_to').val()) ? new Date($('#show_to').val()) : tomorrow,
    });

    $('#show_to').datetimepicker({
        format: "YYYY-MM-DD HH:mm:ss",
        useCurrent: false,
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        },
        minDate: ($('#show_from').val()) ? new Date($('#show_from').val()) : tomorrow,
    });

    $('#new_from').datetimepicker({
        format: "YYYY-MM-DD HH:mm:ss",
        useCurrent: false,
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        },
        minDate: ($('#new_from').val()) ? new Date($('#new_from').val()) : today,
        maxDate: ($('#new_to').val()) ? new Date($('#new_to').val()) : tomorrow,
    });

    $('#new_to').datetimepicker({
        format: "YYYY-MM-DD HH:mm:ss",
        useCurrent: false,
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        },
        minDate: ($('#new_from').val()) ? new Date($('#new_from').val()) : today,
    });

    $("#show_from").on("dp.change", function (e) {
        if ($('#show_to').data("DateTimePicker") != undefined) {
            $('#show_to').data("DateTimePicker").minDate(e.date);
        }
    });

    $("#show_to").on("dp.change", function (e) {
        if ($('#show_from').data("DateTimePicker") != undefined) {
            $('#show_from').data("DateTimePicker").maxDate(e.date);
        }
    });

    $("#new_from").on("dp.change", function (e) {
        if ($('#new_to').data("DateTimePicker") != undefined) {
            $('#new_to').data("DateTimePicker").minDate(e.date);
        }
    });

    $("#new_to").on("dp.change", function (e) {
        if ($('#new_from').data("DateTimePicker") != undefined) {
            $('#new_from').data("DateTimePicker").maxDate(e.date);
        }
    });

    if ($('#status-clock').is(':checked')) {
        $('#status-clock-date-time').show();
    }
    else {
        $('#status-clock-date-time').hide();
    }

    if ($('#is-new-show').is(':checked')) {
        $('#is-new-icon-show-date-time').show();
    }
    else {
        $('#is-new-icon-show-date-time').hide();
    }

    $('input:radio[name="isDisplay"]').change(() => {
        if ($('#status-clock').is(':checked')) {
            $('#status-clock-date-time').show();
        }
        else {
            $('#status-clock-date-time').hide();
        }
    });

    $('input:checkbox[name="isNew"]').change(() => {
        if ($('#is-new-show').is(':checked')) {
            $('#is-new-icon-show-date-time').show();
        }
        else {
            $('#is-new-icon-show-date-time').hide();
        }
    });

    $("#status-all").change(function () {
        if (this.checked) {
            $("input[name='status']").prop('checked', true);
        }
        else {
            $("input[name='status']").prop('checked', false);
        }
    });

    $("#pheduyet-all").change(function () {
        if (this.checked) {
            $("input[name='pheduyet']").prop('checked', true);
        }
        else {
            $("input[name='pheduyet']").prop('checked', false);
        }
    });

    $('#icon-management tbody').on('click', '.delete-button', function () {
        var data = icon_management_table.row($(this).parents('tr')).data();
        deleteButton(JSON.stringify(data), data['productNameVi'], '/iconmanagement/destroy');
    });
}

function initCloseHelpReqest() {
    var tableData = [];
    if (dataCloseHelpRequest != undefined && dataCloseHelpRequest != null) {
        tableData = dataCloseHelpRequest.result;
    };
    var columnData = [{
        title: 'No.',
        render: function (data, type, row, meta) {
            return meta.row + 1;
        },
    },
    {
        data: 'reportId',
        title: 'Report Id'
    },
    {
        title: 'Report Time',
        render: function (data, type, row, meta) {
            return row.stepStatus[0].time;
        }
    },
    {
        data: 'reportName',
        title: 'Report Name'
    },
    {
        title: 'Status',
        render: function (data, type, row, meta) {
            var listColor = ['warning', 'info', 'primary', 'success', 'danger', 'default'];
            var html = '';
            for (const [key, step] of Object.entries(row.stepStatus)) {
                html += `<h5 class="badge badge-` + listColor[key] + ` ml-3">` + step.name + `</h5>`
            };
            return html;
        },
        className: 'text-center'
    },
    {
        data: 'note',
        title: 'Note'
    },
    {
        title: 'Action',
        render: function (data, type, row, meta) {
            return ` <a onclick="dialogConfirmWithAjax(closeRequest,this)" data-id="` + row.reportId + `" type="button"class="btn btn-danger">Close</a>`;
        }
    }
    ]
    $('#closeHelpRequest_table').dataTable({
        data: tableData,
        "processing": true,
        "select": true,
        responsive: true,
        "bDestroy": true,
        "scrollX": true,
        "columns": columnData,
        "language": {
            "emptyTable": "No Record..."
        },
    });

}
function initFtelPhone() {
    $('#phoneTable').DataTable({
        "processing": true,
        "serverSide": true,
        "select": true,
        "dataSrc": "tableData",
        "bDestroy": true,
        "scrollX": true,
        retrieve: true,
        "lengthMenu": [10, 25, 50, 75, 100],
        "pageLength": 25,
        "ajax": {
            url: "/ftel-phone/initDatatable"
        },
        "columns": [
            {
                data: 'id',
                name: "id",
                title: "Id"
            },
            {
                data: 'number_phone',
                name: "number_phone",
                title: "Phone"
            },
            {
                data: 'code',
                name: "code",
                title: "Mã số nhân viên"
            },
            {
                data: 'emailAddress',
                name: "emailAddress",
                title: "Email"
            },
            {
                data: 'fullName',
                name: "fullName",
                title: "Tên đầy đủ"
            },
            {
                data: 'organizationNamePath',
                name: "organizationNamePath",
                title: "organizationNamePath"
            },
            {
                data: 'organizationCodePath',
                name: "organizationCodePath",
                title: "organizationCodePath"
            },
            {
                data: 'response',
                name: "response",
                title: "Response"
            },
            {
                data: 'created_by',
                name: "created_by",
                title: "Người tạo"
            },
            {
                data: 'created_at',
                name: "created_at",
                title: "Ngày tạo"
            }
        ],
        "language": {
            "emptyTable": "No Record..."
        },
        "initComplete": function (setting, json) {
            $('#phoneTable').show();
        },
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
        searchDelay: 500
    });
}

function initIconcategory() {
    var icon_category = $('#icon-category').DataTable({
        "processing": true,
        "select": true,
        "bDestroy": true,
        "scrollX": true,
        "scrollCollapse": true,
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50, 75, 100],
        "orderMulti": true,
        "retrieve": true,
        "serverSide": true,
        "columnDefs": [
            {
                "searchable": false,
                "targets": [0, 3, 5]
            },
        ],
        "ajax": {
            url: "/iconcategory/initDatatable"
        },
        "data": [],
        "columns": [{
            title: "STT",
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
            data: 'productTitleNameVi',
            name: "productTitleNameVi",
            title: "Tên danh mục - VN",
            className: 'text-center',
        },
        {
            data: 'productTitleNameEn',
            name: "productTitleNameEn",
            title: "Tên danh mục - EN",
            className: 'text-center',
        },
        {
            data: 'arrayId',
            name: 'arrayId',
            title: 'Số lượng',
            className: 'text-center',
            render: function (data, type, row) {
                var count_total_prod = 0;
                if (data && typeof data == "string") {

                    var list_prod = data.split(',');
                    count_total_prod = list_prod.length;
                }
                return count_total_prod;
            }
        },
        {
            data: "status",
            name: "status",
            title: "Trạng thái",
            render: function (data, type, row) {
                var html = '';
                if (!row['status']) {
                    html = `<div class="df-switch">
                                    <button type="button" class="btn btn-lg btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="off" disabled>
                                        <div class="inner-handle"></div>
                                        <div class="handle"></div>
                                    </button>
                                </div>`;
                } else {
                    html = `<div class="df-switch">
                                    <button type="button" class="btn btn-lg btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off" disabled>
                                        <div class="inner-handle"></div>
                                        <div class="handle"></div>
                                    </button>
                                </div>`;
                }
                return html;
            },
            className: 'text-center',
        },
        {
            title: 'Action',
            data: 'productTitleId',
            render: function (data, type, row) {
                return `<button style="float: left; margin-right: 5px" class="btn btn-primary btn-sm" onClick="openDetail('/iconcategory/detail/${data}')" data-toggle="tooltip" data-placement="top" title="Xem chi tiết"><i class="far fa-eye"></i></button>
                            <a style="float: left; margin-right: 5px" href="/iconcategory/edit/${data}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="far fa-edit"></i></a>
                            <button style="float: left; type="submit" class="btn btn-danger btn-sm delete-button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fas fa-trash"></i></button>`;
            },
            "sortable": false,
            className: 'text-center',
        }
        ],
        "searchCols": [
            null,
            { "regex": true },
            { "regex": true },
            null,
            null,
            null,
            null
        ],
        "language": {
            "emptyTable": "No Record..."
        },
        "initComplete": function (setting, json) {
            $('#icon-management-home').show();
        },
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
    });

    if ($('#status-clock').is(':checked')) {
        $('#status-clock-date-time').show();
    }
    else {
        $('#status-clock-date-time').hide();
    }

    if ($('#is-new-show').is(':checked')) {
        $('#is-new-icon-show-date-time').show();
    }
    else {
        $('#is-new-icon-show-date-time').hide();
    }

    $('#show_from').datetimepicker({
        format: "YYYY-MM-DD HH:mm",
        useCurrent: false,
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        }
    });

    $('#show_to').datetimepicker({
        format: "YYYY-MM-DD HH:mm",
        useCurrent: false,
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        }
    });

    $('#new_from').datetimepicker({
        format: "YYYY-MM-DD HH:mm:SS",
        useCurrent: false,
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        }
    });

    $('#new_to').datetimepicker({
        format: "YYYY-MM-DD HH:mm:SS",
        useCurrent: false,
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        }
    });

    // lightSlider
    $('#all-product').lightSlider({
        item: 5,
        loop: true,
        slideMove: 1,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        speed: 600,
        slideMargin: 15,
        enableDrag: false,
        enableTouch: false,
        pager: false
    });

    $("#show_from").on("dp.change", function (e) {
        if ($('#show_to').data("DateTimePicker") != undefined) {
            $('#show_to').data("DateTimePicker").minDate(e.date);
        }
    });

    $("#show_to").on("dp.change", function (e) {
        if ($('#show_from').data("DateTimePicker") != undefined) {
            $('#show_from').data("DateTimePicker").maxDate(e.date);
        }
    });

    $("#new_from").on("dp.change", function (e) {
        if ($('#new_to').data("DateTimePicker") != undefined) {
            $('#new_to').data("DateTimePicker").minDate(e.date);
        }
    });

    $("#new_to").on("dp.change", function (e) {
        if ($('#new_from').data("DateTimePicker") != undefined) {
            $('#new_from').data("DateTimePicker").maxDate(e.date);
        }
    });

    $('input:radio[name="status"]').change(() => {
        if ($('#status-clock').is(':checked')) {
            $('#status-clock-date-time').show();
        }
        else {
            $('#status-clock-date-time').hide();
        }
    });

    $('input:checkbox[name="is_new_show"]').change(() => {
        if ($('#is-new-show').is(':checked')) {
            $('#is-new-icon-show-date-time').show();
        }
        else {
            $('#is-new-icon-show-date-time').hide();
        }
    });

    dragula([document.getElementById('all-product'), document.getElementById('selected-product')], {
        direction: 'horizontal',
        revertOnSpill: true,
        copy: function (el, source) {
            return source === document.getElementById('all-product')
        },
        accepts: function (el, target, source, sibling) {
            var li_all = $(el).attr('id');
            if ($('#' + li_all + '-selected-product').length != 0) {
                swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: `Sản phẩm này đã tồn tại trong danh mục`
                });
                return false;
            }

            return target !== document.getElementById('all-product')
        }
    }).on('drop', (el, target, source, sibling) => {
        var li_all = $(el).attr('id');
        $(el).attr('id', li_all + '-selected-product');
        $(el).removeClass("lslide");
        $(el).removeClass("active");
        $(el).removeClass("gu-transit");
        $(el).addClass("col-sm-2");

        $(el).css('margin-right', 0);

        var spanElement = $(el).find("span:first");
        $(spanElement).removeClass("badge-light");
        $(spanElement).addClass("badge-dark");

        if ($(el).find('span.position').length < 1) {
            $(el).append(`<h6><span class="badge badge-warning position">${$(el).index() + 1}</span></h6>`);
        }

        $(target).find("li").each((key, value) => {
            $(value).find("span.position").text($(value).index() + 1);
        });
    });

    $("#status-all").change(function () {
        if (this.checked) {
            $("input[name='status']").prop('checked', true);
        }
        else {
            $("input[name='status']").prop('checked', false);
        }
    });

    $("#pheduyet-all").change(function () {
        if (this.checked) {
            $("input[name='pheduyet']").prop('checked', true);
        }
        else {
            $("input[name='pheduyet']").prop('checked', false);
        }
    });

    $('#icon-category tbody').on('click', '.delete-button', function () {
        var data = icon_category.row($(this).parents('tr')).data();
        deleteButton(JSON.stringify(data), data['productTitleNameVi'], '/iconcategory/destroy');
    });
}

function initIconconfig() {
    // $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
    //     $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    // } );

    var icon_config_table = $('#icon-config').DataTable({
        "processing": true,
        "select": true,
        "bDestroy": true,
        "scrollX": true,
        "scrollCollapse": true,
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50, 75, 100],
        "orderMulti": true,
        "retrieve": true,
        "serverSide": true,
        "ajax": {
            url: "/iconconfig/initDatatable"
        },
        "data": [],
        "columnDefs": [
            {
                "searchable": false,
                "targets": [0, 2, 3, 5]
            },
        ],
        "columns": [{
            title: "STT",
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
            data: 'name',
            name: "name",
            title: "Tên vị trí",
            className: 'text-center',
        },
        {
            data: 'iconsPerRow',
            name: "iconsPerRow",
            title: "Số lượng",
            render: function (data, type, row, meta) {
                return row['arrayId'].split(',').length;
            },
            className: 'text-center',
        },
        {
            data: 'rowOnPage',
            name: "rowOnPage",
            title: "Số dòng",
            className: 'text-center',
        },
        {
            data: "isDisplay",
            name: "isDisplay",
            title: "Trạng thái",
            render: function (data, type, row) {
                var html = '';
                if ('isDisplay' in row) {
                    switch (row['isDisplay']) {
                        case "0":
                            html = `<div class="df-switch">
                                    <button type="button" class="btn btn-lg btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="off" disabled>
                                        <div class="inner-handle"></div>
                                        <div class="handle"></div>
                                    </button>
                                </div>`;
                            break;
                        case "1":
                            html = `<div class="df-switch">
                                    <button type="button" class="btn btn-lg btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off" disabled>
                                        <div class="inner-handle"></div>
                                        <div class="handle"></div>
                                    </button>
                                </div>`;
                            break;
                        case "2":
                            html = (row['displayBeginDay']) ? `Hẹn ngày bật <span class="badge badge-warning">${row['displayBeginDay']}</span>` : '';
                            break;
                        default:
                    }
                }
                return html;
            },
            className: 'text-center',
        },
        {
            title: 'Action',
            data: 'productConfigId',
            render: function (data, type, row) {
                var name = row.name.replace(/(\r\n|\n|\r)/gm, " ");
                return `<div>
                            <button style="float: left; margin-right: 5px" class="btn btn-primary btn-sm" onClick="openDetail('/iconconfig/detail/${data}')" data-toggle="tooltip" data-placement="top" title="Xem chi tiết"><i class="far fa-eye"></i></button>
                            <a style="float: left; margin-right: 5px" href="/iconconfig/edit/${data}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="far fa-edit"></i></a>
                            <button style="float: left;" type="submit" class="btn btn-danger btn-sm delete-button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fas fa-trash"></i></button>
                        </div>`;
            },
            className: 'text-center',
            "sortable": false
        }
        ],
        "language": {
            "emptyTable": "No Record..."
        },
        "initComplete": function (setting, json) {
            $('#icon-management-home').show();
        },
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
        // searchDelay: 500,
        "searchCols": [
            null,
            { "regex": true },
            null,
            null,
            null,
            null,
            null,
            null
        ],
    });

    dragula([document.getElementById('all-product-config'), document.getElementById('selected-product-config')], {
        direction: 'horizontal',
        revertOnSpill: true,
        copy: function (el, source) {
            console.log('copy');
            return source === document.getElementById('all-product-config')
        },
        accepts: function (el, target, source, sibling) {
            var li_all = $(el).attr('id');
            if ($('#' + li_all + '-selected-product-config').length != 0) {
                swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: `Sản phẩm này đã tồn tại trong danh mục`
                });
                return false;
            }

            var iconsPerRow = ($('#icon-per-row').val()) ? $('#icon-per-row').val() : 1;
            var rowOnPage = ($('#row-on-page').val()) ? $('#row-on-page').val() : 1;

            if ($('#selected-product-config li').length > iconsPerRow * rowOnPage) {
                swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: `Chỉ có thể thêm tối đa ${iconsPerRow * rowOnPage} icon vào vị trí này. Đã quá tổng số sản phẩm có thể thêm. Vui lòng xóa bớt sản phẩm trước khi thêm vào vị trí.`
                });
                return false;
            }

            return target !== document.getElementById('all-product-config')
        }
    }).on('drop', (el, target, source, sibling) => {
        var li_all = $(el).attr('id');
        $(el).attr('id', li_all + '-selected-product-config');
        $(el).removeClass("lslide");
        $(el).removeClass("active");
        $(el).removeClass("gu-transit");

        $(el).css('margin-right', 0);

        var spanElement = $(el).find("span:first");
        $(spanElement).removeClass("badge-light");
        $(spanElement).addClass("badge-dark");

        if ($(el).find('span.position').length < 1) {
            $(el).append(`<h6><span class="badge badge-warning position">${$(el).index() + 1}</span></h6>`);
        }

        $(target).find("li").each((key, value) => {
            $(value).find("span.position").text($(value).index() + 1);
        });
    });

    // lightSlider
    $('#all-product-config').lightSlider({
        item: 5,
        loop: true,
        slideMove: 1,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        speed: 600,
        slideMargin: 15,
        enableDrag: false,
        enableTouch: false,
        pager: false
    });

    $("#status-all").change(function () {
        if (this.checked) {
            $("input[name='status']").prop('checked', true);
        }
        else {
            $("input[name='status']").prop('checked', false);
        }
    });

    $("#pheduyet-all").change(function () {
        if (this.checked) {
            $("input[name='pheduyet']").prop('checked', true);
        }
        else {
            $("input[name='pheduyet']").prop('checked', false);
        }
    });

    $('#icon-per-row').change(function () {
        $("#selected-product-config").css({
            "maxWidth": ($('#icon-per-row').val()) ? $('#icon-per-row').val() * 100 / 5 + "%" : "100%",
        });
    });

    $("input[name='prod_add']").change(function () {
        if (this.value == 'category_add') {
            $('.category-add').css('display', 'block');
            $('.product-add').css('display', 'none');
            if ($('#all-title-config')) {
                $('#all-title-config').lightSlider({
                    item: 5,
                    loop: true,
                    slideMove: 1,
                    easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
                    speed: 600,
                    slideMargin: 15,
                    enableDrag: false,
                    enableTouch: false,
                    pager: false
                });
            }
        }
        else {
            $('.category-add').css('display', 'none');
            $('.product-add').css('display', 'block');
            if ($('#all-product-config')) {
                $('#all-product-config').lightSlider({
                    item: 5,
                    loop: true,
                    slideMove: 1,
                    easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
                    speed: 600,
                    slideMargin: 15,
                    enableDrag: false,
                    enableTouch: false,
                    pager: false
                });
            }
        }
        // console.log(this.value);
    });

    $('#icon-config tbody').on('click', '.delete-button', function () {
        var data = icon_config_table.row($(this).parents('tr')).data();
        deleteButton(JSON.stringify(data), data['name'], '/iconconfig/destroy');
    });
}

function initIconapproved() {
    var icon_category = $('#icon-approved').DataTable({
        "processing": true,
        "select": true,
        "bDestroy": true,
        "scrollX": true,
        "scrollCollapse": true,
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50, 75, 100],
        "orderMulti": true,
        "retrieve": true,
        "serverSide": true,
        "order": [[7, "desc"]],
        dom: 'Bfrtip',
        "columnDefs": [
            {
                "searchable": false,
                "targets": [0, 1, 3, 4, 6, 7]
            },
            {
                "searchable": true,
                "targets": [5],
                "visible": false
            },
        ],
        "ajax": {
            url: "/iconapproved/initDatatable"
        },
        "data": [],
        "columns": [{
            title: "STT",
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
            data: 'product_type',
            name: "product_type",
            title: "Loại",
            render: function (data, type, row, meta) {
                var product_type = '';
                switch (data) {
                    case 'icon_management':
                        product_type = `<span class="badge badge-success">Sản phẩm</span>`;
                        break;
                    case 'icon_category':
                        product_type = `<span class="badge badge-warning">Danh mục</span>`;
                        break;
                    case 'icon_config':
                        product_type = `<span class="badge badge-danger">Cấu hình</span>`;
                        break;
                }
                return product_type;
            },
            className: 'text-center',
        },
        {
            data: 'icon',
            name: "icon",
            title: "Tên",
            render: function (data, type, row, meta) {
                var productInfo = '';
                if (row['icon'] && row['icon']['productNameVi']) {
                    productInfo = row['icon']['productNameVi'];
                }

                if (row['icon_category'] && row['icon_category']['productTitleNameVi']) {
                    productInfo = row['icon_category']['productTitleNameVi'];
                }

                if (row['icon_config'] && row['icon_config']['name']) {
                    productInfo = row['icon_config']['name'];
                }

                return productInfo;
            },
            className: 'text-center',
        },
        {
            data: 'approved_type',
            name: 'approved_type',
            title: 'Loại yêu cầu',
            render: function (data, type, row, meta) {
                var result = '';
                switch (data) {
                    case 'create':
                        result = `<span class="badge badge-success">${data}</span>`;
                        break;
                    case 'update':
                        result = `<span class="badge badge-warning">${data}</span>`;
                        break;
                    case 'delete':
                        result = `<span class="badge badge-danger">${data}</span>`;
                        break;
                }
                return result;
            },
            className: 'text-center',
        },
        {
            data: 'approved_status_name',
            name: 'approved_status_name',
            title: 'Trạng thái yêu cầu',
            render: function (data, type, row, meta) {
                var approved_status_name = '';
                switch (row['approved_status']) {
                    case 'chokiemtra':
                        approved_status_name = `<span class="badge badge-success">${data}</span>`;
                        break;
                    case 'dapheduyet':
                        approved_status_name = `<span class="badge badge-warning">${data}</span>`;
                        break;
                    case 'pheduyetthatbai':
                        approved_status_name = `<span class="badge badge-danger">${data}</span>`;
                        break;
                    case 'chopheduyet':
                        approved_status_name = `<span class="badge badge-primary">${data}</span>`;
                        break;
                    case 'kiemtrathatbai':
                        approved_status_name = `<span class="badge badge-dark">${data}</span>`;
                        break;
                }
                return approved_status_name;
            },
            className: 'text-center',
        },
        {
            data: 'approved_status',
            name: 'approved_status',
            title: 'Trạng thái yêu cầu',
            className: 'text-center',
        },
        {
            data: 'user_requested_by',
            name: 'user_requested_by',
            title: 'Người yêu cầu',
            render: function (data, type, row, meta) {
                return (data && data['name']) ? data['name'] : row['requested_by'];
            },
            className: 'text-center',
        },
        {
            data: 'requested_at',
            name: 'requested_at',
            title: 'Thời gian yêu cầu'
        },
        {
            data: 'user_checked_by',
            name: 'user_checked_by',
            title: 'Người kiểm tra',
            render: function (data, type, row, meta) {
                return (data && data['name']) ? data['name'] : row['checked_by'];
            },
            className: 'text-center',
        },
        {
            data: 'user_approved_by',
            name: 'user_approved_by',
            title: 'Người phê duyệt',
            render: function (data, type, row, meta) {
                return (data && data['name']) ? data['name'] : row['approved_by'];
            },
            className: 'text-center',
        },
        {
            title: 'Action',
            data: 'productTitleId',
            render: function (data, type, row) {
                return `<a style="float: left; margin-right: 5px" href="/iconapproved/edit/${row['id']}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="far fa-edit"></i></a>
                        <button style="float: left; type="submit" class="btn btn-danger btn-sm delete-button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fas fa-trash"></i></button>`;
            },
            "sortable": false,
            className: 'text-center',
        }
        ],
        "searchCols": [
            null,
            null,
            { "regex": true },
            null,
            null,
            null,
            null,
            null,
            null,
            null
        ],
        "language": {
            "emptyTable": "No Record..."
        },
        "initComplete": function (setting, json) {
            $('#icon-management-home').show();
        },
        error: function (xhr, error, code) {
            $.pjax.reload('#pjax');
        },
        // searchDelay: 500
        buttons: [
            {
                text: 'Tất cả',
                action: function (e, dt, node, config) {
                    icon_category.column(5).search('', true, false).draw();
                }
            },
            {
                text: 'Chờ kiểm tra',
                action: function (e, dt, node, config) {
                    icon_category.column(5).search('chokiemtra', true, false).draw();
                }
            },
            {
                text: 'Đã phê duyệt',
                action: function (e, dt, node, config) {
                    icon_category.column(5).search('dapheduyet', true, false).draw();
                }
            },
            {
                text: 'Phê duyệt thất bại',
                action: function (e, dt, node, config) {
                    icon_category.column(5).search('pheduyetthatbai', true, false).draw();
                }
            },
            {
                text: '<i class="fas fa-filter"></i> Lọc',
                action: function (e, dt, node, config) {
                    $('#filter-status').modal();
                }
            },
        ]
    });
}

function badgeArrayView(arrayInput) {
    var badge = ['bg-primary', 'bg-secondary', 'bg-success', 'bg-danger', 'bg-warning text-dark', 'bg-info text-dark', 'bg-light text-dark', 'bg-dark'];
    var count_badge = 0;
    var template = ``;
    $.map(arrayInput, function (n, i) {
        if (count_badge == badge.length) {
            count_badge = 0;
        }
        template += `<span class="badge ${badge[count_badge]}">${JSON.stringify(n)}</span> `;
        count_badge++;
    });
    return template;
}

function settings_on_search() {
    $('form .bs-searchbox input').keyup(function (e) {
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
