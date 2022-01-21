<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Services\NewsEventService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

class PopupManageController extends MY_Controller
{
    //
    use DataTrait;

    public function __construct()
    {
        parent::__construct();
        $this->title = 'Popup Manage';
    }

    public function index()
    {
        $newsEventService = new NewsEventService();
        $listTemplatePopup = $newsEventService->getListTemplatePopup();
        $listTemplatePopup->type = config('platform_config.type_popup_service');
        $listTemplatePopup = (isset($listTemplatePopup->statusCode) && $listTemplatePopup->statusCode == 0) ? $listTemplatePopup : [];
        return view('popup.index')->with(['list_template_popup' => $listTemplatePopup]);
    }

    public function edit(Request $request, $bannerId, $bannerType)
    {
        $newsEventService = new NewsEventService();
        $listTargetRoute = $newsEventService->getListTargetRoute();
        $listTargetRoute = (isset($listTargetRoute->statusCode) && $listTargetRoute->statusCode == 0) ? $listTargetRoute->data : [];

        $listTypeBanner = $newsEventService->getListTypeBanner();
        $listTypeBanner = (isset($listTypeBanner->statusCode) && $listTypeBanner->statusCode == 0) ? $listTypeBanner->data : [];

        $getDetailBanner_response = $newsEventService->getDetailBanner($bannerId, $bannerType);
        if (!isset($getDetailBanner_response->statusCode) || $getDetailBanner_response->statusCode != 0) {
            return redirect()->route('bannermanage.index')->withErrors($getDetailBanner_response->message);
        }
        $dataResponse = $getDetailBanner_response->data;
        $bannerObj = (object)[
            "bannerId" => null,
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
            "date_modified" => null,
            "created_by" => null,
            "is_highlight" => false,
        ];
        if (isset($dataResponse->banner_id)) {
            $bannerObj->bannerId = $dataResponse->banner_id;
            $bannerObj->title_vi = $dataResponse->banner_title;
            $bannerObj->bannerType = $dataResponse->custom_data;
            $bannerObj->image = $dataResponse->image_url;
            $bannerObj->view_count = $dataResponse->view_count;
            $bannerObj->direction_id = $dataResponse->direction_id;
            $bannerObj->direction_url = $dataResponse->direction_url;
            $bannerObj->date_created = $dataResponse->date_created;

        } else {
            $bannerObj->bannerId = $dataResponse->event_id;
            $bannerObj->title_vi = $dataResponse->title_vi;
            $bannerObj->bannerType = ($dataResponse->event_type == "highlight") ? 'bannerHome' : $dataResponse->event_type;
            $bannerObj->image = !empty($dataResponse->image) ? env('URL_STATIC') . '/upload/images/event/' . $dataResponse->image : null;
            $bannerObj->view_count = $dataResponse->view_count;
            // $bannerObj->direction_id = $dataResponse->target == 'open_url_in_browser' ? 'url_open_out_app' :  $dataResponse->target;
            $bannerObj->direction_id = $dataResponse->direction_id;
            $bannerObj->direction_url = $dataResponse->event_url;
            $bannerObj->date_created = $dataResponse->date_created;

            $bannerObj->title_en = $dataResponse->title_en;
            $bannerObj->thumb_image = !empty($dataResponse->thumb_image) ? env('URL_STATIC') . '/upload/images/event/' . $dataResponse->thumb_image : null;
            $bannerObj->created_by = $dataResponse->created_by;
            $bannerObj->public_date_start = !empty($dataResponse->public_date_start) ? Carbon::parse($dataResponse->public_date_start)->format('Y-m-d\TH:i') : null;
            $bannerObj->public_date_end = !empty($dataResponse->public_date_end) ? Carbon::parse($dataResponse->public_date_end)->format('Y-m-d\TH:i') : null;
            $bannerObj->is_highlight = (boolean)$dataResponse->is_highlight;
        }
        return view('banners.edit')->with(['list_target_route' => $listTargetRoute, 'list_type_banner' => $listTypeBanner, 'banner' => $bannerObj]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'bannerType' => 'required',
            // 'title_vi'  =>'required',
            // 'title_en'  =>'required',
            // 'img_path_1_name' =>'required',
            'object' => 'required',
            'object_type' => 'required',
            'show_from' => 'date_format:Y-m-d\TH:i|nullable',
            'show_to' => 'date_format:Y-m-d\TH:i|nullable',
            'direction_url' => 'required_if:directionId,url_open_in_app,url_open_out_app',
            // 'img_path_2_name'   => 'required_if:bannerType,promotion',
        ];

        $request->validate($rules);

        $request->merge([
            'show_from' => Carbon::parse($request->show_from)->format('Y-m-d H:i:s'),
            'show_to' => Carbon::parse($request->show_to)->format('Y-m-d H:i:s')
        ]);
        $this->addToLog($request);
        $newsEventService = new NewsEventService();
        $updateParams = [
            'bannerId' => $id,
            'bannerType' => $request->bannerType,
            'objects' => $request->object,
            'objectType' => $request->object_type,
        ];
        if (!empty($request->title_vi)) {
            $updateParams['titleVi'] = $request->title_vi;
        };
        if (!empty($request->show_from)) {
            $updateParams['publicDateStart'] = $request->show_from;
        };
        if (!empty($request->show_to)) {
            $updateParams['publicDateEnd'] = $request->show_to;
        }
        if (!empty($request->title_en)) {
            $updateParams['titleEn'] = $request->title_en;
        }
        if (!empty($request->img_path_1_name)) {
            $updateParams['imageFileName'] = $request->img_path_1_name;
        };
        if (!empty($request->has_target_route)) {
            if (!empty($request->direction_id)) {
                $updateParams['directionId'] = $request->direction_id;
            };
            if (!empty($request->direction_url)) {
                $updateParams['directionUrl'] = $request->direction_url;
            };
        }
        if (!empty($request->bannerType) && $request->bannerType == 'promotion' && !empty($request->img_path_2_name)) {
            $updateParams['thumbImageFileName'] = $request->img_path_2_name;
        };
        if (!empty($request->isHighlight)) {
            $updateParams['isHighlight'] = true;
        } else {
            $updateParams['isHighlight'] = false;
        };
        // my_debug($updateParams, false);
        $update_banner_response = $newsEventService->updateBanner($updateParams);
        // dd($update_banner_response);
        if (isset($update_banner_response->statusCode) && $update_banner_response->statusCode == 0) {
            return redirect()->route('bannermanage.index')->withSuccess('Success!');
        }
        // dd($update_banner_response);
        return redirect()->route('bannermanage.index')->withErrors(isset($update_banner_response->description) ? $update_banner_response->description : $update_banner_response->message);
    }

