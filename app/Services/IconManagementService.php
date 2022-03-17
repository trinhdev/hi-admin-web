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

    public function getAllProduct() {
        // dd($this->token);
        $url                = $this->baseUrl . $this->subDomain . 'products/get-all';
        $response           = sendRequest($url, [], $this->token);
        return $response;
    }

    public function getProductById($id) {
        $url                = $this->baseUrl . $this->subDomain . 'products/get-by-id';
        $response           = sendRequest($url, ['productId' => $id], $this->token);
        return $response;
    }

    public function getProductByListId($list_id) {
        $url                = $this->baseUrl . $this->subDomain . 'products/get-by-id-list';
        $response           = sendRequest($url, ['productIdList' => $list_id], $this->token);
        return $response;
    }

    public function addProduct($params) {
        $url                = $this->baseUrl . $this->subDomain . 'products/add';
        $response           = sendRequest($url, $params, $this->token, [], 'POST');
        return $response;
    }

    public function updateProduct($params) {
        $url                = $this->baseUrl . $this->subDomain . 'products/update';
        $response           = sendRequest($url, $params, $this->token, [], 'POST');
        return $response;
    }

    public function deleteProduct($params) {
        $url                = $this->baseUrl . $this->subDomain . 'products/delete';
        $response           = sendRequest($url, $params, $this->token, [], 'POST');
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

    public function addProductTitle($params) {
        $url                = $this->baseUrl . $this->subDomain . 'product-titles/add';
        $response           = sendRequest($url, $params, $this->token, [], 'POST');
        return $response;
    }

    public function updateProductTitle($params) {
        $url                = $this->baseUrl . $this->subDomain . 'product-titles/update';
        $response           = sendRequest($url, $params, $this->token, [], 'POST');
        return $response;
    }

    public function deleteProductTitle($params) {
        $url                = $this->baseUrl . $this->subDomain . 'product-titles/delete';
        $response           = sendRequest($url, $params, $this->token, [], 'POST');
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

    public function addProductConfig($params) {
        $url                = $this->baseUrl . $this->subDomain . 'product-titles/add';
        $response           = sendRequest($url, $params, $this->token, [], 'POST');
        return $response;
    }

    public function updateProductConfig($params) {
        $url                = $this->baseUrl . $this->subDomain . 'product-configs/update';
        $response           = sendRequest($url, $params, $this->token, [], 'POST');
        return $response;
    }

    public function deleteProductConfig($params) {
        $url                = $this->baseUrl . $this->subDomain . 'product-configs/delete';
        $response           = sendRequest($url, $params, $this->token, [], 'POST');
        return $response;
    }
}