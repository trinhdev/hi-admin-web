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
use App\Models\Sale_Report_By_Range;
use App\Models\Vietlott_Orders;

use DateTime;

class SalereportbydateController extends MY_Controller
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
        $services = (['ict', 'hdi', 'houseware', 'vuanem', 'gas', 'vietlott']);
        $services_filter = (!empty($request->services)) ? $request->services : $services;
        $from2 = $request->from;
        $to2 = $request->to;

        if(empty($from2)) {
            $from2 = date('Y-m-01 00:00:00', strtotime('yesterday midnight'));
        }
        else {
            $from2 = date('Y-m-d 00:00:00', strtotime($from2));
        }
        if(empty($to2)) {
            $to2 = date('Y-m-d 23:59:59', strtotime('today midnight'));
        }
        else {
            $to2 = date('Y-m-d 23:59:59', strtotime($to2));
        }
        $fromDate = new DateTime($from2);
        $toDate = new DateTime($to2);
        $difference = $toDate->diff($fromDate);
        $difference_number = $difference->d + 1;

        if($difference_number >= 28) {
            $from1 = date('Y-m-01 00:00:00', strtotime('-1 month', strtotime($from2)));
            $to1 = date('Y-m-t 23:59:59', strtotime('-1 month', strtotime($to2)));
        }
        else {
            $from1 = date('Y-m-d 00:00:00', strtotime('-' . $difference_number . 'days', strtotime($from2)));
            $to1 = date('Y-m-d 23:59:59', strtotime('-' . $difference_number . 'days', strtotime($to2)));
        }

        $query1 = Sale_Report_By_Range::selectRaw("service,
                                                zone,
                                                NULL AS branch_name,
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', count, 0)) AS 'count_last_time', 
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', amount, 0)) AS 'amount_last_time',
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', count, 0)) AS 'count_this_time', 
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', amount, 0)) AS 'amount_this_time'")
                                        ->whereNotIn('zone', ['FTELHO', 'PNCHO', 'TINHO', 'App Users'])
                                        ->whereIn('service', $services_filter)
                                        ->whereBetween('date_created', [$from1, $to2])
                                        ->groupBy(['service', 'zone']);

        $data = Sale_Report_By_Range::selectRaw("service,
                                                zone,
                                                branch_name,
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', count, 0)) AS 'count_last_time', 
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', amount, 0)) AS 'amount_last_time',
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', count, 0)) AS 'count_this_time', 
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', amount, 0)) AS 'amount_this_time'")
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
        // dd($data);
        $total = Sale_Report_By_Range::selectRaw("service,
                                                'Total' AS zone,
                                                NULL AS branch_name,
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', count, 0)) AS 'count_last_time', 
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', amount, 0)) AS 'amount_last_time',
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', count, 0)) AS 'count_this_time', 
                                                SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', amount, 0)) AS 'amount_this_time'")
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
        $data_product = Sale_Report_By_Range::selectRaw("service, product_type,
                                                    SUM(count) AS 'count_this_time', 
                                                    SUM(amount) AS 'amount_this_time'")
                                            ->whereIn('service', $services_filter)
                                            ->whereBetween('date_created', [$from2, $to2])
                                            ->groupBy(['service', 'product_type'])
                                            ->get()
                                            ->groupBy(['service'])
                                            ->toArray();
            
        if(in_array('vietlott', $services_filter)) {
            $data_vietlott_total = Vietlott_Orders::selectRaw("'Total' AS product_name,
                        SUM(IF(DATE(t_create) BETWEEN '" . $from1 . "' AND '" . $to1 . "', quantity, 0)) AS 'count_last_time', 
                        SUM(IF(DATE(t_create) BETWEEN '" . $from1 . "' AND '" . $to1 . "', product_price * quantity - discount_price, 0)) AS 'amount_last_time',
                        SUM(IF(DATE(t_create) BETWEEN '" . $from2 . "' AND '" . $to2 . "', quantity, 0)) AS 'count_this_time', 
                        SUM(IF(DATE(t_create) BETWEEN '" . $from2 . "' AND '" . $to2 . "', product_price * quantity - discount_price, 0)) AS 'amount_this_time'")
                ->whereBetween('t_create', [$from2, $to2]);

            $data_vietlott = Vietlott_Orders::selectRaw("product_name,
                        SUM(IF(DATE(t_create) BETWEEN '" . $from1 . "' AND '" . $to1 . "', quantity, 0)) AS 'count_last_time', 
                        SUM(IF(DATE(t_create) BETWEEN '" . $from1 . "' AND '" . $to1 . "', product_price * quantity - discount_price, 0)) AS 'amount_last_time',
                        SUM(IF(DATE(t_create) BETWEEN '" . $from2 . "' AND '" . $to2 . "', quantity, 0)) AS 'count_this_time', 
                        SUM(IF(DATE(t_create) BETWEEN '" . $from2 . "' AND '" . $to2 . "', product_price * quantity - discount_price, 0)) AS 'amount_this_time'")
            ->whereBetween('t_create', [$from2, $to2])
            ->groupBy(['product_name'])
            ->union($data_vietlott_total)
            ->get()
            ->toArray();
        }
        else {
            $data_vietlott = null;
        }

        if(!empty($request->is_ajax)) {
            return view('report.reportsalebydatetable', ['data' => $data, 'services' => $services, 'last_time' => date('d/m/Y', strtotime($from1)) . ' - ' . date('d/m/Y', strtotime($to1)), 'this_time' => date('d/m/Y', strtotime($from2)) . ' - ' . date('d/m/Y', strtotime($to2)), 'data_product' => $data_product, 'data_vietlott' => @$data_vietlott])->render();
        }
        else {
            return view('report.reportsalebydate', ['data' => $data, 'services' => $services, 'last_time' => date('d/m/Y', strtotime($from1)) . ' - ' . date('d/m/Y', strtotime($to1)), 'this_time' => date('d/m/Y', strtotime($from2)) . ' - ' . date('d/m/Y', strtotime($to2)), 'data_product' => $data_product, 'data_vietlott' => @$data_vietlott]);
        }
        
    }
}
