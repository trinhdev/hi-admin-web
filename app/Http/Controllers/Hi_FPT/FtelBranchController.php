<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\FtelBranchDataTable;
use App\Http\Controllers\BaseController;
use App\Http\Traits\DataTrait;
use App\Models\Ftel_Branch;
use Illuminate\Http\Request;

class FtelBranchController extends BaseController
{
    //
    use DataTrait;
    protected $module_name = 'Customer Locations';
    protected $model_name = "Ftel_Branch";
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Customer Locations Manage';
        $this->model = new Ftel_Branch();
    }
    public function index(FtelBranchDataTable $dataTable, Request $request) {
        return $dataTable->with([
            'start'=>$request->start,
            'length' => $request->length,
            'order' => $request->order,
            'columns' => $request->columns,
            ])->render('ftel_branch.index');
    }

    public function edit($customer_location_id) {
        $data = parent::edit1();
        return view('ftel_branch.edit')->with($data);
    }

    public function update(Request $request, $customer_location_id)
    {
        $request->merge([
            'updated_by' => (!isset($this->user->id)) ? $this->user->id : ''
        ]);
        unset($request['_token']);
        unset($request['_method']);
        unset($request['password_confirmation']);
        $this->model->where('customer_location_id', $customer_location_id)->update($request->all());
        $this->addToLog(request());
        return redirect()->route('ftel_branch.index');
    }

    public function create(Request $request) {
        return view('ftel_branch.edit');
    }

    public function store(Request $request) {
        $request->merge([
            'created_by' => (!isset($this->user->id)) ? $this->user->id : ''
        ]);
        unset($request['_token']);
        unset($request['_method']);
        unset($request['password_confirmation']);
        // $this->createSingleRecord($this->model, $request->all());
        $this->model->create($request->all());
        $this->addToLog(request());
        return redirect()->route('ftel_branch.index');
    }

    public function destroy($customer_location_id)
    {
        //
        $this->deleteById($this->model, $customer_location_id);
        $this->addToLog(request());
        return redirect()->route('ftel_branch.index');
    }
}
