<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\LogSupportCodeDatatable;
use App\DataTables\Hi_FPT\SuportCodeDataTable;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Models\Support_code_reset_logs;
use App\Services\HdiCustomer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SupportCodeController extends BaseController
{
    //
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Support Code Manager';
        $this->model = new Support_code_reset_logs();
    }

    public function index(suportCodeDataTable $dataTable, Request $request) {
        return $dataTable->with([
            'supportCode'   => $request->supportCode,
            'start'         => $request->start,
            'length'        => $request->length,
            'order'         => $request->order,
            'columns'       => $request->columns,
            ])->render('support_code.index');
    }

    public function log(LogSupportCodeDatatable $dataTable) {
        return $dataTable->render('support_code.log');
    }

    public function openSupportCode(Request $request) {
        $this->addToLog($request);
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
