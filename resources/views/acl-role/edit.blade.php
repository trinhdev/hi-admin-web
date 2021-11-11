<div class ="form-group row">
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