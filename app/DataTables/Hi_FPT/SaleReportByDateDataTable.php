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
use DataTables;

use App\Models\Hdi_Orders;
use App\Models\Employees;

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
    private $service;
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
            // ->setTotalRecords($totalRecords)
            ->skipPaging()
            // ->with('total', $datas->sum('amount'))
            ->make(true);
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
        // $model = $service->findLikeCode($params);
        // if(isset($model['statusCode']) && $model['statusCode'] == 0) {
        //     $result = !empty($model['data']['items']) ? collect($model['data']['items']) : [];
        //     return $result;
        // }
        // $result = Hdi_Orders::reportByTime($this->service, '2022-06-01 00:00:00', '2022-06-30 23:59:59');
        // $result = Hdi_Orders::whereBetween('date_created', ['2022-05-01 00:00:00', '2022-06-30 23:59:59'])
        //                     ->with(['employees', 'employees.list_organizations' => function($query) {
        //                         // $query->select('zone_name, branch_code, branch_name_code');
        //                         $query->groupBy('zone_name', 'branch_code', 'branch_name_code');
        //                     }])
        //                     ->selectRaw("SUM(DATE(date_created) BETWEEN '2022-05-01 00:00:00' AND '2022-05-31 23:59:59') AS 'count_last_time', 
        //                                 SUM(IF(DATE(date_created) BETWEEN '2022-05-01 00:00:00' AND '2022-05-31 23:59:59', amount, 0)) AS 'amount_last_time',
        //                                 SUM(DATE(date_created) BETWEEN '2022-06-01 00:00:00' AND '2022-06-30 23:59:59') AS 'count_this_time', 
        //                                 SUM(IF(DATE(date_created) BETWEEN '2022-06-01 00:00:00' AND '2022-06-30 23:59:59', amount, 0)) AS 'amount_this_time'")
        //                     ->get();
                            // ->groupBy('zone_name', 'branch_code', 'branch_name_code')->toArray();
        $result = Hdi_Orders::reportByTime();
        dd($result->toArray());
        session()->flash('error');
        // return $this->applyScopes($result);
        return $result;
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
