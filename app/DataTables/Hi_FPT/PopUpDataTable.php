<?php

namespace App\DataTables\Hi_FPT;

use Yajra\DataTables\Html\Column;
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
        $list_template_popup = config('platform_config.type_popup_service');
        $data           = $query['data'];
        $totalRecords   = $query['pagination']->totalPage * $query['pagination']->perPage;
        return datatables()
            ->collection($data)
            ->addIndexColumn()
            ->editColumn('templateType', function ($query) use ($list_template_popup) {
                return $list_template_popup[$query->templateType] ?? $query;
            })
            ->editColumn('image', function ($query) {
                $url = env('URL_STATIC').'/upload/images/event/'.$query->image;
                return '<img src="'.$url.'"
                            onclick ="window.open(`'.$url.'`)"
                            width="100" height="100"
                        />';
            })
            ->addColumn('action', 'popup._action-menu')
            ->rawColumns(['buttonActionValue', 'image', 'action','buttonImage'])
            ->setTotalRecords($totalRecords)
            ->skipPaging();
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
                        'text' =>'<i class="fas fa-plus"></i> Add Pop-up',
                        'autoClose'=> true,
                        'action'    => 'function ( e, dt, node, config ) {}',
                        'attr'      =>  [
                            'id'=>'push_popup_public',
                            'class' =>'btn btn-info'
                        ]
                    ],
                    [
                        'extend'=> 'collection',
                        'text' =>'Lọc hiển thị',
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
                    [
                        'text' => 'Copy',
                        'extend' => 'copyHtml5',
                    ],
                    [
                        'text' => 'Excel',
                        'extend' => 'excel',
                    ]
                ]
            ])
            ->addTableClass('table table-hover text-center w-100 table-header-color');
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
            Column::make('image')->title('Image')->sortable(false),
            Column::make('buttonActionValue')->title('Nơi điều hướng'),
            Column::make('templateType')->title('Loại template')->width(120),
            Column::make('viewCount')->title('View'),
            Column::make('createdBy')->title('created By')->width(80),
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
