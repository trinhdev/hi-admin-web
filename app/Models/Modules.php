<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Modules extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'modules';
    protected $primaryKey = 'id';
    protected $fillable = ['module_name','group_module_id', 'uri', 'status','deleted_at','updated_by','created_by'];

    public function getAllModulesByUser()
    {
        $user = Auth::user();
        if($user->role_id != 1){
            $listModule = DB::table('modules')
            ->join('acl_roles','acl_roles.module_id','modules.id')
            ->where('acl_roles.view',1)
            ->where('acl_roles.role_id',$user->role_id)
            ->get()
            ->toArray();
        }else{
            $listModule = DB::table('modules')
            ->get()
            ->toArray();
        }
        return $listModule;
    }
    public function getModulesGroupByParent()
    {
        $user = Auth::user();
        if($user->role_id != 1){
            $listModule = DB::table('modules')
            ->join('acl_roles','acl_roles.module_id','modules.id')
            ->where('acl_roles.view',1)
            ->where('acl_roles.role_id',$user->role_id)
            ->get()
            ->toArray();
        }else{
            $listModule = DB::table('modules')
            ->get()
            ->toArray();
            // $listModule = Modules::query()->with('parent')->get()->toArray();
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
        // dd($arrayGroupKey);
        return $arrayGroupKey;
    }
    
    public function parent(){
        return $this->hasOne(Group_Module::class,'id','group_module_id');
    }
}
