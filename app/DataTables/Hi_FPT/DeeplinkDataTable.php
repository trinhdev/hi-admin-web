<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use App\Models\Deeplink;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DeeplinkDataTable extends DataTable
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
            ->editColumn('action',function($row){
                return '<div style="display:flex; justify-content:center">
                           <a href="'.route('deeplink.edit', [$row->id]).'" id="detail" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>
                           <form action="'.route('deeplink.delete', [$row->id]).'" onsubmit="handleSubmit(event,this)">
                                <button type="submit" id="delete" class="btn btn-sm fas fa-trash-alt btn-icon bg-danger"></button>
                           </form>
                       </div>
                ';
            })
            ->addColumn('operations', function ($item) {
                return ;
            })
            ->rawColumns(['action','operations']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Hi_FPT/Deeplink $model
     * @return Collection
     */
    public function query(Deeplink $model)
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
                    ->setTableId('Deeplink_manage')
                    ->columns($this->getColumns())
                    ->responsive()
                    ->autoWidth(true)
                    ->orderBy(0, 'DESC')
                    ->parameters([
                        'scroll' => false,
                        'searching' => true,
                        'searchDelay' => 500,
                        'initComplete' => "function () {
                            var filter_condition = $('#filter_condition');
                            var table = $('#Deeplink_manage').DataTable();
                            $(filter_condition).on('click', function () {
                                table.ajax.reload();
                            });
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

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Deeplink_' . date('YmdHis');
    }

    public function getColumns()
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('name')->title('Tên deeplink'),
            Column::make('direction')->title('Điều hướng'),
            Column::make('url')->title('URL'),
            Column::make('created_at')->title('Ngày Tạo'),
            Column::computed('action')->sortable(false)
                ->searching(false)
                ->width(80)
                ->addClass('text-center')
        ];
    }
}
