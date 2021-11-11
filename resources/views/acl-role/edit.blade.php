 <section class="content">
     <div class="container-fluid">
         <div class="col-sm-12">
             <div class="ibox float-e-margins">
                 <div class="ibox-title">
                     <h5>Permissions of Role</h5>
                     <div class="ibox-tools">
                         <!-- Acl role modal -->
                        @include('acl-role.modal-module')
                     </div>
                 </div>
                 <div class="ibox-content" id="subpanel_table_content_Module">
                     <div class="subpanel_table_content" id="table_content_Module">
                         <table class="table table-hover">
                             <thead>
                                 <tr>
                                     <th class="header">Name</th>
                                     <th class="header">List</th>
                                     <th class="header">View</th>
                                     <th class="header">Edit</th>
                                     <th class="header">Delete</th>
                                     <th class="header">Save</th>
                                     <th class="header">Set User Permissions</th>
                                     <th class="header">Action</th>
                                 </tr>
                             </thead>

                             <tbody>
                                 <tr>
                                     <td>Users</td>
                                     <td>
                                         <select name="list" id="list" record="8" class="options_Module form-control">
                                             <option value="0">None</option>
                                             <option value="1">All</option>
                                             <option value="2" selected="">Owner</option>
                                             <option value="3">Group</option>
                                             <option value="4">Denied</option>
                                         </select>
                                     </td>
                                     <td>
                                         <select name="view" id="view" record="8" class="options_Module form-control">
                                             <option value="0">None</option>
                                             <option value="1">All</option>
                                             <option value="2" selected="">Owner</option>
                                             <option value="3">Group</option>
                                             <option value="4">Denied</option>
                                         </select>
                                     </td>
                                     <td>
                                         <select name="edit" id="edit" record="8" class="options_Module form-control">
                                             <option value="0">None</option>
                                             <option value="1">All</option>
                                             <option value="2" selected="">Owner</option>
                                             <option value="3">Group</option>
                                             <option value="4">Denied</option>
                                         </select>
                                     </td>
                                     <td>
                                         <select name="delete" id="delete" record="8" class="options_Module form-control">
                                             <option value="0">None</option>
                                             <option value="1">All</option>
                                             <option value="2" selected="">Owner</option>
                                             <option value="3">Group</option>
                                             <option value="4">Denied</option>
                                         </select>
                                     </td>
                                     <td>
                                         <select name="save" id="save" record="8" class="options_Module form-control">
                                             <option value="0" selected="">None</option>
                                             <option value="1">All</option>
                                             <option value="2">Owner</option>
                                             <option value="3">Group</option>
                                             <option value="4">Denied</option>
                                         </select>
                                     </td>
                                     <td>
                                         <select name="set_user_permissions" id="set_user_permissions" record="8" class="options_Module form-control">
                                             <option value="0" selected="">None</option>
                                             <option value="1">All</option>
                                             <option value="2">Owner</option>
                                             <option value="3">Group</option>
                                             <option value="4">Denied</option>
                                         </select>
                                     </td>
                                     <td class="td-actions">
                                         <a href="javascript:detailview.subpanel.remove_relate(
                                                                        'roles',
                                                                        'Module',
                                                                        'Role',
                                                                        '3',
                                                                        'Module',
                                                                         '8'
                                                                        )" class="btn btn-danger">
                                             <i class="fa fa-trash-alt"></i>
                                         </a>
                                     </td>
                                 </tr>


                             </tbody>
                         </table>
                         {{-- <div class="subpanel-pagination">
                             <input type="hidden" id="Module_current_page" name="Module_current_page" value="1">
                             <ul class="pagination pagination-sm">
                                 <li class=" disabled"><a>«</a></li>
                                 <li class="active">
                                     <a>1</a>
                                 </li>
                                 <li class="disabled"><a>»</a></li>
                             </ul>
                         </div> --}}
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
