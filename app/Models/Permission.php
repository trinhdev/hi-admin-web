<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Permission extends Model
{
    public $groupId;
    protected $table = 'permissions';
    protected $primaryKey = 'permission_id';

    public function __construct(){
    }

    //Get all permissions of current user.
    public function saveData($params){
        
        $permission = Permission::create([
            'permission_code' => $params['permission_code'],
            'role_code'       => $params['role_code'],
            'role_name'       => (isset($params['role_name']) ? $params['role_name'] : 'Default'),
            'service_code'    => (isset($params['service_code']) ? $params['service_code'] : 'SERVICE_DEFAULT'),
            'service_name'    => (isset($params['service_name']) ? $params['service_name'] : 'Service Name'),
            'permitted'       => (isset($params['permitted']) ? $params['permitted'] : 1)
        ]);

        if(!$permission){
            return false;
        }
        return true;
    }
    
    // Update permission model
    public function updatePermission($permissionId, $params){
        $permission = Permission::where('permission_id',$permissionId)->update($params);

        if(!$permission){
            return false;
        }

        return true;
    }

    // Get all current permisisons
    public function getAllPermissions(){
        $data = Permission::select('permission_code','role_code','role_name','service_name','service_code')
                            ->where('permitted',1)
                            ->get();
        return $data;
    }
}
