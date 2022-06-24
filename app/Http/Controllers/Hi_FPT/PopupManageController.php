<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\PopUpDataTable;
use App\DataTables\Hi_FPT\PopupDetailDataTable;
use App\DataTables\Hi_FPT\PopUpPrivateDataTable;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Services\NewsEventService;
use App\Services\PopupPrivateService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Matrix\Exception;
use Illuminate\Support\Facades\Http;


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
        $newsEventService = new NewsEventService();
        $list_type_popup = config('platform_config.type_popup_service');
        $list_route = $newsEventService->getListTargetRoute()->data ?? null;
        return $dataTable->with([
            'templateType' => $request->templateType,
            'start' => $request->start,
            'length' => $request->length,
            'order' => $request->order,
            'columns' => $request->columns
        ])->render('popup.index', compact('list_type_popup', 'list_route'));
    }

    public function save(Request $request)
    {
        $rules = [
            'templateType' => 'required',
            'titleVi' => 'required',
            'titleEn' => 'required',
            'image_popup_name' => 'required',
            'directionId' => 'required_if:templateType,popup_custom_image_transparent,popup_full_screen',
            'directionUrl' => 'required_if:directionId,url_open_out_app,url_open_in_app',
            'buttonImage_popup_name' => 'required_if:templateType,popup_custom_image_transparent,popup_full_screen',
        ];
        $request->validate($rules);
        $this->addToLog($request);

        $newsEventService = new NewsEventService();
        $createParams = [
            'templateType' => $request->templateType,
            'titleVi' => $request->titleVi,
            'titleEn' => $request->titleEn,
            'image' => $request->image_popup_name,
            'directionId' => !empty($request->directionId) ? $request->directionId : "",
            'buttonImage' => !empty($request->buttonImage_popup_name) ? $request->buttonImage_popup_name : "",
        ];

        if ($request->directionId == 'url_open_out_app' || $request->directionId == 'url_open_in_app') {
            $createParams['directionUrl'] = $request->directionUrl;
        }

        if (!empty($request->id_popup)) {
            $createParams['templatePersonalId'] = $request->id_popup;
            $create_popup_response = $newsEventService->updatePopup($createParams);
        } else
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
        ])->render('popup.view', compact('object_type', 'repeatTime', 'object', 'id'));
    }

    public function detail($id)
    {
        $dataDetail = $this->get_api_data_detail($id);
        return request()->ajax() ?
            response()->json($dataDetail, Response::HTTP_OK)
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function getPrivate(PopUpPrivateDataTable $dataTablePrivate, Request $request)
    {
        $newsEventService = new NewsEventService();
        $list_type_popup = config('platform_config.type_popup_service');
        $list_route = $newsEventService->getListTargetRoute()->data ?? null;
        return $dataTablePrivate->with([
            'type' => $request->type,
            'start' => $request->start,
            'length' => $request->length
        ])->render('popup-private.index', compact('list_type_popup', 'list_route'));
    }


    public function getPaginatePrivate()
    {
        $popup_private = new PopupPrivateService();
        try {
            $data = $popup_private->getPaginate();
        } catch (Exception $e) {
            return response()->json(['status_code' => '500', 'message' => $e->getMessage()]);
        }
        return response()->json(['status_code' => '0', 'message' => 'Delete Success', 'data' => $data]);
    }

    public function addPrivate(Request $request)
    {
        $rules = [
            'type'      => 'required',
            'iconUrl' => 'required',
            'timeline' => 'required',
            'number_phone' => 'required',
            'dataAction' => 'required',
            'actionType' => 'required',
            'iconButtonUrl' => 'required_if:type,popup_custom_image_transparent,popup_full_screen',
        ];
        $message = [
            'type.required'         => 'Loại popup không được bỏ trống!',
            'iconUrl.required'      => 'Ảnh popup không được bỏ trống!',
            'timeline.required'     => 'Thời gian hiển thị không được bỏ trống!',
            'number_phone.required' => 'Danh sách số điện thoại không được bỏ trống!',
            'dataAction.required'   => 'URL điều hướng không được bỏ trống!',
            'actionType.required'   => 'Nơi điều hướng không được bỏ trống!',
            'iconButtonUrl.required_if' => 'Ảnh nút điều hướng không được bỏ trống!',
        ];
        $this->validate($request, $rules, $message);
        $this->addToLog($request);
        $timeline_array = explode(" - ", $request->timeline);
        $paramsStatic = [
            $request->type,
            $request->actionType,
            $request->dataAction,
            $request->iconButtonUrl ?? '',
            $request->iconUrl,
            $timeline_array[0],
            $timeline_array[1],
            $request->number_phone,
            $request->titleVi ?? '',
            $request->titleEn ?? '',
            $request->desVi ?? '',
            $request->desEn ?? ''
        ];

        $popup_private = new PopupPrivateService();
        try {
            $response = $popup_private->add($paramsStatic);
        } catch (Exception $e) {
            return response()->json(['status_code' => '500', 'message' => $e->getMessage()]);
        }
        return response()->json(['status_code' => '0', 'data' => $response]);

    }

    public function updatePrivate(Request $request)
    {
        $rules = [
            'type' => 'required',
            'actionType' => 'required',
            'dataAction' => 'required',
            'iconButtonUrl' => 'required',
            'iconUrl' => 'required',
            'timeline' => 'required',
            'id' => 'required',
            'popupGroupId' => 'required',
            'temPerId' => 'required',
        ];
        $message = [
            'type.required'         => 'Loại popup không được bỏ trống!',
            'iconUrl.required'      => 'Ảnh popup không được bỏ trống!',
            'timeline.required'     => 'Thời gian hiển thị không được bỏ trống!',
            'dataAction.required'   => 'URL điều hướng không được bỏ trống!',
            'actionType.required'   => 'Nơi điều hướng không được bỏ trống!',
            'iconButtonUrl.required_if' => 'Ảnh nút điều hướng không được bỏ trống!',
        ];
        $this->validate($request, $rules, $message);
        $this->addToLog($request);
        $timeline_array = explode(" - ", $request->timeline);
        $paramsStatic = [
            $request->id,
            $request->type,
            $request->actionType,
            $request->dataAction,
            $request->iconButtonUrl ?? '',
            $request->iconUrl,
            $timeline_array[0],
            $timeline_array[1],
            $request->titleVi ?? '',
            $request->titleEn ?? '',
            $request->desVi ?? '',
            $request->desEn ?? '',
            $request->popupGroupId,
            $request->temPerId
        ];

        $popup_private = new PopupPrivateService();
        try {
            $response = $popup_private->update($paramsStatic);
            if($request->has('number_phone') && !empty($request->number_phone)) {
                $popup_private->import([$request->id, $request->number_phone]);
            }
        } catch (Exception $e) {
            return response()->json(['status_code' => '500', 'message' => $e->getMessage()]);
        }
        return response()->json(['status_code' => '0', 'data' => $response]);
    }

    public function deletePrivate(Request $request)
    {
        if(request()->ajax()) {
            $request->validate(['id' => 'required']);
            $this->addToLog($request);
            $popup_private = new PopupPrivateService();
            $response = $popup_private->delete([$request->id]);
            $res = check_status_code_api($response);
            if(empty($res)) {
                return response()->json($res, 500);
            }
            return response()->json(['data' => $res], 200);
        }
    }

    public function getByIdPrivate(Request $request)
    {
        if(request()->ajax()) {
            $request->validate(['id' => 'required']);
            $this->addToLog($request);
            $popup_private = new PopupPrivateService();
            $data = $popup_private->getById([$request->id]);
            $response = check_status_code_api($data);
            if(empty($response)) {
                return redirect()->back()->withErrors('Error! System maintain!');
            }
            return response()->json(get_data_api($response), Response::HTTP_OK);
        }

    }
}
