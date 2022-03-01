<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\MY_Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Requests\IconSaveRequest;
use App\Models\Icon;
use App\Models\Icon_Category;
use App\Models\Icon_Config;
use App\Models\Icon_approve;
use App\Models\Icon_approve_logs;
use App\Http\Traits\DataTrait;
use \stdClass;
use Yajra\DataTables\DataTables;
use App\Services\IconManagementService;
use App\Services\MailService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class IconmanagementController extends MY_Controller
{
    use DataTrait;
    protected $module_name = 'Icon management';
    protected $model_name = "Icon";
    protected $iconManagement = null;
    protected $mailService = null;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Icon Management';
        $this->iconManagement = new IconManagementService();
        $this->mailService = new MailService();
        $this->model = $this->getModel('Icon');
        $this->to    = filter_var(preg_replace('/\s+/', '', env('ICON_CHANGE_NOTI_TO')));
        $this->cc    = filter_var(preg_replace('/\s+/', '', env('ICON_CHANGE_NOTI_CC')));
        $this->bcc   = filter_var(preg_replace('/\s+/', '', env('ICON_CHANGE_NOTI_BCC')));
    }

    public function index()
    {
        //get view list
        $data = $this->list1();
        $icon_approve = Settings::where('name', 'icon_approve')->get();
        $data['icon_approve'] = (!empty($icon_approve[0]['value'])) ? json_decode($icon_approve[0]['value'], true) : [];
        return view('icon_management.list')->with($data);
    }

    public function edit() {
        $data = [
            'controller'    => 'iconmanagement'
        ];
        $id = request()->segment(3);
        if(!empty($id)) {
            $api_info = json_decode(json_encode($this->iconManagement->getProductById($id)), true);;            

            if(empty($api_info['data'])) {
                $icon = $this->model::withTrashed()->where(['uuid' => $id])->get();
                $api_info['data'] = (!empty($icon[0])) ? json_decode($icon[0], true) : [];
            }
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
        return view('icon_management.edit')->with($data);
    }

    public function save(IconSaveRequest $request) {
        // dd(Auth::user());
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
        $icon_approve = [
            'product_type'          => 'icon_management',
            // 'product_id'            => $icon->uuid,
            'requested_by'          => Auth::check() ? Auth::user()->id : 0,
            'requested_at'          => date('Y-m-d H:i:s', strtotime('now')),
            'approved_status'       => 'chokiemtra',
            'approved_type'         => $approved_status,
            'approved_by'           => '',
            'approved_at'           => null,
        ];

        Icon_approve::create([
            'product_type'          => 'icon_management',
            'product_id'            => $icon->uuid,
            'requested_by'          => Auth::check() ? Auth::user()->id : 0,
            'requested_at'          => date('Y-m-d H:i:s', strtotime('now')),
            'approved_status'       => 'chokiemtra',
            'approved_type'         => $approved_status,
            'approved_by'           => '',
            'approved_at'           => null,
        ]);

        // Send email thong bao
        $sendMailData = [
            'email'                 => Auth::user()->email,
            'name'                  => (!empty(Auth::user()->name)) ? Auth::user()->name : 'N/A',
            'role'                  => Auth::user()->role->role_name,
            'date'                  => date('Y-m-d', strtotime('now')),
            'time'                  => date('H:i:s', strtotime('now')),
            'approved_status'       => (empty($request['productId'])) ? 'Thêm' : 'Sửa',
            'product_type'          => 'sản phẩm',
            'url'                   => route('iconapproved.index')
        ];

        $mailContent = view('icon_approved_email.request_check_email')->with('data', $sendMailData)->render();

        $mailInfo = [
            'FromEmail'             => 'HiFPTsupport@fpt.com.vn',
            'Recipients'            => $this->to,
            'CarbonCopys'           => $this->cc,
            'BlindCarbonCopys'      => $this->bcc,
            'Subject'               => '[ Hi FPT ] Hệ thống CMS vừa có 1 cập nhật mới',
            'Body'                  => $mailContent
        ];
        
        $this->mailService->sendMail($mailInfo);
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
            'requested_by'          => Auth::check() ? Auth::user()->id : 0,
            'requested_at'          => date('Y-m-d H:i:s', strtotime('now')),
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
            $response = json_decode(json_encode($this->iconManagement->getAllProduct()), true);
            $icon_on_review = Icon::get()->toArray();
            $data = [];
            if(!empty($response['data'])) {
                // $data = array_merge($icon_on_review, $response['data']);
                $data = $response['data'];
            }
            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        }
    }
}
