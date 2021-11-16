<?php

namespace App\Services;


class HdiCustomer
{
    private $clientKey;
    private $secretKey;
    private $token;
    private $baseUrl;
    private $postOTPByPhone;
    private $postResetOTPByPhone;

    public function __construct($data = null){
        $this->baseUrl = env('URI_BASE_HI_AUTH', 'http://hi-authapi-stag.fpt.vn');
        $this->postOTPByPhone = '/'.env('HI_AUTH_VERSION','v1').'/help-tool/otp-by-phone';
        $this->postResetOTPByPhone = '/'.env('HI_AUTH_VERSION','v1').'/help-tool/reset-otp';
        $this->clientKey    = env('HI_CUSTOMER_CLIENT_ID', 'hifpt_customer_local');
        $this->secretKey    = env('HI_CUSTOMER_SECRET', 'xxxxxxhifpt2018');
        $this->token = md5($this->clientKey."::".$this->secretKey.date("Y-d-m"));
    }

    public function postOTPByPhone($phone){
        // Call api to get OTP by phone
        $url = $this->baseUrl.$this->postOTPByPhone;
        $result = $this->sendRequest($url, $phone, $this->token);
        $result = json_decode($result,true);
        if(isset($result) && $result['statusCode'] == 0){
            $data['success']    = true;
            $data['data']      = $result['data']['otp'];
        }
        else{
            $data['success'] = false;
            $data['message'] = (!empty($result['message'])) ? $result['message'] : "Không tìm thầy OTP";;
        }
        return $data;
    }

    public function postResetOTPByPhone($phone){
        // Call api to reset OTP by phone
        $url = $this->baseUrl.$this->postResetOTPByPhone;
        $result = $this->sendRequest($url, $phone, $this->token);
        $result = json_decode($result,true);
        if(isset($result) && $result['statusCode'] == 0){
            $data['success']    = true;
            $data['data']    = $result['data'];
        }
        else{
            $data['success'] = false;
            $data['message'] = (!empty($result['message'])) ? $result['message'] : "Có lỗi trong quá trình reset OTP";
        }
        return $data;
    }

    public function sendRequest($url,$params, $token = null){
        $headers[] = "Content-Type: application/json";
        $headers[] = (!empty($token)) ? "Authorization: ".$token : null;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout in seconds

        if(env('APP_ENV') !== 'local'){
            curl_setopt($ch, CURLOPT_PROXY, 'proxy.hcm.fpt.vn:80');
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
        }

        $time = microtime(true);
        $output = curl_exec($ch);
        $timeRun = microtime(true) - $time;
    
        curl_close($ch);
        return $output;
    }
}
