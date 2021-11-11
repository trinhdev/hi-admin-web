 <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".acl-modal">+</button>
 <div class="modal fade acl-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">X</span></button>
             </div>
             <div class="modal-body">
                 <table class="table table-striped">
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
                             <td>{{ $module->id}}</td>
                             <td>{{ $module->module_name}}</td>
                             <td><button class="btn btn-success">Select</button></td>
                         </tr>
                     @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>
