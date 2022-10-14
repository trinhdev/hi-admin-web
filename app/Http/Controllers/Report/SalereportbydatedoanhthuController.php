<?php

namespace App\Http\Controllers\Report;

use App\DataTables\Hi_FPT\SaleReportByDateDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Services\NewsEventService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

use App\Models\Settings;
use App\Models\Hdi_Orders;
use App\Models\Laptop_Orders;
use App\Models\Employees;
use App\Models\Sale_Report_By_Range_Doanh_Thu;
use App\Models\Sale_Report_By_Range_Product_Doanh_Thu;
use App\Models\Sale_Report_By_Range_Product_Category_Doanh_Thu;
use App\Models\Vietlott_Orders;

use DateTime;
use DatePeriod;
use DateInterval;

class SalereportbydatedoanhthuController extends MY_Controller
{
    //
    use DataTrait;
    // protected $module_name = 'SupportSystem';
    // protected $model_name = "SupportSystem";
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Báo cáo kinh doanh';
        // $this->model = $this->getModel('SupportSystem');
    }
    public function index(Request $request) {
        // dd($request->all());
        $services = (['ict', 'hdi', 'household', 'vuanem', 'gas', 'vietlott']);
        // $services = (['vuanem']);
        $services_filter = (!empty($request->services)) ? $request->services : $services;
        $from1 = $request->show_from1;
        $to1 = $request->show_to1;
        $from2 = $request->show_from;
        $to2 = $request->show_to;

        if(empty($from2)) {
            $from2 = date('Y-m-01 00:00:00', strtotime('yesterday midnight'));
        }
        else {
            $from2 = date('Y-m-d 00:00:00', strtotime($from2));
        }
        if(empty($to2)) {
            $to2 = date('Y-m-d 23:59:59', strtotime('yesterday midnight'));
        }
        else {
            $to2 = date('Y-m-d 23:59:59', strtotime($to2));
        }

        $fromDate = new DateTime($from2);
        $toDate = new DateTime($to2);
        $difference = $toDate->diff($fromDate);
        $difference_number = $difference->d + 1;

        if(empty($from1)) {
            $from1 = date('Y-m-d 00:00:00', strtotime('-' . $difference_number . 'days', strtotime($from2)));
        }
        else {
            $from1 = date('Y-m-d 00:00:00', strtotime($from1));
        }
        if(empty($to1)) {
            $to1 = date('Y-m-d 23:59:59', strtotime('-' . $difference_number . 'days', strtotime($to2)));
        }
        else {
            $to1 = date('Y-m-d 23:59:59', strtotime($to1));
        }

        $query1 = Sale_Report_By_Range_Doanh_Thu::selectRaw("service,
                                                zone,
                                                NULL AS branch_name,
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', count, 0)) AS 'count_last_time', 
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', amount, 0)) AS 'amount_last_time',
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', count, 0)) AS 'count_this_time', 
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', amount, 0)) AS 'amount_this_time',
                                                GROUP_CONCAT(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', list_emp_phone, null)) AS 'count_employees_last_time',
                                                GROUP_CONCAT(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', list_emp_phone, null)) AS 'count_employees_this_time'")
                                        ->whereNotIn('zone', ['FTELHO', 'PNCHO', 'TINHO', 'App Users'])
                                        ->whereIn('service', $services_filter)
                                        ->whereBetween('date_created', [$from1, $to2])
                                        ->groupBy(['service', 'zone']);

        $data = Sale_Report_By_Range_Doanh_Thu::selectRaw("service,
                                                zone,
                                                branch_name,
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', count, 0)) AS 'count_last_time', 
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', amount, 0)) AS 'amount_last_time',
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', count, 0)) AS 'count_this_time', 
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', amount, 0)) AS 'amount_this_time',
                                                GROUP_CONCAT(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', list_emp_phone, null)) AS 'count_employees_last_time',
                                                GROUP_CONCAT(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', list_emp_phone, null)) AS 'count_employees_this_time'")
                                    ->whereIn('service', $services_filter)
                                    ->whereBetween('date_created', [$from1, $to2])
                                    ->groupBy(['service', 'zone', 'branch_name'])
                                    ->union($query1)
                                    ->orderBy('service')
                                    ->orderBy('zone')
                                    ->orderBy('branch_name')
                                    ->get()
                                    ->groupBy(['service'])
                                    ->toArray();    

        $total = Sale_Report_By_Range_Doanh_Thu::selectRaw("service,
                                                'Total' AS zone,
                                                NULL AS branch_name,
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', count, 0)) AS 'count_last_time', 
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', amount, 0)) AS 'amount_last_time',
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', count, 0)) AS 'count_this_time', 
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', amount, 0)) AS 'amount_this_time',
                                                GROUP_CONCAT(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', list_emp_phone, null)) AS 'count_employees_last_time',
                                                GROUP_CONCAT(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', list_emp_phone, null)) AS 'count_employees_this_time'")
                                        ->whereIn('service', $services_filter)
                                        ->whereBetween('date_created', [$from1, $to2])
                                        ->groupBy(['service'])
                                        ->get()
                                        ->groupBy(['service'])
                                        ->toArray();
        foreach($data as $key => &$value) {
            array_push($value, $total[$key][0]);
        }

        // count by product type
        $data_product = Sale_Report_By_Range_Doanh_Thu::selectRaw("service,
                                                    SUM(count) AS 'count_this_time', 
                                                    SUM(amount) AS 'amount_this_time'")
                                            ->whereIn('service', $services_filter)
                                            ->whereBetween('date_created', [$from2, $to2])
                                            ->groupBy(['service'])
                                            ->get()
                                            ->groupBy(['service'])
                                            ->toArray();
            
        

        if(in_array('vietlott', $services_filter)) {
            $data_vietlott_total = Vietlott_Orders::selectRaw("'Total' AS product_name,
                        SUM(IF(DATE(t_create) BETWEEN '" . $from1 . "' AND '" . $to1 . "', quantity, 0)) AS 'count_last_time', 
                        SUM(IF(DATE(t_create) BETWEEN '" . $from1 . "' AND '" . $to1 . "', product_price * quantity - discount_price, 0)) AS 'amount_last_time',
                        SUM(IF(DATE(t_create) BETWEEN '" . $from2 . "' AND '" . $to2 . "', quantity, 0)) AS 'count_this_time', 
                        SUM(IF(DATE(t_create) BETWEEN '" . $from2 . "' AND '" . $to2 . "', product_price * quantity - discount_price, 0)) AS 'amount_this_time'")
                ->whereBetween('t_create', [$from1, $to2]);

            $data_vietlott = Vietlott_Orders::selectRaw("product_name,
                        SUM(IF(DATE(t_create) BETWEEN '" . $from1 . "' AND '" . $to1 . "', quantity, 0)) AS 'count_last_time', 
                        SUM(IF(DATE(t_create) BETWEEN '" . $from1 . "' AND '" . $to1 . "', product_price * quantity - discount_price, 0)) AS 'amount_last_time',
                        SUM(IF(DATE(t_create) BETWEEN '" . $from2 . "' AND '" . $to2 . "', quantity, 0)) AS 'count_this_time', 
                        SUM(IF(DATE(t_create) BETWEEN '" . $from2 . "' AND '" . $to2 . "', product_price * quantity - discount_price, 0)) AS 'amount_this_time'")
            ->whereBetween('t_create', [$from1, $to2])
            ->groupBy(['product_name'])
            ->union($data_vietlott_total)
            ->get()
            ->toArray();
        }
        else {
            $data_vietlott = [];
        }
        
        $productByService = Sale_Report_By_Range_Product_Doanh_Thu::selectRaw('product_type, SUM(count) AS count, SUM(amount) AS amount, service')
                                                        ->whereIn('service', $services_filter)
                                                        ->whereBetween('created_at', [$from2, $to2])
                                                        ->groupBy(['service', 'product_type'])
                                                        ->orderBy('amount', 'desc')
                                                        ->get()
                                                        ->groupBy(['service'])
                                                        
                                                        ->toArray();
                                        
        $productByCategory = Sale_Report_By_Range_Product_Category_Doanh_Thu::selectRaw('product_category, SUM(count) AS count, SUM(amount) AS amount, service')
                                                        ->whereIn('service', $services_filter)
                                                        ->whereBetween('created_at', [$from2, $to2])
                                                        ->groupBy(['service', 'product_category'])
                                                        ->orderBy('amount', 'desc')
                                                        ->get()
                                                        ->groupBy(['service'])
                                                        ->toArray();
        
        $chartStartFrom = date('Y-m-d 00:00:00', strtotime('yesterday midnight -30 days'));
        $chartStartTo = date('Y-m-d 23:59:59', strtotime('yesterday midnight'));
        $productByDateRaw = Sale_Report_By_Range_Doanh_Thu::selectRaw('SUM(count) AS count, SUM(amount) AS amount, DATE_FORMAT(date_created, "%Y-%m-%d") AS date_created')
                                                                ->whereBetween('date_created', [$chartStartFrom, $chartStartTo])
                                                                ->orderBy('date_created')
                                                                ->groupBy(['date_created'])
                                                                ->get()
                                                                ->toArray();
        $productByDateRaw = array_column($productByDateRaw, null, 'date_created');
        // dd($productByDateRaw);
        
        $vietlottByDateRaw = Vietlott_Orders::selectRaw('COUNT(trans_id) AS count, SUM(product_price * quantity - discount_price) AS amount, DATE_FORMAT(t_create, "%Y-%m-%d") AS created_at')
                                                                ->where('order_status', 'SUCCESS')
                                                                ->whereBetween('t_create', [$chartStartFrom, $chartStartTo])
                                                                ->orderBy('created_at')
                                                                ->groupBy(['created_at'])
                                                                ->get()
                                                                ->toArray();
        $vietlottByDateRaw = array_column($vietlottByDateRaw, null, 'created_at');
        // dd($vietlottByDateRaw);
        $productByDateChart = [
            [
                'label'             => 'Số tiền',
                'data'              => [],
                'backgroundColor'   => 'rgba(54, 162, 235, 0.5)',
                'borderColor'       => 'rgba(54, 162, 235, 1)',
                'yAxisID'           => 'money',
                'order'             => 2,
                'datalabels'        => [
                    'color'         => 'black',
                    'anchor'        => 'end',
                    'align'         => 'top',
                    'offset'        => 5,
                ]
            ],
            [
                'type'              => 'line',
                'label'             => 'Số lượng đơn hàng',
                'data'              => [],
                'borderColor'       => 'rgba(0, 0, 0, 0.5)',
                'yAxisID'           => 'quantity',
                'order'             => 1,
                'pointBorderWidth'  => 3,
                'pointStyle'        => 'circle',
                'datalabels'        => [
                    'color'         => 'red',
                    'anchor'        => 'end',
                    'align'         => 'top',
                    'offset'        => 5,
                ]
            ]
        ];

        $productByDateChartLabel = [];
        $thisMonthYear = date('Y-m', strtotime('yesterday midnight'));
        $interval = new DateInterval('P1D');
        $realEnd = new DateTime($chartStartTo);
        // $realEnd->add($interval);
        $period = new DatePeriod(new DateTime($chartStartFrom), $interval, $realEnd);

        // for($i = intval(date('d', strtotime('yesterday midnight -30 days'))); $i <= intval(date('d', strtotime('yesterday midnight'))); $i++) {
        //     $productByDateChartLabel[] = date('Y-m-d', strtotime($thisMonthYear . '-' . $i));
        //     $productByDateChart[0]['data'][] = strval((!empty($productByDateRaw[date('Y-m-d', strtotime($thisMonthYear . '-' . $i))]['amount']) ? $productByDateRaw[date('Y-m-d', strtotime($thisMonthYear . '-' . $i))]['amount'] : 0) + (!empty($vietlottByDateRaw[date('Y-m-d', strtotime($thisMonthYear . '-' . $i))]['amount']) ? $vietlottByDateRaw[date('Y-m-d', strtotime($thisMonthYear . '-' . $i))]['amount'] : 0));
        //     $productByDateChart[1]['data'][] = strval((!empty($productByDateRaw[date('Y-m-d', strtotime($thisMonthYear . '-' . $i))]['count']) ? $productByDateRaw[date('Y-m-d', strtotime($thisMonthYear . '-' . $i))]['count'] : 0) + (!empty($vietlottByDateRaw[date('Y-m-d', strtotime($thisMonthYear . '-' . $i))]['count']) ? $vietlottByDateRaw[date('Y-m-d', strtotime($thisMonthYear . '-' . $i))]['count'] : 0));
        // }
        foreach ($period as $periodKey => $periodValue) {
            // $value->format('Y-m-d');
            $productByDateChartLabel[] = strval($periodValue->format('Y-m-d'));
            $productByDateChart[0]['data'][] = strval((!empty($productByDateRaw[strval($periodValue->format('Y-m-d'))]['amount']) ? $productByDateRaw[strval($periodValue->format('Y-m-d'))]['amount'] : 0) + (!empty($vietlottByDateRaw[strval($periodValue->format('Y-m-d'))]['amount']) ? $vietlottByDateRaw[strval($periodValue->format('Y-m-d'))]['amount'] : 0));
            $productByDateChart[1]['data'][] = strval((!empty($productByDateRaw[strval($periodValue->format('Y-m-d'))]['count']) ? $productByDateRaw[strval($periodValue->format('Y-m-d'))]['count'] : 0) + (!empty($vietlottByDateRaw[strval($periodValue->format('Y-m-d'))]['count']) ? $vietlottByDateRaw[strval($periodValue->format('Y-m-d'))]['count'] : 0));
            // var_dump($value->format('Y-m-d'));       
        }

        $productByProductTypeChartLabel = [];
        $productByProductTypeChart = [
            [
                'label'             => 'Số tiền',
                'data'              => [],
                'backgroundColor'   => 'rgba(78, 181, 18, 0.5)',
                'borderColor'       => 'rgba(78, 181, 18, 1)',
                'yAxisID'           => 'money',
                'order'             => 2,
                'datalabels'        => [
                    'color'         => 'black',
                    'anchor'        => 'end',
                    'align'         => 'top',
                    'offset'        => 5,
                ]
            ],
            [
                'type'              => 'line',
                'label'             => 'Số lượng đơn hàng',
                'data'              => [],
                'borderColor'       => 'rgba(0, 0, 0, 0.5)',
                'yAxisID'           => 'quantity',
                'order'             => 1,
                'pointBorderWidth'  => 3,
                'pointStyle'        => 'circle',
                'datalabels'        => [
                    'color'         => 'red',
                    'anchor'        => 'end',
                    'align'         => 'top',
                    'offset'        => 5,
                ]
            ]
        ];

        $totalThisMonth = Sale_Report_By_Range_Doanh_Thu::selectRaw("service,
                                                'Total' AS zone,
                                                NULL AS branch_name,
                                                SUM(count) AS 'count_this_time', 
                                                SUM(amount) AS 'amount_this_time'")
                                        ->whereBetween('date_created', [$chartStartFrom, $chartStartTo])
                                        ->groupBy(['service'])
                                        ->get()
                                        ->groupBy(['service'])
                                        ->toArray();

        $data_vietlott_total_this_month = Vietlott_Orders::selectRaw("'Total' AS product_name,
                                        SUM(quantity) AS 'count_this_time', 
                                        SUM(product_price * quantity - discount_price) AS 'amount_this_time'")
                                ->where('order_status', 'SUCCESS')
                                ->whereBetween('t_create', [$chartStartFrom, $chartStartTo])
                                ->get()
                                ->toArray();

        foreach($totalThisMonth as $totalThisMonthKey => $totalThisMonthValue) {
            $productByProductTypeChartLabel[] = strtoupper($totalThisMonthKey);
            $productByProductTypeChart[0]['data'][] = $totalThisMonthValue[0]['amount_this_time'];
            $productByProductTypeChart[1]['data'][] = $totalThisMonthValue[0]['count_this_time'];
        }
        $productByProductTypeChartLabel[] = 'VIETLOTT';
        $productByProductTypeChart[0]['data'][] = (!empty($data_vietlott_total_this_month[0]['amount_this_time'])) ? $data_vietlott_total_this_month[0]['amount_this_time'] : 0;
        $productByProductTypeChart[1]['data'][] = (!empty($data_vietlott_total_this_month[0]['count_this_time'])) ? $data_vietlott_total_this_month[0]['count_this_time'] : 0;

        $productByBranchChartRaw = Sale_Report_By_Range_Doanh_Thu::selectRaw("zone, SUM(count) AS 'count_this_time', SUM(amount) AS 'amount_this_time'")
                                                                ->whereBetween('date_created', [$chartStartFrom, $chartStartTo])
                                                                ->orderBy('zone')
                                                                ->groupBy(['zone'])
                                                                ->get()
                                                                ->groupBy(['zone'])
                                                                ->toArray();
        $productByBranchChartLabel = [];
        $productByBranchChart = [
            [
                'label'             => 'Số tiền',
                'data'              => [],
                'backgroundColor'   => 'rgba(74, 30, 131, 0.5)',
                'borderColor'       => 'rgba(74, 30, 131, 1)',
                'yAxisID'           => 'money',
                'order'             => 2,
                'datalabels'        => [
                    'color'         => 'black',
                    'anchor'        => 'end',
                    'align'         => 'top',
                    'offset'        => 5,
                ]
            ],
            [
                'type'              => 'line',
                'label'             => 'Số lượng đơn hàng',
                'data'              => [],
                'borderColor'       => 'rgba(0, 0, 0, 0.5)',
                'yAxisID'           => 'quantity',
                'order'             => 1,
                'pointBorderWidth'  => 3,
                'pointStyle'        => 'circle',
                'datalabels'        => [
                    'color'         => 'red',
                    'anchor'        => 'end',
                    'align'         => 'top',
                    'offset'        => 5,
                ]
            ]
        ];
        foreach($productByBranchChartRaw as $productByBranchChartRawKey => $productByBranchChartRawValue) {
            $productByBranchChartLabel[] = $productByBranchChartRawKey;
            $productByBranchChart[0]['data'][] = $productByBranchChartRawValue[0]['amount_this_time'];
            $productByBranchChart[1]['data'][] = $productByBranchChartRawValue[0]['count_this_time'];
        }
        // dd($vietlottByDateRaw);
        return view('report.reportsalebydatedoanhthu', ['data' => $data, 'productByService' => $productByService, 'productByCategory' => $productByCategory, 'services' => $services, 'last_time' => date('d/m/Y', strtotime($from1)) . ' - ' . date('d/m/Y', strtotime($to1)), 'this_time' => date('d/m/Y', strtotime($from2)) . ' - ' . date('d/m/Y', strtotime($to2)), 'data_product' => $data_product, 'data_vietlott' => @$data_vietlott, 'productByDateChart' => $productByDateChart, 'productByDateChartLabel' => array_unique($productByDateChartLabel), 'productByProductTypeChart' => $productByProductTypeChart, 'productByProductTypeChartLabel' => $productByProductTypeChartLabel, 'productByBranchChart' => $productByBranchChart, 'productByBranchChartLabel' => $productByBranchChartLabel]);
    }
}
