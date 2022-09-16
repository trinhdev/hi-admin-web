<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Models\AppLog;
use App\Models\Screen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use App\DataTables\Hi_FPT\AppDataTable;
use App\Http\Controllers\MY_Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
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
        $type = AppLog::select('type')
            ->distinct()
            ->get()
            ->toArray();
        return $dataTable
            ->with([
                'filter_duplicate' => $request->filter_duplicate,
                'public_date_start' => $request->public_date_start,
                'public_date_end' => $request->public_date_end,
                'phone' => $request->phone,
                'type' => $request->type
            ])
            ->render('app.index', [
                'type'          => $type,
                'filter'        => $dataTable->recordsFiltered
            ]);
    }

    public function postChart(Request $request){
        $data_day = DB::table('app_log')
            ->where('date_action', '>=',now()->startOfDay())
            ->leftJoin('screen', 'app_log.type', '=', 'screen.screenId')
            ->groupBy('data')
            ->orderByDesc('count')
            ->get([
                'screenName as data',
                DB::raw('COUNT(*) as count')
            ]);


        $data_month = DB::table('app_log')
            ->where('date_action', '>=',now()->subMonth())
            ->leftJoin('screen', 'app_log.type', '=', 'screen.screenId')
            ->groupBy('data')
            ->orderByDesc('count')
            ->get([
                'screenName as data',
                DB::raw('COUNT(*) as count')
            ]);
        $data_month_user_current = [
            [
                'data' => 'MAU 30 ngày gần nhất',
                'count'=> DB::table('app_log')
                    ->whereBetween('date_action', [now()->subMonth(),now()])
                    ->where('type','=', '1_home' )
                    ->distinct()->count('phone')
            ],
            [
                'data' => 'MAU từ '.now()->subMonth(1)->toDateString().' đến '.now()->subMonth(0)->toDateString(),
                'count'=> DB::table('app_log')
                    ->whereBetween('date_action', [now()->subMonth(2),now()->subMonth()])
                    ->where('type','=', '1_home' )
                    ->distinct()->count('phone')
            ]
        ];
        $data_day_user = DB::table('app_log')
            ->where('date_action', '>', now()->subWeek())
            ->where('type','=', '1_home' )
            ->groupBy('data')
            ->get([
                DB::raw('Date(date_action) as data'),
                DB::raw('COUNT(distinct phone) as count')
            ]);

        return [
            'data_day'      =>$data_day,
            'data_month'    => $data_month,
            'data_total'    => $data_month_user_current,
            'data_month_current'=>$data_day_user
        ];

    }

    public function export(Request $request)
    {
        $fileName = 'data-'.now().'.csv';
        $start = $request->start ? \Carbon\Carbon::parse($request->start)->format('Y-m-d H:i:s'): null;
        $end = $request->end ? \Carbon\Carbon::parse($request->end)->format('Y-m-d H:i:s'): null;
        $model = DB::table('app_log')->select('id','type','phone','url','date_action');
        if (!empty($request->type)) {
            $model->where('type', $request->input('type'));
        }
        if (!empty($request->phone)) {
            $model->where('phone', $request->input('phone'));
        }
        if (!empty($end) && !empty($start)) {
            $model->whereBetween('date_action', [$start, $end]);
        }
        if ($model->count() > 150000) return back()->with(['error' => 'error', 'html'=>'Thông báo! Quá số lượng cho phép 150K, vui lòng liên hệ trinhhdp@fpt.com.vn']);
        return (new FastExcel($this->helper_fast_excel($model)))->download('file/'.$fileName, function ($log) {
            return [
                'ID' => $log->id,
                'TYPE' => $log->type,
                'PHONE' => $log->phone,
                'URL' => $log->url,
                'DATE ACTION' =>  \Carbon\Carbon::parse()->format('Y-m-d H:i:s'),
            ];
        });
    }

    function helper_fast_excel($model) {
        foreach ($model->cursor() as $value) {
            yield $value;
        }

    }
}
