<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PopupDetailDataTable extends BuilderDatatables
{
    protected $hasCheckbox = false;
    public function dataTable($query)
    {
        return datatables()
            ->collection($query)
            ->editColumn('showOnceTime',function($row) {
                return config('platform_config.repeatTime')[$row->showOnceTime];
            })
            ->editColumn('pushedObject',function($row) {
                return config('platform_config.object')[$row->pushedObject];
            })
            ->editColumn('process_status',function($row) {
                if($row->process_status == 'deleted') {
                    return '<span style="color: #006400" class="badge border border-blue">Hoạt động <i class="fas fa-check-circle"></i></span>';
                }
                else {
                    return '<span style="color: #A52A2A" class="badge border border-blue" >Hết hạn <i class="fas fa-times-circle"></i></span>';
                }
            })

            ->addIndexColumn()
            ->rawColumns(['process_status', 'action']);
    }

    public function query()
    {
        return collect($this->data->data->templatePersonalMaps) ?? [];
    }

    public function columns()
    {
        return [
            Column::make('templatePersonalMapId')->title('ID'),
            Column::make('date_created')->title('Ngày push'),
            Column::make('showOnceTime')->title('Tần xuất popup xuất hiện')->addClass('text-left'),
            Column::make('pushedObject')->title('Đối tượng')->addClass('text-left'),
            Column::make('dateStart')->title('Thời gian bắt đầu'),
            Column::make('dateEnd')->title('Thời gian kết thúc'),
            Column::make('process_status')->title('Trạng thái')
        ];
    }

    protected function filename()
    {
        return 'PopupDetailDataTable_' . date('YmdHis');
    }
}
