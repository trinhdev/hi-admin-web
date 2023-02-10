<?php

namespace App\DataTables\Hi_FPT;

use App\Services\PopupPrivateService;
use App\Services\NewsEventService;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Http;

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
        $list_template = config('platform_config.type_popup_service');
        return datatables()
            ->collection($query)
            ->editColumn('type', function ($query) use ($list_template) {
                return !empty($list_template[$query->type]) ? $list_template[$query->type] : $query->type;
            })
            ->editColumn('iconUrl', function ($query) {
                return '
                        <img src="' . env('URL_STATIC') . '/upload/images/event/' . $query->iconUrl . '" width="100" height="100"/>
                ';
            })
            ->editColumn('iconButtonUrl', function ($query) {
                if(!empty($query->iconButtonUrl)) {
                    $image = env("URL_STATIC").'/upload/images/event/'.$query->iconButtonUrl;
                }else {
                    $image = '/images/image_holder.png';
                }
                return '<img src="'.$image.'" window.open(`'.$image.'`) width="100" height="100"/>';
            })
            ->editColumn('isActive', function ($query) {
                if ($query->isActive === 1) {
                    return '<span style="color: rgb(0,86,13)" class="badge border border-blue" >Running <i class="fas fa-check-circle"></i></span>';
                } else {
                    return '<span style="color: #9f3535" class="badge border border-blue" >Stop <i class="fas fa-circle"></i></span>';
                }
            })
            ->addColumn('action', 'popup-private._action-menu')
            ->rawColumns(['iconUrl', 'iconButtonUrl', 'action', 'isActive', 'type', 'popupType']);
    }

    public function query()
    {
        return collect($this->data->data) ?? [];
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
            ->autoWidth(true)
            ->parameters([
                'scroll' => false,
                'scrollX' => false,
                'searching' => true,
                'searchDelay' => 500,
                'dom' => '<"row container-fluid mx-auto mt-2 mb-4"<"col-8"B><"col-1 mt-2 "><"col-2 mt-2"f>>irtp',
                'buttons' => [
                    [
                        'text' => 'Add pop-up',
                        'attr' => [
                            'id' => 'push_popup_private_form',
                            'class' =>'btn btn-sm btn-primary'
                        ]
                    ],
                    [
                        'text' => 'Copy',
                        'extend' => 'copyHtml5',
                        'attr' => [
                            'class' =>'btn btn-sm btn-primary px-4'
                        ]
                    ],
                    [
                        'text' => 'Excel',
                        'extend' => 'excel',
                        'attr' => [
                            'class' =>'btn btn-sm btn-primary px-4'
                        ]
                    ]
                ]
            ])
            ->addTableClass('table table-hover text-center w-100')
            ->languageEmptyTable('Không có dữ liệu')
            ->languageInfoEmpty('Không có dữ liệu')
            ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
            ->languageSearch('Tìm kiếm')
            ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
            ->languageLengthMenu('Hiển thị _MENU_')
            ->languageInfo('<div class="text-bold">TỔNG SỐ DÒNG: _TOTAL_</div>');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('temPerId')->title('ID'),
            Column::make('iconUrl')->title('Hình ảnh')->sortable(false),
            Column::make('iconButtonUrl')->title('Ảnh button'),
            Column::make('dataAction')->title('Nơi điều hướng'),
            Column::make('type')->title('Loại template'),
            Column::make('quantity')->title('Tổng SDT'),
            Column::make('quantityDistinct')->title('SDT không bị trùng'),
            Column::make('viewCount')->title('Lượt click'),
            Column::make('dateBegin')->title('Ngày bắt đầu'),
            Column::make('dateEnd')->title('Ngày kết thúc'),
            Column::make('dateCreated')->title('Ngày tạo'),
            Column::make('isActive')->title('Trạng thái'),
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
