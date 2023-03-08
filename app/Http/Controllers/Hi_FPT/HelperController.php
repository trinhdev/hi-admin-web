<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\HelperDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Services\NewsEventService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use App\Models\Settings;

class HelperController extends MY_Controller
{
    //
    use DataTrait;
    protected $module_name = 'Helper';
    protected $model_name = "Helper";
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Helper Manage';
        $this->model = $this->getModel('Helper');
    }
    public function index(HelperDataTable $dataTable, Request $request) {
        return $dataTable->with([
            'start'=>$request->start,
            'length' => $request->length,
            'order' => $request->order,
            'columns' => $request->columns,
            ])->render('helper.index');
    }
    // public function view(Request $request, $bannerId){
    //     $result = [];
    //     $listTargetRoute = $newsEventService->getListTargetRoute();
    //     $listTargetRoute = (isset($listTargetRoute->statusCode) && $listTargetRoute->statusCode == 0) ? $listTargetRoute->data : [];

    //     $listTypeBanner = $newsEventService->getListTypeBanner();
    //     $listTypeBanner = (isset($listTypeBanner->statusCode) && $listTypeBanner->statusCode == 0) ? $listTypeBanner->data : [];

    //     $getDetailBanner_response = $newsEventService->getDetailBanner($bannerId);
    //     if(!isset($getDetailBanner_response->statusCode) || $getDetailBanner_response->statusCode != 0){
    //         $result['error'] = $getDetailBanner_response->message;
    //         return $result;
    //         // return redirect()->route('bannermanage.index')->withErrors($getDetailBanner_response->message);
    //     }
    //     $dataResponse = $getDetailBanner_response->data;
    //     $bannerObj = (object)[
    //         "bannerId" =>null,
    //         "bannerType" => null,
    //         "public_date_start" => null,
    //         "public_date_end" => null,
    //         "title_vi" => null,
    //         "title_en" => null,
    //         "direction_id" => null,
    //         "direction_url" => null,
    //         "image" => null,
    //         "thumb_image" => null,
    //         "view_count" => 0,
    //         "date_created" => null,
    //         "date_created"    =>null,
    //         "created_by" => null,
    //         "is_show_home" => false,
    //     ];

    //     $bannerObj->bannerId = $dataResponse->event_id;
    //     $bannerObj->title_vi = $dataResponse->title_vi;
    //     $bannerObj->bannerType = ($dataResponse->event_type == "highlight" ) ? 'bannerHome' : $dataResponse->event_type;
    //     $bannerObj->image = !empty($dataResponse->image) ? $dataResponse->image : null;
    //     $bannerObj->view_count = $dataResponse->view_count;
    //     // $bannerObj->direction_id = $dataResponse->target == 'open_url_in_browser' ? 'url_open_out_app' :  $dataResponse->target;
    //     $bannerObj->direction_id = $dataResponse->direction_id;
    //     $bannerObj->direction_url = $dataResponse->event_url;
    //     $bannerObj->date_created = $dataResponse->date_created;

    //     $bannerObj->title_en = $dataResponse->title_en;
    //     $bannerObj->thumb_image = !empty($dataResponse->thumb_image) ? $dataResponse->thumb_image : null;
    //     $bannerObj->created_by = $dataResponse->created_by;
    //     $bannerObj->public_date_start = !empty($dataResponse->public_date_start) ? Carbon::parse($dataResponse->public_date_start)->format('Y-m-d\TH:i') : null;
    //     $bannerObj->public_date_end = !empty($dataResponse->public_date_end) ? Carbon::parse($dataResponse->public_date_end)->format('Y-m-d\TH:i') : null;
    //     $bannerObj->is_show_home = (boolean) $dataResponse->is_show_home;

    //     $result = [
    //         'list_target_route'=>$listTargetRoute,
    //         'list_type_banner' => $listTypeBanner,
    //         'banner'=>$bannerObj
    //     ];
    //     return $result;
    // }

    public function edit($id) {
        $data = parent::edit1();
        $support_system_error_type = Settings::where('name', 'support_system_error_type')->get()->toArray();
        $data['data']->error_type = explode(',', $data['data']->error_type);
        $data['support_system_error_type'] = (!empty($support_system_error_type[0]['value'])) ? json_decode($support_system_error_type[0]['value'], true) : [];
        return view('helper.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'error_type' => implode(',', $request->error_type),
            'updated_by' => (!isset($this->user->id)) ? $this->user->id : ''
        ]);
        $this->updateById($this->model, $id, $request->all());
        $this->addToLog(request());
        return redirect()->route('helper.index');
    }

    public function create(Request $request) {
        $data = [];
        $support_system_error_type = Settings::where('name', 'support_system_error_type')->get()->toArray();
        $data['support_system_error_type'] = (!empty($support_system_error_type[0]['value'])) ? json_decode($support_system_error_type[0]['value'], true) : [];
        return view('helper.edit')->with($data);
    }

    public function store(Request $request) {
        $request->merge([
            'error_type' => implode(',', $request->error_type),
            'created_by' => (!isset($this->user->id)) ? $this->user->id : ''
        ]);
        $this->createSingleRecord($this->model, $request->all());
        $this->addToLog(request());
        return redirect()->route('helper.index');
    }

    public function destroy($id)
    {
        //
        $this->deleteById($this->model, $id);
        $this->addToLog(request());
        return redirect()->route('helper.index');
    }
}
