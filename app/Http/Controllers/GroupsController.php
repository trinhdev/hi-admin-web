<?php

namespace App\Http\Controllers;

use App\Http\Traits\DataTrait;
use App\Models\Roles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class GroupsController extends MY_Controller
{
    use DataTrait;
    protected $module_name = 'Groups';
    protected $model_name = "Groups";

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->getModel('Groups');
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
        return view('groups.list')->with($data);
    }


    public function edit()
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
        $this->addToLog(request());
        return redirect('/groups');
    }
    public function getList(Request $request){
        if ($request->ajax()) {
            $data = $this->model::query();
            $json =   DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return view('layouts.button.action')->with(['row' => $row, 'module' => 'groups']);
                })
                ->make(true);
            return $json;
        }

    }
}