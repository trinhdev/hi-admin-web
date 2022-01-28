<?php

namespace App\Services;

class IconManagementService {
    private $subDomain;
    private $token;
    private $baseUrl;
    public function __construct()
    {
        $api_config         = config('configDomain.DOMAIN_ICON_MANAGEMENT.' . env('APP_ENV'));
        $this->baseUrl      = $api_config['URL'];
        $this->subDomain    = (!empty($api_config['SUB_DOMAIN'])) ? implode('/', $api_config['SUB_DOMAIN']) . '/' : '';
        $this->token        = md5($api_config['CLIENT_KEY'] . '::' . $api_config['SECRET_KEY'] . date('Y-d-m'));
    }

    public function getAllProduct(){
        $url                = $this->baseUrl . $this->subDomain . 'products/get-all';
        $response           = sendRequest($url, [], $this->token);
        return $response;
    }

    public function getProductById($id) {
        $url                = $this->baseUrl . $this->subDomain . 'products/get-by-id';
        $response           = sendRequest($url, ['productId' => $id], $this->token);
        return $response;
    }

    public function getAllProductTitle(){
        $url                = $this->baseUrl . $this->subDomain . 'product-titles/get-all';
        $response           = sendRequest($url, [], $this->token);
        return $response;
    }

    public function getProductTitleById($id) {
        $url                = $this->baseUrl . $this->subDomain . 'product-titles/get-by-id';
        $response           = sendRequest($url, ['productTitleId' => $id], $this->token);
        return $response;
    }

    public function getAllProductConfig() {
        $url                = $this->baseUrl . $this->subDomain . 'product-configs/get-all';
        $response           = sendRequest($url, [], $this->token);
        return $response;
    }

    public function getProductConfigById($id) {
        $url                = $this->baseUrl . $this->subDomain . 'product-configs/get-by-id';
        $response           = sendRequest($url, ['productConfigId' => $id], $this->token);
        return $response;
    }
}