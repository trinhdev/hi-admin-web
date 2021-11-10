$(document).ready(function () {
    $(document).on('pjax:end', function () {
        initUser();
        initModule();
        initGroupModule();
        initGroup();
        initRoles();
    });
    $(document).on('pjax:popstate', function (event) {
        event.preventDefault();
        // $.pjax.defaults.maxCacheLength = 0;
        // location = event.currentTarget.URL;
        $.pjax.reload('#pjax');
    });

});
function initModule() {
    $('#modules').DataTable({
        "processing": true,
        "serverSide": true,
        "select": true,
        "dataSrc": "tableData",
        "bDestroy": true,
        "ajax": {
            url: "/modules/initDatatable"
        },
        "columns": [
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
                title: "Action"
            }
        ],
        "language": {
            "emptyTable": "No Record..."
        },
        "initComplete": function (setting, json) {
            $('#modules').show();
        }
    });
}

function initGroupModule() {
    $('#group-module').DataTable({
        "processing": true,
        "serverSide": true,
        "select": true,
        "dataSrc": "tableData",
        "bDestroy": true,
        "ajax": {
            url: "/groupmodule/initDatatable"
        },
        "columns": [
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
            }
        ],
        "language": {
            "emptyTable": "No Record..."
        },
        "initComplete": function (setting, json) {
            $('#modules').show();
        }
    });
}

function initUser() {
    $('#userTable').DataTable({
        "processing": true,
        "serverSide": true,
        "select": true,
        "dataSrc": "tableData",
        "bDestroy": true,
        "ajax": {
            url: "/user/initDatatable"
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
            data: "role_name",
            name: "role_name",
            title: "Role Name"
        },
        {
            data: "created_at",
            name: "created_at",
            title: "Create at"
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
            $('#userTable').show();
        },
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ]
    });
}

function initGroup() {
    $('#groupTable').DataTable({
        "order": [[0, "desc"]],
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        ajax: {
            headers: { 'X-CSRF-Token': $('meta[name=csrf-token]').attr('content') },
            url: base_url + '/groups/getList',
            type: 'POST',
            dataType: 'JSON',
        },
        columns: [
            { data: 'id' },
            { data: 'group_name' },
            { data: 'created_by' },
            {
                data: "action",
                name: "action",
                title: "Action"
            }
        ],
    });
}
function initRoles() {
    $('#rolesTable').DataTable({
        "order": [[0, "desc"]],
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        ajax: {
            headers: { 'X-CSRF-Token': $('meta[name=csrf-token]').attr('content') },
            url: base_url + '/roles/getList',
            type: 'POST',
            dataType: 'JSON',
        },
        columns: [
            { data: 'id' },
            { data: 'role_name' },
            { data: 'created_by' },
            {
                data: "action",
                name: "action",
                title: "Action"
            }
        ],
    });
}
