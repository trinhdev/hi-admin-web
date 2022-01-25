<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\MY_Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

use App\Http\Traits\DataTrait;
use \stdClass;

use Yajra\DataTables\DataTables;

use App\Services\IconManagementService;

class IconconfigController extends MY_Controller
{
    use DataTrait;
    protected $module_name = 'Icon config';
    protected $model_name = "Icon_Config";
    protected $iconconfig = null;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Icon Management';
        $this->iconconfig = new IconManagementService();
        // $this->model = $this->getModel('icon_config');
    }

    public function index()
    {
        //get view list
        $data = $this->list1();
        $icon_approve = Settings::where('name', 'icon_approve')->get();
        $data['icon_approve'] = (!empty($icon_approve[0]['value'])) ? json_decode($icon_approve[0]['value'], true) : [];
        return view('icon_config.list')->with($data);
    }

    public function edit() {
        // get view edit
        // $data = parent::edit1();
        $data = [
            'controller'    => 'iconconfig'
        ];
        $id = request()->segment(3);
        if(!empty($id)) {
            $api_info = json_decode(json_encode($this->iconconfig->getProductById($id)), true);;            

            // $data['productId'] = (!empty);
            $data['data'] = (!empty($api_info['data'])) ? $api_info['data'] : [];
        }

        if(!empty($data['data']['productNameVi'])) {
            $data['data']['productNameVi'] = preg_replace('/\r|\n/', ' ', @$data['data']['productNameVi']);
        }

        if(!empty($data['data']['productNameEn'])) {
            $data['data']['productNameEn'] = preg_replace('/\r|\n/', ' ', @$data['data']['productNameEn']);
        }
        $loai_dieu_huong = Settings::where('name', 'icon_loai_dieu_huong')->get();
        $data['loai_dieu_huong'] = (!empty($loai_dieu_huong[0]['value'])) ? json_decode($loai_dieu_huong[0]['value'], true) : [];
        return view('icon_config.edit')->with($data);
    }

    public function save(Request $request) {
        // $id = request()->segment(3);
        // if(!empty($id)) {

        // }
        // dd($request);
        $result = $this->list1();
        $icon_approve = Settings::where('name', 'icon_approve')->get();
        $result['icon_approve'] = (!empty($icon_approve[0]['value'])) ? json_decode($icon_approve[0]['value'], true) : [];
        // $result = ['success' => 'success', 'html' => 'Đã gửi yêu cầu đến bộ phận kiểm duyệt. Vui lòng chờ kiểm tra và phê duyệt trước khi hoàn tất yêu cầu.'];
        // array_merge($result, ['success' => 'success', 'html' => 'Đã gửi yêu cầu đến bộ phận kiểm duyệt. Vui lòng chờ kiểm tra và phê duyệt trước khi hoàn tất yêu cầu.']);
        $request->session()->flash('success', 'success');
        $request->session()->flash('html', 'Đã gửi yêu cầu đến bộ phận kiểm duyệt. Vui lòng chờ kiểm tra và phê duyệt trước khi hoàn tất yêu cầu.');
        return redirect()->route('iconconfig.index')->with($result);
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
        if($request->ajax()) {
            $response = json_decode(json_encode($this->iconconfig->getAllProduct()), true);
            $data = [];
            if(!empty($response['data'])) {
                $data = $response['data'];
            }
            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        }
    }
}
