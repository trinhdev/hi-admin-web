<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\MY_Controller;
use Illuminate\Http\Request;

use App\Http\Traits\DataTrait;
use \stdClass;

use Yajra\DataTables\DataTables;

use App\Models\Settings;

class IconmanagementController extends MY_Controller
{
    use DataTrait;
    protected $module_name = 'Icon management';
    protected $model_name = "Icon_Management";
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Icon Management';
        $this->model = $this->getModel('Icon_Management');
    }

    public function index()
    {
        //get view list
        $data = $this->list1();
        return view('icon_management.list')->with($data);
    }

    public function edit() {
        // get view edit
        // $data = parent::edit1();
        $data = [
            'controller'    => 'iconmanagement'
        ];
        $id = request()->segment(3);
        if(!empty($id)) {
            $api_info = [
                "statusCode"                    => 0,
                "message"                       => "Thành công",
                "data"                          => [
                    "productId"                 => 9,
                    "productNameVi"             => "F-Safe",
                    "productNameEn"             => "F-Safe",
                    "iconUrl"                   => "https://hi-static.fpt.vn/sys/hifpt/icons/hi-customer/6_2/FSafe.png",
                    "dataActionStaging"         => "https://staging-hi.fpt.vn/shopping/fpt/fsafe/grid",
                    "dataActionProduction"      => "https://fpt.vn/fsafe/",
                    "actionType"                => "open_url_in_app_with_access_token",
                    "data"                      => null,
                    "content"                   => "",
                    "isNew"                     => "2",
                    "newBeginDay"               => "2021-11-28 00:00:00",
                    "newEndDay"                 => "2021-11-30 00:00:00",
                    "isDisplay"                 => "2",
                    "displayBeginDay"           => "2021-11-28 00:00:00",
                    "displayEndDay"             => "2021-11-30 00:00:00",
                    "decriptionVi"              => null,
                    "decriptionEn"              => null,
                    "keywords"                  => "fsafe, f safe"
                ]
            ];            

            // $data['productId'] = (!empty);
            $data['data'] = (!empty($api_info['data'])) ? $api_info['data'] : [];
        }
        
        $loai_dieu_huong = Settings::where('name', 'icon_loai_dieu_huong')->get();
        $data['loai_dieu_huong'] = (!empty($loai_dieu_huong[0]['value'])) ? json_decode($loai_dieu_huong[0]['value'], true) : [];
        return view('icon_management.edit')->with($data);
    }

    public function save(Request $request) {
        // $id = request()->segment(3);
        // if(!empty($id)) {

        // }
        dd($request);
    }

    public function detail() {
        $id = request()->segment(3);

    }

    public function upload(Request $request) {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->file('file')) {
            $imagePath = $request->file('file');
            $imageName = $imagePath->getClientOriginalName();

            $path = $request->file('file')->storeAs('uploads', $imageName, 'public');
        }
        $request->file->move(public_path('images/upload'), $imageName);
        return ['success' => 'You have successfully upload image.', 'url' => $imageName];
    }

    public function initDatatable(Request $request){
        if($request->ajax()){
            // $data = $this->model::with('user')->select(['id', 'icon_url', 'name', 'position', 'status', 'category', 'updated_by', 'created_by']);
            $data = [[
                'productId'             => 1,
                'productNameVi'         => 'FPT Camera',
                'productNameEn'         => 'FPT Camera',
                'icon_url'              => '/images/camera_icon.jpg',
                'dataActionStaging'     => '',
                'dataActionProduction'  => '',
                'data'                  => '',
                'actionType'            => 'go_to_screen',
                'content'               => '',
                'isNew'                 => '1',
                'newBeginDay'           => '2022-01-01 00:00:00',
                'newEndDay'             => '2031-12-31 00:00:00',
                'isDisplay'             => 1,
                'displayBeginDay'       => '2022-01-01 00:00:00',
                'displayEndDay'         => '2031-12-31 00:00:00',
                'decriptionVi'          => '',
                'decriptionEn'          => '',
                'keywords'              => ''
            ], [
                'productId'             => 2,
                'productNameVi'         => 'Bảo hiểm Ô tô - Xe máy',
                'productNameEn'         => 'HD Insurance',
                'icon_url'              => '/images/hdi_ins.png',
                'dataActionStaging'     => '',
                'dataActionProduction'  => '',
                'data'                  => '',
                'actionType'            => 'go_to_screen',
                'content'               => '',
                'isNew'                 => '1',
                'newBeginDay'           => '2022-01-01 00:00:00',
                'newEndDay'             => '2031-12-31 00:00:00',
                'isDisplay'             => 0,
                'displayBeginDay'       => '2022-01-01 00:00:00',
                'displayEndDay'         => '2031-12-31 00:00:00',
                'decriptionVi'          => '',
                'decriptionEn'          => '',
                'keywords'              => ''
            ], [
                'productId'             => 3,
                'productNameVi'         => 'Nhà thuốc Long Châu',
                'productNameEn'         => 'Long Chau Drugstore',
                'icon_url'              => '/images/lc-logo.png',
                'dataActionStaging'     => '',
                'dataActionProduction'  => '',
                'data'                  => '',
                'actionType'            => 'go_to_screen',
                'content'               => '',
                'isNew'                 => '1',
                'newBeginDay'           => '2022-01-01 00:00:00',
                'newEndDay'             => '2031-12-31 00:00:00',
                'isDisplay'             => 2,
                'displayBeginDay'       => '2022-01-30 00:00:00',
                'displayEndDay'         => '2031-12-31 00:00:00',
                'decriptionVi'          => '',
                'decriptionEn'          => '',
                'keywords'              => ''
            ]];
            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        }
    }
}
