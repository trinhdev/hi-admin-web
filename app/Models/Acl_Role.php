<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acl_Roles extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'acl_roles';
    protected $primaryKey = 'id';
    protected $fillable = ['role_id','module_id','deleted_at','updated_by','created_by'];

}
