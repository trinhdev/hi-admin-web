<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\GroupDataTable;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GroupsController extends MY_Controller
{
    use DataTrait;
    protected $module_name = 'Groups';
    protected $model_name = "Groups";

    public function __construct()
    {
        parent::__construct();
        $this->title = 'List Group';
        $this->model = $this->getModel('Groups');
    }

    public function index(GroupDataTable $dataTable, Request $request)
    {
        return $dataTable->render('groups.index', ['data' => $this->list1()]);
    }


    public function edit($id = null)
    {
        // get view edit
        $data = parent::edit1();
        return view('groups.edit')->with($data);
    }
    public function save(){
        $request = request()->all();
        if (request()->isMethod("post")) {
            if (empty($request['id']))
                $this->createSingleRecord($this->model, $request);
            else {
                $data['group_name'] = $request['group_name'];
                $this->updateById($this->model, $request['id'], $data);
            }
            $this->addToLog(request());
        }
        return redirect()->route('groups.index');
    }

    public function destroy(Request $request)
    {
        $this->deleteById($this->model, $request->id);
        $this->addToLog(request());
        return response()->json(['message' => 'Delete Successfully!']);
    }
    public function getList(Request $request){
        if ($request->ajax()) {
            $data = $this->model::query()->with('createdBy');
            $json = DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return view('layouts.button.action')->with(['row' => $row, 'module' => 'groups']);
                })
                ->editColumn('created_by',function($row){
                    return !empty($row->createdBy) ? $row->createdBy->email : '';
                })
                ->make(true);
            return $json;
        }

    }
}
