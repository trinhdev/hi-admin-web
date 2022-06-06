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

    public function pushExport($info, $phone, $data): array
    {
        $data[] = [
            'phoneNumber' => $phone,
            'code' => $info->code ?? null,
            'emailAddress' => $info->emailAddress ?? null,
            'fullName' => $info->fullName ?? null,
            'organizationCodePath' => $info->organizationCodePath ?? null
        ];
        return array_unique($data, SORT_REGULAR);
    }

    public function stores(Request $request)
    {
        if(empty($request->input('action'))) {
            return redirect()->back()->with('message', 'Error!');
        }
        $data = [];
        $hrService = new HrService();
        $token = $hrService->loginHr()->authorization;
        $arrPhone = array_map('trim', explode(',', $request->number_phone)); // input
        switch ($request->input('action')) {
            case 'check':
                $phone = [];
                foreach(array_chunk($arrPhone, 50) as $value) {
                    $dataExport = $hrService->getListInfoEmployee($value, $token);
                    foreach($dataExport as $data_value) {
                        $phone[] = $data_value->phoneNumber;
                    }
                }
                foreach($arrPhone as $key => $value) {
                    $data[$key]['phoneNumber'] = $value;
                    foreach($phone as $p) {
                        if($value == $p) {
                            $data[$key]['check'] = "TRUE";
                        } else {
                            $data[$key]['check'] = "FALSE";
                        }
                    }
                }
                return redirect()->back()->with( ['data' => json_decode(json_encode($data), true)] );
                break;
            case 'data':
                $dataUpdateDB = [];
                $dataDB = $this->model->whereIn('number_phone', $arrPhone)->get(); // data DB
                $arrPhoneDB = $dataDB->pluck('number_phone')->toArray(); // data phone DB
                if(!empty($dataDB)) {
                    foreach($dataDB as $value)
                    {
                        if($value->updated_at <= now()->subWeeks()) {
                            $dataUpdateDB[] = $value->number_phone; // push vào mảng để gọi api 1 lần
                        } else {
                            $data = $this->pushExport($value, $value->number_phone, $data);
                        }
                    }
                }
                $dataAPI = array_unique(array_merge(array_diff($arrPhone, $arrPhoneDB),$dataUpdateDB)); // [data input api] + [data > 7day] => call api
                foreach(array_chunk($dataAPI, 50) as $value) {
                    $dataExport = $hrService->getListInfoEmployee($value, $token);
                    foreach($dataExport as $data_value) {
                        $data[] = $data_value;
                        $dataSaveDb = [];
                        $dataSaveDb['number_phone'] = $data_value->phoneNumber;
                        $dataSaveDb['code'] = $data_value->code;
                        $dataSaveDb['emailAddress'] = $data_value->emailAddress;
                        $dataSaveDb['fullName'] = $data_value->fullName;
                        $dataSaveDb['response'] = json_encode($data_value);
                        $dataSaveDb['organizationNamePath'] = $data_value->organizationNamePath;
                        $dataSaveDb['organizationCodePath'] = $data_value->organizationCodePath;
                        $dataSaveDb['created_by'] = $this->user->id;
                        $dataSaveDb['updated_at'] = now();
                        $saveDB[] = $dataSaveDb;
                    }
                }
                if(empty($saveDB)) {
                    return redirect()->back()->with( ['data' => json_decode(json_encode($data), true)] );
                }
                $this->model->upsert(
                    $saveDB,
                    ['code'],
                    ['number_phone','emailAddress','fullName','response','organizationNamePath','organizationCodePath'],
                );
                return redirect()->back()->with( ['data' => json_decode(json_encode($data), true)] );
                break;
        }
    }

    public function import(Request $request)
    {
        $request->validate(['excel' => 'mimes:xlsx'],['excel.mimes' => 'Sai định dạng file, chỉ chấp nhận file có đuôi .xlsx']);
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
