<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends MY_Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $fillable = ['name','value','deleted_at','updated_by','created_by'];
}
