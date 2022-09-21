<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\EmployeesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Services\NewsEventService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

class EmployeesController extends MY_Controller
{
    //
    use DataTrait;
    protected $module_name = 'Employees';
    protected $model_name = "Employees";
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Employees Manage';
        $this->model = $this->getModel('Employees');
    }
    public function index(EmployeesDataTable $dataTable, Request $request) {
        return $dataTable->with([
            'start'=>$request->start,
            'length' => $request->length,
            'order' => $request->order,
            'columns' => $request->columns,
            ])->render('employees.index');
    }

    public function edit($id) {
        $data = parent::edit1();
        return view('employees.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'updated_by' => (!isset($this->user->id)) ? $this->user->id : ''
        ]);
        $this->updateById($this->model, $id, $request->all());
        $this->addToLog(request());
        return redirect()->route('employees.index');
    }

    public function create(Request $request) {
        return view('employees.edit');
    }

    public function store(Request $request) {
        $request->merge([
            'created_by' => (!isset($this->user->id)) ? $this->user->id : ''
        ]);
        $this->createSingleRecord($this->model, $request->all());
        $this->addToLog(request());
        return redirect()->route('employees.index');
    }

    public function destroy($id)
    {
        //
        $this->deleteById($this->model, $id);
        $this->addToLog(request());
        return redirect()->route('employees.index');
    }
}
