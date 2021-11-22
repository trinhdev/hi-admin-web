<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group_Module extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'group_module';
    protected $primaryKey = 'id';
    protected $fillable = ['group_module_name','deleted_at','updated_by','created_by'];
}

