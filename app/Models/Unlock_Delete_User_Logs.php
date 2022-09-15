<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unlock_Delete_User_Logs extends Model
{
    use HasFactory;
    protected $table = 'unlock_delete_user_logs';
    protected $primaryKey = 'id';
    protected $fillable = ['phone','result_status','api_result','created_at','createdBy', 'message', 'updated_at'];

    public function created_by(){
        return $this->hasOne(User::class,'id','createdBy');
    }
}
