<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use \stdClass;

use App\Models\Settings;

class SettingsController extends MY_Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->getModel('Settings');
    }

    public function index()
    {
        return view('settings.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting = new stdClass();
        $setting->id = '';
        $setting->name = '';
        $setting->value = '[]';
        return view('settings.form')->with('setting', $setting);
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
            'name'  => 'required|unique:settings|max:255',
            'value' => 'json'
        ]);
        $request->merge([
            'value' => (isset($request->value)) ? '[' . implode(",", $request->value) . ']' : "[]"
        ]);
        $setting = $this->createSingleRecord($this->model, $request->all());
        return redirect('/settings');
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
        $setting = $this->getSigleRecord($this->model, $id);
        return view('settings.form')->with('setting', $setting);
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
            'name' => 'required|max:255',
        ]);
        $request->merge([
            'value' => (isset($request->value)) ? '[' . implode(",", $request->value) . ']' : "[]",
            'value' => 'json'
        ]);
        $setting = $this->updateById($this->model, $id, $request->all());
        return redirect('/settings');
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
        return redirect('/settings');
    }

    public function initDatatable(Request $request){
        if($request->ajax()){
            $data = $this->model::query();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return view('layouts.button.action')->with(['row'=>$row,'module'=>'settings']);
            })
            ->editColumn('group_module_id',function($row){
                return !empty($row->group_module_id) ? $row->parent->group_module_name : '';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
