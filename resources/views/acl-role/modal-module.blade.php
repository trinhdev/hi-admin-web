 <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".acl-modal"><i class="fas fa-plus"></i> Add new role</button>
 <div class="modal fade acl-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
             </div>
             <div class="modal-body">
                 <table class="table table-striped table-borderless">
                     <thead>
                         <tr>
                             <th>id</th>
                             <th>Module</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                     @foreach($modules as $module)
                        <tr>
                             <td class="module_id">{{ $module->id}}</td>
                             <td class="module_name">{{ $module->module_name}}</td>
                             <td><a type="button" class="btn btn-success" onclick ="insertModuleToTable(this)">Select</a></td>
                         </tr>
                     @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>