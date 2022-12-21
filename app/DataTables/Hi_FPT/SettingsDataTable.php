<?php

namespace App\DataTables\Hi_FPT;

use App\Models\Settings;
use Illuminate\Support\Collection;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SettingsDataTable extends DataTable
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
            ->eloquent($query)
            ->editColumn('value',function($row){
                return '<textarea cols="40">'.$row->value.'</textarea>';
            })
            ->editColumn('action',function($row){
                return '<div style="display:flex; justify-content:center">
                           <a href="'.route('settings.edit', [$row->id]).'" id="detail" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>
                           <form action="'.route('settings.destroy', [$row->id]).'" onsubmit="handleSubmit(event,this)">
                                <button type="submit" id="delete" class="btn btn-sm fas fa-trash-alt btn-icon bg-danger"></button>
                           </form>
                       </div>
                ';
            })
            ->rawColumns(['action', 'value']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Hi_FPT/Deeplink $model
     * @return Collection
     */
    public function query(Settings $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('Setting_manage')
                    ->columns($this->getColumns())
                    ->responsive()
                    ->autoWidth(false)
                    ->orderBy(0, 'DESC')
                    ->parameters([
                        'scroll' => false,
                        'searching' => true,
                        'searchDelay' => 500,
                        'initComplete' => "function () {
                         }"
                    ])
                    ->addTableClass('table table-hover table-striped text-center w-100')
                    ->languageEmptyTable('Không có dữ liệu')
                    ->languageInfoEmpty('Không có dữ liệu')
                    ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
                    ->languageSearch('Tìm kiếm')
                    ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
                    ->languageLengthMenu('Hiển thị _MENU_ dòng mỗi trang')
                    ->languageInfo('Hiển thị trang _PAGE_ của _PAGES_ trang
                    ')
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
            Column::make('id')->title('ID'),
            Column::make('name'),
            Column::make('value'),
            Column::make('created_at')->title('Ngày Tạo'),
            Column::make('created_at')->title('Ngày Tạo'),
            Column::make('created_at')->title('Ngày Tạo'),
            Column::make('created_at')->title('Ngày Tạo'),
            Column::computed('action')->sortable(false)
                  ->searching(false)
                  ->width(80)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Setting_' . date('YmdHis');
    }
}
