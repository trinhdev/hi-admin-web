<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UsersGroup extends Model
{
    //
    protected $table = 'users_group';
    protected $primaryKey = 'group_id';

    public function user()
    {
        return $this->hasMany('App\Models\User','group_id')->get();
    }

    public function getCurrentUserGroup(){
        $redis = Redis::connection();
        $keyName = 'hi-admin:userInfo_'.Auth::user()->user_id;
        $data = $redis->get($keyName);

        if($data){
            return unserialize($data);
        }
        $userGroup = User::find(Auth::user()->user_id)->group()->first();

        $redis->set($keyName,serialize($userGroup));

        return $userGroup;
    }    

    public function getRoleListByUsersGroup(){
        $data = DB::select(DB::raw("SELECT users_group.group_code, users_group.group_name, role_group.permission_code, permissions.role_name, role_group.role_code 
                                    FROM hifpt_admin_local.users_group
                                    LEFT JOIN role_group on users_group.group_code = role_group.group_code
                                    LEFT JOIN permissions on role_group.role_code = permissions.role_code and role_group.permission_code = permissions.permission_code"));
        return $data;
    }
}
