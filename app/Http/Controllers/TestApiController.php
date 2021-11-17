<?php

namespace App\Http\Controllers;

class TestApiController {

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

    public function postOTPByPhone($phone = ['phone' => '0917375559']){
        // Call api to get OTP by phone
        $url = $this->baseUrl.$this->postOTPByPhone;
        dd($this->token);
        $result = $this->sendRequest($url, $phone, $this->token);
        // dd($result);
        $result = json_decode($result,true);
        if(isset($result) && $result['statusCode'] == 0){
            $data['success']    = true;
            $data['data']      = $result['data']['otp'];
        }
        else{
            $data['success'] = false;
            $data['message'] = (!empty($result['message'])) ? $result['message'] : "Không tìm thầy OTP";;
        }
        echo $data;
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
    
    function optByPhone() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://hi-authapi-stag.fpt.vn/v1/help-tool/otp-by-phone',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "phone": "0986322412"
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: 09a2dbfc88f945476ac6db2b346b877b',
                'Content-Type: application/json'
            ),
            // curl_setopt($curl, CURLOPT_PROXY, 'proxy.hcm.fpt.vn:80'),
            // curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, 1)
        ));

        $response = curl_exec($curl);
        dd($response);

        curl_close($curl);
        echo $response;
    }
}
