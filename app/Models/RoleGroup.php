<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UsersGroup;
use Illuminate\Support\Facades\Redis;

class RoleGroup extends Model
{
    protected $table = 'role_group';
    protected $primaryKey = 'role_id';

    //
    public $userGroup;
    public function __construct($data = null){
        $userGroup = new UsersGroup();
        $this->userGroup = $userGroup->getCurrentUserGroup();
    }

    // Get current permission of user by group
    public function getGroupRoles(){
        $redis = Redis::connection();
        $keyName = 'hi-admin:roleGroup_'.$this->userGroup->group_code;
        $data = $redis->get($keyName);
        if($data){
            return unserialize($data);
        }

        $data = RoleGroup::where('group_code', $this->userGroup->group_code)->get();

        $redis->set($keyName, serialize($data));
        return $data;
    }

    // Get current permission code by role
    public function getPermissionCodeOfCurUserByRoleCode($roleCode){
        $groupPermissions = $this->getGroupRoles();

        $data = [];
        foreach($groupPermissions as $item){
            if($item->role_code == $roleCode){
                $data[] = $item->permission_code;
            }
        }
        return $data;
    }

    // Get role list
    public function getRoleLists(){
        $data = RoleGroup::select('users_group.group_code', 'users_group.group_name', 'role_group.role_code', 'role_group.permission_code as rolePermission', 'permissions.role_name', 'permissions.service_name')
                        ->join('users_group', 'role_group.group_code', '=', 'users_group.group_code')
                        ->join('permissions', 'role_group.role_code', '=', 'permissions.role_code')
                        ->get();
        return $data;
    }

    // Get role list by group
    public function getRoleListByGroupCode($groupCode){
        $data = RoleGroup::select('role_group.role_code', 'role_group.permission_code as rolePermission','role_group.service_code', 'permissions.role_name', 'permissions.service_name')
                        ->leftJoin('permissions', function($join)
                         {
                            $join->on('role_group.role_code', '=', 'permissions.role_code');
                            $join->on('role_group.permission_code', '=', 'permissions.permission_code');
                         })
                        ->where('role_group.group_code','=',$groupCode)
                        ->get();
        return $data;
    }
}
