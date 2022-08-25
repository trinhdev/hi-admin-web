<?php

namespace App\Repository\Hi_FPT;

use App\Contract\Hi_FPT\FtelPhoneInterface;
use App\Http\Traits\DataTrait;
use App\Models\Employees;
use App\Models\FtelPhone;
use App\Services\HrService;
use App\Services\NewsEventService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FtelPhoneRepository implements FtelPhoneInterface
{
    use DataTrait;
    /*private $listMethod;
    private $client;
    private $headers;
    private $listTypeBanner;
    private $listTargetRoute;*/

    /**
     * @throws GuzzleException
     */
    /*public function __construct()
    {
        $api_config         = config('configDomain.DOMAIN_NEWS_EVENT.' . env('APP_ENV'));
        $this->listMethod   = config('configMethod.DOMAIN_NEWS_EVENT');
        $this->client       = new Client(['base_uri' => $api_config['URL']]);
        $this->headers      = [
            'Authorization' => md5($api_config['CLIENT_KEY'] . "::" . $api_config['SECRET_KEY'] . date("Y-d-m")),
            'clientKey' => $api_config['CLIENT_KEY']
        ];
        $this->listTypeBanner  = json_decode($this->client->request('GET',$this->listMethod['GET_LIST_TYPE_BANNER'], [
            'headers' => $this->headers
        ])->getBody()->getContents())->data;
        $this->listTargetRoute = json_decode($this->client->request('GET',$this->listMethod['GET_LIST_TARGET_ROUTE'], [
            'headers' => $this->headers
        ])->getBody()->getContents())->data;
    }*/

    /**
     * @throws GuzzleException
     */
    public function all($dataTable, $params)
    {
        return $dataTable->render('ftel-phone.index');
    }

    public function show($id)
    {
        try {
            $response = json_decode($this->client->request('GET', $this->listMethod['GET_DETAIL_BANNER'], [
                'headers' => $this->headers,
                'query' => ['bannerId' => $id]
            ])->getBody()->getContents())->data;
            $data = [
                'list_target_route' => $this->listTargetRoute,
                'list_type_banner'  => $this->listTypeBanner
            ];
            if(empty($response)) {
                return response()->json(['status_code' => '500', 'message' => 'System maintain!']);
            }

            $data['banner'] = collect($response)->only([
                "event_id","event_type","public_date_start","public_date_end","title_vi",
                "title_en","direction_id","event_url","image","thumb_image","view_count",
                "date_created","created_by","cms_note","is_show_home"]);
            return $data;
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

    public function store($params): \Illuminate\Http\RedirectResponse
    {
        if(empty($params->input('action'))) {
            return redirect()->back()->with('message', 'Error!');
        }
        try {
            $arrPhone = array_map('trim', explode(',', $params->number_phone)); // input
            switch ($params->input('action')) {
//                case 'check':
//                    $data = $this->checkEmployees($arrPhone);
//                    break;
                case 'data':
                    $data = $this->getFromApi($arrPhone);
                    break;
                case 'db':
                    $data = $this->getFromDataBase($arrPhone);
                    break;
            }
            return redirect()->back()->with(['data' => json_decode(json_encode($data), true)]);
        } catch (\Exception $e) {
            return back()->with(['error'=>'Lỗi hệ thống', 'html'=>$e->getMessage()]);
        }
    }

    public function update($params, $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $model = Employees::find($id)->update($params->except(['_token']));
            return back()->with(['success'=>'Update thành công', 'html'=>'Update thành công']);
        } catch (\Exception $e) {
            return back()->with(['error'=>'Lỗi hệ thống', 'html'=>$e->getMessage()]);
        }
    }

    /**
     * @param array $arrPhone
     * @return array
     */
    public function checkEmployees(array $arrPhone): array
    {
        $data =$phone= [];
        $hrService = new HrService();
        $token = $hrService->loginHr()->authorization;
        foreach(array_chunk($arrPhone, 50) as $value) {
            $dataExport = $hrService->getListInfoEmployee($value, $token);
            $phone = Arr::flatten(collect($dataExport)->pluck('phoneNumber'));
        } // check data
        foreach($arrPhone as $value) {
            foreach ($phone as $item) {
                if ($item == $value) {
                    $data[] = [$value, true];
                } else {
                    $data[] = [$value, false];
                }
                break;
            }
        } // check data

        dd($data);
        return $data;
    }

    public function getFromApi(array $arrPhone): array
    {
        $data = [];
        $hrService = new HrService();
        $token = $hrService->loginHr()->authorization;
        $dataAPI = array_chunk(array_unique($arrPhone), 50); // [data input api] + [data > 7day] => call api
        foreach($dataAPI as $value) {
            $dataExport = collect($hrService->getListInfoEmployee($value, $token));
            foreach($dataExport as $data_value) {
                $data[] = $data_value;
            }
        }
        return $data;
    }

    public function getFromDataBase(array $arrPhone) {
        $employee = Employees::whereIn('phone', $arrPhone)->get()->unique()->toArray();
        return array_map(fn($tag) =>
                [
                    'id' => $tag['id'],
                    'code' => $tag['employee_code'],
                    'name' => $tag['name'],
                    'fullName' => $tag['full_name'],
                    'phoneNumber' => $tag['phone'],
                    'emailAddress' => $tag['emailAddress'],
                    'location_id' => $tag['location_id'],
                    'branch_code' => $tag['branch_code'],
                    'branch_name' => $tag['branch_name'],
                    'area_code' => $tag['code'],
                    'organizationCode' => $tag['organizationCode'],
                    'organizationCodePath' => $tag['organizationCodePath'],
                    'location' => $tag['location'],
                    'isActive' => $tag['isActive'],
                    'checkUpdate' => $tag['checkUpdate'],
                    'created_at' => $tag['created_at'],
                    'organizationNamePath' => $tag['organizationNamePath'],
                    'dept_id' => $tag['dept_id'],
                    'dept_name_1' => $tag['dept_name_1'],
                    'dept_name_2' => $tag['dept_name_2'],
                    'updated_at' => $tag['updated_at'],
                    'updated_from' => $tag['updated_from']
                ], $employee
        );
    }
}
