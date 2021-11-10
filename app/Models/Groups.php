<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Groups extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'groups';
    protected $primaryKey = 'id';
    protected $fillable = ['group_name','deleted_at','updated_by','created_by'];
}
