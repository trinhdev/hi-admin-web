<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FtelPhone extends MY_Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'ftel_phone';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
