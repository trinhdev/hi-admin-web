<?php

namespace App\Http\Controllers\Hi_FPT;
use Excel;
use Carbon\Carbon;
use App\Exports\Export;
use App\Models\FtelPhone;
use App\Services\HrService;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use App\Imports\FtelPhoneImport;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\FtelPhoneRequest;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Session\Session;

class FtelPhoneController extends MY_Controller
{
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Phone';
        $this->model = $this->getModel('FtelPhone');
    }

    public function index()
    {
        return view('ftel-phone.index');
    }

    public function create()
    {
        return view('ftel-phone.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * Số không tồn tại trong db -> chạy qua HR lấy info save ( nếu không có info thì lưu sdt, nếu thông tin đã có trong db thì update lại sdt mới )
     * Số tồn tại trong db -> update lại nếu time > 1 tuần còn không bỏ qua
     * @return \Illuminate\Http\Response
     */
    public function pushExport($getInfo, $phone, $dataExport)
    {
        array_push($dataExport, [
            'number_phone'=> $phone,
            'code' => $getInfo->code,
            'emailAddress' => $getInfo->emailAddress,
            'fullName'=> $getInfo->fullName,
            'organizationCodePath' => substr( $getInfo->organizationCodePath, 13, 6 ), 
        ]);
        $dataExport = array_unique($dataExport, SORT_REGULAR);
        return $dataExport;
    }
    public function dataDB($getInfo, $phone)
    {
        $data = [
            'number_phone' => $phone,
            'code' => $getInfo->code,
            'emailAddress' => $getInfo->emailAddress,
            'fullName' => $getInfo->fullName,
            'response' => json_encode($getInfo),
            'organizationNamePath' => $getInfo->organizationNamePath, 
            'organizationCodePath' => $getInfo->organizationCodePath,
            'created_by' => $this->user->id
        ];
        return $data;
    }
    public function store(FtelPhoneRequest $request)
    {
        $arrPhone = explode(',',$request->number_phone);
        $hrService = new HrService();
        $token = $hrService->loginHr()->authorization;
        $dataExport = array();
        foreach($arrPhone as $arPhone)
        {
            $phone = trim($arPhone);
            $findPhone = $this->model->where('number_phone',$phone)->first();
            if(isset($findPhone) && now()->subWeeks() >= $findPhone->updated_at) {
                $getInfo = $hrService->getInfoEmployee($phone,$token);
                if(isset($getInfo)) {
                    $findPhone->update($this->dataDB($getInfo, $phone));
                    $dataExport = $this->pushExport($getInfo, $phone, $dataExport);
                } else {
                    $findPhone->update([ 'updated_at' => now() ]);
                }
            } elseif(isset($findPhone)) {
                $getInfo = $hrService->getInfoEmployee($phone,$token);
                if(isset($getInfo)) {
                    $dataExport = $this->pushExport($getInfo, $phone, $dataExport);
                }
            } elseif(empty($findPhone)) {
                $getInfo = $hrService->getInfoEmployee($phone,$token);
                if(empty($getInfo)) {
                    $this->model->create([ 'number_phone'=> $phone, 'created_by' => $this->user->id ]);
                } else {                                  
                    $code = $this->model->where('code',$getInfo->code)->first();
                    if(isset($code)) {
                        $code->update($this->dataDB($getInfo, $phone));
                        $dataExport = $this->pushExport($getInfo, $phone, $dataExport);
                    } else {
                        $this->model->create($this->dataDB($getInfo, $phone));
                        $dataExport = $this->pushExport($getInfo, $phone, $dataExport);
                    }               
                }
            }
        }
        return view('ftel-phone.edit')->with( ['data' => $dataExport] );
    }

    public function export(Request $request)
    {
        $data = json_decode($request->data, TRUE);
        return Excel::download(new Export($data), 'FtelPhone_'.now().'.xlsx');
    }

    public function import(Request $request) 
    {
        $validate = $request->validate(['excel' => 'mimes:xlsx'],['excel.mimes' => 'Sai định dạng file, chỉ chấp nhận file có đuôi .xlsx']);
        $import = new FtelPhoneImport;
        if($validate) {
            Excel::import($import, $request->file('excel'));
        }
        return view('ftel-phone.edit');
    }

    public function initDatatable(Request $request){
        if($request->ajax()){
            $data = $this->model->where('code', '!=' , 'null');
            return  DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return view('layouts.button.action')->with(['row'=>$row,'module'=>'ftel_phone']);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
