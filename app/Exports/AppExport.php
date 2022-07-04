<?php

namespace App\Exports;

use App\Models\AppLog;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Yajra\DataTables\Exports\DataTablesCollectionExport;

class AppExport implements FromQuery, WithHeadings,WithColumnWidths, ShouldAutoSize,WithStyles
{
    use Exportable;
    // public function __construct(int $type, $dateStart ,$dateEnd)
    // {
    //     $this->type = $type;
    //     $this->start = $dateStart;
    //     $this->end = $dateEnd;
    // }
    public function forCondition($type, $dateStart ,$dateEnd, $filter_duplicate)
    {
        $this->type = $type;
        $this->start = $dateStart;
        $this->end = $dateEnd;
        $this->filter_duplicate = $filter_duplicate;
        return $this;
    }

    public function query()
    {
        $model = DB::table('app_log')->select('id','type','phone','url','date_action')->orderBy('id');
        \DB::statement("SET SQL_MODE=''");
        $type = $this->type;
        $start = $this->start ? \Carbon\Carbon::parse($this->start)->format('Y-m-d H:i:s'): null;
        $end = $this->end ? \Carbon\Carbon::parse($this->end)->format('Y-m-d H:i:s'): null;
        if(!empty($type)) {
            $model->where('type', $type);
        }
        if(!empty($publicDateEnd) && !empty($publicDateStart)) {
            $model->whereBetween('date_action', [$publicDateStart, $publicDateEnd]);
        }
        if($this->filter_duplicate=='yes') {
            $model->groupBy(['phone','type']);
        }
        return $model;
        // return AppLog::where('type', $this->type)
        //                 ->whereBetween('date_action', [$this->start, $this->end]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Loại',
            'Số điện thoại',
            'URL',
            'Ngày tạo'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 10,
            'C' => 20,
            'D' => 100,
            'E' => 30,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]]
        ];
    }
}
