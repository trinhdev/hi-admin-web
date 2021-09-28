<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Policies\MasterPolicy;

class HdiPolicy extends MasterPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    private const LOOKUP  = 'HDI_LOOKUP';
    private const MANAGE  = 'HDI_MANAGE';
    private const ANALYZE = 'HDI_ANALYZE';
    private const ISADMIN = 2;

    public function __construct($data = null)
    {
        //
        parent::__construct($data);
    }
    
    // Set up policy for lookup permission
    public function lookup(User $user){
        return $user->group_id == HdiPolicy::ISADMIN 
        || in_array(HdiPolicy::LOOKUP,$this->userPermissions);
    }

    // Set up policy for analyze permission
    public function analyze(User $user){
        return $user->group_id == HdiPolicy::ISADMIN 
        || in_array(HdiPolicy::ANALYZE,$this->userPermissions);
    }

    // Set up policy for update permission
    public function manage(User $user){
        return $user->group_id == HdiPolicy::ISADMIN 
        || in_array(HdiPolicy::MANAGE,$this->userPermissions);
    }
    
    // Set up policy for delete permission
    public function delete(User $user){
        return $user->group_id == HdiPolicy::ISADMIN 
        || in_array(HdiPolicy::MANAGE,$this->userPermissions);
    }
}
