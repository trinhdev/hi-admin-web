<?php

namespace App\Services;

class IconManagementService {
    private $token;
    private $baseUrl;
    private $sub_domain;

    public static function getAllProduct() {
        $api_info_config    = config('configDomain.DOMAIN_ICON_MANAGEMENT.' . env('APP_ENV'));
        $baseUrl            = $api_info_config['URL'];
        $subDomain          = (!empty($api_info_config['SUB_DOMAIN'])) ? implode('/', $api_info_config['SUB_DOMAIN']) . '/' : ''; 
        $url                = $url = $baseUrl . $subDomain . 'products/get-all';
        $token              = md5($api_info_config['CLIENT_KEY'] . '::' . $api_info_config['SECRET_KEY'] . date('Y-d-m'));
        // dd($url);
        $response           = sendRequest($url, [], $token);
        return $response;
    }

    public function getContractByContractNo($contractNo) {
        $api_info_config    = config('configDomain.DOMAIN_MODEM_CONTRACT_INFO.' . env('APP_ENV'));
        $baseUrl            = $api_info_config['URL'];
        $subDomain          = (!empty($api_info_config['SUB_DOMAIN'])) ? implode('/', $api_info_config['SUB_DOMAIN']) . '/' : ''; 
        $url                = $url = $baseUrl . $subDomain . 'GetContractByContractNo';
        $token              = $api_info_config['CLIENT_KEY'] . '::' . md5($api_info_config['CLIENT_KEY'] . '::' . $api_info_config['SECRET_KEY'] . date('Y-d-m'));
        $response           = sendRequest($url, ['contractNo' => $contractNo], $token);
        return $response;
    }

    public function getModemInfo($contractId) {
        $api_info_config    = config('configDomain.DOMAIN_MODEM_INFO.' . env('APP_ENV'));
        $baseUrl            = $api_info_config['URL'];
        $subDomain          = (!empty($api_info_config['SUB_DOMAIN'])) ? implode('/', $api_info_config['SUB_DOMAIN']) . '/' : '';
        $url                = $url = $baseUrl . $subDomain . 'modem-info';
        $token              = md5($api_info_config['CLIENT_KEY'] . '::' . $api_info_config['SECRET_KEY'] . date('Y-d-m'));
        $response           = sendRequest($url, array('accessToken' => $token, 'contractId'=> $contractId));
        return $response;
    }
}