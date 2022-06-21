<?php

namespace App\DataTables\Hi_FPT;

use App\Services\PopupPrivateService;
use App\Services\NewsEventService;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PopUpPrivateDataTable extends DataTable
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
        $type = $this->type;
        return datatables()
            ->collection($query)
            ->editColumn('type', function ($query) use ($list_template_popup) {
                $name = $list_template_popup[$query->type]
                    ? $list_template_popup[$query->type]
                    : $query;
                return $name ? $name : $query->type;
            })
            ->editColumn('iconUrl', function ($query) {
                return '
                        <img src="' .$query->iconUrl. '" alt="" onclick ="window.open("' . $query->iconUrl . '").focus()" width="100" height="100"/>
                ';
            })
            ->editColumn('iconButtonUrl', function ($query) {
                return '
                        <img src="' .$query->iconButtonUrl. '" alt="" onclick ="window.open("' . $query->iconButtonUrl . '").focus()" width="100" height="100"/>
                ';
            })
            ->editColumn('popupType', function () {
                return '<span style="color: #111111" class="badge border border-blue" >Private <i class="fas fa-check-circle"></i></span>';
            })
            ->editColumn('isActive', function ($query) {
                if ($query->isActive === 1) {
                    return '<span style="color: rgb(0,86,13)" class="badge border border-blue" >Active <i class="fas fa-check-circle"></i></span>';
                } else {
                    return '<span style="color: #9f3535" class="badge border border-blue" >Delete <i class="fas fa-check-circle"></i></span>';
                }
            })
            ->filter(function ($instance) use ($type) {
                if (!empty($type)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($type) {
                        return (bool)$type;
                    });
                }
            })
            ->addColumn('action', 'popup-private._action-menu')
            ->rawColumns(['iconUrl','iconButtonUrl', 'action' ,'isActive','type', 'popupType']);
    }

    public function query()
    {
        $service_private = new PopupPrivateService();
        $popup_private = $service_private->get();
        return collect(get_data_api($popup_private)) ?? $data = [];

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('popup_private_table')
            ->columns($this->getColumns())
            ->responsive()
            ->orderBy(8)
            ->autoWidth(true)
            ->parameters([
                'scroll' => false,
                'scrollX' => false,
                'searching' => true,
                'searchDelay' => 500,
                'dom' => '<"row container-fluid mx-auto mt-2 mb-4"<"col-md-9"B><"col-md-1 float-left mt-2 "l><"col-md-1 mt-2"f>>irtp',
                'buttons' => [
                    [
                        'text' =>'<i class="fa fa-plus"></i> Thêm mới pop-up',
                        'attr'      =>  [
                            'id'=>'push_popup_public'
                        ]
                    ],
                    'copyHtml5',
                    'excel'
                ]
            ])
            ->addTableClass('table table-hover text-center w-100')
            ->languageEmptyTable('Không có dữ liệu')
            ->languageInfoEmpty('Không có dữ liệu')
            ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
            ->languageSearch('Tìm kiếm')
            ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
            ->languageLengthMenu('Hiển thị _MENU_')
            ->languageInfo('TỔNG DÒNG: _TOTAL_');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('titleVi')->title('Tiêu đề'),
            Column::make('iconUrl')->title('Hình ảnh')->sortable(false),
            Column::make('actionType')->title('Nơi điều hướng'),
            Column::make('type')->title('Loại template'),
            Column::make('iconButtonUrl')->title('Ảnh button'),
            Column::make('popupGroupId')->title('Nhóm PopUp'),
            Column::make('isActive')->title('Trạng thái'),
            Column::computed('popupType')
                ->searching(false)
                ->width(100)
                ->addClass('text-center')
                ->title('Loại popup'),
            Column::make('dateCreated')->title('Ngày tạo'),
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
    protected function filename(): string
    {
        return 'Popup_private_' . date('YmdHis');
    }
}
