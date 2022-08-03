<?php

namespace App\Http\Controllers\Hi_FPT;
use App\DataTables\Hi_FPT\FtelPhoneDatatable;
use App\Models\AppLog;
use Excel;
use App\Models\Employees;
use App\Services\HrService;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use App\Imports\FtelPhoneImport;
use Illuminate\Support\Facades\Validator;
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

    public function index(FtelPhoneDatatable $dataTable, Request $request){
        return $dataTable->render('ftel-phone.index');
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

    public function stores(FtelPhoneRequest $request)
    {
        if(empty($request->input('action'))) {
            return redirect()->back()->with('message', 'Error!');
        }
        $hrService = new HrService();
        $token = $hrService->loginHr()->authorization;
        $arrPhone = array_map('trim', explode(',', $request->number_phone)); // input
        switch ($request->input('action')) {
            case 'check':
                $data = [];
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
                return redirect()->back()->with( ['data' => $data] );
                break;
            case 'data':
                $data = [];
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
            case 'db':
                $data = [];
                $employee = Employees::whereIn('phone', $arrPhone)->get()->toArray();
                $employee = array_map(function($tag) {
                    return array(
                        'code' => $tag['employee_code'],
                        'name' => $tag['name'],
                        'fullName' => $tag['full_name'],
                        'phoneNumber' => $tag['phone'],
                        'emailAddress' => $tag['emailAddress'],
                        'location_id' => $tag['location_id'],
                        'branch_code' => $tag['branch_code'],
                        'branch_name' => $tag['branch_name'],
                        'area_code' => $tag['code'],
                        'organizationCode' => $tag['organizationCode'],
                        'organizationCodePath' => $tag['organizationCodePath'],
                        'location' => $tag['location'],
                        'isActive' => $tag['isActive'],
                        'checkUpdate' => $tag['checkUpdate'],
                        'created_at' => $tag['created_at'],
                        'organizationNamePath' => $tag['organizationNamePath'],
                        'dept_id' => $tag['dept_id'],
                        'dept_name_1' => $tag['dept_name_1'],
                        'dept_name_2' => $tag['dept_name_2'],
                        'updated_at' => $tag['updated_at'],
                        'updated_from' => $tag['updated_from']
                    );
                }, $employee);
                return redirect()->back()->with( ['data' => json_decode(json_encode($employee), true)] );
                break;
        }
    }

    public function import(Request $request)
    {
        $request->validate(['excel' => 'mimes:xlsx'],['excel.mimes' => 'Sai định dạng file, chỉ chấp nhận file có đuôi .xlsx']);
        $rules_phone = [
            'phone.*' => [
                function ($attribute,$value, $fail){
                    $pattern = '/^(03|05|07|08|09)[0-9, ]*$/';
                    if($value == null) {
                        return $fail("Số có giá trị trống, thử xóa hết form và nhập lại đúng định dạng");
                    }
                    if ((strlen($value)!==10)) {
                        return $fail("Số $value phải đúng 10 kí tự");
                    }
                    if(!preg_match($pattern, $value)) {
                        return $fail("Số $value sai định dạng số điện thoại Việt Nam");
                    }

                }
            ]
        ];
        $excel = Excel::toArray(new FtelPhoneImport, $request->file('excel'));
        $change_to_data_validate = collect($excel)->flatten()->toArray();
        Validator::make(array('phone' => $change_to_data_validate), $rules_phone)->validate();

        $data = implode(',', $change_to_data_validate);
        return response()->json(['data'=>$data, 'message'=>'Import thành công'], 200);
    }
}
