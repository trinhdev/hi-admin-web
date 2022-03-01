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
        $approved_data = $this->model::with(['user_requested_by', 'user_approved_by', 'user_checked_by'])->where('id', $id)->get();
        // dd($approved_data->toArray());
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

        return redirect()->to($url)->with('approved_data', $approved_data[0]);
    }

    public function save(Request $request) {
        $update_data = json_decode($request->data, true);
        $id = $update_data['id'];
        unset($update_data['id']);
        $approved_data = $this->model::where('id', $id)->get();
        $table = '';
        $api_function = '';                                  
        switch($approved_data[0]['product_type']) {
            case 'icon_management':
                $table = 'App\Models\Icon';
                break;
            case 'icon_category':
                $table = 'App\Models\Icon_Category';
                break;
            case 'icon_config':
                $table = 'App\Models\Icon_Config';
                break;
        }
        switch($update_data['approved_status']) {
            case 'kiemtrathatbai':
            case 'chopheduyet':
                $update_data = array_merge($update_data, ['checked_by' => Auth::check() ? Auth::user()->id : 0, 'checked_at' => date('Y-m-d H:i:s', strtotime('now'))]);
                if($update_data['approved_status'] == 'kiemtrathatbai') {
                    $table::where('uuid', $approved_data[0]['product_id'])->delete();
                }
                break;
            case 'pheduyetthatbai':
            case 'dapheduyet':
                if($update_data['approved_status'] == 'dapheduyet') {
                    $result = $this->pushApiApproved($approved_data[0]);
                }
                $update_data = array_merge($update_data, ['approved_by' => Auth::check() ? Auth::user()->id : 0, 'approved_at' => date('Y-m-d H:i:s', strtotime('now'))]);
                $table::where('uuid', $approved_data[0]['product_id'])->delete();
                break;
        }
        
        $module = $this->updateById($this->model, $id, $update_data);
        $this->addToLog($request);
        echo json_encode(['status' => 1, 'message' => 'Success', 'data' => null]);
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
            $data_raw = $this->model::with(['user_requested_by', 'user_approved_by', 'user_checked_by', 'icon', 'icon_category', 'icon_config'])->get();
            $data = $data_raw->toArray();
            foreach($data as $key => &$value) {
                $value['approved_status_name'] = ($icon_approve_list[$value['approved_status']]) ? $icon_approve_list[$value['approved_status']] : $value['approved_status'];
            }
            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function pushApiApproved($request) {
        $function_name = '';
        switch($request->approved_type) {
            case 'create':
                $function_name = 'add';
                break;
            case 'update':
                $function_name = 'update';
                break;
            case 'delete':
                $function_name = 'delete';
                break;
        }

        switch($request->product_type) {
            case 'icon_management':
                $function_name .= 'Product';
                $icon_info = Icon::where('uuid', $request->product_id)->first();
                $params = [
                    'productId'             => (!empty($icon_info->productId)) ? $icon_info->productId : '',
                    'productNameVi'         => (!empty($icon_info->productNameVi)) ? $icon_info->productNameVi : '',
                    'productNameEn'         => (!empty($icon_info->productNameEn)) ? $icon_info->productNameEn : '',
                    'iconUrl'               => (!empty($icon_info->iconUrl)) ? $icon_info->iconUrl : '',
                    'dataActionStaging'     => (!empty($icon_info->dataActionStaging)) ? $icon_info->dataActionStaging : '',
                    'dataActionProduction'  => (!empty($icon_info->dataActionProduction)) ? $icon_info->dataActionProduction : '',
                    'data'                  => (!empty($icon_info->data)) ? $icon_info->data : '',
                    'actionType'            => (!empty($icon_info->actionType)) ? $icon_info->actionType : '',
                    'content'               => (!empty($icon_info->content)) ? $icon_info->content : '',
                    'isNew'                 => (!empty($icon_info->isNew)) ? $icon_info->isNew : '0',
                    'newBeginDay'           => (!empty($icon_info->newBeginDay)) ? $icon_info->newBeginDay : date('Y-m-d H:i:s', strtotime('today midnight')),
                    'newEndDay'             => (!empty($icon_info->newEndDay)) ? $icon_info->newEndDay : date('Y-m-d H:i:s', strtotime('tomorrow midnight')),
                    'isDisplay'             => (!empty($icon_info->isDisplay)) ? $icon_info->isDisplay : '',
                    'displayBeginDay'       => (!empty($icon_info->displayBeginDay)) ? $icon_info->displayBeginDay : date('Y-m-d H:i:s', strtotime('today midnight')),
                    'displayEndDay'         => (!empty($icon_info->displayEndDay)) ? $icon_info->displayEndDay : date('Y-m-d H:i:s', strtotime('tomorrow midnight')),
                    'decriptionVi'          => (!empty($icon_info->decriptionVi)) ? $icon_info->decriptionVi : '',
                    'decriptionEn'          => (!empty($icon_info->decriptionEn)) ? $icon_info->decriptionEn : '',
                    'keywords'              => (!empty($icon_info->keywords)) ? $icon_info->keywords : ''
                ];
                break;
            case 'icon_category':
                $function_name .= 'ProductTitle';
                $category = Icon_Category::where('uuid', $request->product_id)->first();
                
                $params = [
                    'productTitleId'        => (!empty($category->productTitleId)) ? $category->productTitleId : '',
                    'productTitleNameVi'    => (!empty($category->productTitleNameVi)) ? $category->productTitleNameVi : '',
                    'productTitleNameEn'    => (!empty($category->productTitleNameEn)) ? $category->productTitleNameEn : '',
                    'arrayId'               => (!empty($category->arrayId)) ? $category->arrayId : '',
                    'isDeleted'             => '0'
                ];
                break;
            case 'icon_config':
                $function_name .= 'ProductConfig';
                $config = Icon_Config::where('uuid', $request->product_id)->first();
                $params = [
                    'productConfigId'       => (!empty($config->productConfigId)) ? $config->productConfigId : '',
                    'titleVi'               => (!empty($config->titleVi)) ? $config->titleVi : '',
                    'titleEn'               => (!empty($config->titleEn)) ? $config->titleEn : '',
                    'name'                  => (!empty($config->name)) ? $config->name : '',
                    'type'                  => 'PRODUCT',
                    'iconsPerRow'           => (!empty($config->iconsPerRow)) ? $config->iconsPerRow : '',
                    'rowOnPage'             => (!empty($config->rowOnPage)) ? $config->rowOnPage : '',
                    'arrayId'               => (!empty($config->arrayId)) ? $config->arrayId : '',
                    'isDeleted'             => '0',
                ];
                break;
        }
        $result = $this->iconManagement->$function_name($params);
        return $result;
    }
}
