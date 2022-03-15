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
    

    public function dataTable($query)
    {
        $NewsEventService = new NewsEventService();
        $listRoute = collect($NewsEventService->getListTargetRoute()->data);
        $list_template_popup = config('platform_config.type_popup_service');
        return datatables()
            ->collection($query)
            ->addIndexColumn()
            ->editColumn('buttonActionValue', function ($query) use ($listRoute){
                
                $name = $query->buttonActionType == 'function' 
                        ?  $listRoute->where('id', $query->directionId)->first()->name 
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
            ->rawColumns(['buttonActionValue','image','action']);
    }

    public function query(NewsEventService $service)
    {
        $model = $service->getListTemplatePopup();
        if(isset($model->statusCode) && $model->statusCode == 0) {
            return collect($model->data->data);
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
                    ->setTableId('popup_manage')
                    ->columns($this->getColumns())
                    ->minifiedAjax('',null, $data =[])
                    ->responsive()
                    ->orderBy(1)
                    ->autoWidth(false)
                    ->parameters([
                        'scrollX' => true,
                        'searching' => true,
                        'searchDelay' => 500,
                        'initComplete' => "function () {
                            this.api().columns([4]).every(function () {
                                var column = this;
                                var templateType = document.getElementById('show_at');
                                $(templateType).on('change', function () {
                                    column.search($(this).val()).draw();
                                });
                            });
                         }"
                    ])
                    ->addTableClass('table table-hover table-striped text-center')
                    ->languageEmptyTable('Không có dữ liệu')
                    ->languageInfoEmpty('Không có dữ liệu')
                    ->languageProcessing('Đang tải')
                    ->languageSearch('Tìm kiếm')
                    ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
                    ->languageLengthMenu('Hiển thị _MENU_ dòng mỗi trang')
                    ->languageInfo('Trang _PAGE_ / _PAGES_ của _TOTAL_ dữ liệu')
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
            Column::make('DT_RowIndex')->title('STT')->width(20),
            Column::make('titleVi')->title('Tiêu đề'),
            Column::make('image')->title('Hình ảnh'),
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
