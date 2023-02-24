<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportLogReportCustomerInfoMarketingDetail extends Model
{
    use HasFactory;
    protected $table = 'import_log_report_customer_info_marketing_detail';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'import_id',
        'phone',
        'created_at',
        'updated_at'
    ];
}
