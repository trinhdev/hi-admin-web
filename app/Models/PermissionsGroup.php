<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UsersGroup;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
class PermissionsGroup extends Model
{
    protected $table = 'permissions_group';
    protected $primaryKey = 'role_id';

    //
    public $userGroup;
    public function __construct($data = null){
        $userGroup = new UsersGroup();
        $this->userGroup = $userGroup->getCurrentUserGroup();
    }

    // Get current permission of user by group
    public function getGroupPermissions(){
        $redis = Redis::connection();
        $keyName = 'hi-admin:PermissionsGroup_'.$this->userGroup->group_code;
        $data = $redis->get($keyName);
        if($data){
            return unserialize($data);
        }

        $data = PermissionsGroup::where('group_code', $this->userGroup->group_code)->get();

        $redis->set($keyName, serialize($data));
        return $data;
    }

    // Check current user permission by permission_code
    public function checkCurrentUserPermissionByPermissionCode($permission, $permissionCode){
        $groupPermissions = $this->getGroupPermissions()->toArray();
        switch($permission){
            case "UPDATE":
                $permissionColumn = "permission_update";
                break;
            case "CREATE":
                $permissionColumn = "permission_create";
                break; 
            case "DELETE":
                $permissionColumn = "permission_del";
                break;
            default:
                $permissionColumn = "permission_read";
                break;
        }
        foreach($groupPermissions as $item){
            if($item["permission_code"] == $permissionCode && $item[$permissionColumn] == 1){
                return true;
            }
        }
        return false;
    }

    // Get role list
    public function updateData($params){
        $save = UsersGroup::where("group_code", $params["group_code"])->update(["group_name" => $params["group_name"]]);
        foreach($params["data"] as $service){
            foreach($service["permissions"] as $permission){
                $dataSave = [
                    "permission_read"   => $permission["permission_read"],
                    "permission_create" => $permission["permission_create"],
                    "permission_update" => $permission["permission_update"],
                    "permission_del"    => $permission["permission_del"]
                ];
                $save = PermissionsGroup::where("permission_code", $permission["permission_code"])->update($dataSave);
            }
           
        }
        
        return $save;
    }

    // Get role list by group
    public function getPermissionListByGroupCode($groupCode){
        $data = PermissionsGroup::select('permissions_group.permission_code', 'permissions_group.service_code', 'permissions.service_name', 'permissions.permission_name',
                                'permissions_group.permission_create','permissions_group.permission_read','permissions_group.permission_update','permissions_group.permission_del')
                        ->leftJoin('permissions', function($join)
                         {
                            $join->on('permissions_group.permission_code', '=', 'permissions.permission_code');
                            $join->on('permissions_group.permission_code', '=', 'permissions.permission_code');
                         })
                        ->where('permissions_group.group_code','=',$groupCode)
                        ->get();
        return $data;
    }
}
