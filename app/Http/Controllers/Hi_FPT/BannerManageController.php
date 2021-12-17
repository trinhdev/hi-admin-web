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
        return view('banners.index');
    }

    public function edit(Request $request){

    }

    public function update(Request $request, $id)
    {
        $this->updateById($this->model,$id,$request->all());
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

    public function initDatatable(Request $request){
        if ($request->ajax()) {
            
            $data = $this->model::query();

            $json = DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return view('layouts.button.action')->with(['row' => $row, 'module' => 'bannermanage']);
                })
                ->rawColumns(['action'])
                ->make(true);
            return $json;
        }
    }
}
