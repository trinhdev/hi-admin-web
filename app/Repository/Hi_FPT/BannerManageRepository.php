<?php

namespace App\Repository\Hi_FPT;

use App\Contract\Hi_FPT\BannerManageInterface;
use App\Http\Traits\DataTrait;
use App\Services\NewsEventService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BannerManageRepository implements BannerManageInterface
{
    use DataTrait;
    private $listMethod;
    private $client;
    private $headers;
    public function __construct()
    {
        $api_config         = config('configDomain.DOMAIN_CUSTOMER.' . env('APP_ENV'));
        $this->listMethod   = config('configMethod.DOMAIN_NEWS_EVENT');
        $this->client       = new Client(['base_uri' => $api_config['URL']]);
        $this->headers      = [
            'Authorization' => md5($api_config['CLIENT_KEY'] . "::" . $api_config['SECRET_KEY'] . date("Y-d-m")),
            'clientKey' => $api_config['CLIENT_KEY']
        ];
    }

    /**
     * @throws GuzzleException
     */
    public function all($dataTable, $params)
    {
        $perPage = $params->length ?? 10;
        $currentPage = $params->start == 0 ? 1 : ($params->start / $perPage) + 1;
        $form_params = [
            'banner_type' => $params->bannerType,
            'public_date_start' => $params->public_date_start,
            'public_date_end' => $params->public_date_end,
            'order_by' => $params->columns[$params->order[0]['column']]['data'],
            'per_page' => $perPage,
            'current_page' => $currentPage,
            'order_direction' => $this->orderBy ?? $params->order[0]['dir']
        ];
        $response = $this->client->request('POST', $this->listMethod['GET_LIST_BANNER'], [
            'headers' => $this->headers,
            'form_params' => $form_params
        ]);
        $res = check_status_code_api(json_decode($response->getBody()->getContents()));
        $service = new NewsEventService();
        $listTypeBanner = get_data_api($service->getListTypeBanner());
        if(empty($res)) {
            return redirect()->back()->withErrors('Error! System maintain!');
        }
        return $dataTable->with([
            'data'=>$res
        ])->render('banners.index', ['list_type_banner' => $listTypeBanner]);
    }

    public function show($id)
    {
        try {
            $service = new NewsEventService();
            $response = $this->client->request('POST', $this->listMethod['GET_DETAIL_BANNER'], [
                'headers' => $this->headers,
                'form_params' => ['id' => $id]
            ]);
            $data = [
                'list_target_route' => get_data_api($service->getListTargetRoute()),
                'list_type_banner'  => $this->client->request('POST', $this->listMethod['GET_LIST_TYPE_BANNER'], [
                    'headers' => $this->headers
                ])
            ];
            $res = check_status_code_api(json_decode($response->getBody()->getContents()));
            if(empty($res)) {
                return view('banners.create')->with($data);
            }
            $data['data'] = collect($res);
            return $data;
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

    public function store($params)
    {
        try {
            $form_params = collect($params->validated())->merge([
                'publicDateStart'   => Carbon::parse($params->input('show_from'))->format('Y-m-d H:i:s'),
                'publicDateEnd'     => Carbon::parse($params->input('show_to'))->format('Y-m-d H:i:s'),
                'directionId'       => $params->input('has_target_route')=='checked' ? $params->input('direction_id', '') : '',
                'directionUrl'      => $params->input('has_target_route')=='checked' && $params->input('direction_id')==1 ? $params->input('directionUrl', '') : '',
                'isShowHome'        => $params->has('isShowHome') ? 1 : null,
                'cms_note'          => json_encode([
                    'created_by' => substr($this->user->email, 0, strpos($this->user->email, '@')),
                    'modified_by' => null
                ])
            ])->toArray();
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

    public function update($params, $id)
    {
        try {
            $form_params = collect($params->validated())->merge([
                'bannerId'          => $id,
                'isShowHome'       => $params->has('isShowHome') ? 1 : null,
                'imageFileName'     => $params->input('imageFileName'),
                'thumbImageFileName'=> $params->input('thumbImageFileName'),
                'publicDateStart'   => Carbon::parse($params->input('show_from'))->format('Y-m-d H:i:s'),
                'publicDateEnd'     => Carbon::parse($params->input('show_to'))->format('Y-m-d H:i:s'),
                'titleVi'           => $params->input('title_vi', ''),
                'titleEn'           => $params->input('title_en', ''),
                'directionId'       => $params->input('has_target_route')=='checked' ? $params->input('direction_id', '') : '',
                'directionUrl'      => $params->input('has_target_route')=='checked' && $params->input('direction_id')==1 ? $params->input('directionUrl', '') : '',
            ])->toArray();
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

    public function updateOrder($params)
    {
        try {
            $form_params =[
                'orderings'     => [
                    [
                        'eventId'  => $params->eventId,
                        'ordering'  => $params->ordering
                    ]
                ]
            ];
            $response = $this->client->request('POST', $this->listMethod['UPDATE_ORDERING'], [
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
}
