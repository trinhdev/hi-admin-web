<?php

namespace App\Policies;

use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserPolicy
{
    use HandlesAuthorization;

    private const CREATE = 'USER_CREATE';
    private const VIEW   = 'USER_VIEW';
    private const UPDATE = 'USER_UPDATE';
    private const DELETE = 'USER_DEL';

    public $userPermissions;

    public function __construct($data = null){
        $userPermission = new Permission();
        $this->userPermissions = $userPermission->getUserPermissions();
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function viewAny(User $model)
    {
        //
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
        // Check xem trong bảng permission user có quyền xem model này HOẶC có phải là chính user này ko?
        return in_array(UserPolicy::VIEW,$this->userPermissions) || $model->user_id === $user->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function create()
    {
        // Check xem trong bảng permission user có quyền tạo record mới ko?
        return in_array(UserPolicy::CREATE,$this->userPermissions);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        // Check xem trong bảng permission user có quyền update model này HOẶC có phải là user này ko?
        return in_array(UserPolicy::UPDATE,$this->userPermissions) || $model->user_id === $user->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function delete(User $model)
    {
        // Check xem trong bảng permission user có quyền delete model này ko?
        return in_array(UserPolicy::DELETE,$this->userPermissions);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function restore(User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function forceDelete(User $model)
    {
        //
    }
}
