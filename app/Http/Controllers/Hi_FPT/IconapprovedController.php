<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\MY_Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Requests\IconSaveRequest;

use App\Models\Icon_approve;
use App\Models\Icon;
use App\Models\Icon_Category;
use App\Models\Icon_Config;

use App\Http\Traits\DataTrait;
use \stdClass;

use Yajra\DataTables\DataTables;

use App\Services\IconManagementService;

use Illuminate\Support\Str;

class IconapprovedController extends MY_Controller
{
    use DataTrait;
    protected $module_name = 'Icon approved';
    protected $model_name = "Icon_approve";
    protected $iconManagement = null;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Icon Approved';
        $this->iconManagement = new IconManagementService();
        $this->model = $this->getModel('Icon_approve');
    }

    public function index()
    {
        //get view list
        $data = $this->list1();
        $icon_approve = Settings::where('name', 'icon_approve')->get();
        $data['icon_approve'] = (!empty($icon_approve[0]['value'])) ? json_decode($icon_approve[0]['value'], true) : [];
        return view('icon_approved.list')->with($data);
    }

    public function edit($id = null) {
        $approved_data = $this->model::where('id', $id)->get();
        // dd($data);
        // // $data = [
        // //     'controller'    => 'iconmanagement'
        // // ];
        // // $id = request()->segment(3);
        $uuid = $approved_data[0]['product_id'];
        switch($approved_data[0]['product_type']) {
            case 'icon_management':
                $url = "/iconmanagement/edit/$uuid";
                break;
            case 'icon_category':
                $url = "/iconcategory/edit/$uuid";
                break;
            case 'icon_config':
                $url = "/iconconfig/edit/$uuid";
                break;
        }

        return redirect()->to($url);

        // if(!empty($id)) {
        //     $data = parent::edit1();

        //     $api_info = json_decode(json_encode($this->iconManagement->getProductById($id)), true);;            

        //     if(empty($api_info['data'])) {
        //         $icon = Icon::where(['productId' => $id])->get();
        //         $api_info['data'] = (!empty($icon[0])) ? json_decode($icon[0], true) : [];
        //     }
        //     $data['data'] = (!empty($api_info['data'])) ? $api_info['data'] : [];
        // }

        // if(!empty($data['data']['productNameVi'])) {
        //     $data['data']['productNameVi'] = preg_replace('/\r|\n/', ' ', @$data['data']['productNameVi']);
        // }

        // if(!empty($data['data']['productNameEn'])) {
        //     $data['data']['productNameEn'] = preg_replace('/\r|\n/', ' ', @$data['data']['productNameEn']);
        // }
        // $loai_dieu_huong = Settings::where('name', 'icon_loai_dieu_huong')->get();
        // $data['loai_dieu_huong'] = (!empty($loai_dieu_huong[0]['value'])) ? json_decode($loai_dieu_huong[0]['value'], true) : [];
        // return view('icon_management.edit')->with($data);
    }

    public function save(IconSaveRequest $request) {
        $result = $this->list1();
        $icon_approve = Settings::where('name', 'icon_approve')->get();
        $result['icon_approve'] = (!empty($icon_approve[0]['value'])) ? json_decode($icon_approve[0]['value'], true) : [];
        $approved_status = 'update';

        if(empty($request['productId'])) {
            $request->merge([
                'productId' => '',
            ]);
            $approved_status = 'create';
        }

        $icon = $this->createSingleRecord($this->model, $request->all());

        Icon_approve::create([
            'product_type'          => 'icon_management',
            'product_id'            => $icon->uuid,
            'updated_by'            => Auth::check() ? Auth::user()->id : 0,
            'approved_status'       => 'chokiemtra',
            'approved_type'         => $approved_status,
            'approved_by'           => '',
            'approved_at'           => null,
        ]);

        $this->addToLog(request());
        $request->session()->flash('success', 'success');
        $request->session()->flash('html', 'Đã gửi yêu cầu đến bộ phận kiểm duyệt. Vui lòng chờ kiểm tra và phê duyệt trước khi hoàn tất yêu cầu.');
        return redirect()->route('iconmanagement.index')->with($result);
    }

    public function destroy(Request $request) {
        $result = $this->list1();
        $icon_approve = Settings::where('name', 'icon_approve')->get();
        $result['icon_approve'] = (!empty($icon_approve[0]['value'])) ? json_decode($icon_approve[0]['value'], true) : [];
        $icon = $this->createSingleRecord($this->model, json_decode($request['formData'], true));

        Icon_approve::create([
            'product_type'          => 'icon_management',
            'product_id'            => $icon->uuid,
            'updated_by'            => Auth::check() ? Auth::user()->id : 0,
            'approved_status'       => 'chokiemtra',
            'approved_type'         => 'delete',
            'approved_by'           => '',
            'approved_at'           => null,
        ]);
        $this->addToLog(request());
        echo json_encode(['result' => 1, 'message' => 'Đã gửi yêu cầu đến bộ phận kiểm duyệt. Vui lòng chờ kiểm tra và phê duyệt trước khi hoàn tất yêu cầu.']);
    }

    public function detail($productId) {
        $data['productId'] = $productId;
        $data['data'] = [];
        $response = json_decode(json_encode($this->iconManagement->getProductById($productId)), true);
        if(!empty($response['data'])) {
            $data['data'] = $response['data'];
        }
        $detail_prod_title = view('icon_management.detail')->with($data);
        return $detail_prod_title->render();
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
            $icon_approve = Settings::where('name', 'icon_approve')->get();
            $icon_approve_list = array_column(json_decode($icon_approve[0]['value'], true), 'value', 'key');
            $data_raw = $this->model::with(['user', 'icon', 'icon_category', 'icon_config'])->get();
            $data = $data_raw->toArray();
            foreach($data as $key => &$value) {
                $value['approved_status_name'] = ($icon_approve_list[$value['approved_status']]) ? $icon_approve_list[$value['approved_status']] : $value['approved_status'];
            }
            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        }
    }
}
