$(document).ready(function () {
    $(document).pjax('a', '#pjax');
    // if ($.support.pjax) {
    //     $.pjax.defaults.timeout = 500; // time in milliseconds
    // }
    $('ul.nav li.nav-item').click(function () {
        $(this).find('a').addClass('active');
        $(this).siblings().find('a').removeClass('active');
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
    let check = table.querySelector('tr[name="'+moduleObj.id+'"');
    if(check == null){
        table.innerHTML += ` 
        <tr name="${moduleObj.id}">
            <td><input name="module_id[]" value="${moduleObj.id}" hidden/>${moduleObj.name}</td>
            <td>
                 <select name="view[]" id="view" record="8" class="options_Module form-control">
                     <option value="0" selected>None</option>
                     <option value="1">All</option>
                 </select>
            </td>
            <td>
                 <select name="create[]" id="create" record="8" class="options_Module form-control">
                     <option value="0" selected>None</option>
                     <option value="1">All</option>
                 </select>
            </td>
            <td>
                 <select name="update[]" id="update" record="8" class="options_Module form-control">
                     <option value="0" selected="">None</option>
                     <option value="1">All</option>
                 </select>
             </td>
             <td>
                 <select name="delete[]" id="delete" record="8" class="options_Module form-control">
                     <option value="0" selected="">None</option>
                     <option value="1">All</option>
                 </select>
             </td>
             <td class="td-actions">
                 <a type="button" onclick="deleteRow(this)" class="btn btn-danger">
                 <i class="fa fa-trash-alt"></i></a>
             </td>
         </tr>`;
    }

    // console.log(table);
    // console.log(row);
}

function deleteRow(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

function handleSubmit(e){
    // e.preventDefault();
    let data = $(e).serialize();
    console.log(data);
}
