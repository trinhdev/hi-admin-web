<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportSystem extends Model
{
    public $timestamps = true;
    protected $table = 'support_system';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'upload_url', 'asked_by', 'start_time', 'group', 'status', 'solve_progress', 'end_time', 'error_type', 'result', 'note', 'created_at', 'created_by', 'updated_at', 'updated_by', 'upload_result_url'];
}
