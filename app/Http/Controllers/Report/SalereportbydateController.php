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
    public function index(Request $request, SaleReportByDateDataTable $dataTable) {
        // $services = ['ict', 'hdi', 'elmich', 'vuanem'];
        $services = ['ict'];
        $tables = [];
        $this->from1 = '2022-05-01 00:00:00';
        $this->to1 = '2022-05-31 23:59:59';
        $this->from2 = '2022-06-01 00:00:00';
        $this->to2 = '2022-06-30 23:59:59';
        foreach($services as $service) {
            // $dataTable->with([
            //     'start'     => $request->start,
            //     'length'    => $request->length,
            //     'order'     => $request->order,
            //     'columns'   => $request->columns,
            //     'service'   => $service,
            //     'from1'     => '2022-05-01 00:00:00',
            //     'to1'       => '2022-05-31 23:59:59',
            //     'from2'     => '2022-06-01 00:00:00',
            //     'to2'       => '2022-06-30 23:59:59'
            // ])->render('report.reportbysaledatedatatable');
            // $tables[$service] = $dataTable->html();

            $query1 = Laptop_Orders::selectRaw("organizations.zone_name AS 'zone_name', 
                                                NULL, 
                                                NULL, 
                                                SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from1 . "' AND '" . $this->to1 . "', 1, 0)) AS 'count_last_time', 
                                                SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from1 . "' AND '" . $this->to1 . "', total_amount_finish, 0)) AS 'amount_last_time',
                                                SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from2 . "' AND '" . $this->to2 . "', 1, 0)) AS 'count_this_time', 
                                                SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from2 . "' AND '" . $this->to2 . "', total_amount_finish, 0)) AS 'amount_this_time'")
                                    ->join('employees_final as emp', 'emp.phone', '=', 'referral_code')
                                    ->join('list_organizations as organizations', 'emp.organizationCode', '=', 'organizations.code')
                                    ->where('merchant_id', 'XIAOMI')
                                    ->whereBetween('t_deliver', [$this->from1, $this->to2])
                                    ->groupBy('zone_name');

            $query2 = Laptop_Orders::selectRaw("organizations.zone_name AS 'zone_name', 
                                                organizations.branch_code AS 'branch_code', 
                                                organizations.branch_name_code AS 'branch_name_code', 
                                                SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from1 . "' AND '" . $this->to1 . "', 1, 0)) AS 'count_last_time', 
                                                SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from1 . "' AND '" . $this->to1 . "', total_amount_finish, 0)) AS 'amount_last_time',
                                                SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from2 . "' AND '" . $this->to2 . "', 1, 0)) AS 'count_this_time', 
                                                SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from2 . "' AND '" . $this->to2 . "', total_amount_finish, 0)) AS 'amount_this_time'")
                                        ->join('employees_final as emp', 'emp.phone', '=', 'referral_code')
                                        ->join('list_organizations as organizations', 'emp.organizationCode', '=', 'organizations.code')
                                        ->join('customer_locations as cl', 'cl.customer_location_id', '=', 'emp.location_id')
                                        ->join('ftel_branch as fb1', 'fb1.location_id', '=', 'emp.location_id')
                                        ->join('ftel_branch as fb2', 'fb2.branch_code', '=', 'emp.branch_code')
                                        ->where('merchant_id', 'XIAOMI')
                                        ->whereBetween('t_deliver', [$this->from1, $this->to2])
                                        ->groupBy('zone_name', 'branch_code', 'branch_name_code')
                                        ->union($query1)
                                        ->orderBy('zone_name', 'asc')
                                        ->orderBy('branch_code', 'asc')
                                        ->orderBy('branch_name_code', 'asc')
                                        // ->union($queryAppUser)
                                        // ->union($queryTotal)
                                        ->get()
                                        ->toArray();
            dd($query2);
                                
            $queryAppUser = Laptop_Orders::selectRaw("'App users' AS 'zone_name',
                                                    NULL, 
                                                    NULL, 
                                                    SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from1 . "' AND '" . $this->to1 . "', 1, 0)) AS 'count_last_time',
                                                    SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from1 . "' AND '" . $this->to1 . "', total_amount_finish, 0)) AS 'amount_last_time',
                                                    SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from2 . "' AND '" . $this->to2 . "', 1, 0)) AS 'count_this_time', 
                                                    SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from2 . "' AND '" . $this->to2 . "', total_amount_finish, 0)) AS 'amount_this_time'")
                                        ->where(function($subQuery) {
                                            $subQuery->whereIn('referral_code', ['', null])
                                                    ->orWhereNotIn('referral_code', Employees::selectRaw('Replace(coalesce(`phone`, ""), " ", "") as `phone`')->whereNotNull('phone')->where('phone', '!=', '')->get());
                                        })
                                        ->where('merchant_id', 'XIAOMI')
                                        ->whereBetween('t_deliver', [$this->from1, $this->to2])
                                        ->get()
                                        ->toArray();
                                        
            $queryTotal = Laptop_Orders::selectRaw("'Total' AS 'zone_name', 
                                                    NULL, 
                                                    NULL, 
                                                    SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from1 . "' AND '" . $this->to1 . "', 1, 0)) AS 'count_last_time', 
                                                    SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from1 . "' AND '" . $this->to1 . "', total_amount_finish, 0)) AS 'amount_last_time',
                                                    SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from2 . "' AND '" . $this->to2 . "', 1, 0)) AS 'count_this_time', 
                                                    SUM(IF(DATE(t_deliver) BETWEEN '" . $this->from2 . "' AND '" . $this->to2 . "', total_amount_finish, 0)) AS 'amount_this_time'")
                                        ->where('merchant_id', 'XIAOMI')
                                        ->whereBetween('t_deliver', [$this->from1, $this->to2])
                                        ->get()
                                        ->toArray();
            
            if(!empty($queryAppUser)) {
                array_push($query2, $queryAppUser[0]);
            }

            if(!empty($queryTotal)) {
                array_push($query2, $queryTotal[0]);
            }

            $tables[$service] = $query2;
        }
        return view('report.reportsalebydate', $tables);
    }
}
