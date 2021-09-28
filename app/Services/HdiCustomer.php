<?php

namespace App\Services;


class HdiCustomer
{
    private $clientId;
    private $secretKey;
    private $token;
    private $baseUrl;
    private $postOTPByPhone;
    public function __construct($data = null){
        $this->clientId = $data['clientId'];
        $this->baseUrl = env('URI_BASE_HI_CUSTOMER', 'http://hi-customer-stag.fpt.vn');
        $this->postOTPByPhone = '/hi-customer-local/swagger/otp-by-phone';
        $this->clientKey    = env('HI_CUSTOMER_CLIENT_ID', 'hifpt_customer_local');
        $this->secretKey    = env('HI_CUSTOMER_SECRET', 'xxxxxxhifpt2018');
        $this->token = md5($this->clientId."::".$this->secretKey.date("Y-d-m"));
    }

    public function postOTPByPhone($phone){
        // Call api calculate fee to HDI
        $url = $this->baseUrl.$this->postOTPByPhone;
        $result = $this->sendRequest($url, ["phone" => $phone]);
        $result = json_decode($result,true);
        if(isset($result) && $result['statusCode'] == 0){
            $data['success']    = true;
            $data['data']      = $result['data'];
        }
        else{
            $data['success'] = false;
            $data['message'] = $result['message'];
        }
        
        return $data;
    }

    public function sendRequest($url,$params){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json"
            )
        );

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
