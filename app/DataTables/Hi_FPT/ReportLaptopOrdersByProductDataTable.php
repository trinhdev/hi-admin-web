<?php

namespace App\DataTables\Hi_FPT;

use App\Models\Report_Laptop_Orders_By_Product;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\ExportServiceProvider;
use DataTables;

class ReportLaptopOrdersByProductDataTable extends DataTable
{
    // use WithExportQueue;
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    protected $actions = ['customExport'];
    private $perPage = 10;
    private $orderBy = null;
    private $orderDirection  = null;
    private $currentPage = 1;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('avo',function($row) {
                $avo = ($row['count_delivered'] != 0) ? $row['amount_delivered'] / $row['count_delivered'] : 0;
                return number_format($avo);
            })
            ->editColumn('count_delivered',function($row) {
                return number_format($row['count_delivered']);
            })
            ->editColumn('amount_delivered',function($row) {
                return number_format($row['amount_delivered']);
            })
            ->editColumn('page_view_user',function($row) {
                return number_format(count(array_filter(explode(',', $row['page_view_user']))));
            })
            ->editColumn('page_view_user_per_page_view',function($row) {
                $page_view_user = count(array_filter(explode(',', $row['page_view_user'])));
                return (intval($page_view_user) != 0) ? round(intval($row['page_view']) / $page_view_user, 2) : 0;
            })
            ->editColumn('cr',function($row) {
                return (intval($row['page_view']) != 0) ? round($row['count_delivered'] / intval($row['page_view']), 4) * 100 . '%' : 0 . '%';
            })
            // ->editColumn('userapp',function($row) {
            //     return (intval($row['page_view']) != 0) ? round($row['count_delivered'] / intval($row['page_view']), 4) * 100 . '%' : 0 . '%';
            // })
            ->editColumn('userapp_ctv',function($row) {
                return (intval($row['emp_count']) != 0) ? round($row['app_users_count'] / intval($row['emp_count']), 4) * 100 . '%' : 0 . '%';
            })
            ->escapeColumns([])
            ->rawColumns(['avo', 'count_delivered', 'amount_delivered', 'page_view_user', 'page_view_user_per_page_view', 'userapp_ctv']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hi_FPT/Banner $model
     * @return Builder
     */
    public function query()
    {
        $from = $this->from;
        $to = $this->to;
        $agent_id = $this->agent_id;
        $merchant_id = $this->merchant_id;
        $product_id = $this->product_id;

        $merchants = Settings::where('name', 'sale_laptop_order_merchat_id')->get();
        $merchants_default = (!empty($merchants[0]['value'])) ? array_column(json_decode($merchants[0]['value'], true), 'key') : [];

        if(!empty($from)) {
            $from = date('Y-m-d 00:00:00', strtotime($from));
        }
        else {
            $from = date('Y-m-01 00:00:00', strtotime('yesterday midnight'));
        }

        if(!empty($to)) {
            $to = date('Y-m-d 00:00:00', strtotime($to));
        }
        else {
            $to = date('Y-m-t 23:59:59', strtotime('yesterday midnight'));
        }

        $reportData = Report_Laptop_Orders_By_Product::selectRaw('view_shopping_product_tb.sku AS sku, 
                                                                view_shopping_product_tb.product_name AS product_name, 
                                                                report_laptop_orders_by_product.product_id, 
                                                                SUM(report_laptop_orders_by_product.count_delivered) AS count_delivered, 
                                                                SUM(report_laptop_orders_by_product.amount_delivered) AS amount_delivered, 
                                                                SUM(report_laptop_orders_by_product.page_view) AS page_view,
                                                                SUM(report_laptop_orders_by_product.emp_count) AS emp_count,
                                                                SUM(report_laptop_orders_by_product.app_users_count) AS app_users_count, 
                                                                GROUP_CONCAT(page_view_user, ",") AS page_view_user')
                                                    ->whereBetween('created_at', [$from, $to])
                                                    ->join('view_shopping_product_tb', 'report_laptop_orders_by_product.product_id', '=', 'view_shopping_product_tb.product_id');

        if(!empty($merchant_id)) {
            $reportData->whereIn('view_shopping_product_tb.merchant_id', $merchant_id);
        }
        else {
            $reportData->whereIn('view_shopping_product_tb.merchant_id', $merchants_default);
        }

        if(!empty($agent_id)) {
            $reportData->whereIn('view_shopping_product_tb.agent_id', $agent_id);
        }
        else {
            $reportData->whereIn('view_shopping_product_tb.merchant_id', $merchants_default);
        }

        if(!empty($product_id)) {
            $reportData->whereIn('report_laptop_orders_by_product.product_id', $product_id);
        }
        else {
            $reportData->whereIn('view_shopping_product_tb.merchant_id', $merchants_default);
        }

        $reportData->orderBy('amount_delivered', 'desc')->groupBy(['product_id']);
        // dd($reportData->get()->toArray());
        return $this->applyScopes($reportData);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    // ->minifiedAjax( route('laptopordersbyproduct.renderProductTable') )
                    ->ajax([
                        'url' => route('laptopordersbyproduct.renderProductTable'),
                        'type' => 'GET',
                        'data' => 'function(d) { 
                            d.show_from = $("#show_from").val();
                            d.show_to = $("#show_to").val();
                            d.merchant_id = $("#merchant_id").val();
                            d.agent_id = $("#agent_id").val();
                            d.product_id = $("#product_id").val();
                        }',
                    ])
                    ->setTableId('report-data')
                    ->columns($this->getColumns())
                    ->lengthMenu([5, 10, 25, 50, 100, 200, 500])
                    ->pageLength(5)
                    ->parameters([
                        'scroll' => false,
                        'scrollX' => true,
                        'searching' => false,
                        'searchDelay' => 500,
                        'serverSide' => false
                    ])
                    ->dom('Bfrtip')
                    ->buttons(
                        Button::make('excel'),
                    )
                    ->addTableClass('table table-hover table-striped text-center w-100')
                    ->languageEmptyTable('Không có dữ liệu')
                    ->languageInfoEmpty('Không có dữ liệu')
                    ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
                    ->languageSearchPlaceholder('Nhập thông tin cần tra cứu')
                    ->languageSearch('Tìm kiếm')
                    ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
                    ->languageLengthMenu('Hiển thị _MENU_')
                    ->languageInfo('Hiển thị trang _PAGE_ của _PAGES_ trang');
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
                    ->sortable(false),
            Column::make('sku')->title('SKU')->searching(false)->defaultContent(''),
            Column::make('product_name')->title('Tên sản phẩm')->searching(false)->defaultContent(''),
            Column::make('amount_delivered')->title('Doanh số')->searching(false)->defaultContent(''),
            Column::make('count_delivered')->title('Đơn hàng')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('avo')->title('AVO')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('page_view')->title('Số lượt xem của nhà cung cấp')->sortable(false)->searching(false),
            Column::make('page_view_user')->title('Số lượng User xem')->sortable(false)->searching(false),
            Column::make('page_view_user_per_page_view')->title('Số trang 01 User xem')->sortable(false)->searching(false),
            Column::make('cr')->title('Tỷ lệ chuyển đổi đơn hàng vs Page view')->sortable(false)->searching(false),
            Column::make('emp_count')->title('Số lượng đơn hàng của CTV nội bộ')->sortable(false)->searching(false),
            Column::make('app_users_count')->title('Số lượng đơn hàng App users')->sortable(false)->searching(false),
            Column::make('userapp_ctv')->title('% User App vs CTV nội bộ')->sortable(false)->searching(false),
            // Column::make('customer_name')->title('Customer name')->sortable(false)->searching(false),
            // Column::make('address')->title('Address')->sortable(false)->searching(false)->defaultContent(''),
            // Column::make('total_amount_finish')->title('Total amount finish')->sortable(false)->searching(false)->defaultContent(''),
            // Column::make('referral_code')->title('Referral code')->sortable(false)->searching(false)->defaultContent(''),
            // Column::make('name')->title('IBB Account')->sortable(false)->searching(false)->defaultContent(''),
            // Column::make('full_name')->title('Referral name')->sortable(false)->searching(false)->defaultContent(''),
            // Column::make('order_state')->title('Order state')->sortable(false)->searching(false)->defaultContent(''),
            // Column::make('payment_method')->title('Payment method')->sortable(false)->searching(false)->defaultContent(''),
            // Column::make('payment_status')->title('Payment status')->sortable(false)->searching(false)->defaultContent(''),
            // Column::make('t_create')->title('Order create time')->sortable(false)->searching(false)->defaultContent(''),
            // Column::make('t_deliver')->title('Order deliver time')->sortable(false)->searching(false)->defaultContent(''),
            // Column::make('organization_zone_name')->title('Zone')->sortable(false)->searching(false)->defaultContent(''),
            // Column::make('organization_branch_code')->title('Branch code')->sortable(false)->searching(false)->defaultContent(''),
            // Column::make('branch_name')->title('Branch name')->sortable(false)->searching(false)->defaultContent(''),
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
