<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MY_Controller;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use Yajra\DataTables\DataTables;
use \stdClass;

use App\Models\Group_Module;

class GroupmoduleController extends MY_Controller
{
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Group Module';
        $this->model = $this->getModel('Group_Module');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('groupmodule.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groupmodule = new stdClass();
        $groupmodule->id = '';
        $groupmodule->group_module_name = '';
        return view('groupmodule.edit')->with('groupmodule', $groupmodule);
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
            'group_module_name' => 'required|unique:group_module|max:255',
        ]);
        $group_module = $this->createSingleRecord($this->model, $request->all());
        $this->addToLog(request());
        return redirect()->route('groupmodule.index');
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
        $group_module = $this->getSigleRecord($this->model, $id);
        return view('groupmodule.edit')->with('groupmodule', $group_module);
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
        $group_module = $this->updateById($this->model, $id, $request->all());
        $this->addToLog($request);
        return redirect()->route('groupmodule.index');
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
        $this->addToLog(request());
        return redirect()->route('groupmodule.index');
    }

    public function initDatatable(Request $request){
        if($request->ajax()){
            $data = $this->model::query();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return view('layouts.button.action')->with(['row'=>$row,'module'=>'groupmodule']);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
