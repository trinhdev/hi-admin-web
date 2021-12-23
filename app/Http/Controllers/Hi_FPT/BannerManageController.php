<?php

namespace App\Http\Controllers\Hi_FPT;

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
    public function index(){
        $newsEventService = new NewsEventService();
        $listTypeBanner = $newsEventService->getListTypeBanner();
        $listTypeBanner = ($listTypeBanner->statusCode == 0) ? $listTypeBanner->data : [];
        return view('banners.index')->with(['list_type_banner' => $listTypeBanner]);
    }

    public function edit(Request $request,$bannerId,$bannerType){
        $newsEventService = new NewsEventService();
        $listTargetRoute = $newsEventService->getListTargetRoute();
        $listTargetRoute = ($listTargetRoute->statusCode == 0) ? $listTargetRoute->data : [];

        $listTypeBanner = $newsEventService->getListTypeBanner();
        $listTypeBanner = ($listTypeBanner->statusCode == 0) ? $listTypeBanner->data : [];

        $getDetailBanner_response = $newsEventService->getDetailBanner($bannerId,$bannerType);
        if($getDetailBanner_response->statusCode != 0){
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
            "ordering" => null,
            "view_count" => 0,
            "date_created" => null,
            "created_by" => null,
            "is_highlight" => false
        ];
        // dd($dataResponse);
        if(isset($dataResponse->banner_id)){
            $bannerObj->bannerId = $dataResponse->banner_id;
            $bannerObj->title_vi = $dataResponse->banner_title;
            $bannerObj->bannerType = $dataResponse->custom_data;
            $bannerObj->image = $dataResponse->image_url;
            $bannerObj->ordering = $dataResponse->ordering;
            $bannerObj->view_count = $dataResponse->view_count;
            $bannerObj->direction_id = $dataResponse->action_type;
            $bannerObj->direction_url = $dataResponse->direction_url;
            
        }else{
            $bannerObj->bannerId = $dataResponse->event_id;
            $bannerObj->title_vi = $dataResponse->title_vi;
            $bannerObj->bannerType = ($dataResponse->event_type == "highlight" ) ? 'bannerHome' : $dataResponse->event_type;
            $bannerObj->image = !empty($dataResponse->image) ? env('URL_STATIC').'/upload/images/event/'.$dataResponse->image : null;
            $bannerObj->ordering = $dataResponse->ordering;
            $bannerObj->view_count = $dataResponse->view_count;
            $bannerObj->direction_id = $dataResponse->target == 'open_url_in_browser' ? 'url_open_out_app' :  $dataResponse->target;
            $bannerObj->direction_url = $dataResponse->event_url;

            $bannerObj->title_en = $dataResponse->title_en;
            $bannerObj->thumb_image = !empty($dataResponse->thumb_image) ? env('URL_STATIC').'/upload/images/event/'.$dataResponse->thumb_image : null;
            $bannerObj->created_by = $dataResponse->created_by;
            $bannerObj->public_date_start = !empty($dataResponse->public_date_start) ? Carbon::parse($dataResponse->public_date_start)->format('Y-m-d\TH:i') : null;
            $bannerObj->public_date_end = !empty($dataResponse->public_date_end) ? Carbon::parse($dataResponse->public_date_end)->format('Y-m-d\TH:i') : null;
            $bannerObj->is_highlight = (boolean) $bannerObj->is_highlight;
        }
        // dd($bannerObj);
        return view('banners.edit')->with(['list_target_route'=>$listTargetRoute, 'list_type_banner' => $listTypeBanner, 'banner'=>$bannerObj]);
    }

    public function update(Request $request, $id)
    {
        $this->addToLog($request);
        return redirect()->route('bannermanage.index')->withSuccess('Success!');
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
        $request->validate([
            'bannerType' =>'required',
            'path_1'    =>'required',
            'title_vi'  =>'required',
            'title_en'  =>'required',
            'object'    =>'required',
            'object_type'=>'required',
        ]);
    }

    public function uploadImage(Request $request){
        $request->validate([
            'imageFileName' => 'required',
            'encodedImage' =>'required'
        ]);
        $newsEventService = new NewsEventService();
        $uploadImage_response = $newsEventService->uploadImage($request->imageFileName,$request->encodedImage);
        return $uploadImage_response;
    }

    public function initDatatable(Request $request){
            $newsEventService = new NewsEventService();
            
            $param = [
                'bannerType' => empty($request->bannerType) ? null : $request->bannerType,
                'publicDateStart' => empty($request->public_date_from) ? null : $request->public_date_from,
                'publicDateEnd' => empty($request->public_date_to) ? null : $request->public_date_to
            ];

            $responseCallAPIGetListBanner = $newsEventService->getListbanner($param);
            if(empty($responseCallAPIGetListBanner)){
                $responseCallAPIGetListBanner = (object)[];
            };
            if($this->user->role_id == ADMIN){
                $responseCallAPIGetListBanner->isAdmin = true;
            }
            $responseCallAPIGetListBanner->aclCurrentModule  = $this->aclCurrentModule;
            return $responseCallAPIGetListBanner;
    }
}
