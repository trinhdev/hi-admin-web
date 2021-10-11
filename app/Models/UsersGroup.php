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
    protected $fillable = ['group_name','group_code'];
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
        $data = DB::select(DB::raw("SELECT users_group.group_code, users_group.group_name, permissions.permission_name, permissions_group.permission_code 
                                    FROM users_group
                                    LEFT JOIN permissions_group on users_group.group_code = permissions_group.group_code
                                    LEFT JOIN permissions on permissions_group.permission_code = permissions.permission_code"));
        foreach($data as $item){
            $result[$item->group_code]["group_name"] = $item->group_name;
            $result[$item->group_code]["group_code"] = $item->group_code;
            $result[$item->group_code]["permissions"][] = [
                "permission_name" => $item->permission_name,
                "permission_code" => $item->permission_code,
            ];
        }
        
        return array_values($result);
    }

    public function saveData($groupName, $groupCode){
        return UsersGroup::create([
            "group_name" => $groupName,
            "group_code" => $groupCode
        ]);
    }

    public function getAllUsersGroup(){
        $data = UsersGroup::select('group_name','group_code')->get()->toArray();
        return $data;
    }

    public function getUsersByGroupCode($groupCode){
        $data = User::select('users.user_id','users.name','users.email','users.group_id',DB::raw("DATE_FORMAT(users.created_at,'%Y-%m-%d') as created_at"))
                    ->join('users_group','users.group_id','=','users_group.group_id')
                    ->where('users_group.group_code','=',$groupCode)
                    ->get();
     
        return $data;
    }

}
