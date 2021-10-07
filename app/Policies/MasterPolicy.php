<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\RoleGroup;
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
    protected const WRITE    = "WRITE";
    protected const DESTROY  = "DESTROY";
    protected const ISADMIN  = "ADMIN";
    
    public $roles;
    public $curUserGroup;
    
    public function __construct($data = null)
    {
        $this->roles = new RoleGroup();
        $this->curUserGroup = $this->roles->userGroup;
    }
    

    // Set up policy for read permission
    public function read($roleCode = ""){
        return in_array(MasterPolicy::READ,$this->roles->getPermissionCodeOfCurUserByRoleCode($roleCode)) 
            || $this->curUserGroup->group_code == MasterPolicy::ISADMIN;
    } 

    // Set up policy for write permission
    public function write($roleCode = ""){
        return in_array(MasterPolicy::WRITE,$this->roles->getPermissionCodeOfCurUserByRoleCode($roleCode)) 
            || $this->curUserGroup->group_code == MasterPolicy::ISADMIN;
    } 

    // Set up policy for destroy permission
    public function destroy($roleCode = ""){
        return in_array(MasterPolicy::DESTROY,$this->roles->getPermissionCodeOfCurUserByRoleCode($roleCode)) 
            || $this->curUserGroup->group_code == MasterPolicy::ISADMIN;
    } 
}
