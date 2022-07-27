<?php

namespace App\Http\Controllers\Report;

use App\DataTables\Hi_FPT\SaleReportByDateDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Services\NewsEventService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

use App\Models\Settings;
use App\Models\Hdi_Orders;

class SalereportbydateController extends MY_Controller
{
    //
    use DataTrait;
    // protected $module_name = 'SupportSystem';
    // protected $model_name = "SupportSystem";
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Báo cáo kinh doanh';
        // $this->model = $this->getModel('SupportSystem');
    }
    public function index(Request $request, SaleReportByDateDataTable $dataTable) {
        // $services = ['ict', 'hdi', 'elmich', 'vuanem'];
        $services = ['hdi'];
        $tables = [];
        foreach($services as $service) {
            $dataTable->with([
                'start'     => $request->start,
                'length'    => $request->length,
                'order'     => $request->order,
                'columns'   => $request->columns,
                'service'   => $service
            ])->render('report.reportbysaledatedatatable');
            $tables[$service] = $dataTable->html();
        }
        
        return view('report.reportsalebydate', $tables);
    }

    public function datatable($service, SaleReportByDateDataTable $table) {
        return $table->with([
            'start'     =>$request->start,
            'length'    => $request->length,
            'order'     => $request->order,
            'columns'   => $request->columns,
            'service'   => $service
        ])->view('report.reportbysaledatedatatable', ['service' => $service])->render();
    }
}
