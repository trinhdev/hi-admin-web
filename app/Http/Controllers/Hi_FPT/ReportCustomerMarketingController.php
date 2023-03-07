<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\BaseController;
use App\Models\AppLog;
use App\Models\Screen;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use App\DataTables\Hi_FPT\ReportCustomerMarketingDataTable;
use App\Http\Controllers\MY_Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
// use Rap2hpoutre\FastExcel\SheetCollection;
// use Rap2hpoutre\FastExcel\FastExcel;
use App\Imports\ReportCustomerImport;
use App\Exports\ReportCustomerMarketingExport;
use \Exception;

class ReportCustomerMarketingController extends BaseController
{
    use DataTrait;

    public function __construct()
    {
        parent::__construct();
        $this->title = 'Báo cáo khách hàng';
        // $this->model = $this->getModel('ReportCustomerMarketing');
    }

    public function index(ReportCustomerMarketingDataTable $dataTable, Request $request) {
        return $dataTable
            ->with([
                // 'import_id' => $request->import_id,
            ])
            ->render('report.customer_marketing', [
                // 'import_id'     => $request->import_id
            ]);
    }

    public function store(Request $request) {
        $request->merge([
            'created_by' => (!isset($this->user->id)) ? $this->user->id : ''
        ]);
        $this->createSingleRecord($this->model, $request->all());
        $this->addToLog(request());
        return redirect()->route('employees.index');
    }

    public function uploadFile(Request $request) {
        // dd($request->customer_phone);
        // $row_limit = 1000;
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx'
        ]);

        $file_import = request()->file('excel');
        // dd($file_import->getClientOriginalName());
        // $data = Excel::import(new ReportCustomerImport(1000, $file_import->getClientOriginalName()), $file_import);
        try {
            $data = Excel::import(new ReportCustomerImport(20000, $file_import->getClientOriginalName()), $file_import);
        }
        catch(Exception $e) {
            return back()->withError($e->getMessage());
        }
        return back();

    }

    public function exportResult($import_id) {
        return Excel::download(new ReportCustomerMarketingExport(intval($import_id)), 'report.xlsx');
    }
}
