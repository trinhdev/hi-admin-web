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
        $newsEventService = new NewsEventService();
        $listTypeBanner = $newsEventService->getListTypeBanner();
        $listTypeBanner = (isset($listTypeBanner->statusCode) && $listTypeBanner->statusCode == 0) ? $listTypeBanner->data : [];
        // return view('banners.index')->with(['list_type_banner' => $listTypeBanner]);
        return $dataTable->with([
            'bannerType'=>$request->bannerType,
            'public_date_start' => $request->public_date_start,
            'public_date_end' => $request->public_date_end,
            'start'=>$request->start,
            'length' => $request->length,
            'order' => $request->order,
            'columns' => $request->columns,
            'list_type_banner' => $listTypeBanner
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
            "date_created"    =>null,
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

    public function edit(Request $request, $bannerId){
        $newsEventService = new NewsEventService();
        $listTargetRoute = $newsEventService->getListTargetRoute();
        $listTargetRoute = (isset($listTargetRoute->statusCode) && $listTargetRoute->statusCode == 0) ? $listTargetRoute->data : [];

        $listTypeBanner = $newsEventService->getListTypeBanner();
        $listTypeBanner = (isset($listTypeBanner->statusCode) && $listTypeBanner->statusCode == 0) ? $listTypeBanner->data : [];

        $getDetailBanner_response = $newsEventService->getDetailBanner($bannerId);
        if(!isset($getDetailBanner_response->statusCode) || $getDetailBanner_response->statusCode != 0){
            return redirect()->route('bannermanage.index')->withErrors($getDetailBanner_response->message);
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
            "date_created"    =>null,
            "created_by" => null,
            "cms_note" => null,
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
        $bannerObj->cms_note = $dataResponse->cms_note;

        $bannerObj->title_en = $dataResponse->title_en;
        $bannerObj->thumb_image = !empty($dataResponse->thumb_image) ? $dataResponse->thumb_image : null;
        $bannerObj->created_by = $dataResponse->created_by;
        $bannerObj->public_date_start = !empty($dataResponse->public_date_start) ? Carbon::parse($dataResponse->public_date_start)->format('Y-m-d\TH:i') : null;
        $bannerObj->public_date_end = !empty($dataResponse->public_date_end) ? Carbon::parse($dataResponse->public_date_end)->format('Y-m-d\TH:i') : null;
        $bannerObj->is_show_home = (boolean) $dataResponse->is_show_home;
        
        return view('banners.edit')->with(['list_target_route'=>$listTargetRoute, 'list_type_banner' => $listTypeBanner, 'banner'=>$bannerObj]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'bannerType' =>'required',
            'objects'    =>'required',
            'objectType'=>'required',
            'show_from' =>'required|date_format:Y-m-d\TH:i',
            'show_to'   =>'required|date_format:Y-m-d\TH:i',
            'directionUrl' => 'required_if:directionId,1',
            'thumbImageFileName' => 'required_if:bannerType,promotion',
        ]);
        // dd($request->all());

        $this->addToLog($request);

        $params = collect($validated)->merge([
            'bannerId'          => $id,
            'show_from'         => Carbon::parse($request->show_from)->format('Y-m-d H:i:s'),
            'show_to'           => Carbon::parse($request->show_to)->format('Y-m-d H:i:s'),
            'titleVi'           => $request->title_vi ?? '',
            'titleEn'           => $request->titleEn ?? '',
            'imageFileName'     => $request->img_path_1_name ?? '',
            'directionId'       => $request->directionId ?? '',
            'directionId'       => $request->directionId ?? '',
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
        
        $rules = [
            'bannerType' =>'required',
            'title_vi'  =>'required',
            'title_en'  =>'required',
            'path_1'    =>'required',
            'img_path_1_name' =>'required',
            'object'    =>'required',
            'object_type'=>'required',
            'show_from' =>'required|date_format:Y-m-d\TH:i',
            'show_to'   =>'required|date_format:Y-m-d\TH:i',
            'direction_url' => 'required_if:direction_id,1',
            'img_path_2_name'   => 'required_if:bannerType,promotion',
        ];
        $message = [
            'direction_url.required_if' => 'Không được bỏ trống URL',
        ];
        $this->validate($request, $rules, $message);

        $request->merge([
            'show_from' => Carbon::parse($request->show_from)->format('Y-m-d H:i:s'),
            'show_to'   => Carbon::parse($request->show_to)->format('Y-m-d H:i:s')
        ]);
        $this->addToLog($request);

        $newsEventService = new NewsEventService();
        $createParams = [
            'bannerType'        => $request->bannerType,
            'titleVi'           =>$request->title_vi,
            'titleEn'           => $request->title_en,
            'publicDateStart'   =>$request->show_from,
            'publicDateEnd'     => $request->show_to,
            'objects'            => $request->object,
            'objectType'        => $request->object_type,
            'imageFileName'     => $request->img_path_1_name,
        ];
        if(!empty($request->has_target_route)){
            if(!empty($request->direction_id)){
                $createParams['directionId'] = $request->direction_id;
            }else{
                $createParams['directionId'] = NULL;
            }
            if(!empty($request->direction_url)){
                $createParams['directionUrl'] = $request->direction_url;
            }else{
                $createParams['directionUrl'] = NULL;
            }
        }
        if(!empty($request->bannerType) && $request->bannerType =='promotion'){
           $createParams['thumbImageFileName'] = $request->img_path_2_name;
        };
        if(!empty($request->isShowHome)){
            $createParams['isShowHome'] = 1;
        }
        $user_email = $this->user->email;
        $createParams['cms_note'] = json_encode([
            'created_by' => substr($user_email, 0, strpos($user_email, '@')),
            'modified_by' => null
        ]);
        // dd($createParams);
        $create_banner_response = $newsEventService->addNewBanner($createParams);
        if(!empty($create_banner_response->data)){
            return redirect()->route('bannermanage.index')->withSuccess('Success!');
        }
        return  redirect()->route('bannermanage.index')->withErrors(isset($create_banner_response->description) ? $create_banner_response->description : $create_banner_response->message);
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
