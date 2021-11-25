<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Traits\DataTrait;
use App\Models\Modules;
use App\Models\Group_Module;
use App\Models\Settings;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use \stdClass;

class ModulesController extends MY_Controller
{
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->getModel('Modules');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $module_list = $this->getAll($this->model);
        $list_group_module = $this->getAll(new Group_Module);
        $list_icon = explode(",", file_get_contents(public_path('fontawsome.txt')));
        $module = new stdClass();
        $module->id = '';
        $module->module_name = '';
        $module->uri = '';
        $module->group_module_id = '';
        $module->icon = '';
        $module->status = True;
        $module->list_modules = $module_list;
        $module->list_group_module = $list_group_module;
        $module->list_icon = $list_icon;
        return view('modules.form')->with('module', $module);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'module_name' => 'required|unique:modules|max:255',
            'uri' => 'required',
        ]);
        $request->merge([
            'status' => (!isset($request->status)) ? false : true
        ]);
        $module = $this->createSingleRecord($this->model, $request->all());
        return redirect('/modules');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list_group_module = $this->getAll(new Group_Module);
        $list_icon = explode(",", file_get_contents(public_path('fontawsome.txt')));
        $module = $this->getSigleRecord($this->model, $id);
        $module->list_group_module = $list_group_module;
        $module->list_icon = $list_icon;
        return view('modules.form')->with('module', $module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'module_name' => 'required|max:255',
            'uri' => 'required',
        ]);
        $request->merge([
            'status' => (!isset($request->status)) ? false : true
        ]);
        $module = $this->updateById($this->model, $id, $request->all());
        return redirect('/modules');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->deleteById($this->model, $id);
        return redirect('/modules');
    }
    
    public function initDatatable(Request $request){
        if($request->ajax()){
            $data = $this->model::query()->with('parent');
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return view('layouts.button.action')->with(['row'=>$row,'module'=>'modules']);
            })
            ->editColumn('group_module_id',function($row){
                return !empty($row->group_module_id) ? $row->parent->group_module_name : '';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
