<?php

namespace App\Http\Controllers\Hi_FPT;
use Excel;
use App\Models\FtelPhone;
use App\Services\HrService;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use App\Imports\FtelPhoneImport;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\FtelPhoneRequest;

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
        $codePath = explode('/', $getInfo->organizationCodePath);
        array_push($dataExport, [
            'number_phone'=> $phone,
            'code' => $getInfo->code,
            'emailAddress' => $getInfo->emailAddress,
            'fullName'=> $getInfo->fullName,
            'organizationCodePath' => $codePath[2], 
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
        $dataExport = array();
        $dataPhoneDB = array();
        $hrService = new HrService();
        $token = $hrService->loginHr()->authorization;
        $arrPhone = explode(',',$request->number_phone);
        $dataDB = $this->model->whereIn('number_phone', $arrPhone)->get();
        if(isset($dataDB)) {
            foreach($dataDB as $key => $value) // data co trong db > 7 day -> van goi api de update
            {
                if (now()->subWeeks() >= $value->updated_at) {
                    $getInfo = $hrService->getInfoEmployee($value->number_phone,$token);
                    if(isset($getInfo)) {
                        $value->update($this->dataDB($getInfo, $value->number_phone));
                        $dataExport = $this->pushExport($getInfo, $value->number_phone, $dataExport);
                    } else {
                        $value->update([ 'updated_at' => now() ]);
                    }
                } else {
                    if(isset($value->code)) {
                        $dataExport = $this->pushExport($value, $value->number_phone, $dataExport); // sai trong TH data co db nhung api khong co (nhan vien nghi viec)
                    }
                }
                array_push($dataPhoneDB, $value->number_phone);
            }
        }

        $dataAPI = array_diff($arrPhone, $dataPhoneDB);
        if(isset($dataAPI)) {
            foreach($dataAPI as $key => $value) // data ko co trong db -> goi api check
            {
                $getInfo = $hrService->getInfoEmployee($value,$token);
                if(empty($getInfo)) {
                    $this->model->create(['number_phone'=> $value, 'created_by' => $this->user->id]);
                } else {                                  
                    $code = $this->model->where('code',$getInfo->code)->first();
                    if(isset($code)) {
                        $code->update($this->dataDB($getInfo, $value));
                        $dataExport = $this->pushExport($getInfo, $value, $dataExport);
                    } else {
                        $this->model->create($this->dataDB($getInfo, $value));
                        $dataExport = $this->pushExport($getInfo, $value, $dataExport);
                    }               
                }
            }
        }
        return redirect()->back()->with( ['data' => $dataExport] );
    }

    public function import(Request $request) 
    {
        $validate = $request->validate(['excel' => 'mimes:xlsx'],['excel.mimes' => 'Sai định dạng file, chỉ chấp nhận file có đuôi .xlsx']);
        Excel::import(new FtelPhoneImport, $request->file('excel'));
        return redirect()->back();
    }

    public function initDatatable(Request $request){
        if($request->ajax()){
            $data = $this->model->where('code', '!=' , 'null');
            return  DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('created_by',function($row){
                return !empty($row->created_by) ? $row->createdBy->email : '';
            })
            ->addColumn('action', function($row){
                return view('layouts.button.action')->with(['row'=>$row,'module'=>'ftel_phone']);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
