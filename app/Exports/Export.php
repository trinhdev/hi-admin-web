<?php

namespace App\Exports;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

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
            'Đơn vị',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->data);
    }
    // public function view(): View
    // {
    //     return view('ftel-phone.export', [
    //         'data' => $this->data
    //     ]);
    // }
}
