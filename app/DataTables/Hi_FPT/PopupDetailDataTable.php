<?php

namespace App\DataTables\Hi_FPT;

use App\Services\NewsEventService;
use App\Services\PaymentService;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class PopupDetailDataTable extends DataTable
{
    /**
     * Build DataTable class.
     */
    public function dataTable($query)
    {
        return datatables()
            ->collection($query)
            ->editColumn('action',function($row) {
                return '<a class="btn btn-sm fa fa-bell btn-icon bg-olive"></a>';
            })
            ->editColumn('showOnceTime',function($row) {
                return config('platform_config.repeatTime')[$row['showOnceTime']];
            })
            ->editColumn('pushedObject',function($row) {
                return config('platform_config.object')[$row['pushedObject']];
            })
            ->addIndexColumn()
            ->rawColumns(['process_status', 'action']);
    }

    public function query()
    {
        $data = $this->data;
        return empty($data) ? $response=null : $response=collect($data['templatePersonalMaps']);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('popup_detail_table')
            ->columns($this->getColumns())
            ->responsive()
            ->autoWidth(true)
            ->lengthMenu([10,25,50])
            ->pageLength(10)
            ->orderBy(4)
            ->parameters([
                'scroll' => false,
                'searching' => true,
                'searchDelay' => 500,
                'dom' => '<"row container mx-auto"<"col-md-4"B><"col-md-4 mt-2 "l><"col-md-2 mt-2"f>>irtp',
                'buttons' => [
                    [
                        'extend'=> 'collection',
                        'text' =>'<i class="fa fa-rocket"></i> Push pop-up',
                        'autoClose'=> true,
                        'buttons'=> [
                            [
                                'text'      =>'Pop-up Public',
                                'action'    => 'function ( e, dt, node, config ) {}',
                                'attr'      =>  [
                                    'id'=>'push_popup_public'
                                ]
                            ],
                            [
                                'text' => 'Pop-up Private',
                                'action'=> 'function ( e, dt, node, config ) {
                                    dt.column( -2 ).visible( ! dt.column( -2 ).visible() );
                                }',
                                'attr'      =>  [
                                    'id'    => 'push_popup_private'
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
            ->languageSearchPlaceholder('Tìm kiếm')
            ->languageSearch('Tìm kiếm')
            ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
            ->languageLengthMenu('Hiển thị _MENU_')
            ->languageInfo('TỔNG DÒNG: _TOTAL_')
            ;
    }

    protected function getColumns()
    {
        return [
            Column::make('templatePersonalMapId')->title('ID'),
            Column::make('date_created')->title('Ngày push'),
            Column::make('showOnceTime')->title('Tần xuất popup xuất hiện')->addClass('text-left'),
            Column::make('pushedObject')->title('Đối tượng')->addClass('text-left'),
            Column::make('dateStart')->title('Thời gian bắt đầu'),
            Column::make('dateEnd')->title('Thời gian kết thúc'),
            Column::make('process_status')->title('Trạng thái'),
            Column::computed('action')
                ->searching(false)
                ->width(80)
                ->addClass('text-center')
        ];
    }

    protected function filename()
    {
        return 'PopupDetailDataTable_' . date('YmdHis');
    }
}
