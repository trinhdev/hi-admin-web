<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\MY_Controller;
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
        $this->title = 'Manage OTP';
        parent::__construct();
    }
    public function index()
    {
        return view('otp.index');
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
        $this->addToLog($request);
        return redirect()->route('manageotp.index')->with($result);
    }
}
