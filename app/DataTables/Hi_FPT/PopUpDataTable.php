<?php

namespace App\DataTables\Hi_FPT;

use Carbon\Carbon;
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
    private $perPage;
    private $orderBy = 'date_created';
    private $orderDirection = 'DESC';
    private $currentPage = 1;

    public function dataTable($query)
    {
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
            ->editColumn('buttonActionValue', function ($query) use ($listRoute) {
                $name = $query->buttonActionType == 'function'
                    ? ($routeObject = $listRoute->where('id', $query->directionId)->first()) ? $routeObject->name : 'null'
                    : $query->buttonActionValue;
                return $name ? $name : 'null';
            })
            ->editColumn('templateType', function ($query) use ($list_template_popup) {
                $name = $list_template_popup[$query->templateType]
                    ? $list_template_popup[$query->templateType]
                    : $query;
                return $name ? $name : $query->templateType;
            })
            ->editColumn('image', function ($query) {
                return '
                        <img src="' . env('URL_STATIC') . '/upload/images/event/' . $query->image . '" alt="" onclick ="window.open("' . $query->image . '").focus()" width="100" height="100"/>
                ';
            })
            ->editColumn('popupType', function () {
                if(true) {
                    return '<span style="color: #006400" class="badge border border-blue">Public <i class="fas fa-check-circle"></i></span>';
                }
                else {
                    return '<span style="color: #111111" class="badge border border-blue" >Private <i class="fas fa-check-circle"></i></span>';
                }
            })
            ->addColumn('action', 'popup._action-menu')
            ->rawColumns(['buttonActionValue', 'image', 'action','buttonImage', 'popupType'])
            ->setTotalRecords($totalRecords)
            ->skipPaging();
    }

    public function query(NewsEventService $service)
    {
        $this->perPage = $this->length ?? 10;
        if (!isset($this->currentPage) || $this->start == 0) {
            $this->currentPage = 1;
        }
        if ($this->start != 0) {
            $this->currentPage = ($this->start / $this->perPage) + 1;
        };
        //$this->start == 0 ? $this->currentPage = 1 : $this->currentPage =  ($this->start / $this->perPage) + 1;
        $orderColumn = $this->order[0]['column'];
        $this->orderBy = $this->columns[$orderColumn]['data'];
        $this->orderDirection = $this->order[0]['dir'];
        $this->templateType = $this->templateType ?? '';
        $model = $service->getListTemplatePopup($this->templateType, $this->perPage, $this->currentPage, $this->orderBy, $this->orderDirection);
        return collect(get_data_api($model)) ?? [];
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
                        'extend'=> 'collection',
                        'text' =>'<i class="fa fa-plus"></i> Thêm mới pop-up',
                        'autoClose'=> true,
                        'action'    => 'function ( e, dt, node, config ) {}',
                        'attr'      =>  [
                            'id'=>'push_popup_public'
                        ]
                    ],
                    [
                        'extend'=> 'collection',
                        'text' =>'<i class="fa fa-filter"></i> Lọc hiển thị template',
                        'autoClose'=> true,
                        'buttons'=> [
                            [
                                'text'      =>'Center box có button',
                                'action'    => 'function ( e, dt, node, config ) {
                                    dt.on("preXhr.dt", function(e, settings, data){
                                        data.templateType = "popup_custom_image_transparent";
                                    });
                                    dt.ajax.reload();
                                }',
                                'attr'      =>  [
                                    'id'=>'popup_custom_image_transparent'
                                ]
                            ],
                            [
                                'text' => 'Center box không có button',
                                'action'    => 'function ( e, dt, node, config ) {
                                    dt.on("preXhr.dt", function(e, settings, data){
                                        data.templateType = "popup_image_transparent";
                                    });
                                    dt.ajax.reload();
                                }',
                                'attr'      =>  [
                                    'id'    => 'popup_image_transparent'
                                ]
                            ],
                            [
                                'text' => 'Full screen có button',
                                'action'    => 'function ( e, dt, node, config ) {
                                    dt.on("preXhr.dt", function(e, settings, data){
                                        data.templateType = "popup_full_screen";
                                    });
                                    dt.ajax.reload();
                                }',
                                'attr'      =>  [
                                    'id'    => 'popup_full_screen'
                                ]
                            ],
                            [
                                'text' => 'Full screen không có button',
                                'action'    => 'function ( e, dt, node, config ) {
                                    dt.on("preXhr.dt", function(e, settings, data){
                                        data.templateType = "popup_image_full_screen";
                                    });
                                    dt.ajax.reload();
                                }',
                                'attr'      =>  [
                                    'id'    => 'popup_image_full_screen'
                                ]
                            ]
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
            Column::make('DT_RowIndex')
                ->title('STT')
                ->width(10)
                ->sortable(false),
            Column::make('titleVi')->title('Tiêu đề'),
            Column::make('image')->title('Hình ảnh')->sortable(false),
            Column::make('buttonActionValue')->title('Nơi điều hướng'),
            Column::make('templateType')->title('Loại template'),

            Column::make('viewCount')->title('Số lượt view'),
            Column::make('createdBy')->title('Người tạo'),

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
        return 'Popup_' . date('YmdHis');
    }
}
