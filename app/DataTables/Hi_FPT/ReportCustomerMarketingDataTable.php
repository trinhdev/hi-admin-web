<?php

namespace App\DataTables\Hi_FPT;

use App\Models\ImportLogReportCustomerInfoMarketing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class ReportCustomerMarketingDataTable extends DataTable
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
            ->addIndexColumn()
            ->editColumn('is_runned',function($row) {
                if($row['is_runned'] == 0) {
                    $html = '<span class="badge bg-danger">Chưa xử lý</span>';
                }
                if($row['is_runned'] == 2) {
                    $html = '<span class="badge bg-warning text-dark">Đang xử lý</span>';
                }
                if($row['is_runned'] == 1) {
                    $html = '<span class="badge bg-success">Đã xử lý</span>';
                }
                return $html;
            })
            ->editColumn('action',function($row) {
                return '<div style="display:flex; justify-content:center" class="infoRow" data-id="' . $row->id . '">' . '<form action="/helper/destroy/' . $row->id . '" method="POST" onsubmit="handleSubmit(event,this)">
                                '.csrf_field().'
                                '.method_field("DELETE").'
                                <button type="submit" class="btn btn-sm fas fa-trash-alt btn-icon bg-red"></button>
                            </form>' . 
                            (($row['is_runned'] == 1) ? '<a class="btn btn-sm icon-cloud-download btn-icon bg-green" href="/import-log-report-customer-info-marketing/export-result"></a>' : '') . 
                        '</div>';
            })
            ->escapeColumns([])
            ->rawColumns(['is_runned', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Hi_FPT/Banner $model
     * @return Collection
     */
    public function query()
    {
        $data_import = ImportLogReportCustomerInfoMarketing::query();
        return $this->applyScopes($data_import);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('customer_marketing')
            ->columns($this->getColumns())
            ->responsive()
            // ->pageLength(10)
            ->autoWidth(true)
            // ->orderBy(0)
            ->parameters([
                'scroll' => false,
                'searching' => false,
                'searchDelay' => 500,
                'initComplete' => "function () {
                    
                }"
            ])
            ->addTableClass('table table-hover table-striped text-center w-100')
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
            Column::make('file_name')->title('Tên file'),
            Column::make('processing_row')->title('Số dòng đã xử lý'),
            Column::make('total_row')->title('Tổng số dòng cần xử lý'),
            Column::make('is_runned')->title('Trạng thái xử lý'),
            Column::make('created_by')->title('Nhân viên upload file'),
            Column::make('created_at')->title('Thời gian upload file'),
            Column::make('action')->title('')
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
        return 'Report_Customer_' . date('YmdHis');
    }
}
