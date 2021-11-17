<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class Modules extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'modules';
    protected $primaryKey = 'id';
    protected $fillable = ['module_name','group_module_id', 'uri', 'icon', 'status', 'deleted_at', 'updated_by', 'created_by'];

    public function getAllModulesByUser($role_id)
    {
        if($role_id != 1){
            $listModule = DB::table('modules')
            ->join('acl_roles','acl_roles.module_id','modules.id')
            ->where('acl_roles.view',1)
            ->where('acl_roles.role_id',$role_id)
            ->where('modules.deleted_at',null)
            ->get()
            ->toArray();
        }else{
            $listModule = DB::table('modules')
            ->where('deleted_at',null)
            ->get()
            ->toArray();
        }
        return $listModule;
    }
    public function getModulesGroupByParent($role_id)
    {
        $result = new stdClass();
        if($role_id != 1){
            $listModule = DB::table('modules')
            ->join('acl_roles','acl_roles.module_id','modules.id')
            ->where('acl_roles.view',1)
            ->where('acl_roles.role_id',$role_id)
            ->whereNull('modules.deleted_at')
            ->whereNull('acl_roles.deleted_at')
            ->get()
            ->toArray();
        }else{
            $listModule = DB::table('modules')
            ->join('acl_roles','acl_roles.module_id','modules.id')
            ->whereNull('modules.deleted_at')
            ->whereNull('acl_roles.deleted_at')
            ->where('acl_roles.role_id',$role_id)
            ->get()
            ->toArray();
        }

        $listGroupModule = DB::table('group_module')->get()->toArray();
        $arrayGroupKey = [];
        foreach($listGroupModule as $groupModule){
            $groupModule->children = [];
            $arrayGroupKey[$groupModule->id] = $groupModule;
        };
        array_walk_recursive($listModule, function($val, $key) use(&$arrayGroupKey) {
            if(array_key_exists($val->group_module_id,$arrayGroupKey)){
                $arrayGroupKey[$val->group_module_id]->children[] = $val;
            }else{
                $arrayGroupKey[] = $val;
            }
        });
        $result->listModule = $listModule;
        $result->arrayGroupkey = $arrayGroupKey;
        return $result;
    }
    
    public function parent(){
        return $this->hasOne(Group_Module::class,'id','group_module_id');
    }
}
