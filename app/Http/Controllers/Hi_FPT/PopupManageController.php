<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\PopUpDataTable;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Services\NewsEventService;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;
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

    public function index(PopUpDataTable $dataTable)
    {
        return $dataTable->render('popup.index');
    }

    // public function index()
    // {
    //     $newsEventService = new NewsEventService();
    //     $listTemplatePopup = $newsEventService->getListTemplatePopup();
    //     $listTemplatePopup->type = config('platform_config.type_popup_service');
    //     $listTemplatePopup = (isset($listTemplatePopup->statusCode) && $listTemplatePopup->statusCode == 0) ? $listTemplatePopup : [];
    //     return view('popup.index')->with(['list_template_popup' => $listTemplatePopup]);
    // }

    public function edit()
    {
        $data = array();
        $newsEventService = new NewsEventService();
        $id = request()->segment(3);
        if ($id) {
            $getDetailPopup_response = $newsEventService->getDetailPopup($id);
            if (isset($getDetailPopup_response->statusCode)) {
                $data['detailPopup'] = ($getDetailPopup_response->statusCode == 0) ? $getDetailPopup_response->data : [];
//              clear buttonActionValue when deeplink define
                if ($data['detailPopup']->buttonActionType == 'function')
                    $data['detailPopup']->buttonActionValue = ''; 
            } else
                $data['detailPopup'] = [];
        } else
            $data['detailPopup'] = [];
        $listTargetRoute = $newsEventService->getListTargetRoute();
        if (isset($listTargetRoute->statusCode)) {
            $data['listTargetRoute'] = ($listTargetRoute->statusCode == 0) ? $listTargetRoute->data : [];
        } else
            $data['listTargetRoute'] = [];
        $data['listTypePopup'] = config('platform_config.type_popup_service');
        //dd($listTargetRoute);
        return view('popup.edit')->with($data);
    }

    public function save(Request $request)
    {

        $ruleButtonImage = [
            'directionId' => 'required',
            'img_path_2_name' => 'required',
        ];
        $rules = [
            'templateType' => 'required',
            'titleVi' => 'required',
            'titleEn' => 'required',
            'img_path_1_name' => 'required',
        ];
//      banner có button
        if ($request->templateType == "popup_custom_image_transparent" || $request->templateType == "popup_full_screen") {
            $rules = array_merge($ruleButtonImage, $rules);
            $directionUrl = $request->directionUrl;
        } else {
            $directionUrl = "";
        }
        if ($request->directionId == "url_open_out_app" || $request->directionId == "url_open_in_app") {
            $rules['directionUrl'] = 'required';
        }
        $request->validate($rules);
//        $request->merge([
//            'show_from' => Carbon::parse($request->show_from)->format('Y-m-d H:i:s'),
//            'show_to' => Carbon::parse($request->show_to)->format('Y-m-d H:i:s')
//        ]);
        $this->addToLog($request);
        $newsEventService = new NewsEventService();
        $createParams = [
            'templateType' => $request->templateType,
            'titleVi' => $request->titleVi,
            'titleEn' => $request->titleEn,
//            'publicDateStart' => $request->show_from,
//            'publicDateEnd' => $request->show_to,
            'image' => $request->img_path_1_name,
            'directionId' => !empty($request->directionId) ? $request->directionId : "",
            'buttonImage' => !empty($request->img_path_2_name) ? $request->img_path_2_name : "",
        ];

        if ($request->directionId == 'url_open_out_app' || $request->directionId == 'url_open_in_app') {
            $createParams['directionUrl'] = $directionUrl;
        }

        if (!empty($request->id_popup)) {
            $createParams['templatePersonalId'] = $request->id_popup;
            $create_popup_response = $newsEventService->updatePopup($createParams);
        } else
        // dd($createParams);
            $create_popup_response = $newsEventService->addNewPopup($createParams);
        if (($create_popup_response->statusCode == 0)) {
            return redirect()->route('popupmanage.index')->withSuccess('Success!');
        }
        return redirect()->route('popupmanage.index')->withErrors(isset($create_popup_response->description) ? $create_popup_response->description : $create_popup_response->message);
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

    public function view($id)
    {
        $newsEventService = new NewsEventService();
        $result = [];
        $listTargetRoute = $newsEventService->getListTargetRoute();

        $listTargetRoute = (isset($listTargetRoute->statusCode) && $listTargetRoute->statusCode == 0) ? $listTargetRoute->data : [];
        $typePopup = config('platform_config.type_popup_service');

        $getDetailPopup_response = $newsEventService->getDetailPopup($id);
        if (!isset($getDetailPopup_response->statusCode) || $getDetailPopup_response->statusCode != 0) {
            $result['error'] = $getDetailPopup_response->message;
//            return $result;
            return redirect()->route('popupmanage.index')->withErrors($getDetailPopup_response->message);
        }
        $dataResponse = $getDetailPopup_response->data;

        $templateObj = (object)[
            "templateId" => null,
            "templateType" => null,
            "titleVi" => null,
            "titleEn" => null,
            "directionId" => null,
            "directionUrl" => null,
            "image" => null,
            "buttonImage" => null,
            "view_count" => 0,
            "dateCreated" => null,
            "templatePersonalMaps" => null,
        ];
        $templateObj->templateId = $dataResponse->id;
        $templateObj->templateType = $dataResponse->templateType;
        $templateObj->titleVi = $dataResponse->titleVi;
        $templateObj->titleEn = $dataResponse->titleEn;
        $templateObj->image = $dataResponse->image;
        $templateObj->buttonImage = $dataResponse->buttonImage;
        $templateObj->actionType = $dataResponse->actionType;
        $templateObj->dateCreated = $dataResponse->dateCreated;
        $templateObj->dateModified = $dataResponse->dateModified;
        $templateObj->ordering = $dataResponse->ordering;
        $templateObj->directionUrl = $dataResponse->buttonActionValue;
        $templateObj->directionId = $dataResponse->directionId;
        $templateObj->templatePersonalMaps = $dataResponse->templatePersonalMaps;

        $data = [
            'detailTemplate' => $templateObj,
            'list_target_route' => $listTargetRoute,
            'list_type_popup' => $typePopup,
        ];
        $data['object_type'] = config('platform_config.object_type');
        $data['object'] = config('platform_config.object');
        $data['repeatTime'] = config('platform_config.repeatTime');
        return view('popup.view')->with($data);
    }

    public function pushPopupTemplate()
    {
        $data = request()->all();
        $timeline = $data['timeline'];
        $timeline_array = explode(" - ", $timeline);
        $dateStart = $timeline_array[0];
        $dateEnd = $timeline_array[1];

        $objecttype = $data['objecttype'];
        $object = $data['object'];
        $repeatTime = $data['repeatTime'];
        $templateId = $data['templateId'];
        $pushParams = [
            'templateId' => $templateId,
            'repeatTime' => $repeatTime,
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd,
            'objectType' => $objecttype,
            'objects' => $object,
        ];
        $newsEventService = new NewsEventService();
        $push_response = $newsEventService->pushTemplate($pushParams);
    }
    public function getDetailPersonalMaps() {
        $data = request()->all();
        $personalID = $data['personalID'];
        $newsEventService = new NewsEventService();
        $detail_PersonalMaps = $newsEventService->getDetailPersonalMap($personalID);
        return $detail_PersonalMaps;
    }
}
