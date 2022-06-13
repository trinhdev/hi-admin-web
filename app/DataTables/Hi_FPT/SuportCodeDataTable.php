<?php

namespace App\DataTables\Hi_FPT;

use App\Models\Otp_Reset_Logs;
use App\Services\HdiCustomer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use DataTables;

class SuportCodeDataTable extends DataTable
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
            ->collection($query)
            ->addIndexColumn()
            ->editColumn('action',function($row){
                return '<div style="display:flex; justify-content:center">
                    <a style="float: left; margin-right: 5px" type="button" onclick="unclockSupportCode(this)" class="btn btn-sm btn-icon bg-primary"><i class="fas fa-unlock"></i></a>';
            })
            ->rawColumns(['action'])
            // ->setTotalRecords($totalRecords)
            ->skipPaging();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hi_FPT/Banner $model
     * @return Builder
     */
    public function query(HdiCustomer $service)
    {
        // var_dump($this->supportCode);
        $result = [];
        $this->perPage = $this->length ?? 10;
        if(!isset($this->currentPage) || $this->start == 0){
            $this->currentPage = 1;
        }
        if($this->start != 0){
            $this->currentPage =  ($this->start / $this->perPage) + 1 ;
        }

        $orderColumn = $this->order[0]['column'];
        $this->orderBy = $this->columns[$orderColumn]['data'] == "DT_RowIndex" ? null : $this->columns[$orderColumn]['data'];
        $this->orderDirection = $this->order[0]['dir'];
        $params = [
            'supportCode'   => $this->supportCode,
            'page'          => $this->currentPage,
        ];
        $model = $service->findLikeCode($params);
        if(isset($model['statusCode']) && $model['statusCode'] == 0) {
            $result = !empty($model['data']['items']) ? collect($model['data']['items']) : [];
            return $result;
        }
        session()->flash('error');
        return $result;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('support-code-table')
                    ->columns($this->getColumns())
                    ->responsive()
                    ->autoWidth(true)
                    ->parameters([
                        'scroll' => false,
                        'searchDelay' => 500,
                        'searching' => false,
                        'initComplete' => "function () {
                            var supportCode = $('#support-code');
                            var table = $('#support-code-table').DataTable();
                            $(supportCode).on('change', function () {
                                table.ajax.reload();
                            });
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
            Column::make('list_phone')->title('Danh sách SDT đăng nhập')->searchable(true)->searching(false)->sortable(false),
            Column::make('support_code')->title('Mã hỗ trợ')->searching(false)->searchable(true)->sortable(false),
            Column::make('last_updated')->title('Thời gian cập nhật cuối cùng')->sortable(false)->searchable(false),
            Column::computed('action')->sortable(false)
                  ->searching(false)
                  ->width(80)
                  ->addClass('text-center')
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
