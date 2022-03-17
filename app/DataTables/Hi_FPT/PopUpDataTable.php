<?php

namespace App\DataTables\Hi_FPT;

use Yajra\DataTables\Html\Column;
use App\Services\NewsEventService;
use Yajra\DataTables\Services\DataTable;

class PopUpDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    private $perPage = 10;
    private $orderBy = 'date_created';
    private $orderDirection  = 'DESC';
    private $currentPage = 1;
    public function dataTable($query)
    {
        //dd($query);
        $NewsEventService = new NewsEventService();
        $listRoute = collect($NewsEventService->getListTargetRoute()->data);
        $list_template_popup = config('platform_config.type_popup_service');
        $tmp = $query;
        $query = $query['data'];
        $paginate = $tmp['pagination'];
        $totalRecords = $paginate->totalPage * $paginate->perPage;
        return datatables()
            ->collection($query)
            ->addIndexColumn()
            ->editColumn('buttonActionValue', function ($query) use ($listRoute){
                $name = $query->buttonActionType == 'function' 
                        ?  ($routeObject = $listRoute->where('id', $query->directionId)->first()) ? $routeObject->name : 'null'
                        : $query->buttonActionValue;
                return $name ? $name : 'null';
            })
            ->editColumn('templateType', function ($query) use ($list_template_popup){
                $name = $list_template_popup[$query->templateType]
                        ?  $list_template_popup[$query->templateType]
                        : $query;
                return $name ? $name : $query->templateType;
            })
            ->editColumn('image', function ($query) {
                return '
                        <img src="'.env('URL_STATIC'). '/upload/images/event/' . $query->image .'" alt="" onclick ="window.open("' . $query->image .'").focus()" width="100" height="100"/>
                ';
            })
            ->addColumn( 'action', 'popup._action-menu')
            ->rawColumns(['buttonActionValue','image','action'])
            ->setTotalRecords($totalRecords)
            ->skipPaging()
            ;
    }

    public function query(NewsEventService $service)
    {
        $this->perPage = $this->length ?? 10;
        if(!isset($this->currentPage) || $this->start == 0){
            $this->currentPage = 1;
        }
        if($this->start != 0){
            $this->currentPage =  ($this->start / $this->perPage) + 1 ;
        };
        //$this->start == 0 ? $this->currentPage = 1 : $this->currentPage =  ($this->start / $this->perPage) + 1;
        $orderColumn = $this->order[0]['column'];
        $this->orderBy = $this->columns[$orderColumn]['data'];
        $this->orderDirection = $this->order[0]['dir'];
        $this->templateType = $this->templateType ?? '';
        $model = $service->getListTemplatePopup( $this->templateType, $this->perPage, $this->currentPage, $this->orderBy, $this->orderDirection);

        if(isset($model->statusCode) && $model->statusCode == 0) {
            return collect($model->data);
        }
        session()->flash('error');
        return $model = [];
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('popup_manage_table')
                    ->columns($this->getColumns())
                    ->responsive()
                    ->orderBy(6)
                    ->autoWidth(true)
                    ->parameters([
                        'scrollX' => true,
                        'searching' => true,
                        'searchDelay' => 500,
                        'initComplete' => "function () {
                            var templateType = $('#show_at');
                            var table = $('#popup_manage_table').DataTable();
                            $(templateType).on('change', function () { 
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
                    ->sortable(false),
            Column::make('titleVi')->title('Tiêu đề'),
            Column::make('image')->title('Hình ảnh')->sortable(false),
            Column::make('buttonActionValue')->title('Nơi điều hướng'),
            Column::make('templateType')->title('Loại template'),
            Column::make('viewCount')->title('Số lượt view'),
            Column::make('dateCreated')->title('Ngày tạo'),
            Column::make('createdBy')->title('Người tạo'),
            Column::make('modifiedBy')->title('Người cập nhật'),
            Column::computed('action')
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
        return 'Popup_' . date('YmdHis');
    }
}
