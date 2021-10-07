<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\HdiCustomer;

class ManageOTPController extends Controller
{
    public function __construct(Request $request){
        parent::__construct($request);
    }

    public function checkOTP(Request $request)
    {
        // Check if user has permission 
        if($this->authorize('read-otp')){
            // Return view if it is get request
            if($request->getMethod() == 'GET'){
                return view('user.check-otp');
            }
   
            // Validate input
            $validatedData = \Validator::make($request->all(),[
                'phone' => 'required|digits_between:10,11',
            ]);
            if($validatedData->fails()){
                return $this->apiJsonResponse("RESPONSE_INVALID_INPUT",$validatedData->messages());
            }
            
            // Send request to hi-customer to get OTP
            $hiCustomer = new HdiCustomer();
            $result = $hiCustomer->postOTPByPhone(["phone" => $request["phone"]]);
            // Handle result
            if($result["success"] == false){
                return $this->apiJsonResponse("RESPONSE_ERROR",null,$result["message"]);
            }

            return $this->apiJsonResponse("RESPONSE_SUCCESS",$result["data"]);
        }
        
        abort(403);
    }

    public function manageOTP(){
        // Return view manage-otp when user has permission
        if($this->authorize('write-otp')) {
            return view('user.manage-otp');
        };

        abort(403);
    }
    
    public function resetOTP(Request $request){
        // Check if user has permission 
        if($this->authorize('write-otp')){
  
            // Validate input
            $validatedData = \Validator::make($request->all(),[
                'phone' => 'required|digits_between:10,11',
            ]);
            if($validatedData->fails()){
                return $this->apiJsonResponse("RESPONSE_INVALID_INPUT",$validatedData->messages());
            }
            
            // Send request to hi-customer to get OTP
            $hiCustomer = new HdiCustomer();
            $result = $hiCustomer->postResetOTPByPhone(["phone" => $request["phone"]]);
           
            // Handle result
            if($result["success"] == false){
                return $this->apiJsonResponse("RESPONSE_ERROR",null,$result["message"]);
            }

            return $this->apiJsonResponse("RESPONSE_SUCCESS",$result["data"]);
        }
        
        abort(403);
    } 
}
