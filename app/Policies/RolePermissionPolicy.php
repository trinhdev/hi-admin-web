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
    private $listControllerDontNeedPolicy =['home','profile'];
    public function __construct()
    {
        //
    }
    public function rolePermissionPolicy(){
        $moduleUri = request()->segment(1);
        $user_role = Auth::user()->role_id;
        if($moduleUri=='groupmodule' && $user_role != config('constants.ADMIN')){
            return false;
        }
        if(!empty($moduleUri) && !in_array($moduleUri,$this->listControllerDontNeedPolicy) && $user_role != config('constants.ADMIN')){
            $listModuleByUser =(new Modules())->getAllModulesByUser(Auth::user()->role_id);
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
