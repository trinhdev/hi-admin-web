<?php

namespace App\DataTables\Hi_FPT;

use App\Models\Support_code_reset_logs;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LogSupportCodeDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ;
    }
    public function query(Support_code_reset_logs $model)
    {
        return $model->newModelQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('log_support_code_table')
                    ->columns($this->getColumns())
                    ->lengthMenu([10,25,50,100,200,500,100000000])
                    ->pageLength(25)
                    ->parameters([
                        'scroll' => false,
                        'scrollX' => true,
                        'searching' => true,
                        'searchDelay' => 500
                    ])
                    ->addTableClass('table table-hover table-striped text-center w-100')
                    ->languageEmptyTable('Không có dữ liệu')
                    ->languageInfoEmpty('Không có dữ liệu')
                    ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
                    ->languageSearchPlaceholder('Nhập thông tin cần tra cứu')
                    ->languageSearch('Tìm kiếm')
                    ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
                    ->languageLengthMenu('Hiển thị _MENU_')
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
            Column::make('device_id'),
            Column::make('list_phone'),
            Column::make('support_code'),
            Column::make('last_updated'),
            Column::make('code_created_at'),
            Column::make('api_result'),
            Column::make('note'),
            Column::make('statusCode'),
            Column::make('message'),
            Column::make('created_by'),
            Column::make('created_at'),
            Column::make('updated_at')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'LogSupportCode_' . date('YmdHis');
    }
}
