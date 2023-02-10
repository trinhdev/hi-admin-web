<?php

namespace App\Http\Controllers\Hi_FPT;
use App\Contract\Hi_FPT\FtelPhoneInterface;
use App\DataTables\Hi_FPT\FtelPhoneDatatable;
use Excel;
use Illuminate\Http\Request;
use App\Imports\FtelPhoneImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\FtelPhoneRequest;

class FtelPhoneController extends MY_Controller
{
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
}
