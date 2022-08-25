<?php

namespace App\Http\Controllers\Hi_FPT;
use App\Contract\Hi_FPT\FtelPhoneInterface;
use App\DataTables\Hi_FPT\FtelPhoneDatatable;
use Excel;
use App\Models\Employees;
use App\Services\HrService;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use App\Imports\FtelPhoneImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\FtelPhoneRequest;

class FtelPhoneController extends MY_Controller
{
    use DataTrait;
    private $FtelPhoneRepository;
    public function __construct(FtelPhoneInterface $FtelPhoneRepository)
    {
        parent::__construct();
        $this->title = 'FPT Telecom Phone Number';
        $this->model = $this->getModel('FtelPhone');
        $this->FtelPhoneRepository = $FtelPhoneRepository;
    }

    public function index(FtelPhoneDatatable $dataTable, Request $request){
        return $this->FtelPhoneRepository->all($dataTable, $request);
    }

    public function create()
    {
        return view('ftel-phone.create');
    }

    public function edit($id)
    {
        $data = DB::table('employees')->find($id);
        return view('ftel-phone.edit', compact('data'));
    }

    public function update(Request $request,$id) {
        $this->addToLog($request);
        return $this->FtelPhoneRepository->update($request, $id);
    }

    public function stores(FtelPhoneRequest $request)
    {
        $this->addToLog($request);
        return $this->FtelPhoneRepository->store($request);
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
