<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\PopUpDataTable;
use App\DataTables\Hi_FPT\PopupDetailDataTable;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Services\NewsEventService;
use App\Services\PopupPrivateService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class PopupManageController extends MY_Controller
{
    use DataTrait;

    public function __construct()
    {
        parent::__construct();
        $this->title = 'Popup Manage';
    }

    public function index(PopUpDataTable $dataTable, Request $request)
    {
        return $dataTable->with([
            'templateType' => $request->templateType,
            'start' => $request->start,
            'length' => $request->length,
            'order' => $request->order,
            'columns' => $request->columns
        ])->render('popup.index');
    }

    public function edit()
    {
        $data = array();
        $data['listTypePopup'] = config('platform_config.type_popup_service');
        $data['listTargetRoute'] = [];
        $newsEventService = new NewsEventService();
        $id = request()->segment(3);
        if (!empty($id)) {
            $getDetailPopup_response = $newsEventService->getDetailPopup($id);
            if (isset($getDetailPopup_response->statusCode)) {
                $data['detailPopup'] = ($getDetailPopup_response->statusCode == 0) ? $getDetailPopup_response->data : [];
//              clear buttonActionValue when deeplink define
                if ( isset($data['detailPopup']->buttonActionType) && $data['detailPopup']->buttonActionType == 'function')
                    $data['detailPopup']->buttonActionValue = '';
            } else
                $data['detailPopup'] = [];
        } else {
            $data['detailPopup'] = [];
            $listTargetRoute = $newsEventService->getListTargetRoute();
            if (isset($listTargetRoute->statusCode)) {
                $data['listTargetRoute'] = ($listTargetRoute->statusCode == 0) ? $listTargetRoute->data : [];
            }
        }

        return view('popup.edit')->with($data);
    }

    public function save(Request $request)
    {
        $rules = [
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

    public function get_api_data_detail($id)
    {
        $newsEventService = new NewsEventService();
        $detail = json_decode(json_encode($newsEventService->getDetailPopup($id)), true);
        if (!isset($detail['statusCode']) || $detail['statusCode'] != 0) {
            return redirect()->back()->withErrors($detail['message']) ?? redirect()->back();
        }
        return $detail['data'];
    }

    public function view(PopupDetailDataTable $dataTable, Request $request, $id)
    {
        $dataResponse = $this->get_api_data_detail($id);
        $object_type = config('platform_config.object_type');
        $object = config('platform_config.object');
        $repeatTime = config('platform_config.repeatTime');

        return $dataTable->with([
            'data' => $dataResponse
        ])->render('popup.view', compact('object_type', 'repeatTime','object', 'id'));
    }

    public function detail($id)
    {
        $dataDetail = $this->get_api_data_detail($id);
        return request()->ajax() ?
                response()->json($dataDetail,Response::HTTP_OK)
                : redirect()->back()->withErrors('Error! System maintain!');
    }

    public function pushPopupTemplate(Request $request)
    {
        $rules = [
            'timeline' => 'required',
            'objecttype' => 'required',
            'repeatTime' => 'required',
            'templateId' => 'required',
        ];
        $request->validate($rules);
        $this->addToLog($request);
        $timeline_array = explode(" - ", $request->timeline);
        $templateId = $request->templateId;
        $pushParams = [
            'popupTemplateId' => $templateId,
            'repeatTime' => $request->repeatTime,
            'dateStart' => $timeline_array[0],
            'dateEnd' => $timeline_array[1],
            'objectType' => $request->objecttype,
            'objects' => $request->object,
        ];
        $newsEventService = new NewsEventService();
        $push_response = $newsEventService->pushTemplate($pushParams);
        return response()->json(['data' => $push_response]);
    }

    public function getDetailPersonalMaps(Request $request)
    {
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
