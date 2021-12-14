<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\MY_Controller;
use Illuminate\Http\Request;

use App\Http\Traits\DataTrait;
use \stdClass;

use App\Services\ApiService;
use Illuminate\Support\Facades\RateLimiter;

use Yajra\DataTables\DataTables;

use App\Models\Settings;

use Illuminate\Support\Facades\Gate;

class HidepaymentController extends MY_Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Hide Payment';
        $this->model = $this->getModel('Hidepayments');
    }

    public function index()
    {
        $version = Settings::where('name', 'hide_payment_version')->get();
        $device = Settings::where('name', 'hide_payment_device')->get();
        $hidepayment = new stdClass();
        $hidepayment->versions = (!empty($version[0]['value'])) ? json_decode($version[0]['value'], true) : [];
        $hidepayment->device = (!empty($device[0]['value'])) ? json_decode($device[0]['value'], true) : [];
        return view('hidepayment.index')->with('hidepayment', $hidepayment);
    }
    
    public function hide(Request $request) {
        if (Gate::denies('hide-payment')) {
            abort(403);
        }

        $executed = RateLimiter::attempt(
            'hide-payment' . $request['version'],
            $perMinute = 2,
            function() {
                
            }
        );
        if (! $executed) {
            abort(419);
        }

        $version_setting = Settings::where('name', 'hide_payment_version')->get();
        $version = (!empty($version_setting[0]['value'])) ? json_decode($version_setting[0]['value'], true) : [];

        $validated = $request->validate([
            'version'   => 'required|in:' . implode(',', $version),
            'action'    => 'required'
        ]);

        $action = [];
        $action[$request->platform] = $request->action;

        $request->merge($action);
        
        $data = ApiService::hidePayment($request->all());

        if(!empty($data['status'])) {
            $result = ['success' => 'success', 'html' => $data['message']];
        }
        else {
            $result = ['error' => 'error', 'html' => $data['message']];
        }

        $request->merge([
            'api_status'    => $data['statusCode'],
            'error_mesg'    => $data['message']
        ]);

        $hidepayment = $this->createSingleRecord($this->model, $request->all());
        $this->addToLog($request);
        return redirect()->route('hidepayment.index')->with($result);
    }
    public function initDatatable(Request $request){
        if($request->ajax()){
            $data = $this->model::with('user')->select(['id', 'version', 'isUpStoreAndroid', 'isUpStoreIos', 'created_by', 'created_at', 'error_mesg']);
            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        }
    }
}
