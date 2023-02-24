<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\ReportCustomerMarketing;

class ReportCustomerMarketingExport implements FromCollection
{
    public function collection()
    {
        return ReportCustomerMarketing::all();
    }
}
