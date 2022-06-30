<?php

namespace App\DataTables\Hi_FPT;

use App\Services\AirDirectionService;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AirDirectionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

    public function dataTable($query)
    {
        return datatables()
            ->collection($query)
            ->editColumn('is_deleted', function ($query) {
                if ($query->is_deleted === 0) {
                    return '<span style="color: rgb(0,86,13)" class="badge border border-blue" >Active <i class="fas fa-check-circle"></i></span>';
                } else {
                    return '<span style="color: #9f3535" class="badge border border-blue" >Stop <i class="fas fa-circle"></i></span>';
                }
            })
            ->addColumn('action', 'air-direction._action-menu')
            ->rawColumns(['action','is_deleted']);
    }

    public function query()
    {
        $service = new AirDirectionService();
        $data_air_direction = $service->get();
        return collect(get_data_api($data_air_direction)) ?? $data = [];
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('air_direction_table')
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
                        'text' => 'Thêm điều hướng',
                        'attr' => [
                            'id' => 'push_air_direction_form',
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
            ->languageInfo('<div class="text-bold">TỔNG SỐ ĐIỀU HƯỚNG: _TOTAL_</div>');
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
            Column::make('name')->title('Tên'),
            Column::make('decription')->title('Mô tả'),
            Column::make('key')->title('Khóa'),
            Column::make('value')->title('Giá trị'),
            Column::make('data')->title('Dữ liệu'),
//            Column::make('product_id')->title('Mã sản phẩm'),
            Column::make('is_deleted')->title('Trạng thái'),
            Column::make('date_created')->title('Ngày tạo'),
            Column::make('date_modified')->title('Ngày sửa'),
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
