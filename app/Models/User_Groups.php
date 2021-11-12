<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_Groups extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'user_groups';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','group_id','deleted_at','updated_by','created_by'];

    protected $casts = [
        'created_at'=> 'datetime:H:i:s d-m-Y',
        'updated_at'=> 'datetime:H:i:s d-m-Y'
    ];
}
