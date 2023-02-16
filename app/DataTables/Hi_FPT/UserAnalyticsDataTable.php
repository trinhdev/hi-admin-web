<?php

namespace App\DataTables\Hi_FPT;

use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserAnalyticsDataTable extends DataTable
{
    public function ajax()
    {
        return datatables()
            ->collection($this->query())
            ->editColumn('action',function(){
                return '<div style="display:flex; justify-content:center">
                           <a href="" id="detail" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>
                           <form action="" onsubmit="handleSubmit(event,this)">
                                <button type="submit" id="delete" class="btn btn-sm fas fa-trash-alt btn-icon bg-danger"></button>
                           </form>
                       </div>
                ';
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function query()
    {
        return collect($this->data_detail);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->ajax(['data' => 'function(d) { d.table = "detail"; }'])
            ->columns($this->getColumns())
            ->orderBy(4)
            ->responsive()
            ->autoWidth(true)
            ->parameters([
                'scroll' => false,
                'searching' => true,
                'searchDelay' => 500,
                'initComplete' => "function () {
                    var type = $('#show_at');
                    var filter_condition = $('#filter_condition');
                    var detail = $('#table-detail').DataTable();
                    var overview = $('#table-overview').DataTable();
                    $(type).on('change', function () {
                        detail.ajax.reload();
                    });
                    $(filter_condition).on('click', function () {
                          detail.ajax.reload();
                    });
                 }",
            ])
            ->addTableClass('table table-hover table-striped text-center w-100 table-header-color')
            ->languageEmptyTable('Không có dữ liệu')
            ->languageInfoEmpty('Không có dữ liệu')
            ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
            ->languageSearch('Tìm kiếm')
            ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
            ->languageLengthMenu('Hiển thị _MENU_ dòng mỗi trang')
            ->languageInfo('Hiển thị trang _PAGE_ của _PAGES_ trang
                    ');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('customer_id'),
            Column::make('phone'),
            Column::make('date_created'),
            Column::make('app_version'),
            Column::computed('action')->sortable(false)
                ->searching(false)
                ->width(80)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SessionAnalyticsDataTable_' . date('YmdHis');
    }
}

