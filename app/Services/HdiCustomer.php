<?php

namespace App\Services;


class HdiCustomer
{
    private $clientKey;
    private $secretKey;
    private $token;
    private $baseUrl;
    private $version;

    public function __construct($data = null){
        $api_config         = config('hdi_customer.' . env('APP_ENV'));
        $this->baseUrl      = $api_config['URI_BASE_HI_AUTH'];
        $this->version      = $api_config['HI_AUTH_VERSION'];
        $this->clientKey    = $api_config['HI_CUSTOMER_CLIENT_ID'];
        $this->secretKey    = $api_config['HI_CUSTOMER_SECRET'];
        $this->token        = md5($this->clientKey . "::" . $this->secretKey . date("Y-d-m"));
    }

    public function postOTPByPhone($method_name, $params = ['phone' => '']){
        // Call api to get OTP by phone
        $url = $this->baseUrl . $this->version . $method_name;
        $result = json_decode(sendRequest($url, $params, $this->token), true);
        
        if(isset($result) && $result['statusCode'] == 0){
            $data['status']     = true;
            $data['data']       = $result['data'];
            $data['message']    = '';
        }
        else{
            $data['status']     = false;
            $data['message']    = (!empty($result['message'])) ? $result['message'] : "Không tìm thấy OTP";
        }
        return $data;
    }

    public function postResetOTPByPhone($method_name, $params = ['phone' => '']){
        // Call api to reset OTP by phone
        $url = $this->baseUrl . $this->version . $method_name;
        $result = json_decode(sendRequest($url, $params, $this->token), true);

        if(isset($result) && $result['statusCode'] == 0){
            $data['status']     = true;
            $data['data']       = $result['data'];
            $data['message']    = '';
        }
        else{
            $data['status']     = false;
            $data['message']    = (!empty($result['message'])) ? $result['message'] : "Có lỗi trong quá trình reset OTP";
        }
        return $data;
    }

    public function sendRequest($url, $params, $token = null){
        $headers[] = "Content-Type: application/json";
        $headers[] = (!empty($token)) ? "Authorization: " . $token : null;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout in seconds

        // if(env('APP_ENV') !== 'local'){
        //     curl_setopt($ch, CURLOPT_PROXY, 'proxy.hcm.fpt.vn:80');
        //     curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
        // }

        $time = microtime(true);
        $output = curl_exec($ch);
        $timeRun = microtime(true) - $time;
        // if (curl_errno($ch)) {
            // my_debug($url.'</br>'.curl_error($ch));
        // }
        curl_close($ch);
        // my_debug($output.'</br>'.$url);
        return $output;
    }
}
