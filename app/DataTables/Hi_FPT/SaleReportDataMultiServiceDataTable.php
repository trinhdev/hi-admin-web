<?php

namespace App\DataTables\Hi_FPT;

use App\Models\Sale_Report_Data_Multi_Service;
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

class SaleReportDataMultiServiceDataTable extends DataTable
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
            // ->editColumn('action',function($row) {
            //     return '<div style="display:flex; justify-content:center" class="infoRow" data-id="' . $row->id . '">
            //                 <a style="margin-right: 5px" type="button" onclick="getDetail(this)" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>
            //                 <form action="/employees/destroy/' . $row->id . '" method="POST" onsubmit="handleSubmit(event,this)">
            //                     '.csrf_field().'
            //                     '.method_field("DELETE").'
            //                     <button type="submit" class="btn btn-sm fas fa-trash-alt btn-icon bg-red"></button>
            //                 </form>
            //             </div>';
            // })
            ->escapeColumns([])
            ->rawColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hi_FPT/Banner $model
     * @return Builder
     */
    public function query()
    {
        $customer_phone = $this->customer_phone ?? null;
        $from = $this->from;
        $to = $this->to;
        $service_type = $this->service_type;
        $order_state = $this->order_state;
        $payment_method = $this->payment_method;
        $payment_status = $this->payment_status;
        $zone = $this->zone;
        $branch_code = $this->branch_code;
        $ftel_branch = $this->ftel_branch;
        $isAndServiceType = $this->isAndServiceType;

        if(!empty($isAndServiceType)) {
            $reportData = Sale_Report_Data_Multi_Service::selectRaw('customer_phone, customer_name, group_concat(service_type) AS combine_service');
        }
        else {
            $reportData = Sale_Report_Data_Multi_Service::select()->leftJoin('employees', 'sale_report_data_multi_service.referral_code', '=', 'employees.phone');
        }

        if(!empty($from)) {
            $from = date('Y-m-d 00:00:00', strtotime($from));
        }
        else {
            $from = date('Y-m-d 00:00:00', strtotime('yesterday midnight'));
        }

        if(!empty($to)) {
            $to = date('Y-m-d 00:00:00', strtotime($to));
        }
        else {
            $to = date('Y-m-d 23:59:59', strtotime('yesterday midnight'));
        }

        $reportData->whereBetween('t_deliver', [$from, $to]);

        if(!empty($customer_phone)) {
            $reportData->where('customer_phone', $customer_phone);
        }

        if(!empty($service_type)) {
            $reportData->whereIn('service_type', $service_type);
        }

        if(!empty($order_state)) {
            $reportData->whereIn('order_state', $order_state);
        }

        if(!empty($payment_method)) {
            $reportData->whereIn('payment_method', $payment_method);
        }

        if(!empty($payment_status)) {
            $reportData->whereIn('payment_status', $payment_status);
        }

        if(!empty($zone)) {
            $reportData->whereIn('employees.organization_zone_name', $zone);
        }

        if(!empty($branch_code)) {
            $reportData->whereIn('employees.organization_branch_code', $branch_code);
        }

        if(!empty($ftel_branch)) {
            $reportData->whereIn('employees.branch_name', $ftel_branch);
        }

        if(!empty($isAndServiceType)) {
            $reportData->groupBy('customer_phone');
            if(empty($service_type)) {
                $services = Settings::where('name', 'multi_service_service_settings')->get();
                $service_type = (!empty($services[0]['value'])) ? array_column(json_decode($services[0]['value'], true), 'key') : [];
            }
            foreach($service_type as $keyService => $valueService) {
                $reportData->havingRaw('Find_In_Set("' . $valueService . '", combine_service) > 0');
            }
        }

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
                    ->setTableId('report-data')
                    ->columns($this->getColumns())
                    ->lengthMenu([5, 10, 25, 50, 100, 200, 500])
                    ->pageLength(5)
                    ->parameters([
                        'scroll' => false,
                        'scrollX' => true,
                        'searching' => false,
                        'searchDelay' => 500,
                        'serverSide'    => true
                    ])
                    // ->dom('Bfrtip')
                    // ->buttons(
                    //     Button::
                    // )
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
            Column::make('service_type_name')->title('Type')->searching(false)->defaultContent(''),
            Column::make('order_id')->title('Order id')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('product_name')->title('Product name')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('customer_phone')->title('Customer phone')->sortable(false)->searching(false),
            Column::make('customer_name')->title('Customer name')->sortable(false)->searching(false),
            Column::make('address')->title('Address')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('total_amount_finish')->title('Total amount finish')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('referral_code')->title('Referral code')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('name')->title('IBB Account')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('full_name')->title('Referral name')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('order_state')->title('Order state')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('payment_method')->title('Payment method')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('payment_status')->title('Payment status')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('t_create')->title('Order create time')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('t_deliver')->title('Order deliver time')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('organization_zone_name')->title('Zone')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('organization_branch_code')->title('Branch code')->sortable(false)->searching(false)->defaultContent(''),
            Column::make('branch_name')->title('Branch name')->sortable(false)->searching(false)->defaultContent(''),
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
