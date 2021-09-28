<?php

namespace App\Policies;

use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Policies\MasterPolicy;
use App\Models\User;
class UserPolicy extends MasterPolicy
{
    use HandlesAuthorization;

    private const VIEW   = 'USER_VIEW';
    private const MANAGE = 'USER_MANAGE';
    private const ISADMIN = 2;

    public $userPermissions;

    public function __construct($data = null){
        parent::__construct($data);
    }
 

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        // Check xem trong bảng permission user có quyền xem model này HOẶC có phải là chính user này HOẶC là admin hay ko?
        return in_array(UserPolicy::MANAGE,$this->userPermissions) 
            || in_array(UserPolicy::VIEW,$this->userPermissions) 
            || $model->user_id === $user->user_id 
            || $user->group_id === UserPolicy::ISADMIN;
    }

    /**
     * Determine whether the user can manage any models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User $model
     * @return mixed
     */
    public function manage(User $user)
    {
        //
        return in_array(UserPolicy::MANAGE,$this->userPermissions) 
               || $user->group_id === UserPolicy::ISADMIN;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
        return $user->group_id === UserPolicy::ISADMIN;
    }
}
