<?php

namespace App\DataTables\Hi_FPT;

use App\Models\SupportSystem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use DataTables;

class SupportSystemDataTable extends DataTable
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
            ->editColumn('grid_title_show',function($row){
                return !empty($row->title) ? $row->title : $row->description;
            })
            ->editColumn('action',function($row) {
                return '<div style="display:flex; justify-content:center" class="infoRow" data-id="' . $row->id . '">
                            <a style="margin-right: 5px" type="button" onclick="getDetail(this)" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>
                            <form action="/supportsystem/destroy/' . $row->id . '" method="POST" onsubmit="handleSubmit(event,this)">
                                '.csrf_field().'
                                '.method_field("DELETE").'
                                <button type="submit" class="btn btn-sm fas fa-trash-alt btn-icon bg-red"></button>
                            </form>
                        </div>';
            })
            ->escapeColumns([])
            ->rawColumns(['grid_title_show', 'is_active', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hi_FPT/SupportSystem $model
     * @return Builder
     */
    public function query()
    {
        $supportsystem = SupportSystem::query();
        return $this->applyScopes($supportsystem->orderBy('status', 'desc')->orderBy('start_time', 'desc'));
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('support-system')
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
                    ->sortable(false),  
            Column::make('title')->title('Tên lỗi')->sortable(false)->searching(true),
            // Column::make('description')->title('Tên mô tả')->sortable(false)->searching(true),
            // Column::make('description')->title('Mô Tả')->sortable(false)->searching(false),
            Column::make('asked_by')->title('Người gửi lỗi')->searching(false),
            
            // Column::make('group')->title('Hỏi vào lúc')->searching(false),
            Column::make('status')->title('Trạng thái')->searching(false),
            Column::make('start_time')->title('Ngày bắt đầu')->searchable(false),
            Column::make('end_time')->title('Ngày kết thúc')->searchable(false),
            // Column::make('created_at')->title('Tạo vào lúc')->searchable(false),
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
        return 'Support_System_' . date('YmdHis');
    }
}
