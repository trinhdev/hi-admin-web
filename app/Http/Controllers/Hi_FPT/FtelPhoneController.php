<?php

namespace App\Http\Controllers\Hi_FPT;
use App\Contract\Hi_FPT\FtelPhoneInterface;
use App\DataTables\Hi_FPT\FtelPhoneDatatable;
use App\DataTables\Hi_FPT\FtelPhoneDetailDatatable;
use App\Http\Controllers\BaseController;
use Excel;
use Illuminate\Http\Request;
use App\Imports\FtelPhoneImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\FtelPhoneRequest;

class FtelPhoneController extends BaseController
{
    private $FtelPhoneRepository;
    public function __construct(FtelPhoneInterface $FtelPhoneRepository)
    {
        parent::__construct();
        $this->title = 'FPT Telecom Phone Number';
        $this->FtelPhoneRepository = $FtelPhoneRepository;
    }

    public function index(FtelPhoneDatatable $dataTable, Request $request){
        return $this->FtelPhoneRepository->all($dataTable, $request);
    }

    public function create(FtelPhoneDetailDatatable $dataTable,FtelPhoneRequest $request)
    {
        return $this->FtelPhoneRepository->create($dataTable, $request);
    }

    public function show(Request $request)
    {
        $data = DB::table('employees')->where('phone', $request->phone)->first();
        return response(['data' => $data]);
    }

    public function update(Request $request,$id) {
        $this->addToLog($request);
        return $this->FtelPhoneRepository->update($request, $id);
    }
}
