<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

use Illuminate\Support\Str;

class Icon_Category extends MY_Model
{
    use HasFactory;

    protected $table = 'icon_categories';
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['uuid', 'productTitleId', 'productTitleNameVi', 'productTitleNameEn', 'arrayId', 'isDeleted', 'created_by'];

    protected static function boot() {
        parent::boot();

        static::creating(function($model) {
            if(empty($model->uuid)) {
                $model->uuid = Str::uuid();
            }
        });
    } 

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
