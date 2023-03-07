<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\CustomerLocationsDataTable;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Models\Customer_Locations;
use App\Services\NewsEventService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

class CustomerLocationsController extends BaseController
{
    //
    use DataTrait;
    protected $module_name = 'Customer Locations';
    protected $model_name = "Customer_Locations";
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Customer Locations Manage';
        $this->model = new Customer_Locations();;
    }
    public function index(CustomerLocationsDataTable $dataTable, Request $request) {
        return $dataTable->with([
            'start'=>$request->start,
            'length' => $request->length,
            'order' => $request->order,
            'columns' => $request->columns,
            ])->render('customer_locations.index');
    }

    public function edit($customer_location_id) {
        $data = parent::edit1();
        return view('customer_locations.edit')->with($data);
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
        return redirect()->route('customer_locations.index');
    }

    public function create(Request $request) {
        return view('customer_locations.edit');
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
        return redirect()->route('customer_locations.index');
    }

    public function destroy($customer_location_id)
    {
        //
        $this->deleteById($this->model, $customer_location_id);
        $this->addToLog(request());
        return redirect()->route('customer_locations.index');
    }
}
