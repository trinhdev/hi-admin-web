<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Permission;


class HdiPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    private const VIEW    = 'HDI_LOOKUP';
    private const UPDATE  = 'HDI_UPDATE';
    private const DELETE  = 'HDI_DEL';
    private const ANALYZE  = 'HDI_ANALYZE';
    private const ISADMIN = 2;

    public function __construct()
    {
        //
        $userPermission = new Permission();
        $this->userPermissions = $userPermission->getUserPermissions();
    }
    
    // Set up policy for view permission
    public function view(User $user){
        return $user->group_id == HdiPolicy::ISADMIN || in_array(HdiPolicy::VIEW,$this->userPermissions);
    }

    // Set up policy for analyze permission
    public function analyze(User $user){
        return $user->group_id == HdiPolicy::ISADMIN || in_array(HdiPolicy::ANALYZE,$this->userPermissions);
    }

    // Set up policy for update permission
    public function update(User $user){
        return $user->group_id == HdiPolicy::ISADMIN || in_array(HdiPolicy::UPDATE,$this->userPermissions);
    }
    
    // Set up policy for delete permission
    public function delete(User $user){
        return $user->group_id == HdiPolicy::ISADMIN || in_array(HdiPolicy::DELETE,$this->userPermissions);
    }
}
