<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class Sale_Report_By_Range_Doanh_Thu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'sale_report_by_range_doanh_thu';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'service','service_name','zone','branch_name','product_type','count','amount','date_created','day', 'month', 'year', 'list_emp_phone'];

}
