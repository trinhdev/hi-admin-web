<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\AppDataTable;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Models\AppLog;
use Illuminate\Http\Request;

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
        return $dataTable
            ->with([
                'public_date_start' => $request->public_date_start,
                'public_date_end' => $request->public_date_end,
                'type' => $request->type
            ])
            ->render('app.index', ['type' => $type]);
    }
}
