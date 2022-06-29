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
            ->editColumn('date_action',function($row){
                return $row->date_action . ' ('.Carbon::parse($row->date_action)->diffForHumans().')';
            })
            ;
    }

    public function query(AppLog $model)
    {
//        $type = $this->type;
//        $publicDateStart = $this->public_date_start ? Carbon::parse($this->public_date_start)->format('Y-m-d H:i:s'): null;
//        $publicDateEnd = $this->public_date_end ? Carbon::parse($this->public_date_end)->format('Y-m-d H:i:s'): null;
//        if(!empty($type) && !empty($publicDateEnd) && !empty($publicDateStart)) {
//            $model = $model->where('type', $type)->whereBetween('date_action', [$publicDateStart, $publicDateEnd]);
//        } else {
//
//        }
//
//        if(!empty($type) && empty($publicDateEnd) && empty($publicDateStart)) {
//            $model = $model->where('type', $type);
//        }
//        if(empty($type) && !empty($publicDateEnd) && !empty($publicDateStart)) {
//            $model = $model->whereBetween('date_action', [$publicDateStart, $publicDateEnd]);
//        }
//        $query = $model->when($this->filter_duplicate=='yes', function ($query){
//                            \DB::statement("SET SQL_MODE=''");
//                            return $query->groupBy(['phone','type']);
//                        }, function ($query) {
//                            return $query->orderByDesc('id');
//                        });
//        return $query;
        $model = $model->newQuery();
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
            \DB::statement("SET SQL_MODE=''");
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
                'dom' => '<"trinhdev"B><"trinhdev-2"il>frtp',
                'buttons' => [
                    [
                        'text' => 'Copy',
                        'extend' => 'copyHtml5',
                        'attr' => [
                            'class' =>'btn btn-sm btn-primary'
                        ]
                    ],
                    [
                        'text' => 'Excel',
                        'extend' => 'excel',
                        'attr' => [
                            'class' =>'btn btn-sm btn-primary'
                        ]
                    ]
                ],
                'initComplete' => "function () {
                    var table = $('#app_table').DataTable();
                    $('#submit').on('click', function () {
                        table.ajax.reload();
                    });
                 }"
            ])
            ->addTableClass('table table-hover table-striped text-center w-100')
            ->searchDelay(1000)
            ->languageEmptyTable('Không có dữ liệu')
            ->languageInfoEmpty('Không có dữ liệu')
            ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
            ->languageSearchPlaceholder('Nhập SDT cần tra cứu')
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
