<?php

namespace App\DataTables\Hi_FPT;

use App\Models\AppLog;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;

class AppDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->filter(function ($query) {
                if (request()->has('type')) {
                    $query->where('type', request('type'));
                }
                if (!empty(request('phone'))) {
                    $query->where('phone', request('phone'));
                }
                if (!empty(request('public_date_start')) && !empty(request('public_date_end'))) {
                    $publicDateStart = request('public_date_start') ? Carbon::parse(request('public_date_start'))->format('Y-m-d H:i:s'): null;
                    $publicDateEnd = request('public_date_end') ? Carbon::parse(request('public_date_end'))->format('Y-m-d H:i:s'): null;
                    $query->whereBetween('date_action', [$publicDateStart,$publicDateEnd]);
                }  $query->groupBy(['phone','type'])->distinct();
            }, true)
//            ->filter(function ($query) {
//                if (request()->filter_duplicate =='yes') {
//                    \DB::statement("SET SQL_MODE=''");
//                    $query->groupBy(['phone','type'])->distinct();
//                }
//            }, true)
            ;
    }

    public function query(AppLog $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('app_table')
                    ->columns($this->getColumns())
                    ->responsive()
                    ->orderBy(0, 'desc')
                    ->autoWidth(true)
                    ->lengthMenu([[10, 25, 50, -1], [10, 25, 50, "All"]])
                    ->pageLength(10)
                    ->serverSide(true)
                    ->parameters([
                        'scroll' => false,
                        'searching' => true,
                        'index_column' => 'id',
                        'searchDelay' => 500,
                        'dom' => '<"trinhdev"><"trinhdev-2"il>frtp',
                        'initComplete' => "function () {
                            var table = $('#app_table').DataTable();
                            $('#submit').on('click', function () {
                                table.ajax.reload();
                            });
                        }"
                    ])
                    ->addTableClass('table table-hover table-striped text-center w-100')
                    ->searchDelay(1000)
                    ->languageSearchPlaceholder('Search dont support export')
                    ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
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
            'id'            => ['title'=> 'ID'],
            'type'          => ['title'=> 'Loại'],
            'phone'         => ['title'=> 'Số điện thoại'],
            'url'           => ['title'=> 'URL'],
            'date_action'   => ['title'=> 'Ngày log']
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
