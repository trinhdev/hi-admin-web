<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class Sale_Report_By_Range_Product_Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'report_sale_by_range_product_category';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'service', 'product_category','count','amount','created_at','day','month','year','zone','branch_name'];

}
