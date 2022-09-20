<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Models\AppLog;
use App\Models\Screen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use App\DataTables\Hi_FPT\AppLogDataTable;
use App\Http\Controllers\MY_Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\SheetCollection;
use Rap2hpoutre\FastExcel\FastExcel;

class AppLogController extends MY_Controller
{
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'App log information';
        $this->model = $this->getModel('AppLog');
    }

    public function index(AppLogDataTable $dataTable, Request $request){
        $type = Screen::select('screenId')
            ->orderBy('screenId','asc')
            ->get()
            ->toArray();
        return $dataTable
            ->with([
                'date_action_start' => $request->date_action_start,
                'date_action_end' => $request->date_action_end,
                'phone' => $request->phone,
                'type' => $request->type
            ])
            ->render('applog.index', [
                'type'          => $type,
                'filter'        => $dataTable->recordsFiltered
            ]);
    }
}
