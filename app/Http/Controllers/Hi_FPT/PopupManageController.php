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

    public function index(PopUpDataTable $dataTable, Request $request)
    {
        if($request->has('templateType') && $request->templateType){
            //dd($request->templateType);
        };
        return $dataTable->with([
            'templateType'=>$request->templateType,
            'start'=>$request->start,
            'length' => $request->length,
            'order' => $request->order,
            'columns' => $request->columns
            ])->render('popup.index');
    }

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
                if ( isset($data['detailPopup']->buttonActionType) && $data['detailPopup']->buttonActionType == 'function')
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
        $rules= [
            'templateType' => 'required',
            'titleVi' => 'required',
            'titleEn' => 'required',
            'img_path_1_name' => 'required',
            'directionId' => 'required_if:templateType,popup_custom_image_transparent,popup_full_screen',
            'directionUrl' => 'required_if:directionId,url_open_out_app,url_open_in_app',
            'img_path_2_name' => 'required_if:templateType,popup_custom_image_transparent,popup_full_screen',
        ];
        $request->validate($rules);
        $this->addToLog($request);
        $newsEventService = new NewsEventService();
        $createParams = [
            'templateType' => $request->templateType,
            'titleVi' => $request->titleVi,
            'titleEn' => $request->titleEn,
            'image' => $request->img_path_1_name,
            'directionId' => !empty($request->directionId) ? $request->directionId : "",
            'buttonImage' => !empty($request->img_path_2_name) ? $request->img_path_2_name : "",
        ];

        if ($request->directionId == 'url_open_out_app' || $request->directionId == 'url_open_in_app') {
            $createParams['directionUrl'] = $request->directionUrl;
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

    public function pushPopupTemplate(Request $request)
    {
        $rules = [
            'timeline' => 'required',
            'objecttype' => 'required',
            'repeatTime'=> 'required',
            'templateId'=> 'required',
        ];
        $request->validate($rules);
        $this->addToLog($request);
        $timeline = $request->timeline;
        $timeline_array = explode(" - ", $timeline);
        $dateStart = $timeline_array[0];
        $dateEnd = $timeline_array[1];

        $objecttype = $request->objecttype;
        $object = $request->object;
        $repeatTime = $request->repeatTime;
        $templateId = $request->templateId;
        $pushParams = [
            'popupTemplateId' => $templateId,
            'repeatTime' => $repeatTime,
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd,
            'objectType' => $objecttype,
            'objects' => $object,
        ];
        $newsEventService = new NewsEventService();
        $push_response = $newsEventService->pushTemplate($pushParams);
        if(isset($push_response->statusCode) && $push_response->statusCode==0){
            return redirect()->back()->withSuccess('Thành Công');
        }else{
            return redirect()->back()->withErrors($push_response->message);
        }
    }
    public function getDetailPersonalMaps(Request $request) {
        $rules = [
            'personalID' => 'required',
        ];
        $request->validate($rules);
        $personalID = $request->personalID;
        $newsEventService = new NewsEventService();
        $detail_PersonalMaps = $newsEventService->getDetailPersonalMap($personalID);
        return $detail_PersonalMaps;
    }
}
