<?php

namespace App\Http\Controllers;
use App\Helpers\LogactivitiesHelper;
use App\Http\Traits\DataTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class LogactivitiesController extends MY_Controller
{
    //
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->getModel('Log_activities');
    }
    public function index()
    {
        // $logs = LogactivitiesHelper::logActivityLists();
        return view('log.list');
    }
    public function initDatatable(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->model::query();
            $json =   DataTables::of($data)
                ->editColumn('method', function($row){
                    return view('log.label')->with(['row' => $row]);
                })
                ->editColumn('url', function($row){
                    return '<p class="text-success font-weight-bolder">'.$row->url.'</p>';
                })
                ->editColumn('ip', function($row){
                    return '<p class="text-danger font-weight-bolder">'.$row->ip.'</p>';
                })
                ->addColumn('action', function ($row) {
                    return view('layouts.button.action')->with(['row' => $row, 'module' => 'logactivities']);
                })
                ->rawColumns(['method','url','ip'])
                ->make(true);
            return $json;
        }
    }

    public function destroy($id)
    {
        $this->deleteById($this->model, $id);
        return redirect()->back();
    }
}
