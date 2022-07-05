<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Models\AppLog;
use App\Exports\AppExport;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use App\DataTables\Hi_FPT\AppDataTable;
use App\Http\Controllers\MY_Controller;

class AppController extends MY_Controller
{
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'App log information';
        $this->model = $this->getModel('AppLog');
    }

    public function index(AppDataTable $dataTable, Request $request){
        $type = AppLog::select('type')->distinct()->get()->toArray();
        $data_chart = [];
        return $dataTable
            ->with([
                'filter_duplicate' => $request->filter_duplicate,
                'public_date_start' => $request->public_date_start,
                'public_date_end' => $request->public_date_end,
                'type' => $request->type
            ])
            ->render('app.index', ['type' => $type, 'filter' => $dataTable->recordsFiltered, 'data_chart' => $data_chart]);
    }

    public function export(Request $request)
    {
        $type = $request->type ?? null;
        $start = $request->start ?? null;
        $end = $request->end ?? null;
        $duplicate = $request->filter_duplicate ?? 'yes';
        return (new AppExport)->forCondition($type, $start, $end, $duplicate)->download('data'.date('Y-m-d').'.xlsx');
    }
}
