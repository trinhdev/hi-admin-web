<?php

namespace App\DataTables\Hi_FPT;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PaymentSupportDataTableOverView extends DataTable
{
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->editColumn('status', function($row){
                if ($row->status === '1') {
                    $data = ['Đã chuyển tiếp', 'badge badge-info'] ;
                } elseif  ($row->status === '2') {
                    $data = ['Đang xử lí', 'badge badge-info'] ;
                } elseif  ($row->status === '3') {
                    $data = ['Đã xử lí', 'badge badge-success'];
                } elseif  ($row->status === '4') {
                    $data = ['Hủy bỏ', 'badge badge-danger'];
                } else {
                    $data = ['Chưa tiếp nhận', 'badge badge-warning'] ;
                }
                return '<h4 class="'.$data[1].'">'.$data[0].'</h4>';

            })
            ->filter(function ($query) {
                if (request()->filled('daterange')) {
                    $date = explode('-', request('daterange'));
                    $query->whereBetween('created_at', [changeFormatDateLocal($date[0]), changeFormatDateLocal($date[1])]);
                }
            })
            ->rawColumns(['status'])
            ->make();
    }

    public function query()
    {
        return $this->applyScopes($this->data);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->ajax(['data' => 'function(d) { d.table = "overview"; }'])
            ->columns($this->getColumns())
            ->orderBy(1)
            ->responsive()
            ->autoWidth(true)
            ->parameters([
                'scroll' => false,
                'searching' => false,
                'searchDelay' => 500,
                'dom' => ''
            ])
            ->addTableClass('table table-hover table-striped text-center w-100 table-header-color')
            ->languageEmptyTable('Không có dữ liệu')
            ->languageInfoEmpty('Không có dữ liệu')
            ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
            ->languageSearch('Tìm kiếm')
            ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
            ->languageLengthMenu('Hiển thị _MENU_ dòng mỗi trang')
            ->languageInfo('Hiển thị trang _PAGE_ của _PAGES_ trang
                    ');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('status')->title('Status'),
            Column::make('count'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PaymentSupportOverview_' . date('YmdHis');
    }
}

