<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
class UserPolicy extends MasterPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        parent::__construct();
    }

    public function readUser(User $user){
        return $user->user_id == Auth::user()->user_id 
        || $this->curUserGroup->group_code == MasterPolicy::ISADMIN;
    }
}
