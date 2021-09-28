<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Policies\MasterPolicy;

class HiCustomerPolicy extends MasterPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    private const LOOKUP   = 'OTP_LOOKUP';
    private const MANAGE   = 'OTP_MANAGE';
    private const ISADMIN = 2;

    public function __construct($data = null)
    {
        parent::__construct($data);
    }
    
    // Set up policy for view permission
    public function lookup(User $user){
        return $user->group_id == HiCustomerPolicy::ISADMIN 
        || in_array(HiCustomerPolicy::LOOKUP,$this->userPermissions);
    }

    // Set up policy for update permission
    public function manage(User $user){
        return $user->group_id == HiCustomerPolicy::ISADMIN 
        || in_array(HiCustomerPolicy::MANAGE,$this->userPermissions);
    }

    // Set up policy for view permission
    public function delete(User $user){
        return $user->group_id == HiCustomerPolicy::ISADMIN 
        || in_array(HiCustomerPolicy::MANAGE,$this->userPermissions);
    }

}
