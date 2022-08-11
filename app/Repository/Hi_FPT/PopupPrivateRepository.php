<?php

namespace App\Repository\Hi_FPT;

use App\Contract\Hi_FPT\PopupPrivateInterface;
use App\Http\Traits\DataTrait;
use App\Imports\FtelPhoneImport;
use App\Rules\NumberPhoneRule;
use App\Services\NewsEventService;
use App\Services\PopupPrivateService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PopupPrivateRepository implements PopupPrivateInterface
{
    use DataTrait;
    private $listMethod;
    private $client;
    private $headers;
    public function __construct()
    {
        $api_config         = config('configDomain.DOMAIN_CUSTOMER.' . env('APP_ENV'));
        $this->listMethod   = config('configMethod.DOMAIN_POPUP_PRIVATE');
        $this->client       = new Client(['base_uri' => $api_config['URL']]);
        $this->headers      = [
            'Authorization' => md5($api_config['CLIENT_KEY'] . "::" . $api_config['SECRET_KEY'] . date("Y-d-m"))
        ];
    }
    public function all($dataTable, $params)
    {
        $newsEventService = new NewsEventService();
        $list_route = $newsEventService->getListTargetRoute()->data ?? null;
        $list_type_popup = config('platform_config.type_popup_service');
        $response = $this->client->request('POST', $this->listMethod['GET'], [
            'headers' => $this->headers
        ]);
        $res = check_status_code_api(json_decode($response->getBody()->getContents()));
        return $dataTable->with([
            'data'  =>$res,
            'type'  => $params->type,
            'start' => $params->start,
            'length'=> $params->length
        ])->render('popup-private.index', compact('list_type_popup', 'list_route'));
    }
    public function paginate(array $params)
    {
        try {
            $form_params = [
                'size' => $params->size,
                'page' => $params->page
            ];

            $response = $this->client->request('POST', $this->listMethod['GET_PAGINATE'], [
                'headers' => $this->headers,
                'form_params' => $form_params
            ]);
            return json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

    public function show(array $params)
    {
        try {
            $form_params = ['id' => $params['id']];
            $response = $this->client->request('POST', $this->listMethod['GET_BY_ID'], [
                'headers' => $this->headers,
                'form_params' => $form_params
            ]);
            $data = json_decode($response->getBody()->getContents())->data;
            return response()->json($data);
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

    public function store(array $params)
    {
        try {
            $timeline_array = explode(" - ", $params['timeline']);
            $form_params = [
                'type'          =>$params['type'],
                'actionType'    =>$params['actionType'],
                'dataAction'    =>$params['dataAction'],
                'iconButtonUrl' =>$params['iconButtonUrl'] ?? null,
                'iconUrl'       =>$params['iconUrl'],
                'dateBegin'     =>$timeline_array[0],
                'dateEnd'       =>$timeline_array[1],
                'phoneList'     =>$params['number_phone'],
                'titleVi'       =>$params['titleVi'] ?? null,
                'titleEn'       =>$params['titleEn'] ?? null,
                'desVi'         =>$params['desVi'] ?? null,
                'desEn'         =>$params['desEn'] ?? null
            ];
            $response = $this->client->request('POST', $this->listMethod['ADD'], [
                'headers' => $this->headers,
                'form_params' => array_filter($form_params)
            ]);
            $data = json_decode($response->getBody()->getContents());
            return response()->json(['data' => $data]);
        } catch (GuzzleException $e) {
            return response()->json(['data'=>['status_code' => '500', 'message' => $e->getMessage()]]);
        }
    }

    public function update(array $params)
    {
        if(isset($params['number_phone'])) {
            $this->import(array($params['id'], $params['number_phone']));
        }
        try {
            $timeline_array = explode(" - ", $params['timeline']);
            $form_params = [
                'id'            =>$params['id'],
                'type'          =>$params['type'],
                'actionType'    =>$params['actionType'],
                'dataAction'    =>$params['dataAction'],
                'iconButtonUrl' =>$params['type']=='popup_image_transparent'||$params['type']=='popup_image_full_screen' ? "avatar.png" : $params['iconButtonUrl'],
                'iconUrl'       =>$params['iconUrl'],
                'dateBegin'     =>$timeline_array[0],
                'dateEnd'       =>$timeline_array[1],
                'titleVi'       =>$params['titleVi'] ?? null,
                'titleEn'       =>$params['titleEn'] ?? null,
                'desVi'         =>$params['desVi'] ?? null,
                'desEn'         =>$params['desEn'] ?? null,
                'popupGroupId'  =>$params['popupGroupId'],
                'temPerId'      =>$params['temPerId']
            ];
            $response = $this->client->request('POST', $this->listMethod['UPDATE'], [
                'headers' => $this->headers,
                'form_params' => array_filter($form_params)
            ]);
            $data = json_decode($response->getBody()->getContents());
            return response()->json(['data' => $data]);
        } catch (GuzzleException $e) {
            return response()->json(['data'=>['status_code' => '500', 'message' => $e->getMessage()]]);
        }
    }

    public function destroy(array $params)
    {
        try {
            $form_params = [
                'id' => $params['id'],
                'active' => $params['check']==1 ? self::STOP : self::ACTIVE
            ];
            $response = $this->client->request('POST', $this->listMethod['DELETE'], [
                'headers' => $this->headers,
                'form_params' => $form_params
            ]);
            $data = json_decode($response->getBody()->getContents());
            return response()->json(['data'=>$data]);
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

    public function import(array $params)
    {
        try {
            $response = $this->client->request('POST', $this->listMethod['IMPORT'], [
                'headers' => $this->headers,
                'form_params' => [
                    'id'          =>$params['0'],
                    'phoneList'   =>$params['1']
                ]
            ]);
            $res = check_status_code_api(json_decode($response->getBody()->getContents()));
            if(empty($res)) {
                return response()->json(['status_code' => '500', 'message' => 'System maintain! Cant import phone']);
            }
            return true;
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

    public function importFile($params)
    {
        define("App\Repository\Hi_FPT\LIMITNUMBER", 30000);
        $params->validate(['excel.*' => 'mimes:xlsx'],['excel.*.mimes' => 'Sai định dạng file, chỉ chấp nhận file có đuôi .xlsx']);
        $data = [];
        foreach ($params->file('excel') as $key => $item){
            $data['data'][] = fastexcel()->import($item)->flatten()->toArray();
            if (count($data['data'][$key]) > LIMITNUMBER)
                return response()->json(['errors' => ['error'=>'Data in files '.($key+1).' too big <= '.LIMITNUMBER.'K']], 401);
        }
        return $data;
    }
}
