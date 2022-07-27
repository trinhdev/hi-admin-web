<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\BannerDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\BannerManageRequest\StoreRequest;
use App\Http\Requests\BannerManageRequest\UpdateRequest;
use App\Http\Traits\DataTrait;
use App\Models\AppLog;
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
        $this->service = new NewsEventService();
    }

    public function index(BannerDataTable $dataTable, Request $request){
        $listTypeBanner = get_data_api($this->service->getListTypeBanner());
        $input = $request->only(['bannerType', 'public_date_start','public_date_end','start','length','order','columns']);
        return $dataTable->with([
            'request'=>$input
            ])->render('banners.index', ['list_type_banner' => $listTypeBanner]);
    }
    public function view(Request $request, $bannerId){
        $listTargetRoute    = get_data_api($this->service->getListTargetRoute());
        $listTypeBanner     = get_data_api($this->service->getListTypeBanner());
        $dataResponse       = get_data_api($this->service->getDetailBanner($bannerId));
        if(empty($dataResponse)){
            return view('banners.create')->with(['list_target_route'=>$listTargetRoute, 'list_type_banner' => $listTypeBanner]);
        }

        $dataResponse = collect($dataResponse)->only([
            "event_id","event_type","public_date_start","public_date_end","title_vi",
            "title_en","direction_id","event_url","image","thumb_image","view_count",
            "date_created","created_by","cms_note","is_show_home"]);
        return [
            'list_target_route'=>$listTargetRoute,
            'list_type_banner' => $listTypeBanner,
            'banner'=>$dataResponse
        ];
    }

    public function edit(Request $request, $bannerId=null){
        $listTargetRoute    = get_data_api($this->service->getListTargetRoute());
        $listTypeBanner     = get_data_api($this->service->getListTypeBanner());
        $dataResponse       = get_data_api($this->service->getDetailBanner($bannerId));
        if(empty($dataResponse)){
            return view('banners.create')->with(['list_target_route'=>$listTargetRoute, 'list_type_banner' => $listTypeBanner]);
        }

        $dataResponse = collect($dataResponse)->only([
            "event_id","event_type","public_date_start","public_date_end","title_vi",
            "title_en","direction_id","event_url","image","thumb_image","view_count",
            "date_created","created_by","cms_note","is_show_home"]);
        return view('banners.edit')->with(['list_target_route'=>$listTargetRoute, 'list_type_banner' => $listTypeBanner, 'banner'=>$dataResponse]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $validated = $request->validated();

        $this->addToLog($request);
        $params = collect($validated)->merge([
            'bannerId'          => $id,
            'isShowHome'       => $request->has('isShowHome') ? 1 : null,
            'imageFileName'     => $request->input('imageFileName'),
            'thumbImageFileName'=> $request->input('thumbImageFileName'),
            'publicDateStart'   => Carbon::parse($request->input('show_from'))->format('Y-m-d H:i:s'),
            'publicDateEnd'     => Carbon::parse($request->input('show_to'))->format('Y-m-d H:i:s'),
            'titleVi'           => $request->input('title_vi', ''),
            'titleEn'           => $request->input('title_en', ''),
            'directionId'       => $request->input('has_target_route')=='checked' ? $request->input('direction_id', '') : '',
            'directionUrl'      => $request->input('has_target_route')=='checked' && $request->input('direction_id')==1 ? $request->input('directionUrl', '') : '',
        ])->filter(function ($value) {
            return !empty($value);
        });
        $response = $this->service->updateBanner($params);
        if($response){
            return redirect('bannermanage')->withSuccess('');
        }
        return  redirect('bannermanage')->withErrors($response->message ?? 'Staging system error!');
    }

    public function create(Request $request){
        $listTargetRoute = $this->service->getListTargetRoute();
        $listTargetRoute = ($listTargetRoute->statusCode == 0) ? $listTargetRoute->data : [];

        $listTypeBanner = $this->service->getListTypeBanner();
        $listTypeBanner = ($listTypeBanner->statusCode == 0) ? $listTypeBanner->data : [];
        return view('banners.edit')->with(['list_target_route'=>$listTargetRoute, 'list_type_banner' => $listTypeBanner]);
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $this->addToLog($request);
        $params = collect($validated)->merge([
            'publicDateStart'   => Carbon::parse($request->input('show_from'))->format('Y-m-d H:i:s'),
            'publicDateEnd'     => Carbon::parse($request->input('show_to'))->format('Y-m-d H:i:s'),
            'directionId'       => $request->input('has_target_route')=='checked' ? $request->input('direction_id', '') : '',
            'directionUrl'      => $request->input('has_target_route')=='checked' && $request->input('direction_id')==1 ? $request->input('directionUrl', '') : '',
            'isShowHome'        => $request->has('isShowHome') ? 1 : null,
            'cms_note'          => json_encode([
                'created_by' => substr($this->user->email, 0, strpos($this->user->email, '@')),
                'modified_by' => null
            ])
        ])->filter(function ($value) {
            return !empty($value);
        });
        $response = $this->service->addNewBanner($params);
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
        return $this->service->updateOrderBannder($request->eventId, $request->ordering);
    }
}
