<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Models\AppLog;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use App\DataTables\Hi_FPT\AppDataTable;
use App\Http\Controllers\MY_Controller;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\SheetCollection;
use Rap2hpoutre\FastExcel\FastExcel;

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
        $data_db = DB::table('app_log')
                            ->select('type', DB::raw('COUNT(id) as count'));
        $data_month = $data_db->groupBy('type')->get()->toArray();
        $data_day = $data_db->where('date_action', '>', now()->startOfDay())->groupBy('type')->get()->toArray();
        return $dataTable
            ->with([
                'filter_duplicate' => $request->filter_duplicate,
                'public_date_start' => $request->public_date_start,
                'public_date_end' => $request->public_date_end,
                'type' => $request->type
            ])
            ->render('app.index', ['type' => $type, 'filter' => $dataTable->recordsFiltered, 'data_month' => $data_month, 'data_day'=>$data_day]);
    }

    public function export(Request $request)
    {
        $fileName = 'data-'.now().'.csv';
        return (new FastExcel($this->helper_fast_excel($request)))->download('file/'.$fileName, function ($log) {
            return [
                'ID' => $log->id,
                'TYPE' => $log->type,
                'PHONE' => $log->phone,
                'URL' => $log->url,
                'DATE ACTION' =>  \Carbon\Carbon::parse()->format('Y-m-d H:i:s'),
            ];
        });
    }

    function helper_fast_excel($request) {
        $start = $request->start ? \Carbon\Carbon::parse($request->start)->format('Y-m-d H:i:s'): null;
        $end = $request->end ? \Carbon\Carbon::parse($request->end)->format('Y-m-d H:i:s'): null;
        $model = DB::table('app_log')->select('id','type','phone','url','date_action');
        if ($request->has('type')) {
            $model->where('type', $request->input('type'));
        }
        if (!empty($end) && !empty($start)) {
            $model->whereBetween('date_action', [$start, $end]);
        }
        if ($request->has('filter_duplicate') && $request->has('filter_duplicate')=='yes') {
            \DB::statement("SET SQL_MODE=''");
            $model->groupBy(['phone','type'])->distinct();
        }
        foreach ($model->cursor() as $value) {
            yield $value;
        }

    }
}
