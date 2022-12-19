<?php

namespace App\DataTables\Hi_FPT;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PaymentSupportDataTable extends DataTable
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
            ->editColumn('status', function($row){
                if (!$row->status) {
                    return '<h4 class="badge badge-warning"> Chưa tiếp nhận </h4>';
                }
                $data = $row->status === '2' ? ['Hủy bỏ', 'badge badge-danger'] : ['Đã xử lí', 'badge badge-success'];
                return '<h4 class="'.$data[1].'">'.$data[0].'</h4>';

            })
            ->editColumn('action',function($row){
                if (!$row->status) {
                    return '<div style="display:flex; justify-content:center">
                   <a type="button" id="detail" data-id="'.$row->id.'" class="btn btn-sm bg-primary"><i class="fa fa-lock"></i></a>';
                }

            })
            ->rawColumns(['action','status']);
    }

    public function query()
    {
        return collect($this->data) ?? [];
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('PaymentSupport_manage')
            ->columns($this->getColumns())
            ->responsive()
            ->autoWidth(true)
            ->orderBy(1, 'DESC')
            ->parameters([
                'scroll' => false,
                'searching' => true,
                'searchDelay' => 500,
                'initComplete' => "function () {
                    var type = $('#show_at');
                    var filter_condition = $('#filter_condition');
                    var table = $('#PaymentSupport_manage').DataTable();
                    $(type).on('change', function () {
                        table.ajax.reload();
                    });
                    $(filter_condition).on('click', function () {
                        table.ajax.reload();
                    });
                 }"
            ])
            ->addTableClass('table table-hover table-striped text-center w-100')
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
            Column::make('order_id')->title('Order ID'),
            Column::make('customer_phone')->title('Customer Phone'),
            Column::make('description_error_code')->title('Error Description'),
            Column::make('payment_type')->title('Payment Type'),
            Column::make('created_at')->title('Created At'),
            Column::make('status')->title('Status'),
            Column::computed('action')->sortable(false)
                ->searching(false)
                ->width(80)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PaymentSupport_' . date('YmdHis');
    }
}

