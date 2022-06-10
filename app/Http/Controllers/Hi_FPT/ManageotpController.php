<?php

namespace App\Http\Controllers\Hi_FPT;
use App\DataTables\Hi_FPT\OtpResetLogDataTable;
use App\Http\Controllers\MY_Controller;
use Illuminate\Http\Request;
use App\Services\HdiCustomer;
use Illuminate\Support\Facades\RateLimiter;

class ManageotpController extends MY_Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->title = 'Manage OTP';
        $this->model = $this->getModel('Otp_Reset_Logs');
        parent::__construct();
    }
    public function index(OtpResetLogDataTable $dataTable, Request $request)
    {
        return $dataTable->with([
            'start'     => $request->start,
            'length'    => $request->length,
            'order'     => $request->order,
            'columns'   => $request->columns,
            ])->render('otp.index', ['phone' => @$request['phone'], 'action' => @$request['action']]);
    }

    public function handle(OtpResetLogDataTable $dataTable, Request $request) {
        $executed = RateLimiter::attempt(
            'request-otp-with-phone' . $request['phone'],
            $perMinute = 2,
            function() {
                
            }
        );
        
        if (! $executed) {
            abort(429);
        }

        $validated = $request->validate([
            'phone' => 'required|digits_between:10,11',
        ]);

        $result = [];

        switch($request->action) {
            case 'reset_otp':
                $hiCustomer = new HdiCustomer();
                $data = $hiCustomer->postResetOTPByPhone(["phone" => $request["phone"]]);
                
                if(!empty($data['status'])) {
                    $result = ['success' => 'success', 'html' => $data['message']];
                    $request->session()->flash('success', 'success');
                    $request->session()->flash('html', $data['message']);
                }
                else {
                    $result = ['error' => 'error', 'html' => $data['message']];
                    $request->session()->flash('error', 'error');
                    $request->session()->flash('html', $data['message']);
                }
                break;
        }

        
        $result['phone'] = $request['phone'];
        $result['action'] = $request['action'];
        $log_data = [
            'phone'         => $request['phone'],
            'api_result'    => json_encode($data),
            'created_by'    => $this->user->id
        ];
        $this->model->create($log_data);
        $this->addToLog($request);
        return $dataTable->with([
            'start'     => $request->start,
            'length'    => $request->length,
            'order'     => $request->order,
            'columns'   => $request->columns,
            ])->render('otp.index', ['phone' => $request['phone'], 'action' => $request['action']]);
    }

    public function initDatatable(Request $request){
        $newsEventService = new NewsEventService();
        // $toDay = Carbon::parse( date('Y-m-d h:i:s'))->format('Y-m-d\TH:i');
        $param = [
            'bannerType' => empty($request->bannerType) ? null : $request->bannerType,
            'publicDateStart' => empty($request->public_date_from) ? null : Carbon::parse($request->public_date_from)->format('Y-m-d H:i:s'),
            'publicDateEnd' => empty($request->public_date_to) ? null : Carbon::parse($request->public_date_to)->format('Y-m-d H:i:s')
        ];
        $responseCallAPIGetListBanner = $newsEventService->getListbanner($param);
        if(empty($responseCallAPIGetListBanner)){
            $responseCallAPIGetListBanner = (object)[];
        };
        if($this->user->role_id == ADMIN){
            $responseCallAPIGetListBanner->isAdmin = true;
        }
        $responseCallAPIGetListBanner->aclCurrentModule  = $this->aclCurrentModule;
        return $responseCallAPIGetListBanner;
}
}
