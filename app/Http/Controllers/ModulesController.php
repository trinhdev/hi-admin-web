<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Traits\DataTrait;
use App\Models\Modules;
use App\Models\Group_Module;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
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
        $controllers = [];
        $list_controller = array_diff(scandir(app_path('Http/Controllers')), ['.', '..', 'Auth', 'Controller.php', 'MY_Controller.php']);
        foreach ($list_controller as $path) {
            $controllers[] = strtolower(str_replace('Controller.php', '', $path));
        }
        $module_list = $this->getAll(new Modules);
        $list_group_module = $this->getAll(new Group_Module);
        $module = new stdClass();
        $module->id = '';
        $module->module_name = '';
        $module->uri = '';
        $module->group_module_id = '';
        $module->status = True;
        $module->list_uri = array_unique($controllers);
        $module->list_modules = $module_list;
        $module->list_group_module = $list_group_module;
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
        $controllers = [];
        $list_controller = array_diff(scandir(app_path('Http/Controllers')), ['.', '..', 'Auth', 'Controller.php', 'MY_Controller.php']);
        foreach ($list_controller as $path) {
            $controllers[] = strtolower(str_replace('Controller.php', '', $path));
        }
        $list_group_module = $this->getAll(new Group_Module);
        $module = $this->getSigleRecord(new Modules, $id);
        // dd($module);
        $module->list_uri = array_unique($controllers);
        $module->list_group_module = $list_group_module;
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
            $data = $this->model::query();
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
