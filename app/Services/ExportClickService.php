<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait ExportClickService
{
    public function export_click($method, $params, $id)
    {
        try {
            $form_params = [
                $method == 'provider/tool/banner/get-list-click-banner' ? 'eventId' : 'templateId' => $id,
                'dateStart' => changeFormatDateLocal($params->show_from) ?? '',
                'dateEnd' => changeFormatDateLocal($params->show_to) ?? '',
            ];
            $api_config = config('configDomain.DOMAIN_NEWS_EVENT.' . env('APP_ENV'));
            $client = new Client(['base_uri' => $api_config['URL']]);
            $headers = [
                'Authorization' => md5($api_config['CLIENT_KEY'] . "::" . $api_config['SECRET_KEY'] . date("Y-d-m")),
                'clientKey' => $api_config['CLIENT_KEY'],
                'Content-Type' => 'application/json'
            ];
            $response = $client->request('POST', $method, [
                'headers' => $headers,
                'json' => $form_params
            ])->getBody()->getContents();
            $data = json_decode(json_decode($response)->data);
            $phone = [];
            foreach ($data as $value) {
                $phone[] = ['SDT Khách hàng' => $value];
            }
            return fastexcel($phone)->download('banner_export_'.date('Y-m-d').'.xlsx');

        } catch (GuzzleException $e) {
            return response()->json(['status_code' => '500', 'message' => $e->getMessage()]);
        }
    }
}
