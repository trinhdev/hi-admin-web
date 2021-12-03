<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Traits\DataTrait;
use \stdClass;

use App\Services\ApiService;
use Illuminate\Support\Facades\RateLimiter;

use Yajra\DataTables\DataTables;

use App\Models\Settings;

use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $this->model = $this->getModel('Hidepayments');
    }

    public function index()
    {
        $version = Settings::where('name', 'hide_payment_version')->get();
        $hidepayment = new stdClass();
        $hidepayment->versions = (!empty($version[0]['value'])) ? json_decode($version[0]['value'], true) : [];

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
            'version' => 'required|in:' . implode(',', $version),
        ]);

        $request->merge([
            'isUpStoreAndroid' => (!isset($request->isUpStoreAndroid)) ? "0" : "1",
            'isUpStoreIos' => (!isset($request->isUpStoreIos)) ? "0" : "1",
        ]);
        
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
        $this->addToLog(request());
        return redirect('/hidepayment')->with($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function initDatatable(Request $request){
        if($request->ajax()){
            $data = $this->model::query();
            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        }
    }
}
