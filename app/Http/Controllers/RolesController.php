<?php

namespace App\Http\Controllers;

use App\Http\Traits\DataTrait;
use App\Models\Acl_Roles;
use App\Models\Modules;
use App\Models\Roles;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use stdClass;

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
        $data['acls'] = Roles::find($data['data']['id'])->acls;
        return view('roles.edit')->with($data);
    }
    public function save(){
        $model_groups = $this->getModel('roles');
        $request = request()->all();
        if (request()->isMethod("post")) {
            DB::transaction(function() use($request,$model_groups)
            {

                $role = new stdClass();
                if (empty($request['id']))
                    $role = $this->createSingleRecord($model_groups, $request);
                else {
                    $data['role_name'] = $request['role_name'];
                    $this->updateById($model_groups, $request['id'], $data);
                    $role->id = $request['id'];
                }  
                //create and update permission
                // dd($request);
                if(isset($request['module_id'])){
                    $arrayDataAcl = [];
                    foreach($request['module_id'] as $key => $val){
                        $dataAcl = [];
                        $dataAcl['role_id'] = $role->id;
                        $dataAcl['module_id'] = $val;
                        $dataAcl['view'] = $request['view'][$key];
                        $dataAcl['delete'] = $request['delete'][$key];
                        $dataAcl['create'] = $request['create'][$key];
                        $dataAcl['update'] = $request['update'][$key];
                        $arrayDataAcl[] = $dataAcl;
                    }
                    DB::table('acl_roles')->upsert($arrayDataAcl,['role_id','module_id'],['view','delete','create','update']);
                    // dd($arrayDataAcl);
                }
                
            });
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
