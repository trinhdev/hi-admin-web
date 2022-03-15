<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\MY_Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;
use App\Models\Icon_approve;
use App\Models\Icon_approve_logs;
use Illuminate\Http\Request;

use App\Http\Traits\DataTrait;
use \stdClass;

use Yajra\DataTables\DataTables;

use App\Services\IconManagementService;
use Illuminate\Support\Facades\Gate;

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
        $this->model = $this->getModel('Icon_Config');
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
        $data = [
            'controller'    => 'iconconfig'
        ];
        $productList = json_decode(json_encode($this->iconconfig->getAllProduct()), true);
        $list_category = json_decode(json_encode($this->iconconfig->getAllProductTitle()), true);
        $data['data']['list_category'] = (!empty($list_category['data'])) ? $list_category['data'] : [];
        $data['data']['productList'] = (!empty($productList['data'])) ? array_column($productList['data'], null, 'productId') : [];
        $data['data']['productListInConfig'] = [];
        if(!empty($data['data']['list_category'])) {
            foreach($data['data']['list_category'] as &$category) {
                $category['productListInTitle'] = [];
                foreach(explode(',', $category['arrayId']) as $productId) {
                    if(empty($data['data']['productList'][intval($productId)])) {
                        continue;
                    }
                    array_push($category['productListInTitle'], $data['data']['productList'][intval($productId)]);
                }
            } 
            
        }
        $id = request()->segment(3);
        if(!empty($id)) {
            $data['id'] = $id;
            $response = json_decode(json_encode($this->iconconfig->getProductConfigById($id)), true);
            if(empty($response['data'])) {
                $icon_category = $this->model::withTrashed()->where(['uuid' => $id])->get();
                $response['data'] = (!empty($icon_category[0])) ? json_decode($icon_category[0], true) : [];
            }
            if(!empty($response['data'])) {                
                $data['data']['productListId'] = (isset($response['data']['arrayId']) && is_string($response['data']['arrayId'])) ? explode(',', $response['data']['arrayId']) : [];
                // dd($data);
                foreach($data['data']['productListId'] as $productId) {
                    if(empty($data['data']['productList'][intval($productId)])) {
                        continue;
                    }
                    array_push($data['data']['productListInConfig'], $data['data']['productList'][intval($productId)]);
                }

                $data['data'] = array_merge($response['data'], $data['data']);
            }
        }
        $loai_dieu_huong = Settings::where('name', 'icon_loai_dieu_huong')->get();
        $data['loai_dieu_huong'] = (!empty($loai_dieu_huong[0]['value'])) ? json_decode($loai_dieu_huong[0]['value'], true) : [];
        return view('icon_config.edit')->with($data);
    }

    public function save(Request $request) {
        $result = $this->list1();
        $icon_approve = Settings::where('name', 'icon_approve')->get();
        $result['icon_approve'] = (!empty($icon_approve[0]['value'])) ? json_decode($icon_approve[0]['value'], true) : [];

        $approved_status = 'update';

        if(empty($request['productConfigId'])) {
            $request->merge([
                'productConfigId' => '',
            ]);
            $approved_status = 'create';
        }

        $icon_config = $this->createSingleRecord($this->model, $request->all());

        Icon_approve::create([
            'product_type'          => 'icon_config',
            'product_id'            => $icon_config->uuid,
            'requested_by'          => Auth::check() ? Auth::user()->id : 0,
            'requested_at'          => date('Y-m-d H:i:s', strtotime('now')),
            'approved_status'       => Gate::allows('icon-check-data-permission', Auth::user()) ? 'chopheduyet' : 'chokiemtra',
            'approved_type'         => $approved_status,
            'approved_by'           => '',
            'approved_at'           => null,
        ]);

        $this->addToLog(request());
        $request->session()->flash('success', 'success');
        $request->session()->flash('html', 'Đã gửi yêu cầu đến bộ phận kiểm duyệt. Vui lòng chờ kiểm tra và phê duyệt trước khi hoàn tất yêu cầu.');
        return redirect()->route('iconconfig.index')->with($result);
    }

    public function detail($productConfigId) {
        $data['productConfigId'] = $productConfigId;
        $data['data'] = [];
        $response = json_decode(json_encode($this->iconconfig->getProductConfigById($productConfigId)), true);
        
        if(!empty($response['data'])) {
            $response['data']['productListId'] = (isset($response['data']['arrayId']) && is_string($response['data']['arrayId'])) ? explode(',', $response['data']['arrayId']) : [];
            $productList = json_decode(json_encode($this->iconconfig->getAllProduct()), true);
            $response['data']['productList'] = (!empty($productList['data'])) ? $productList['data'] : [];
            $response['data']['productListInTitle'] = [];
            foreach($response['data']['productListId'] as $productId) {
                foreach($response['data']['productList'] as $product) {
                    if(intval($productId) == $product['productId']) {
                        array_push($response['data']['productListInTitle'], $product);
                    }
                }
            }
            
            $data['data'] = $response['data'];
        }
        $detail_prod_config_title = view('icon_config.detail')->with($data);
        return $detail_prod_config_title->render();
    }

    public function destroy(Request $request) {
        $result = $this->list1();
        $icon_approve = Settings::where('name', 'icon_approve')->get();
        $result['icon_approve'] = (!empty($icon_approve[0]['value'])) ? json_decode($icon_approve[0]['value'], true) : [];
        $icon_config = $this->createSingleRecord($this->model, json_decode($request['formData'], true));

        Icon_approve::create([
            'product_type'          => 'icon_config',
            'product_id'            => $icon_config->uuid,
            'requested_by'          => Auth::check() ? Auth::user()->id : 0,
            'requested_at'          => date('Y-m-d H:i:s', strtotime('now')),
            'approved_type'         => 'delete',
            'approved_status'       => Gate::allows('icon-check-data-permission', Auth::user()) ? 'chopheduyet' : 'chokiemtra',
            'approved_by'           => '',
            'approved_at'           => null,
        ]);
        $this->addToLog(request());
        echo json_encode(['result' => 1, 'message' => 'Đã gửi yêu cầu đến bộ phận kiểm duyệt. Vui lòng chờ kiểm tra và phê duyệt trước khi hoàn tất yêu cầu.']);
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
            $response = json_decode(json_encode($this->iconconfig->getAllProductConfig()), true);
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
