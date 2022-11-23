
<?php

namespace App\DataTables\Hi_FPT;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class GetPhoneNumberDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->collection($query);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models/FtelPhoneDatatable $model
     * @return Collection
     */
    public function query()
    {
        dd($this);
        return collect($this->data) ?? [];
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('GetPhoneNumber_table')
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
                        'buttons' => [ 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf' ]
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
            Column::make('STT'),
            Column::make('Customer ID'),
            Column::make('Phone Number')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'GetPhoneNumber_' . date('YmdHis');
    }
}
