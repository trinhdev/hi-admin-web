<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\PermissionsGroup;
use Illuminate\Support\Facades\Log;
class MasterPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    protected const READ     = "READ";
    protected const UPDATE   = "UPDATE";
    protected const CREATE   = "CREATE";
    protected const DELETE  = "DELETE";
    protected const ISADMIN  = "ADMIN";
    
    public $roles;
    public $curUserGroup;
    
    public function __construct($data = null)
    {
        $this->roles = new PermissionsGroup();
        $this->curUserGroup = $this->roles->userGroup;
    }
    

    // Set up policy for read permission
    public function read($roleCode = ""){
        return $this->roles->checkCurrentUserPermissionByPermissionCode(MasterPolicy::READ,$roleCode)
            || $this->curUserGroup->group_code == MasterPolicy::ISADMIN;
    } 

    // Set up policy for write permission
    public function update($roleCode = ""){
        return $this->roles->checkCurrentUserPermissionByPermissionCode(MasterPolicy::UPDATE,$roleCode)
            || $this->curUserGroup->group_code == MasterPolicy::ISADMIN;
    } 

    // Set up policy for create permission
    public function create($roleCode = ""){
        return $this->roles->checkCurrentUserPermissionByPermissionCode(MasterPolicy::CREATE,$roleCode)
            || $this->curUserGroup->group_code == MasterPolicy::ISADMIN;
    } 

    // Set up policy for destroy permission
    public function delete($roleCode = ""){
        return $this->roles->checkCurrentUserPermissionByPermissionCode(MasterPolicy::DELETE,$roleCode)
            || $this->curUserGroup->group_code == MasterPolicy::ISADMIN;
    } 
}
