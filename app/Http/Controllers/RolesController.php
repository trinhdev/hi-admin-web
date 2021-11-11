<?php

namespace App\Http\Controllers;

use App\Http\Traits\DataTrait;
use App\Models\Modules;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RolesController extends MY_Controller
{
    use DataTrait;
    protected $module_name = 'Roles';
    protected $model_name = "Roles";

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->getModel('Roles');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get view list
        $data = $this->list1();
        return view('roles.list')->with($data);
    }

    public function edit()
    {
        // get view edit
        $data = parent::edit1();
        $data['modules'] = Modules::query()->get();
        return view('roles.edit')->with($data);
    }
    public function save(){
        $model_groups = $this->getModel('roles');
        $request = request()->all();
        if (request()->isMethod("post")) {
            if (empty($request['id']))
                $this->createSingleRecord($model_groups, $request);
            else {
                $data['roles_name'] = $request['roles_name'];
                $this->updateById($model_groups, $request['id'], $data);
            }
        }
        return $this->redirect($this->controller_name);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->deleteById($this->model, $id);
        return redirect('/roles');
    }
    public function getList(Request $request){
        if ($request->ajax()) {
            $data = $this->model::query();
            $json =   DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return view('layouts.button.action')->with(['row' => $row, 'module' => 'roles']);
                })
                ->make(true);
            return $json;
        }

    }
}
