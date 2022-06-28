<?php

namespace App\Exports;

use App\Models\AppLog;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Yajra\DataTables\Exports\DataTablesCollectionExport;

class AppExport extends DataTablesCollectionExport implements FromQuery
{
    use Exportable;
    public function __construct(int $type, $dateStart ,$dateEnd)
    {
        $this->type = $type;
        $this->start = $dateStart;
        $this->end = $dateEnd;
    }
    public function query()
    {
        return AppLog::query();
    }

    public function headings(): array
    {
        return [
            'id',
            'type',
            'phone',
            'url',
            'date_action'
        ];
    }

    public function map($row): array
    {
        return [
            $row['id'],
            $row['type'],
            $row['phone'],
            $row['url'],
            $row['date_action']
        ];
    }
}
