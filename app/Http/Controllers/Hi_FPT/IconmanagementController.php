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
            $data['id'] = $id;
            $data['data'] = [
                'id'            => 1,
                'icon_url'      => '/images/camera_icon.jpg',
                'productNameVi' => 'FPT Camera',
                'productNameEn' => 'FPT Camera',
                'status'        => 1,
                
            ];
        }
        
        $loai_dieu_huong = Settings::where('name', 'icon_loai_dieu_huong')->get();
        $data['loai_dieu_huong'] = (!empty($loai_dieu_huong[0]['value'])) ? json_decode($loai_dieu_huong[0]['value'], true) : [];
        // dd($data);
        return view('icon_management.edit')->with($data);
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
                'id'            => 1,
                'icon_url'      => '/images/camera_icon.jpg',
                'productNameVi' => 'FPT Camera',
                'productNameEn' => 'FPT Camera',
                'status'        => 1,
                'description'   => 'TEST'
            ], [
                'id'            => 2,
                'icon_url'      => '/images/hdi_ins.png',
                'productNameVi' => 'Bảo hiểm Ô tô - Xe máy',
                'productNameEn' => 'HD Insurance',
                'status'        => 0,
                'description'   => 'TEST'
            ]];
            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        }
    }
}
