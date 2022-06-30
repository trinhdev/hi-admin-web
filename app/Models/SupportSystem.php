<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportSystem extends Model
{
    public $timestamps = true;
    protected $table = 'support_system';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'asked_by', 'asked_at', 'group', 'status', 'way_to_solve', 'solved_by', 'solved_at', 'created_at', 'updated_at', 'updated_by', 'created_by', 'error_type', 'caused', 'note'];
}