    public function create(Request $request)
    {
        $data = array();
        $newsEventService = new NewsEventService();
        $listTargetRoute = $newsEventService->getListTargetRoute();
        if (isset($listTargetRoute->statusCode)) {
            $data['listTargetRoute'] = ($listTargetRoute->statusCode == 0) ? $listTargetRoute->data : [];
        } else
            $data['listTargetRoute'] = [];
//        my_debug($data);
        $data['listTypePopup'] = config('platform_config.type_popup_service');
        return view('popup.edit')->with($data);
    }

    public function store(Request $request)
    {
        $ruleButtonImage = [
            'path_button' => 'required',
            'img_path_button_name' => 'required',
        ];
        my_debug($request->all());
        $rules = [
            'templateType' => 'required',
            'title_vi' => 'required',
            'title_en' => 'required',
            'path_1' => 'required',
            'img_path_1_name' => 'required',
            // 'show_from'             =>  'required|date_format:Y-m-d\TH:i',
            // 'show_to'               =>  'required|date_format:Y-m-d\TH:i',
            // 'direction_url'         =>  'required_if:directionId,url_open_in_app,url_open_out_app',
            // 'img_path_2_name'       =>  'required_if:bannerType,promotion',

            // "titleVi"
            // "titleEn"
            // "descriptionVi"
            // "descriptionEn"
            // "image"
            // "templateType"
            // "buttonImage"
            // "directionId"
            // "directionUrl"
        ];
        if ($request->templateType == "popup_custom_image_transparent") {
            $rules = array_merge($ruleButtonImage, $rules);
        }

        $request->validate($rules);

        $request->merge([
            'show_from' => Carbon::parse($request->show_from)->format('Y-m-d H:i:s'),
            'show_to' => Carbon::parse($request->show_to)->format('Y-m-d H:i:s')
        ]);

        return $request;
        // khúc dưới này chưa xử lý    
        $this->addToLog($request);
        $newsEventService = new NewsEventService();
        $createParams = [
            'bannerType' => $request->bannerType,
            'titleVi' => $request->title_vi,
            'titleEn' => $request->title_en,
            'publicDateStart' => $request->show_from,
            'publicDateEnd' => $request->show_to,
            'objects' => $request->object,
            'objectType' => $request->object_type,
            'imageFileName' => $request->img_path_1_name,
        ];
        if (!empty($request->has_target_route)) {
            if (!empty($request->direction_id)) {
                $createParams['directionId'] = $request->direction_id;
            };
            if (!empty($request->direction_url)) {
                $createParams['directionUrl'] = $request->direction_url;
            };
        }
        if (!empty($request->bannerType) && $request->bannerType == 'promotion') {
            $createParams['thumbImageFileName'] = $request->img_path_2_name;
        };
        if (!empty($request->isHighlight)) {
            $createParams['isHighlight'] = true;
        };

        $create_banner_response = $newsEventService->addNewBanner($createParams);
        if (!empty($create_banner_response->data)) {
            return redirect()->route('bannermanage.index')->withSuccess('Success!');
        }
        return redirect()->route('bannermanage.index')->withErrors(isset($create_banner_response->description) ? $create_banner_response->description : $create_banner_response->message);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            // 'imageFileName' => 'required',
            // 'encodedImage' =>'required'
            'file' => 'required'
        ]);
        $file = $request->file('file');
        $param = [
            'imageFileName' => $file->getClientOriginalName(),
            'encodedImage' => base64_encode(file_get_contents($file))
        ];
        $newsEventService = new NewsEventService();
        $uploadImage_response = $newsEventService->uploadImage($param['imageFileName'], $param['encodedImage']);
        return $uploadImage_response;
    }

    public function initDatatable(Request $request)
    {
        $newsEventService = new NewsEventService();

        // $toDay = Carbon::parse( date('Y-m-d h:i:s'))->format('Y-m-d\TH:i');
        $param = [
            'popupType' => empty($request->popupType) ? null : $request->popupType,
            'publicDateStart' => empty($request->public_date_from) ? null : Carbon::parse($request->public_date_from)->format('Y-m-d H:i:s'),
            'publicDateEnd' => empty($request->public_date_to) ? null : Carbon::parse($request->public_date_to)->format('Y-m-d H:i:s')
        ];
        $responseCallAPIGetListPopup = $newsEventService->getListTemplatePopup($param);
        if (empty($responseCallAPIGetListPopup)) {
            $responseCallAPIGetListPopup = (object)[];
        };
        if ($this->user->role_id == ADMIN) {
            $responseCallAPIGetListPopup->isAdmin = true;
        }
        $responseCallAPIGetListPopup->aclCurrentModule = $this->aclCurrentModule;
        return $responseCallAPIGetListPopup;
    }

    public function updateOrder(Request $request)
    {
        if (!$request->ajax()) {
            return false;
        }
        $request->validate([
            'ordering' => 'required',
            'bannerType' => 'required',
            'bannerId' => 'required'
        ]);
        $newsEventService = new NewsEventService();
        $updateOrder_response = $newsEventService->updateOrderBannder($request->bannerId, $request->bannerType, $request->ordering);
        return $updateOrder_response;
    }
}
