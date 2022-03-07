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

    public function pushExport($info, $phone, $data)
    {
        //dd($info->organizationCodePath);
        array_push($data, [
            'phoneNumber'=> $phone,
            'code' => $info->code,
            'emailAddress' => $info->emailAddress,
            'fullName'=> $info->fullName,
            'organizationCodePath' => $info->organizationCodePath
        ]);
        $data = array_unique($data, SORT_REGULAR);
        return $data;
    }
    public function dataDB($info)
    {
        $data = [
            'number_phone' => $info->phoneNumber,
            'code' => $info->code,
            'emailAddress' => $info->emailAddress,
            'fullName' => $info->fullName,
            'response' => json_encode($info),
            'organizationNamePath' => $info->organizationNamePath, 
            'organizationCodePath' => $info->organizationCodePath,
            'created_by' => $this->user->id,
            'updated_at' => now(),
        ];
        return $data;
    }

    public function stores(FtelPhoneRequest $request)
    {  
        $data = [];
        $dataPhoneDB = [];
        $hrService = new HrService();
        $token = $hrService->loginHr()->authorization;
        $arrPhone = array_map('trim', explode(',', $request->number_phone));
        $dataDB = $this->model->whereIn('number_phone', $arrPhone)->get();
        
        if(!empty($dataDB)) {
            foreach($dataDB as $value)
            {
                if($value->updated_at <= now()->subWeeks()) {
                    $info = $hrService->getInfoEmployee($value->number_phone, $token);
                    if(!empty($info)) {
                        $value->update($this->dataDB($info));
                        $data = $this->pushExport($info, $info->phoneNumber, $data);
                    } else {
                        $value->update([ 'updated_at' => now() ]);
                    }
                }
                if(!empty($value->code)) {
                    $data = $this->pushExport($value, $value->number_phone, $data);
                }
                $dataPhoneDB[] = $value->number_phone;
            }
        }
        dd($data);
        
        $dataAPI = array_diff($arrPhone, $dataPhoneDB);
        $chunk50 = array_chunk($dataAPI, 50);
        foreach($chunk50 as $value) {
            $dataExport = $hrService->getListInfoEmployee($value, $token);
            foreach($dataExport as $data_value) {
                $this->model->create($this->dataDB($data_value));
                $data[] = $data_value;
            }
        }

        return redirect()->back()->with( ['data' => json_decode(json_encode($data), true)] );
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
