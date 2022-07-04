<?php

namespace App\DataTables\Hi_FPT;

use App\Models\AppLog;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder;

class AppDataTable extends DataTable
{
    protected $exportClass = UsersExport::class;

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query->distinct())
            ;
    }

    public function query(AppLog $model)
    {
        $model = $model->newQuery();
        \DB::statement("SET SQL_MODE=''");
        $type = $this->type;
        $publicDateStart = $this->public_date_start ? Carbon::parse($this->public_date_start)->format('Y-m-d H:i:s'): null;
        $publicDateEnd = $this->public_date_end ? Carbon::parse($this->public_date_end)->format('Y-m-d H:i:s'): null;
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
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('app_table')
            ->columns($this->getColumns())
            ->responsive()
            ->autoWidth(true)
            ->lengthMenu([10,25,50,100,200,500,2000,5000])
            ->pageLength(10)
            ->parameters([
                'scroll' => false,
                'searching' => true,
                'searchDelay' => 500,
                'dom' => '<"trinhdev"><"trinhdev-2"il>frtp',
                'initComplete' => "function () {
                    var table = $('#app_table').DataTable();
                    $('#submit').on('click', function () {
                        table.ajax.reload();
                    });
                    $('#export').on('click', function () {
                        table.on('preXhr.dt', function(e, settings, data){
                            data.export = 'true';
                        });
                        window.location.href = '/app';
                    });
                 }"
            ])
            ->addTableClass('table table-hover table-striped text-center w-100')
            ->searchDelay(1000)
            ->languageEmptyTable('Không có dữ liệu')
            ->languageInfoEmpty('Không có dữ liệu')
            ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
            ->languageSearchPlaceholder('Search dont support export')
            ->languageSearch('Search')
            ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
            ->languageLengthMenu('Show _MENU_')
            ->languageInfo('<div class="p-auto text-bold">TỔNG SỐ DÒNG: _TOTAL_</div>');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->searching(false)->title('ID')->width('50px'),
            Column::make('type')->title('Loại'),
            Column::make('phone')->title('Số điện thoại'),
            Column::make('url'),
            Column::make('date_action')->title('Thời gian log')
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
