$(document).ready(function () {
    $(document).pjax('a', '#pjax');
    $('aside li.nav-item a').on('click', function (e) {
        if ($(this).attr('href') != '#') {
            $('aside').find(".menu-open > .nav-treeview").not($(this).parents('.menu-open > .nav-treeview')).slideUp()
            $('aside').find(".menu-open").not($(this).parents('.menu-open')).removeClass("menu-is-opening menu-open");
            $('li a').removeClass("active");
        }

        $(this).parents('.nav-treeview').prevAll('.nav-link').addClass('active');
        $(this).addClass("active");
    });
    reloadPjax();
});

function reloadPjax() {
    const pathArray = window.location.pathname.split("/");
    let segment2 = pathArray[2];
    if (segment2 == undefined) {
        $.pjax.reload('#pjax');
    }

}

function insertModuleToTable(_this) {
    let row = _this.closest('tr');
    let table = document.getElementById('aclRoletableBody');
    let tmp = row.querySelector('.module_id');
    let moduleObj = {
        id: row.querySelector('.module_id').innerHTML,
        name: row.querySelector('.module_name').innerHTML
    };
    let check = table.querySelector('tr[name="' + moduleObj.id + '"');
    if (check == null) {
        table.innerHTML += ` 
        <tr name="${moduleObj.id}">
            <td><input name="module_id[]" value="${moduleObj.id}" hidden/>${moduleObj.name}</td>
            <td>
                <select name="view[]" id="${moduleObj.id}-view" record="8" class="options_Module form-control">
                    <option value="0" selected>None</option>
                    <option value="1">All</option>
                </select>
            </td>
            <td>
                <select name="create[]" id="${moduleObj.id}-create" record="8" class="options_Module form-control">
                    <option value="0" selected>None</option>
                    <option value="1">All</option>
                </select>
            </td>
            <td>
                <select name="update[]" id="${moduleObj.id}-update" record="8" class="options_Module form-control">
                    <option value="0" selected="">None</option>
                    <option value="1">All</option>
                </select>
            </td>
            <td>
                <select name="delete[]" id="${moduleObj.id}-delete" record="8" class="options_Module form-control">
                    <option value="0" selected="">None</option>
                    <option value="1">All</option>
                </select>
            </td>
            <td class="td-actions">
                <a type="button" onclick="deleteRow(this)" class="btn btn-danger">
                <i class="fa fa-trash-alt"></i></a>
            </td>
        </tr>`;
        console.log(`#${moduleObj.id}-view`);
         $(`#${moduleObj.id}-view`).selectpicker();
         $(`#${moduleObj.id}-create`).selectpicker();
         $(`#${moduleObj.id}-update`).selectpicker();
         $(`#${moduleObj.id}-delete`).selectpicker();
    }
}

function deleteRow(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

function handleSubmit(e) {
    // e.preventDefault();
    let data = $(e).serialize();
    console.log(data);
}
