<?php

namespace App\DataTables\Hi_FPT;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BuilderDatatables extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->collection($query->row);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Hi_FPT/Banner $model
     * @return array
     */
    public function query()
    {
        return $this->data ?? [];
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('statistics')
            ->columns($this->getColumns())
            ->responsive()
            ->autoWidth(true)
            ->orderBy(0)
            ->parameters([
                'scroll' => false,
                'searching' => false,
                'searchDelay' => 500,
                'initComplete' => "function () {
                            var type = $('#show_at');
                            var filter_condition = $('#filter_condition');
                            var table = $('#statistics').DataTable();
                            $(filter_condition).on('click', function () {
                                table.column().ajax.reload( null, false )
                            });
                         }",
                'dom' => '<"row container-fluid mx-auto mt-2 mb-4"<"col-8"B><"col-1 mt-2 "><"col-2 mt-2"f>>irtp',
                'buttons' => [
                    [
                        'text' => 'Copy',
                        'extend' => 'copyHtml5',
                        'attr' => [
                            'class' =>'btn btn-sm btn-info px-4'
                        ]
                    ],
                    [
                        'text' => 'Excel',
                        'extend' => 'excel',
                        'attr' => [
                            'class' =>'btn btn-sm btn-info px-4'
                        ]
                    ]
                ]
            ])
            ->addTableClass('table table-hover table-striped text-center w-100')
            ->languageEmptyTable('Không có dữ liệu')
            ->languageInfoEmpty('Không có dữ liệu')
            ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
            ->languageSearch('Tìm kiếm')
            ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
            ->languageLengthMenu('Hiển thị _MENU_ dòng mỗi trang')
            ->languageInfo('Hiển thị trang _PAGE_ của _PAGES_ trang');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {

        $res = [];
        for($i = 0 ; $i< count($this->query()->column); $i++) {
            $res[] = Column::make($i)->title($this->query()->column[$i]);
        }
        return $res;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'statistics_' . date('YmdHis');
    }
}
