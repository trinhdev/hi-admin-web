<?php

namespace App\Services;

class ModemService {
    private $token;
    private $baseUrl;
    private $sub_domain;

    public function __construct() {
        
    }

    public function getContractByContractNo($contractNo) {
        $api_info_config    = config('configDomain.DOMAIN_MODEM_CONTRACT_INFO.' . env('APP_ENV'));
        $baseUrl            = $api_info_config['URL'];
        $subDomain          = (!empty($api_info_config['SUB_DOMAIN'])) ? implode('/', $api_info_config['SUB_DOMAIN']) . '/' : ''; 
        $url                = $url = $baseUrl . $subDomain . 'GetContractByContractNo';
        $token              = $api_info_config['CLIENT_KEY'] . '::' . md5($api_info_config['CLIENT_KEY'] . '::' . $api_info_config['SECRET_KEY'] . date('Y-d-m'));
        $response           = self::my_sendRequest($url, ['contractNo' => $contractNo], $token);
        return $response;
    }

    public function getModemInfo($contractId) {
        $api_info_config    = config('configDomain.DOMAIN_MODEM_INFO.' . env('APP_ENV'));
        $baseUrl            = $api_info_config['URL'];
        $subDomain          = (!empty($api_info_config['SUB_DOMAIN'])) ? implode('/', $api_info_config['SUB_DOMAIN']) . '/' : '';
        $url                = $url = $baseUrl . $subDomain . 'modem-info';
        $token              = md5($api_info_config['CLIENT_KEY'] . '::' . $api_info_config['SECRET_KEY'] . date('Y-d-m'));
        $response           = self::my_sendRequest($url, array('accessToken' => $token, 'contractId'=> $contractId));
        return $response;
    }

    public function my_sendRequest($url, $params, $token = null, $headerArray = array(),$method = null)
    {
        $headers[] = "Content-Type: application/json";
        $headers[] = (!empty($token)) ? "Authorization: " . $token : null;
        if(!empty($headerArray)){
            foreach($headerArray as $key => $val){
                $headers[] = $key.": ". $val;
            }
        }
        // my_debug($headers);
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
        if(!empty($method)){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }
        $output = curl_exec($ch);
        $timeRun = microtime(true) - $time;
        if (curl_errno($ch)) {
            // dd(curl_error($ch));
            self::my_debug_private($url.'</br>'.curl_error($ch));
        }
        curl_close($ch);
        // my_debug($output.'</br>'.$url);
        return json_decode($output);
    }

    public function my_debug_private($var, $is_die = true)
    {
        echo '<pre>' . print_r($var, true) . '</pre>';
        if ($is_die) {
            die();
        }
    }
}