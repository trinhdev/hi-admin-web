<?php

namespace App\DataTables\Hi_FPT;

use App\Models\Ftel_Branch;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use DataTables;

class FtelBranchDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    private $perPage = 10;
    private $orderBy = null;
    private $orderDirection  = null;
    private $currentPage = 1;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('action',function($row) {
                return '<div style="display:flex; justify-content:center" class="infoRow" data-customer_location_id="' . $row->customer_location_id . '">
                            <a style="margin-right: 5px" type="button" onclick="getDetail(this)" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>
                            <form action="/ftel_branch/destroy/' . $row->customer_location_id . '" method="POST" onsubmit="handleSubmit(event,this)">
                                '.csrf_field().'
                                '.method_field("DELETE").'
                                <button type="submit" class="btn btn-sm fas fa-trash-alt btn-icon bg-red"></button>
                            </form>
                        </div>';
            })
            ->editColumn('solve_way', function ($row) {
                return $row->solve_way;
            })
            ->escapeColumns([])
            ->rawColumns(['is_active', 'action', 'solve_way']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hi_FPT/Banner $model
     * @return Builder
     */
    public function query()
    {
        $ftel_branch = Ftel_Branch::query();
        return $this->applyScopes($ftel_branch);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('ftel_branch')
                    ->columns($this->getColumns())
                    ->responsive()
                    ->autoWidth(true)
                    ->parameters([
                        'scroll' => false,
                        'searchDelay' => 500,
                        'initComplete' => "function () {
                            
                        }"
                    ])
                    ->addTableClass('table table-hover table-striped text-center w-100')
                    ->languageEmptyTable('Không có dữ liệu')
                    ->languageInfoEmpty('Không có dữ liệu')
                    ->languageProcessing('Đang tải')
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
            Column::make('DT_RowIndex')
                    ->title('STT')
                    ->width(20)
                    ->sortable(false)->searchable(false),
            Column::make('location_id')->title('location_id')->searching(false),
            Column::make('branch_code')->title('branch_code')->sortable(false)->searching(false),
            Column::make('branch_name')->title('branch_name')->sortable(false)->searching(false),
            // Column::computed('action')->sortable(false)
            //       ->searching(false)
            //       ->width(80)
            //       ->addClass('text-center')

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Banner_' . date('YmdHis');
    }
}
