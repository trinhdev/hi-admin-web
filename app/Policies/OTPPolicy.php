<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Permission;
class OTPPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    private const VIEW   = 'OTP_LOOKUP';
    private const UPDATE    = 'OTP_UPDATE';
    private const DELETE = 'USER_DEL';
    private const ISADMIN = 2;

    public function __construct()
    {
        //
        $userPermission = new Permission();
        $this->userPermissions = $userPermission->getUserPermissions();
    }
    
    // Set up policy for view permission
    public function view(User $user){
        return $user->group_id == OTPPolicy::ISADMIN || in_array(OTPPolicy::VIEW,$this->userPermissions);
    }

    // Set up policy for update permission
    public function update(User $user){
        return $user->group_id == OTPPolicy::ISADMIN || in_array(OTPPolicy::UPDATE,$this->userPermissions);
    }

    // Set up policy for view permission
    public function delete(User $user){
        return $user->group_id == OTPPolicy::ISADMIN || in_array(OTPPolicy::DELETE,$this->userPermissions);
    }

}
