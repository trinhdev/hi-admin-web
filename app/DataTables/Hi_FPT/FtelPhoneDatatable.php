<?php

namespace App\DataTables\Hi_FPT;

use App\Models\FtelPhone;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;

class FtelPhoneDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models/FtelPhoneDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FtelPhone $model)
    {
        return $model->where('code', '!=' , 'null');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('ftelphone_table')
                    ->columns($this->getColumns())
                    ->responsive()
                    ->autoWidth(true)
                    ->lengthMenu([10,25,50,100,200,500,100000000])
                    ->pageLength(25)
                    ->parameters([
                        'scroll' => false,
                        'scrollX' => false,
                        'searching' => true,
                        'searchDelay' => 500,
                        'dom' => '<"row container-fluid mx-auto mt-2 mb-4"<"col-md-8"B><"col-md-2 mt-2 "l><"col-md-1 mt-2"f>>irtp',
                        'buttons' => [[
                        'extend'=> 'collection',
                            'text' =>'<i class="fas fa-plus"></i> Add New',
                            'autoClose'=> true,
                            'action'    => 'function ( e, dt, node, config ) {
                                window.location.assign("/ftel-phone/create");
                            }',
                            'attr'      =>  [
                                'id'=>'push_popup_public',
                                'class' =>'btn btn-sm btn-info action-item p-2'
                            ]
                        ], 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf']
                    ])
                    ->addTableClass('table table-hover table-striped text-center w-100')
                    ->languageEmptyTable('Không có dữ liệu')
                    ->languageInfoEmpty('Không có dữ liệu')
                    ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
                    ->languageSearchPlaceholder('Nhập SDT cần tra cứu')
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
            Column::make('number_phone'),
            Column::make('code'),
            Column::make('emailAddress'),
            Column::make('fullName'),
            Column::make('organizationNamePath'),
            Column::make('organizationCodePath'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'FtelPhone_' . date('YmdHis');
    }
}
