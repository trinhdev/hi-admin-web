<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use App\Models\DAU_Report;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use DataTables;

class DauWauMauReportDataTable extends BuilderDataTables
{
    protected $hasCheckbox = false;
    public function dataTable($query)
    {
        // dd($query);
        // $this->to_date = $query['to_date'];
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->escapeColumns([])
            ->rawColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hi_FPT/Banner $model
     * @return Builder
     */
    public function query()
    {
        $report = DAU_Report::query();
        $date_range = explode(' - ', $this->to_date);
        $report->whereBetween('to_date', $date_range)->where('location_zone', '!=', '');
        if(is_array($this->selectedZones) && count($this->selectedZones) > 0) {
            $report->whereIn('location_zone', $this->selectedZones);
        }
        if($this->selectedType != '') {
            $this->selectedType = 'DAU';
        }
        $report->where('type', $this->selectedType);
        return $this->applyScopes($report);
    }


    /**
     * Get columns.
     *
     * @return array
     */
    public function columns()
    {
        return [
            Column::make('location_zone')->title('Vùng')->searching(false),
            Column::make('location_code')->title('Mã chi nhánh')->sortable(false)->searching(false),
            Column::make('branch_name')->title('Tên chi nhánh')->sortable(false)->searching(false),
            Column::make('count_login')->title('Tổng số đăng nhập')->sortable(false)->searching(false),
            Column::make('type')->title('Loại báo cáo')->sortable(false)->searching(false),
            Column::make('from_date')->title('Từ ngày')->sortable(false)->searching(false),
            Column::make('to_date')->title('Đến ngày')->sortable(false)->searching(false),
        ];
    }

    public function htmlInitCompleteFunction(): ?string
    {
        return "
            var table = $('#dau-report').DataTable();
            var dateRange = $('#daterange');
            $(dateRange).on('change', function () {
                table.ajax.reload();
            });

            var location_zone = $('#zones');
            $(location_zone).on('change', function () {
                table.ajax.reload();
            });

            var type = $('#type');
            $(type).on('change', function () {
                table.ajax.reload();
            });
        ";
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Banner_' . date('YmdHis');
    }
}
