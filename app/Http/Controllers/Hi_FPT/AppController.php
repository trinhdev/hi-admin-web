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
        if($request->has('export')) {
            return (new AppExport)->forCondition($request->type, $request->public_date_start, $request->public_date_end, $request->filter_duplicate)->download('data'.date('Y-m-d').'.xlsx');
        }
        $type = AppLog::select('type')->distinct()->get()->toArray();
        return $dataTable
            ->with([
                'filter_duplicate' => $request->filter_duplicate,
                'public_date_start' => $request->public_date_start,
                'public_date_end' => $request->public_date_end,
                'type' => $request->type
            ])
            ->render('app.index', ['type' => $type, 'filter' => $dataTable->recordsFiltered]);
    }

    public function export($type = null,$start = null,$end = null,$duplicate = 'yes') 
    {
        return (new AppExport)->forCondition($type, $start, $end, $duplicate)->download('data'.date('Y-m-d').'.xlsx');
    }
}
