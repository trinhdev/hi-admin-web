<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Roles extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = ['role_name','deleted_at','updated_by','created_by'];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
