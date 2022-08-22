<?php

namespace App\DataTables\Hi_FPT;

use App\Models\Support_code_reset_logs;
// use App\Services\HdiCustomer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Support\Facades\DB;
use DataTables;

use App\Models\Hdi_Orders;
use App\Models\Employees;
use App\Models\List_Organizations;
use App\Models\Laptop_Orders;

class SaleReportByDateDataTable extends DataTable
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
    // private $service;
    public function dataTable($query)
    {
        return datatables()
            ->collection($query)
            ->addIndexColumn()
            ->editColumn('zone',function($row){
                return '<span>' . number_format($row->amount_last_time) . '</span>';
            })
            ->editColumn('amount_last_time',function($row){
                return '<span>' . number_format($row->amount_last_time) . '</span>';
            })
            ->editColumn('amount_this_time',function($row){
                return '<span>' . number_format($row->amount_this_time) . '</span>';
            })
            ->rawColumns(['zone', 'amount_last_time', 'amount_this_time'])
            ->skipPaging();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hi_FPT/Banner $model
     * @return Builder
     */
    public function query()
    {
        // var_dump($this->supportCode);
        $result = [];
        $this->perPage = $this->length ?? 10;
        if(!isset($this->currentPage) || $this->start == 0){
            $this->currentPage = 1;
        }
        if($this->start != 0){
            $this->currentPage =  ($this->start / $this->perPage) + 1 ;
        }

        $orderColumn = $this->order[0]['column'];
        $this->orderBy = $this->columns[$orderColumn]['data'] == "DT_RowIndex" ? null : $this->columns[$orderColumn]['data'];
        $this->orderDirection = $this->order[0]['dir'];
        $params = [
            'service'   => $this->service,
            'page'      => $this->currentPage,
        ];
        switch($this->service) {
            case 'ict':
                $query = collect(Laptop_Orders::selectRaw("organizations.zone_name AS 'zone_name', 
                                                    organizations.branch_code AS 'branch_code', 
                                                    organizations.branch_name_code AS 'branch_name_code', 
                                                    SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from1 . "' AND '" . $this->to1 . "', 1, 0)) AS 'count_last_time', 
                                                    SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from1 . "' AND '" . $this->to1 . "', amount, 0)) AS 'amount_last_time',
                                                    SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from2 . "' AND '" . $this->to2 . "', 1, 0)) AS 'count_this_time', 
                                                    SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from2 . "' AND '" . $this->to2 . "', amount, 0)) AS 'amount_this_time'")
                                        ->join('employees as emp', 'emp.phone', '=', 'referral_code')
                                        ->join('list_organizations as organizations', 'emp.organizationCode', '=', 'organizations.code')
                                        ->whereBetween('t_deliver', [$this->from1, $this->to2])
                                        ->groupBy('zone_name', 'branch_code', 'branch_name_code')
                                        ->orderBy('zone_name', 'asc')
                                        ->orderBy('branch_code', 'asc')
                                        ->orderBy('branch_name_code', 'asc')
                                        ->get());
            break;
        }
        // session()->flash('error');
        // return DataTables::of($query)->toJson();
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('sale-report-date')
                    ->columns($this->getColumns())
                    ->responsive()
                    ->autoWidth(true)
                    ->parameters([
                        'scroll' => false,
                        'searchDelay' => 500,
                        'searching' => false,
                        'initComplete' => "function () {}"
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
            Column::make('zone')->title('Vùng')->searchable(true)->searching(false)->sortable(false),
            Column::make('amount_last_time')->title('Doanh thu')->searching(false)->searchable(true)->sortable(false),
            Column::make('count_last_time')->title('Đơn hàng')->sortable(false)->searchable(false),
            Column::make('amount_this_time')->title('Doanh thu')->searching(false)->searchable(true)->sortable(false),
            Column::make('count_this_time')->title('Đơn hàng')->sortable(false)->searchable(false),
        ];
    }

//     public function html() {
//     return $this->builder()
//                 ->minifiedAjax( route('dashboard.users') );
// }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'OtpResetLogs_' . date('YmdHis');
    }
}
