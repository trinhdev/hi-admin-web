<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCustomerMarketing extends Model
{
    use HasFactory;
    protected $table = 'report_customer_info_marketing';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'phone',
        'contract_no',
        'full_name',
        'email',
        'address', 
        'location_zone', 
        'location_id', 
        'branch_code', 
        'branch_name', 
        'foxpay_status', 
        'is_fpt_employee', 
        'local_type', 
        'first_date_login', 
        'date_login', 
        'import_id', 
        'is_checked', 
        'date_created'
    ];
}
