<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

use App\Admin\UserController;
class Icon_Management extends MY_Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'icon_management';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'iconUrl', 'productNameEn', 'productNameVi', 'category', 'descriptionVi', 'descriptionEn', 'platform', 'dataActionStaging', 'dataActionProduction', 'is_filterable', 'show_position', 'deleted_at', 'updated_by', 'created_by'];
    // Show position sẽ có dạng [{'place_show':'home/product', 'status':'show/hide', 'newBeginDay':'31/12/2021', 'newEndDay':'15/02/2021', 'order': 1, 'is_new': true, 'in_weeks': 2}]

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
