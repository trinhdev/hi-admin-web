<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ModuleDataTable;
use App\Http\Controllers\MY_Controller;
use App\Models\Modules;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use App\Models\Group_Module;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
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

    public function store(Request $request)
    {
        $request->validate([
            'module_name' => 'required|unique:modules|max:255',
            'uri' => 'required',
        ]);
        $request->merge([
            'status' => !!isset($request->status)
        ]);

        $permission = str_replace('-', '', ucwords($request->uri, '-'));
        Permission::create(['name' => $permission.'-view'])
            ->create(['name' => $permission.'-create'])
            ->create(['name' => $permission.'-edit'])
            ->create(['name' => $permission.'-import'])
            ->create(['name' => $permission.'-export'])
            ->create(['name' => $permission.'-delete']);

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
            'status' => !!isset($request->status)
        ]);

        $module = Modules::findOrFail($request->id);
        $permission_old = str_replace('-', '', ucwords($module->uri, '-'));
        $permission_new = str_replace('-', '', ucwords($request->uri, '-'));
        Permission::where('name', 'like', $permission_old . "-view")->updateOrCreate([],["name" => $permission_new."-view"]);
        Permission::where('name', 'like', $permission_old . "-create")->updateOrCreate([],["name" => $permission_new."-create"]);
        Permission::where('name', 'like', $permission_old . "-edit")->updateOrCreate([],["name" => $permission_new."-edit"]);
        Permission::where('name', 'like', $permission_old . "-import")->updateOrCreate([],["name" => $permission_new."-import"]);
        Permission::where('name', 'like', $permission_old . "-export")->updateOrCreate([],["name" => $permission_new."-export"]);
        Permission::where('name', 'like', $permission_old . "-delete")->updateOrCreate([],["name" => $permission_new."-delete"]);
        $module->update($request->all());
        $this->addToLog($request);
        return response(['success' => 'success', 'message'=> 'Update successfully!']);
    }

    public function destroy(Request $request)
    {
        $module = Modules::findOrFail($request->id);
        $permission_id = Permission::where('name', 'like', str_replace('-', '', ucwords($module->uri, '-')) . "-%")->pluck('id');
        Permission::destroy($permission_id);
        $module->delete();
        $this->addToLog(request());
        return response()->json(['message' => 'Delete Successfully!']);
    }
}
