<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\BannerDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Services\NewsEventService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

class BannerManageController extends MY_Controller
{
    //
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Banner Manage';
        $this->model = $this->getModel('Banner');
    }
    public function index(BannerDataTable $dataTable, Request $request){
        $service = new NewsEventService();
        $listTypeBanner = get_data_api($service->getListTypeBanner());
        $input = $request->only(['bannerType', 'public_date_start','public_date_end','start','length','order','columns']);
        return $dataTable->with([
            'request'=>$input
            ])->render('banners.index', ['list_type_banner' => $listTypeBanner]);
    }
    public function view(Request $request, $bannerId){
        $newsEventService = new NewsEventService();
        $result = [];
        $listTargetRoute = $newsEventService->getListTargetRoute();
        $listTargetRoute = (isset($listTargetRoute->statusCode) && $listTargetRoute->statusCode == 0) ? $listTargetRoute->data : [];

        $listTypeBanner = $newsEventService->getListTypeBanner();
        $listTypeBanner = (isset($listTypeBanner->statusCode) && $listTypeBanner->statusCode == 0) ? $listTypeBanner->data : [];

        $getDetailBanner_response = $newsEventService->getDetailBanner($bannerId);
        if(!isset($getDetailBanner_response->statusCode) || $getDetailBanner_response->statusCode != 0){
            $result['error'] = $getDetailBanner_response->message;
            return $result;
            // return redirect()->route('bannermanage.index')->withErrors($getDetailBanner_response->message);
        }
        $dataResponse = $getDetailBanner_response->data;
        $bannerObj = (object)[
            "bannerId" =>null,
            "bannerType" => null,
            "public_date_start" => null,
            "public_date_end" => null,
            "title_vi" => null,
            "title_en" => null,
            "direction_id" => null,
            "direction_url" => null,
            "image" => null,
            "thumb_image" => null,
            "view_count" => 0,
            "date_created" => null,
            "created_by" => null,
            "is_show_home" => false,
        ];

        $bannerObj->bannerId = $dataResponse->event_id;
        $bannerObj->title_vi = $dataResponse->title_vi;
        $bannerObj->bannerType = ($dataResponse->event_type == "highlight" ) ? 'bannerHome' : $dataResponse->event_type;
        $bannerObj->image = !empty($dataResponse->image) ? $dataResponse->image : null;
        $bannerObj->view_count = $dataResponse->view_count;
        // $bannerObj->direction_id = $dataResponse->target == 'open_url_in_browser' ? 'url_open_out_app' :  $dataResponse->target;
        $bannerObj->direction_id = $dataResponse->direction_id;
        $bannerObj->direction_url = $dataResponse->event_url;
        $bannerObj->date_created = $dataResponse->date_created;

        $bannerObj->title_en = $dataResponse->title_en;
        $bannerObj->thumb_image = !empty($dataResponse->thumb_image) ? $dataResponse->thumb_image : null;
        $bannerObj->created_by = $dataResponse->created_by;
        $bannerObj->public_date_start = !empty($dataResponse->public_date_start) ? Carbon::parse($dataResponse->public_date_start)->format('Y-m-d\TH:i') : null;
        $bannerObj->public_date_end = !empty($dataResponse->public_date_end) ? Carbon::parse($dataResponse->public_date_end)->format('Y-m-d\TH:i') : null;
        $bannerObj->is_show_home = (boolean) $dataResponse->is_show_home;

        $result = [
            'list_target_route'=>$listTargetRoute,
            'list_type_banner' => $listTypeBanner,
            'banner'=>$bannerObj
        ];
        return $result;
    }

    public function edit(Request $request, $bannerId=null){
        $newsEventService   = new NewsEventService();
        $listTargetRoute    = get_data_api($newsEventService->getListTargetRoute());
        $listTypeBanner     = get_data_api($newsEventService->getListTypeBanner());
        $dataResponse       = get_data_api($newsEventService->getDetailBanner($bannerId));
        if(empty($dataResponse)){
            return view('banners.create')->with(['list_target_route'=>$listTargetRoute, 'list_type_banner' => $listTypeBanner]);
        }
//        dd($listTargetRoute);
        $dataResponse = collect($dataResponse)->only([
            "event_id","event_type","public_date_start","public_date_end","title_vi",
            "title_en","direction_id","event_url","image","thumb_image","view_count",
            "date_created","created_by","cms_note","is_show_home"]);
        return view('banners.edit')->with(['list_target_route'=>$listTargetRoute, 'list_type_banner' => $listTypeBanner, 'banner'=>$dataResponse]);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $validated = $request->validate([
            'bannerType' =>'required',
            'objects'    =>'required',
            'objectType'=>'required',
            'show_from' =>'required|date_format:Y-m-d\TH:i',
            'show_to'   =>'required|date_format:Y-m-d\TH:i',
            'directionUrl' => 'required_if:direction_id,1',
            'imageFileName' => 'required',
            'thumbImageFileName' => 'required'
        ]);

        $this->addToLog($request);
        $params = collect($validated)->merge([
            'bannerId'          => $id,
            'publicDateStart'   => Carbon::parse($request->input('show_from'))->format('Y-m-d H:i:s'),
            'publicDateEnd'     => Carbon::parse($request->input('show_to'))->format('Y-m-d H:i:s'),
            'titleVi'           => $request->input('title_vi', ''),
            'titleEn'           => $request->input('title_en', ''),
            'imageFileName'     => $request->input('imageFileName') ?? 'avatar.png',
            'thumbImageFileName'=> $request->input('thumbImageFileName') ?? 'avatar.png',
            'directionId'       => $request->input('direction_id', ''),
        ]);
        $newsEventService = new NewsEventService();
        $response = $newsEventService->updateBanner($params);
        if($response->statusCode == 0){
            return redirect('bannermanage')->withSuccess('');
        }
        return  redirect('bannermanage')->withErrors($response->message ?? 'Staging system error!');
    }

    public function create(Request $request){
        $newsEventService = new NewsEventService();
        $listTargetRoute = $newsEventService->getListTargetRoute();
        $listTargetRoute = ($listTargetRoute->statusCode == 0) ? $listTargetRoute->data : [];

        $listTypeBanner = $newsEventService->getListTypeBanner();
        $listTypeBanner = ($listTypeBanner->statusCode == 0) ? $listTypeBanner->data : [];
        return view('banners.edit')->with(['list_target_route'=>$listTargetRoute, 'list_type_banner' => $listTypeBanner]);
    }

    public function store(Request $request){
       // dd($request->all());
        $validated = $request->validate([
            'titleVi'  =>'required',
            'titleEn'  =>'required',
            'bannerType' =>'required',
            'objects'    =>'required',
            'objectType'=>'required',
            'show_from'   =>'required|date_format:Y-m-d\TH:i',
            'show_to'   =>'required|date_format:Y-m-d\TH:i',
            'imageFileName' =>'required',
        ]);

        $this->addToLog($request);
        $params = collect($validated)->merge([
            'publicDateStart'   => Carbon::parse($request->input('show_from'))->format('Y-m-d H:i:s'),
            'publicDateEnd'     => Carbon::parse($request->input('show_to'))->format('Y-m-d H:i:s'),
            'directionId'       => $request->input('direction_id', null),
            'directionUrl'      => $request->input('directionUrl', null),
            'isShowHome'        => $request->input('isShowHome') ? 1 : null,
            'cms_note'          => json_encode([
                'created_by' => substr($this->user->email, 0, strpos($this->user->email, '@')),
                'modified_by' => null
            ])
        ]);
        $newsEventService = new NewsEventService();
        $response = $newsEventService->addNewBanner($params);
        if($response->statusCode == 0){
            return redirect('bannermanage')->withSuccess('');
        }
        return back()->withErrors($response->message ?? 'Staging system error!');

    }

    public function updateOrder(Request $request){
        if(!$request->ajax()){
            return false;
        }
        $request->validate([
            'ordering' => 'required',
            // 'bannerType'    => 'required',
            'eventId'  => 'required'
        ]);

        $this->addToLog($request);
        $newsEventService = new NewsEventService();
        $updateOrder_response = $newsEventService->updateOrderBannder($request->eventId, $request->ordering);
        return $updateOrder_response;
    }
}
