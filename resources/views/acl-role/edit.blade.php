<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Permissions Role</label>
    <div class="container-fluid">
        {{-- <div class="form-group row"> --}}
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="ibox-tools">
                    <!-- Acl role modal -->
                    @include('acl-role.modal-module')
                </div>
            </div>
            <br>
            <div class="ibox-content justify-content-center" id="subpanel_table_content_Module">
                <div class="subpanel_table_content" id="table_content_Module">
                    <table class="table table-striped table-responsive" align="center" id="aclRoleTable">
                        <thead>
                            <tr>
                                <th class="header">Module</th>
                                <th class="header">View</th>
                                <th class="header">Create</th>
                                <th class="header">Update</th>
                                <th class="header">Delete</th>
                                <th class="header">Action</th>
                            </tr>
                        </thead>
                        <tbody id="aclRoletableBody">
                            @foreach($acls as $acl)
                            @php
                            $module = $modules->where('id',$acl->module_id)->first();
                            @endphp
                            <tr name="{{$acl->module_id}}">
                                <td><input name="module_id[]" value="{{$acl->module_id}}" hidden />{{$module->module_name}}</td>
                                <td>
                                    <select name="view[]" id="view" record="8" class="options_Module form-control">
                                        <option value="0">None</option>
                                        <option value="1" {{$acl->view =='1' ? 'selected':''}}>All</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="create[]" id="create" record="8" class="options_Module form-control">
                                        <option value="0">None</option>
                                        <option value="1" {{$acl->create == '1' ? 'selected':''}}>All</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="update[]" id="update" record="8" class="options_Module form-control">
                                        <option value="0" selected="">None</option>
                                        <option value="1" {{$acl->update == '1' ? 'selected':''}}>All</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="delete[]" id="delete" record="8" class="options_Module form-control">
                                        <option value="0" selected="">None</option>
                                        <option value="1" {{$acl->delete == '1' ? 'selected':''}}>All</option>
                                    </select>
                                </td>
                                <td class="td-actions">
                                    <a type="button" onclick="deleteRow(this)" class="btn btn-danger">
                                        <i class="fa fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
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
