<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\BaseController;
use App\Models\Screen;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use App\DataTables\Hi_FPT\AppLogDataTable;

class AppLogController extends BaseController
{
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'App log information';
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
