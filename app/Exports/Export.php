<?php

namespace App\Exports;

use App\Models\FtelPhone;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Export implements FromCollection, WithHeadings
{
    use Exportable;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function headings(): array
    {
        return [
            'Phone',
            'Mã só nhân viên',
            'Email',
            'Tên đầy đủ',
            'organizationNamePath',
            'organizationCodePath',
            'Response',
            'Người tạo',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return FtelPhone::all();
        return collect($this->data);
    }
}
