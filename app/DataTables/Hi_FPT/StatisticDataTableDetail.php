<?php

namespace App\DataTables\Hi_FPT;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StatisticDataTableDetail extends DataTable
{

    public function dataTable($query)
    {
        $current_page = $query->page[0];
        $total_page = $query->page[1];
        $totalRecords = request()->length * $total_page;

        return datatables()
            ->collection($query->row)
            ->setTotalRecords($totalRecords)
            ->skipPaging();
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param Hi_FPT/Banner $model
     * @return array
     */
    public function query()
    {
        return $this->data_detail ?? [];
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->ajax(['data' => 'function(d) { d.table = "detail"; }'])
                    ->columns($this->getColumns())
                    ->responsive()
                    ->orderBy(3)
                    ->parameters([
                        'scroll' => false,
                        'searchDelay' => 500,
                        'initComplete' => "function () {
                            var type = $('#show_at');
                            var filter_condition = $('#filter_condition');
                            var detail = $('#table-detail').DataTable();
                            var overview = $('#table-overview').DataTable();
                            $(filter_condition).on('click', function () {
                                  detail.ajax.reload();
                                  overview.ajax.reload();
                            });
                         }",
                        'dom' => '<"row container-fluid mx-auto mt-2 mb-4"<"col-8"B><"col-1 mt-2 "><"col-2 mt-2"f>>lirtp',
                        'buttons' => [
                            [
                                'text' => 'Copy',
                                'extend' => 'copyHtml5',
                                'attr' => [
                                    'class' =>'btn btn-sm btn-info px-4'
                                ]
                            ],
                            [
                                'text' => 'Excel (Current Page)',
                                'extend' => 'excel',
                                'attr' => [
                                    'class' =>'btn btn-sm btn-info px-4'
                                ]
                            ]
                        ]
                    ])
                    ->addTableClass('table table-hover table-striped text-center table-header-color w-100')
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
    public function getColumns()
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
        return 'Statistics_detail_' . date('YmdHis');
    }
}
