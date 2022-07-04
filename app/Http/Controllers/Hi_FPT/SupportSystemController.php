<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\SupportSystemDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Services\NewsEventService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

use App\Models\Settings;

class SupportSystemController extends MY_Controller
{
    //
    use DataTrait;
    protected $module_name = 'SupportSystem';
    protected $model_name = "SupportSystem";
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Support System Manage';
        $this->model = $this->getModel('SupportSystem');
    }
    public function index(SupportSystemDataTable $dataTable, Request $request) {
        
        return $dataTable->with([
            'start'=>$request->start,
            'length' => $request->length,
            'order' => $request->order,
            'columns' => $request->columns,
            ])->render('supportsystem.index');
    }

    public function edit($id) {
        $data = parent::edit1();
        $support_code_group = Settings::where('name', 'support_system_group')->get()->toArray();
        $support_code_status = Settings::where('name', 'support_system_status')->get()->toArray();
        $support_system_error_type = Settings::where('name', 'support_system_error_type')->get()->toArray();
        $data['support_system_group'] = (!empty($support_code_group[0]['value'])) ? json_decode($support_code_group[0]['value'], true) : [];
        $data['support_code_status'] = (!empty($support_code_status[0]['value'])) ? json_decode($support_code_status[0]['value'], true) : [];
        $data['support_system_error_type'] = (!empty($support_system_error_type[0]['value'])) ? json_decode($support_system_error_type[0]['value'], true) : [];
        return view('supportsystem.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'updated_by' => (!isset($this->user->id)) ? $this->user->id : ''
        ]);
        $this->updateById($this->model, $id, $request->all());
        $this->addToLog(request());
        return redirect()->route('supportsystem.index');
    }

    public function create(Request $request) {
        $data = [];
        $support_code_group = Settings::where('name', 'support_system_group')->get()->toArray();
        $support_code_status = Settings::where('name', 'support_system_status')->get()->toArray();
        $support_system_error_type = Settings::where('name', 'support_system_error_type')->get()->toArray();
        $data['support_system_group'] = (!empty($support_code_group[0]['value'])) ? json_decode($support_code_group[0]['value'], true) : [];
        $data['support_code_status'] = (!empty($support_code_status[0]['value'])) ? json_decode($support_code_status[0]['value'], true) : [];
        $data['support_system_error_type'] = (!empty($support_system_error_type[0]['value'])) ? json_decode($support_system_error_type[0]['value'], true) : [];
        return view('supportsystem.edit')->with($data);
    }

    public function store(Request $request) {
        $request->merge([
            'created_by' => (!isset($this->user->id)) ? $this->user->id : ''
        ]);
        $this->createSingleRecord($this->model, $request->all());
        $this->addToLog(request());
        return redirect()->route('supportsystem.index');
    }

    public function destroy($id)
    {
        //
        $this->deleteById($this->model, $id);
        $this->addToLog(request());
        return redirect()->route('supportsystem.index');
    }
}
