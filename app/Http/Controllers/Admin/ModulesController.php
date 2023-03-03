<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ModuleDataTable;
use App\Http\Controllers\MY_Controller;
use App\Models\Modules;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use App\Models\Group_Module;
use Yajra\DataTables\DataTables;
use \stdClass;

class ModulesController extends MY_Controller
{
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'List Module';
        $this->model = $this->getModel('Modules');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ModuleDataTable $dataTable, Request $request)
    {
        $list_icon = explode(",", file_get_contents(public_path('fontawsome.txt')));
        $list_group_module = $this->getAll(new Group_Module);
        return $dataTable->render('modules.index', ['list_icon' => $list_icon, 'list_group_module' => $list_group_module]);
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
        return view('modules.edit')->with('module', $module);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'module_name' => 'required|unique:modules|max:255',
            'uri' => 'required',
        ]);
        $request->merge([
            'status' => (!isset($request->status)) ? false : true
        ]);
        $module = $this->createSingleRecord($this->model, $request->all());
        $this->addToLog(request());
        return response(['success' => 'success', 'message'=> 'Add new successfully!']);
    }

    public function show(Request $request)
    {
        $module = Modules::findOrFail($request->id);
        return response(['data' => $module]);
    }

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
        $this->addToLog($request);
        return response(['success' => 'success', 'message'=> 'Update successfully!']);
    }

    public function destroy(Request $request)
    {
        $this->deleteById($this->model, $request->id);
        $this->addToLog(request());
        return response()->json(['message' => 'Delete Successfully!']);
    }
}
