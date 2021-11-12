<?php

namespace App\Policies;

use App\Models\Modules;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class RolePermissionPolicy
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
    }
    public function rolePermissionPolicy(){
        $moduleUri = request()->segment(1);
        $user_role = Auth::user()->role_id;
        if($moduleUri=='groupmodule' && $user_role != 1){
            return false;
        }
        if(!empty($moduleUri) && $moduleUri !='home' && $user_role != 1){
            $listModuleByUser =(new Modules())->getAllModulesByUser();
            $listUriModule = array_map(function ($module){
                return $module->uri;
            }, $listModuleByUser);
            if(!in_array($moduleUri,$listUriModule)){
                return false;
            }
        }
        return true;
    }
}
