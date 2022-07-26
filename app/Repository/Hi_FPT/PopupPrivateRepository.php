<?php

namespace App\Repository\Hi_FPT;

use App\Contract\Hi_FPT\PopupPrivateInterface;
use App\Http\Traits\DataTrait;
use App\Services\NewsEventService;
use App\Services\PopupPrivateService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            $res = check_status_code_api(json_decode($response->getBody()->getContents()));
            if(empty($res)) {
                return redirect()->back()->withErrors('Error! System maintain!');
            }
            return response()->json(get_data_api($res), 200);
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
            $res = check_status_code_api(json_decode($response->getBody()->getContents()));
            if(empty($res)) {
                return response()->json(['status_code' => '500', 'message' => 'System maintain!']);
            }
            return response()->json(['status_code' => '0', 'data' => $res]);
        } catch (GuzzleException $e) {
            return response()->json(['status_code' => '500', 'message' => $e->getMessage()]);
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
                'iconButtonUrl' =>$params['iconButtonUrl'] ?? null,
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
            $res = check_status_code_api(json_decode($response->getBody()->getContents()));
            if(empty($res)) {
                return response()->json(['status_code' => '500', 'message' => 'System maintain!']);
            }
            return response()->json(['status_code' => '0', 'data' => $res]);
        } catch (GuzzleException $e) {
            return response()->json(['status_code' => '500', 'message' => $e->getMessage()]);
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
            $res = check_status_code_api(json_decode($response->getBody()->getContents()));
            if(empty($res)) {
                return redirect()->back()->withErrors('Error! System maintain!');
            }
            return response()->json(get_data_api($res), 200);
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

    public function check()
    {
        try {
            $popup_private = new PopupPrivateService();
            $data = $popup_private->get();
            foreach($data->data as $key => $value) {
                if($value->dateEnd < \Carbon\Carbon::now()) {
                    $popup_private->delete([$value->id,$STOP]);
                }
            }
            return response()->json(['message' => 'Check status done'], 200);
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
}
