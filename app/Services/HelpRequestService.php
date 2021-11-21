<?php

namespace App\Services;

use App\Helpers\CallApiHelper;
use Illuminate\Http\Request;

class HelpRequestService
{
    private $clientKey;
    private $secretKey;
    private $token;
    private $baseUrl;
    private $version;
    private $listMethod;
    public function __construct(){
        $api_config         = config('configDomain.DOMAIN_REPORT.' . env('APP_ENV'));
        $this->baseUrl      = $api_config['URL'];
        $this->version      = $api_config['VERSION'];
        $this->clientKey    = $api_config['CLIENT_KEY'];
        $this->secretKey    = $api_config['SECRET_KEY'];
        $this->token        = md5($this->clientKey . "::" . $this->secretKey . date("Y-d-m"));
        $this->listMethod = config('configMethod.DOMAIN_REPORT');
    }

    public function getListReportByContract($contract_info){
        $url = $this->baseUrl . $this->version .'/'. $this->listMethod['GET_LIST_REPORT'];
        $postParam = [
            'contractId' => $contract_info->Id,
            'customerId' => 555,
            'listContractHiFPT' => array(
                [
                    'contractNo' => $contract_info->Contract,
                    'contractId' => $contract_info->Id,
                    'customerIsActive' => 1
                ]
            )
        ];
        $response =  CallApiHelper::sendRequest($url, $postParam,$this->token);
        return $response;
    }
}