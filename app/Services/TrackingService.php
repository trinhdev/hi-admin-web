<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TrackingService
{
    private $clientKey;
    private $secretKey;
    private $baseUrl;
    private $listMethod;
    private $client;
    private $headers;

    public function __construct()
    {
        $api_config         = config('configDomain.DOMAIN_TRACKING.' . env('APP_ENV'));
        $this->listMethod = config('configMethod.DOMAIN_TRACKING');
        if ($api_config) {
            $this->baseUrl      = $api_config['URL'];
            $this->clientKey    = $api_config['CLIENT_KEY'];
            $this->secretKey    = $api_config['SECRET_KEY'];
            $this->client = new Client(['base_uri' => $api_config['URL']]);
            $this->headers = [
                'Authorization' => 'Bearer '.md5($this->clientKey."::".$this->secretKey.date("Y-d-m")),
                'Content-Type' => 'application/json'
            ];
        }
    }

    public function get_active_customers($event, $from, $to, int $limit = 10, int $above_duration = 0)
    {
        try {
            $form_params = [
                'query_event'=>$event,
                'data'=> [
                    'from_date' => $from,
                    'to_date' => $to,
                    'limit'     => $limit,
                    'above_duration' => $above_duration
                ]
            ];
            $response = $this->client->request('POST', $this->listMethod['CUSTOMERS_ACTIVITIES'], [
                'headers' => $this->headers,
                "proxy" => "http://proxy.hcm.fpt.vn:80",
                'json' => $form_params
            ])->getBody()->getContents();
            return json_decode($response);
        } catch (\Exception $exception) {
            return abort(403);
        }
    }

    public function get_detail_customers(?string $customer_id, ?string $from, ?string $to)
    {
        try {
            $form_params = [
                'customer_id'=>$customer_id,
                'data'=> [
                    'from_date' => $from,
                    'to_date' => $to,
                ]
            ];
            $response = $this->client->request('POST', $this->listMethod['CUSTOMERS_ACTIVITIES'], [
                'headers' => $this->headers,
                "proxy" => "http://proxy.hcm.fpt.vn:80",
                'json' => $form_params
            ])->getBody()->getContents();
            return json_decode($response);
        } catch (\Exception $exception) {
            return abort(403);
        }
    }

}
