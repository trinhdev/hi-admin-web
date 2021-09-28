<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Permission;

class MasterPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    private const LOOKUP   = 'LOOKUP';
    private const MANAGE   = 'MANAGE';
    private const ISADMIN  = 2;
    public $userPermission;
    public function __construct($data = null)
    {
        $userPermission = new Permission();
        $this->userPermissions = $userPermission->getUserPermissions();
    }
    
    // Set up policy for view permission
    public function lookup(User $user){
        return $user->group_id == MasterPolicy::ISADMIN;    
    }

    // Set up policy for update permission
    public function manage(User $user){
        return $user->group_id == MasterPolicy::ISADMIN 
        || in_array(MasterPolicy::MANAGE,$this->userPermissions);
    }

    // Set up policy for view permission
    public function delete(User $user){
        return $user->group_id == MasterPolicy::ISADMIN;
    }

}
