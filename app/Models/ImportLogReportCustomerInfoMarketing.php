<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportLogReportCustomerInfoMarketing extends Model
{
    use HasFactory;
    protected $table = 'import_log_report_customer_info_marketing';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'file_name',
        'total_row',
        'is_runned',
        'created_by'
    ];
}
