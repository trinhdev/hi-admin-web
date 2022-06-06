<?php

namespace App\DataTables\Hi_FPT;

use App\Models\AppLog;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AppDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query);
    }

    public function query(AppLog $model)
    {
        $type = $this->type;
        $publicDateStart = $this->public_date_start ? Carbon::parse($this->public_date_start)->format('Y-m-d H:i:s'): null;
        $publicDateEnd = $this->public_date_end ? Carbon::parse($this->public_date_end)->format('Y-m-d H:i:s'): null;
        if(empty($type) && empty($publicDateEnd) && empty($publicDateStart)) {
            return $model->newQuery();
        }else {
            if(!empty($type)) {
                $model = $model->where('action_name', $type);
            }elseif(!empty($publicDateEnd) && !empty($publicDateStart)) {
                $model = $model->whereBetween('date_action', [$publicDateStart, $publicDateEnd]);
            }else{
                $model = $model->where('action_name', $type)->whereBetween('date_action', [$publicDateStart, $publicDateEnd]);
            }
        }
        return $model;
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('app_table')
            ->columns($this->getColumns())
            ->responsive()
            ->autoWidth(true)
            ->parameters([
                'scroll' => false,
                'searching' => false,
                'searchDelay' => 500,
                'dom'          => 'Bfrtip',
                'initComplete' => "function () {
                    var type = $('#show_at');
                    var public_date_start = $('#show_from');
                    var public_date_end = $('#show_to');
                    var table = $('#app_table').DataTable();
                    $(type).on('change', function () {
                        console.log(Filter Type By TrinhHDP);
                        table.ajax.reload();
                    });
                    $(public_date_end).on('change', function () {
                        table.ajax.reload();
                    });
                 }"
            ])
            ->addTableClass('table table-hover table-striped text-center w-100')
            ->languageEmptyTable('Không có dữ liệu')
            ->languageInfoEmpty('Không có dữ liệu')
            ->languageProcessing('Đang tải')
            ->languageSearch('Tìm kiếm')
            ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
            ->languageLengthMenu('Hiển thị _MENU_ dòng mỗi trang')
            ->languageInfo('Hiển thị trang _PAGE_ của _PAGES_ trang')
            ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('type')->title('Loại'),
            Column::make('phone')->title('Số điện thoại'),
            Column::make('date_action')->title('Thời gian log'),
            Column::make('url')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'App_' . date('YmdHis');
    }
}
