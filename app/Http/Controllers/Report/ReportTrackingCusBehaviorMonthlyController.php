<?php

namespace App\Http\Controllers\Report;

use App\DataTables\Hi_FPT\LogSupportCodeDatatable;
use App\DataTables\Hi_FPT\SuportCodeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Services\HdiCustomer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\Settings;
use App\Models\Contracts;
use App\Models\Customers;
use Illuminate\Support\Facades\DB;

class ReportTrackingCusBehaviorMonthlyController extends MY_Controller
{
    //
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Báo cáo hành vi khách hàng theo tháng';
        $this->model = $this->getModel('Support_code_reset_logs');
    }

    public function index(Request $request) {
        $chisobaocao = Settings::where('name', 'ChiSoBaoCaoThangHiFPT')->get();
        $from2 = $request->show_from;
        $to2 = $request->show_to;

        if(empty($from2)) {
            // $from2 = date('Y-m-01 00:00:00', strtotime('now'));
            $from2 = '2022-11-01 00:00:00';
        }

        if(empty($to2)) {
            // $to2 = date('Y-m-t 23:59:59', strtotime('now'));
            $to2 = '2022-11-30 23:59:59';
        }

        $from1 = date('Y-m-01 00:00:00', strtotime($from2 . ' last month'));
        $to1 = date('Y-m-d 23:59:59', strtotime($to2 . ' last day last month'));
        // dd($from1);
        // return $dataTable->with([
        //     'supportCode'   => $request->supportCode,
        //     'start'         => $request->start,
        //     'length'        => $request->length,
        //     'order'         => $request->order,
        //     'columns'       => $request->columns,
        //     ])->render('support_code.index');

        return view('report.trackingcusbehaviormonthly')->with([
            'filter'            => [
                'chisobaocao'   => (!empty($request->chisobaocao)) ? $request->chisobaocao : [],
            ],
            'chisobaocaos'      => (!empty($chisobaocao[0]['value'])) ? json_decode($chisobaocao[0]['value'], true) : [],
            // 'activebymonth'     => $this->getDataActiveMonthly($from1, $to1, $from2, $to2)
        ]);
    }

    public function getDataActiveMonthly() {
        $zones = ['Vung 1', 'Vung 2', 'Vung 3', 'Vung 4', 'Vung 5', 'Vung 6', 'Vung 7'];
        $results = [];
        // $from2 = $request->show_from;
        // $to2 = $request->show_to;

        // $from2 = date('Y-m-01 00:00:00', strtotime('now'));
        $from2 = '2022-10-01 00:00:00';
        // $to2 = date('Y-m-t 23:59:59', strtotime('now'));
        $to2 = '2022-10-31 23:59:59';

        // if(empty($from2)) {
        //     // $from2 = date('Y-m-01 00:00:00', strtotime('now'));
        //     $from2 = '2022-11-01 00:00:00';
        // }

        // if(empty($to2)) {
        //     // $to2 = date('Y-m-t 23:59:59', strtotime('now'));
        //     $to2 = '2022-11-30 23:59:59';
        // }

        $from1 = date('Y-m-01 00:00:00', strtotime($from2 . ' last month'));
        $to1 = date('Y-m-t 23:59:59', strtotime($to2 . ' last day last month'));
        // foreach($zones as $zone) {
        //     $data = Contracts::selectRaw("SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', 1, 0)) AS count_last_month,
        //                                 SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', 1, 0)) AS count_this_month")
        //                      ->whereBetween('date_created', [$from1, $to2])
        //                      ->where('location_zone', $zone)
        //                      ->get()
        //                      ->toArray();
        //     dd($data);
        //     array_push($results, ['location_zone' => $zone, 'count_last_month' => (isset($data[0]['count_last_month'])) ? $data[0]['count_last_month'] : 0, 'count_this_month' => (isset($data[0]['count_this_month'])) ? $data[0]['count_this_month'] : 0]);
        // }

        $data = Contracts::selectRaw("location_zone,
                                     SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', 1, 0)) AS count_last_month,
                                     SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', 1, 0)) AS count_this_month")
                        ->whereBetween('date_created', [$from1, $to2])
                        ->groupBy('location_zone')
                        ->get()->toArray();
        // dd('test');
        // $data = DB::connection('mysql4')->select('
        //     SELECT location_zone, SUM(IF(DATE(date_created) BETWEEN "' . $from1 . '" AND "' . $to1 . '", 1, 0)) AS "count_last_time", SUM(IF(DATE(date_created) BETWEEN "' . $from2 . '" AND "' . $to2 . '", 1, 0)) AS "count_this_time"
        //     FROM contracts
        //     WHERE date_created BETWEEN "' . $from1 . '" AND "' . $to2 . '"
        //     GROUP BY location_zone
        // ');
        // dd($data);
        // $dataNoContract = Customers::with(['customer_contract' => fn($query) => $query->whereNull('contract_id')])
        //                         //    ->selectRaw("SUM(IF(DATE(date_created) BETWEEN '" . $from1 . "' AND '" . $to1 . "', 1, 0)) AS count_last_month,
        //                         //                 SUM(IF(DATE(date_created) BETWEEN '" . $from2 . "' AND '" . $to2 . "', 1, 0)) AS count_this_month")
        //                            ->whereBetween('date_created', [$from1, $to1])
        //                            ->count();
        // dd($dataNoContract);
        // array_push($data, [
        //     'location_zone'     => 'Không có hợp đồng', 
        //     'count_last_month'  => (isset($dataNoContract[0]['count_last_month']) ? $dataNoContract[0]['count_last_month'] : 0), 
        //     'count_this_month'  => (isset($dataNoContract[0]['count_this_month']) ? $dataNoContract[0]['count_this_month'] : 0), 
        // ]);
        
        return ["data" => json_decode(json_encode($data), true), "time" => ["from" => 'T' . date('m-Y', strtotime($from1)), "to" => 'T' . date('m-Y', strtotime($to2))]];
    }

    public function log(LogSupportCodeDatatable $dataTable) {
        return $dataTable->render('support_code.log');
    }

    public function openSupportCode(Request $request) {
        $log_data = [];
        $hdiCustomer = new HdiCustomer();
        $api_result = $hdiCustomer->resetDeviceLockByCode(['supportCode' => $request->supportCode]);

        if(isset($api_result['statusCode']) && $api_result['statusCode'] == 0) {
            if(!empty($api_result['data'])) {
                $log_data = $api_result['data'];
                $log_data['code_created_at'] = date('Y-m-d H:i:s', strtotime(@$api_result['data']['created_at']));
                $log_data['code_updated_at'] = date('Y-m-d H:i:s', strtotime(@$api_result['data']['updated_at']));
                $log_data['last_updated'] = date('Y-m-d H:i:s', strtotime(@$api_result['data']['last_updated']));
                $log_data['api_result'] = json_encode($api_result);
                $log_data['created_by'] = Auth::check() ? Auth::user()->id : 0;
                $log_data['note'] = $request->note;
                $log_data['created_at'] = (!empty($request->created_at)) ? $request->created_at : date('Y-m-d H:i:s', strtotime('now'));
                $log_data['updated_at'] = (!empty($request->created_at)) ? $request->created_at : date('Y-m-d H:i:s', strtotime('now'));
            }
        }

        $log_data['statusCode'] = @$api_result['statusCode'];
        $log_data['message'] = @$api_result['message'];
        $this->model->create($log_data);
        if(isset($api_result['statusCode']) && $api_result['statusCode'] == 0) {
            return redirect()->back()->withSuccess($api_result['message']);
        }
        else {
            return redirect()->back()->withErrors($api_result['message']);
        }
    }
}
