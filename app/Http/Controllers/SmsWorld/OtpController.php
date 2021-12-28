<?php

namespace App\Http\Controllers\SmsWorld;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Services\SmsWorldService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class OtpController extends MY_Controller
{
    //
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Sms World';
    }
    // public function login(Request $request){

    //     $accessToken = $this->getAccessToken();
    //     if($accessToken !== false){
    //         return redirect()->route('smsworld.logs');
    //     };
    //     if($request->isMethod('get')){
    //         return view('smsworld.index');
    //     }else{
    //         $request->validate([
    //             'username' =>'required',
    //             'password' =>'required'
    //         ]);
    //         $smsWorldService = new SmsWorldService;
    //         $response = $smsWorldService->login($request->username,$request->password);
    //         if(empty($response->Detail)){
    //             return redirect()->route('smsworld.login')->withErrors(['errors'=>'Login Failed!']);
    //         }
    //         $this->setAccessToken($response->Detail->AccessToken);
    //         return redirect()->back();
    //     }
    // }
    // public function logout(){
    //     $keyName = config('constants.REDIS_KEY.ACCESS_TOKEN_SMS_WORLD');
    //     Redis::del($keyName);
    //     return redirect()->route('smsworld.login');
    // }
    public function logs(){
        return view('smsworld.logs');
    }

    public function getLog(Request $request){


        $request->validate([
            'PhoneNumber' =>'required',
            'Month' => 'required',
            'Year' => 'required'
        ]);

        $result = [];
        $userName = 'hifpt@hr.fpt.vn';
        $passWord = '!@#hiFPT123';
        $smsWorldService = new SmsWorldService;
        $response_Login = $smsWorldService->login($userName,$passWord);
        if(empty($response_Login->Detail)){
            $result['error'] = 'Authorization has been denied for this request.';
        }else{
            $accessToken = $response_Login->Detail->AccessToken;
            if($accessToken === false){
                $result['error'] = 'Authorization has been denied for this request.';
            }else{
                $smsWorldService = new SmsWorldService;
                $response = $smsWorldService->getlogs($request->PhoneNumber,$request->Month,$request->Year,$accessToken);
                if(empty($response->Detail)){
                    $result['error'] = $response->Message;
                }else{
                    $result = $response->Detail;
                }
            }
        }
        return $result;
    }

    private function getAccessToken(){
        $keyName = config('constants.REDIS_KEY.ACCESS_TOKEN_SMS_WORLD');
        $accessToken = Redis::get($keyName);
        return (is_null($accessToken)) ? false: unserialize($accessToken);
    }

    private function setAccessToken($accessToken){
        $keyName = config('constants.REDIS_KEY.ACCESS_TOKEN_SMS_WORLD');
        Redis::setex($keyName,1000, serialize($accessToken));
        return true;
    }
}
