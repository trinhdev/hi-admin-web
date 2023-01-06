<?php

namespace App\DataTables\Hi_FPT;

use App\Models\Unlock_Delete_User_Logs;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use DataTables;

class UnlockDeleteUserLogsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    private $perPage = 10;
    private $orderBy = null;
    private $orderDirection  = null;
    private $currentPage = 1;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_by_name', function($row) {
                if(!empty($row->created_by->email)) {
                    return '<span>' . $row->created_by->email . '</span>';
                }
                else {
                    return '<span></span>';
                }
            })
            ->editColumn('created_at', function($data) { 
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s'); return $formatedDate; 
            })
            ->rawColumns(['created_by_name', 'created_at']);
            // ->rawColumns()
            // ->skipPaging();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hi_FPT/Banner $model
     * @return Builder
     */
    public function query()
    {
        $otp_reset_logs = Unlock_Delete_User_Logs::select()->with(['created_by']);
        return $this->applyScopes($otp_reset_logs);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('unlock-delete-logs')
                    ->columns($this->getColumns())
                    ->responsive()
                    ->autoWidth(true)
                    ->parameters([
                        'scroll' => false,
                        'searchDelay' => 500,
                        'initComplete' => "function () {
                            
                        }"
                    ])
                    ->addTableClass('table table-hover table-striped text-center w-100')
                    ->languageEmptyTable('Không có dữ liệu')
                    ->languageInfoEmpty('Không có dữ liệu')
                    ->languageProcessing('Đang tải')
                    ->languageSearch('Tìm kiếm')
                    ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
                    ->languageLengthMenu('Hiển thị _MENU_ dòng mỗi trang')
                    ->languageInfo('Hiển thị trang _PAGE_ của _PAGES_ trang
                    ')
                    ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')
                    ->title('STT')
                    ->width(20)
                    ->sortable(false)->searchable(false),
            Column::make('phone')->title('Số điện thoại')->searching(true),
            Column::make('result_status')->title('Status kết quả trả về')->searching(false),
            Column::make('api_result')->title('Kết quả trả về')->searchable(false),
            Column::make('created_by_name')->title('Người thực hiện')->sortable(false)->searchable(false),
            Column::make('created_at')->title('Thời gian thực hiện')->sortable(false)->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'OtpResetLogs_' . date('YmdHis');
    }
}
