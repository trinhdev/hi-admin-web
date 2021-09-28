<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\HdiCustomer;

class ManageOTPController extends Controller
{
    public function __contruct(Request $request){
        parent::__contruct($request);
    }

    public function checkOTP(Request $request)
    {
        // Check if user has permission 
        if($this->authorize('check-otp', Auth::user())){
            if($request->getMethod() == 'GET'){
                return view('user.check-otp');
            }
            $validatedData = $request->validate([
                'phone' => 'required|digits_between:10,11',
            ]);
            dd($validatedData);
            $hiCustomer = new HdiCustomer();
            $result = $hiCustomer->postOTPByPhone($request["phone"]);
            return "Mã OTP của bạn là : ".$result["data"];
        }
        abort(403);
    }

    public function manageOTP(){
        if($this->authorize('manage-otp', Auth::user())) {
            return view('user.manage-otp');
        };
        abort(403);
    }
}
