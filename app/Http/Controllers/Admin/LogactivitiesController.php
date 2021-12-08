<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class LogactivitiesController extends MY_Controller
{
    //
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Log Activites';
        $this->model = $this->getModel('Log_activities');
    }
    public function index()
    {
        return view('log.list');
    }
    public function initDatatable(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->model::query()->with('user', 'User.role');
            $json =   DataTables::of($data)
                ->editColumn('method', function ($row) {
                    return view('log.label')->with(['row' => $row]);
                })
                ->editColumn('url', function ($row) {
                    return '<span class="text-success font-weight-bolder">' . $row->url . '</span>';
                })
                ->editColumn('ip', function ($row) {
                    return '<span class="text-danger font-weight-bolder">' . $row->ip . '</span>';
                })
                ->addColumn('email', function ($row) {
                    return !empty($row->user) ? $row->user->email : '';
                })
                ->addColumn('user_role', function ($row) {
                    return !empty($row->user) ? $row->user->role->role_name : '';
                })
                ->rawColumns(['method', 'url', 'ip', 'user_name', 'user_role'])
                ->make(true);
            return $json;
        }
    }

    public function destroy($id)
    {
        $this->deleteById($this->model, $id);
        return redirect()->back();
    }

    public function clearLog(Request $request)
    {
        $request->validate([
            'clear_log_option' => 'required'
        ]);
        DB::transaction(function () use ($request) {
            $this->model->clearLog($request->clear_log_option);
        });
        return redirect()->back()->withSuccess('success');
    }
}
