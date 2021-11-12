<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Roles extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = ['role_name','deleted_at','updated_by','created_by'];

    protected $casts = [
        'created_at'=> 'datetime:H:i:s d-m-Y',
        'updated_at'=> 'datetime:H:i:s d-m-Y'
    ];
    public function acls(){
        return $this->hasMany(Acl_Roles::class,'role_id','id');
    }
}
