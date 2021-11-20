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

    public function __construct(){
        $api_config         = config('configDomain.DOMAIN_REPORT.' . env('APP_ENV'));
        $this->baseUrl      = $api_config['URL'];
        $this->version      = $api_config['VERSION'];
        $this->clientKey    = $api_config['CLIENT_KEY'];
        $this->secretKey    = $api_config['SECRET_KEY'];
        $this->token        = md5($this->clientKey . "::" . $this->secretKey . date("Y-d-m"));
    }

    public function getContractInfo(Request $request){

    }
}