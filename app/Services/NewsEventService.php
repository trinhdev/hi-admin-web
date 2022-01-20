<?php

namespace App\Services;

use Illuminate\Http\Request;

class NewsEventService
{
    private $clientKey;
    private $secretKey;
    private $token;
    private $baseUrl;
    private $listMethod;
    public function __construct()
    {
        $api_config         = config('configDomain.DOMAIN_NEWS_EVENT.' . env('APP_ENV'));
        $this->baseUrl      = $api_config['URL'];
        $this->clientKey    = $api_config['CLIENT_KEY'];
        $this->secretKey    = $api_config['SECRET_KEY'];
        $this->token        = md5($this->clientKey . "::" . $this->secretKey . date("Y-d-m"));
        $this->listMethod = config('configMethod.DOMAIN_NEWS_EVENT');
    }

    public function getListTargetRoute()
    {
        $url = $this->baseUrl . $this->listMethod['GET_LIST_TARGET_ROUTE'];
        $response =  sendRequest($url, null, $this->token, $header = ['clientKey' => $this->clientKey], 'GET');
        return $response;
    }

    public function getListTypeBanner()
    {
        $url = $this->baseUrl . $this->listMethod['GET_LIST_TYPE_BANNER'];
        $response =  sendRequest($url, null, $this->token, $header = ['clientKey' => $this->clientKey], 'GET');
        return $response;
    }

    public function uploadImage($imageFileName, $encodedImage)
    {
        $url = $this->baseUrl . $this->listMethod['UPLOAD_IMAGE'];
        $param = [
            'imageFileName' => $imageFileName,
            'encodedImage'  => $encodedImage
        ];
        $response =  sendRequest($url, $param, $this->token, $header = ['clientKey' => $this->clientKey]);
        return $response;
    }

    public function getListbanner($param = null){
        $url = $this->baseUrl . $this->listMethod['GET_LIST_BANNER'];
        // my_debug($param,false);
        $response =  sendRequest($url, $param, $this->token, $header = ['clientKey' => $this->clientKey],'GET');
        // my_debug($response);
        return $response;
    }

    public function getDetailBanner($bannerId,$bannerType){
        $url = $this->baseUrl . $this->listMethod['GET_DETAIL_BANNER'];
        $param = [
            'bannerId' => $bannerId,
            'bannerType'  => $bannerType
        ];
        $response =  sendRequest($url, $param, $this->token, $header = ['clientKey' => $this->clientKey],'GET');
        return $response;
    }

    public function updateOrderBannder($bannerId, $bannerType, $ordering){
        $url = $this->baseUrl . $this->listMethod['UPDATE_ORDERING'];
        
        $updateParam = [
            'bannerType'    => ($bannerType == 'highlight') ? 'bannerHome' : $bannerType,
            'orderings'     => [
                [
                    'bannerId'  => $bannerId,
                    'ordering'  => $ordering
                ]
            ]
        ];
        $response =  sendRequest($url, $updateParam, $this->token, $header = ['clientKey' => $this->clientKey]);
        return $response;
    }

    public function addNewBanner($params){
        $url = $this->baseUrl . $this->listMethod['CREATE_BANNER'];
        $response =  sendRequest($url, $params, $this->token, $header = ['clientKey' => $this->clientKey]);
        return $response;
    }
    public function updateBanner($params){
        $url = $this->baseUrl . $this->listMethod['UPDATE_BANNER'];
        $response =  sendRequest($url, $params, $this->token, $header = ['clientKey' => $this->clientKey]);
        return $response;
    }

    public function getListTemplatePopup($param = null)
    {
        $url = $this->baseUrl . $this->listMethod['GET_LIST_POPUP'];
        $response =  sendRequest($url, $param, $this->token, $header = ['clientKey' => $this->clientKey], 'POST');
        return $response;
    }
}
