<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Otp extends MY_Model
{
    use SoftDeletes;
    protected $table = 'otp';
    protected $primaryKey = 'id';
    protected $fillable = ['otp', '','deleted_at','updated_by','created_by'];

    protected $casts = [
        'created_at'=> 'datetime:H:i:s d-m-Y',
        'updated_at'=> 'datetime:H:i:s d-m-Y'
    ];
}

