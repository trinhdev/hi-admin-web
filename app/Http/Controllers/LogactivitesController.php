<?php

namespace App\Http\Controllers;
use App\Helpers\LogactivitiesHelper;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class LogactivitesController extends MY_Controller
{
    //
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->getModel('Log_activities');
    }
    public function index()
    {
        $logs = LogactivitiesHelper::logActivityLists();
        return view('log.list',compact('logs'));
    }
    public function initDatatable(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->model::query();
            $json =   DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return view('layouts.button.action')->with(['row' => $row, 'module' => 'logactivities']);
                })
                ->make(true);
            return $json;
        }
    }
}
