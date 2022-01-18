<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\MY_Controller;
use Illuminate\Http\Request;

use App\Http\Traits\DataTrait;
use \stdClass;

use Yajra\DataTables\DataTables;

use App\Models\Settings;

class IconcategoryController extends MY_Controller
{
    use DataTrait;
    protected $module_name = 'Icon_Category';
    protected $model_name = "Icon_Category";
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Icon Category';
        // $this->model = $this->getModel('Icon_Management');
    }

    public function index()
    {
        //get view list
        $data = $this->list1();
        return view('icon_category.list')->with($data);
    }

    public function edit() {
        // get view edit
        // $data = parent::edit1();
        $data = [
            'controller'    => 'iconcategory'
        ];
        $id = request()->segment(3);
        if(!empty($id)) {
            $data['id'] = $id;
            $data['data'] = [
                'id'                    => 1,
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
            ];
        }
        
        $loai_dieu_huong = Settings::where('name', 'icon_loai_dieu_huong')->get();
        $data['loai_dieu_huong'] = (!empty($loai_dieu_huong[0]['value'])) ? json_decode($loai_dieu_huong[0]['value'], true) : [];
        // dd($data);
        return view('icon_category.edit')->with($data);
    }

    public function save(Request $request) {
        $id = request()->segment(3);
        if(!empty($id)) {

        }
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
                'productTitleId'        => 1,
                'productTitleNameVi'    => 'Viễn thông',
                'productTitleNameEn'    => 'Telecom',
                'arrayId'               => '5,17,8,34,9,10,11,39',
                'dateModified'          => '2021-10-21 08:34:39',
                'isDeleted'             => 0,
                'pheduyet'              => 'Chờ kiểm tra'
            ], [
                'productTitleId'        => 2,
                'productTitleNameVi'    => 'Smart Home',
                'productTitleNameEn'    => 'Smart Home',
                'arrayId'               => '7,19',
                'dateModified'          => '2021-10-11 18:27:36',
                'isDeleted'             => 0,
                'pheduyet'              => 'Kiểm tra thất bại'
            ], [
                'productTitleId'        => 3,
                'productTitleNameVi'    => 'Dịch vụ IT',
                'productTitleNameEn'    => 'IT service',
                'arrayId'               => '5,17,8,34,9,10,11,39,7,19,30',
                'dateModified'          => '2021-10-21 08:34:39',
                'isDeleted'             => 0,
                'pheduyet'              => 'Đã phê duyệt'
            ]];
            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function test_drag_drop() {
        return view('icon_category.test_drag_drop');
    }

    public function test_carousel() {
        return view('icon_category.test_carousel');
    }
}
