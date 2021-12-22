<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Services\NewsEventService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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

    public function edit(Request $request){

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

    public function getDetailBanner(Request $request){
        $request->validate([
            'bannerType' => 'required',
            'bannerId'  => 'required'
        ]);

        $newsEventService = new NewsEventService();
        $uploadImage_response = $newsEventService->getDetailBanner($request->bannerId,$request->bannerType);
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
