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

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query->distinct())
            ->editColumn('date_action',function($row){
                return $row->date_action . ' ('.Carbon::parse($row->date_action)->diffForHumans().')';
            })
            ;
    }

    public function query(AppLog $model)
    {
        $type = $this->type;
        $this->filter_duplicate ? $f_dup = true : $f_dup = false;

        $publicDateStart = $this->public_date_start ? Carbon::parse($this->public_date_start)->format('Y-m-d H:i:s'): null;
        $publicDateEnd = $this->public_date_end ? Carbon::parse($this->public_date_end)->format('Y-m-d H:i:s'): null;
        if(!empty($type) && !empty($publicDateEnd) && !empty($publicDateStart)) {
            $model = $model->where('type', $type)->whereBetween('date_action', [$publicDateStart, $publicDateEnd]);
        } else {
            $model = $model->newQuery();
        }

        if(!empty($type) && empty($publicDateEnd) && empty($publicDateStart)) {
            $model = $model->where('type', $type);
        }
        if(empty($type) && !empty($publicDateEnd) && !empty($publicDateStart)) {
            $model = $model->whereBetween('date_action', [$publicDateStart, $publicDateEnd]);
        }
        $query = $model->when($f_dup, function ($query) {
                            \DB::statement("SET SQL_MODE=''");
                            return $query->groupBy(['phone','type']);
                        }, function ($query) {
                            return $query->orderByDesc('id');
                        });
        return $query;
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
                'dom' => '<"row container mx-auto"<"col-md-4"B><"col-md-4 mt-2 "l><"col-md-2 mt-2"f>>irtp',
                'buttons' => [
                    [
                        'text' =>'<i class="fa fa-filter"></i> ' . 'Filter duplicate log',
                        'className' => 'filter_duplicate'
                    ],
                    'copyHtml5',
                    'excel'
                ],
                'initComplete' => "function () {
                    var type = $('#show_at');
                    var public_date_start = $('#show_from');
                    var public_date_end = $('#show_to');
                    var filter_duplicate = $('.filter_duplicate');
                    var table = $('#app_table').DataTable();
                    $(type).on('change', function () {
                        table.ajax.reload();
                    });
                    $(public_date_end).on('change', function () {
                        table.ajax.reload();
                    });
                    $(filter_duplicate).on('click', function () {
                            table.on('preXhr.dt', function(e, settings, data){
                                data.filter_click = true;
                            });
                          table.ajax.reload();
                    });
                 }"
            ])
            ->addTableClass('table table-hover table-striped text-center w-100')
            ->languageEmptyTable('Không có dữ liệu')
            ->languageInfoEmpty('Không có dữ liệu')
            ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
            ->languageSearchPlaceholder('Nhập SDT cần tra cứu')
            ->languageSearch('Tìm kiếm')
            ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
            ->languageLengthMenu('Hiển thị _MENU_')
            ->languageInfo('<div class="border border-black wrap-border col-2 p-auto text-bold">TỔNG SỐ DÒNG: _TOTAL_</div>');
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
