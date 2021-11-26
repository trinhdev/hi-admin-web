<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\HdiCustomer;
use Illuminate\Support\Facades\RateLimiter;

class ManageOtpController extends MY_Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        parent::__construct();
        //     $this->middleware('throttle:20,1,recents');
    }
    public function index()
    {
        return view('otp.request');
    }

    public function handle(Request $request) {
        $executed = RateLimiter::attempt(
            'request-otp-with-phone' . $request['phone'],
            $perMinute = 2,
            function() {
                
            }
        );
        if (! $executed) {
            abort(419);
        }

        $validated = $request->validate([
            'phone' => 'required|digits_between:10,11',
        ]);

        switch($request->action) {
            case 'get_otp':
                $hiCustomer = new HdiCustomer();
                $data = $hiCustomer->postOTPByPhone('/help-tool/otp-by-phone', ["phone" => $request["phone"]]);
                if(!empty($data['status'])) {
                    $result = ['success' => 'success', 'html' => $data['data']['otp']];
                }
                else {
                    $result = ['error' => 'error', 'html' => $data['message']];
                }
                break;
            case 'reset_otp':
                $hiCustomer = new HdiCustomer();
                $data = $hiCustomer->postResetOTPByPhone('/help-tool/reset-otp', ["phone" => $request["phone"]]);
                if(!empty($data['status'])) {
                    $result = ['success' => 'success', 'html' => $data['message']];
                }
                else {
                    $result = ['error' => 'error', 'html' => $data['message']];
                }
                break;
        }

        return redirect('/manageotp')->with($result);
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
}
