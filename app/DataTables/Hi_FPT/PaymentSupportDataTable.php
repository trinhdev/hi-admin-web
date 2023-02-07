<?php

namespace App\DataTables\Hi_FPT;

use App\Models\PaymentUnpaid;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PaymentSupportDataTable extends DataTable
{
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->editColumn('status', function($row){
                if ($row->status === '3') {
                    $data = ['Đã chuyển tiếp & xử lí', 'badge badge-success'] ;
                } elseif  ($row->status === '1') {
                    $data = [ 'Đã xử lí', 'badge badge-success'] ;
                } elseif  ($row->status === '2') {
                    $data = ['Hủy bỏ', 'badge badge-danger'];
                } else {
                    $data = ['Chưa tiếp nhận', 'badge badge-warning'] ;
                }
                return '<h4 class="'.$data[1].'">'.$data[0].'</h4>';

            })
            ->editColumn('description_error_code', function($row){
                $error_des = PaymentUnpaid::where('customer_phone', $row->customer_phone)->pluck('description_error_code');
                $row->description_error_code = $error_des;
                return implode('<br>', json_decode($error_des));

            })
            ->editColumn('created_at', function($row){
                return Carbon::parse($row->created_at)->format('Y-m-d');
            })
            ->editColumn('action',function($row){
                if (!$row->status) {
                    return '<div style="display:flex; justify-content:center">
                   <a type="button" id="detail" data-id="'.$row->id.'" class="btn btn-sm bg-primary"><i class="fa fa-lock"></i></a>';
                }
            })
            ->filter(function ($query) {
                if (request()->filled('type')) {
                    $query->where('status', 'like', "%" . request('type') . "%");
                    if (request('type') == "0") {
                        $query->orwhereNull('status');
                    }
                }

                if (request()->filled('phone')) {
                    $query->where('customer_phone', 'like', "%" . request('phone') . "%");
                }

                if (request()->filled('daterange')) {
                    $date = explode('-', request('daterange'));
                    $query->whereBetween('created_at', [changeFormatDateLocal($date[0]), changeFormatDateLocal($date[1])]);
                }
            })
            ->rawColumns(['action','status', 'description_error_code', 'order_id'])
            ->make();
    }

    public function query()
    {
        return $this->applyScopes($this->data_detail);
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
            ->orderBy(4)
            ->responsive()
            ->autoWidth(true)
            ->parameters([
                'scroll' => false,
                'searching' => true,
                'searchDelay' => 500,
                'initComplete' => "function () {
                    var type = $('#show_at');
                    var filter_condition = $('#filter_condition');
                    var detail = $('#table-detail').DataTable();
                    var overview = $('#table-overview').DataTable();
                    $(type).on('change', function () {
                        detail.ajax.reload();
                        overview.ajax.reload();
                    });
                    $(filter_condition).on('click', function () {
                          detail.ajax.reload();
                          overview.ajax.reload();
                    });
                 }",
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
            Column::make('customer_phone')->title('Customer Phone'),
            Column::make('order_id')->title('Order ID'),
            Column::make('description_error_code')->title('Error Description'),
            Column::make('payment_type')->title('Payment Type'),
            Column::make('created_at')->title('Created At'),
            Column::make('status')->title('Status'),
            Column::make('description_error')->title('Mô tả trạng thái lỗi'),
            Column::make('description')->title('Ghi chú'),
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

