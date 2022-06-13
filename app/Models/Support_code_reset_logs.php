<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support_code_reset_logs extends Model
{
    protected $table = 'support_code_reset_logs';
    protected $primaryKey = 'id';
    protected $fillable = ['device_id', 'list_phone', 'support_code', 'last_updated', 'code_created_at', 'code_updated_at', 'api_result', 'note', 'created_at', 'updated_at', 'created_by', 'message', 'statusCode'];

    public function createdBy(){
        return $this->hasOne(User::class,'id','created_by');
    }
}
