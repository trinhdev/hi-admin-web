<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use App\Models\PaymentUnpaid;
use Carbon\Carbon;
use Illuminate\Support\HtmlString;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PaymentSupportDataTable extends BuilderDatatables
{
    protected $ajaxUrl = ['data' => 'function(d) { console.log(d);d.table = "detail"; }'];
    protected $orderBy = 5;

    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->editColumn('status', function ($row) {
                if ($row->status == '1') {
                    $data = ['Đã chuyển tiếp', '#c3dafe'];
                } elseif ($row->status == '2') {
                    $data = ['Đang xử lí', '#c3dafe'];
                } elseif ($row->status == '3') {
                    $data = ['Đã xử lí', '#c6f6d5'];
                } elseif ($row->status == '4') {
                    $data = ['Hủy bỏ', '#fed7d7'];
                } else {
                    $data = ['Chưa tiếp nhận', '#fefcbf'];
                }
                return '<h4 class="badge bg-gray-200 text-gray-800" style="color: #1f1d1d;background: ' . $data[1] . '">' . $data[0] . '</h4>';

            })
            ->editColumn('description_error_code', function ($row) {
                $error_des = PaymentUnpaid::where('customer_phone', $row->customer_phone)->pluck('description_error_code');
                $row->description_error_code = $error_des;
                return implode('<br>', json_decode($error_des));

            })
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('Y-m-d');
            })
            ->editColumn('action', function ($row) {
                if ($row->status != '3' && $row->status != '4') {
                    return '
                    <div class="tw-flex tw-items-center tw-space-x-3">
                    <a id="detail" data-id="' . $row->id . '" href="#" class="tw-text-neutral-500 hover:tw-text-neutral-700 focus:tw-text-neutral-700" data-toggle="modal" data-target="#showDetail_Modal" data-id="1">
                                        <i class="fa-regular fa-pen-to-square fa-lg"></i>
                    </a></div>';
                }
            })
            ->editColumn('checkbox', function ($row) {
                return '<div class="checkbox"><input type="checkbox" value="' . $row->event_id . '"><label></label></div>';
            })
            ->filter(function ($query) {
                if (request()->filled('type')) {
                    $query->where('status', 'like', "%" . request('type') . "%");
                    if (request('type') == "0" || empty(request('type'))) {
                        $query->orwhereNull('status');
                    }
                }

                if (request()->filled('phone')) {
                    $query->where('customer_phone', 'like', "%" . request('phone') . "%");
                }

                if (request()->filled('daterange')) {
                    $date = explode(' - ', request('daterange'));
                    $query->whereBetween('created_at', [changeFormatDateLocal($date[0]), changeFormatDateLocal($date[1])]);
                }
            })
            ->rawColumns(['checkbox', 'action', 'status', 'description_error_code', 'order_id', 'description'])
            ->make();
    }

    public function query()
    {
        return $this->applyScopes($this->data_detail);
    }


    /**
     * Get columns.
     *
     * @return array
     */
    public function columns()
    {
        return [
            Column::make('customer_phone')->title('Số điện thoại'),
            Column::make('order_id')->title('Order ID'),
            Column::make('description_error_code')->title('Mô tả lỗi'),
            Column::make('payment_type')->title('Loại thanh toán'),
            Column::make('created_at')->title('Ngày tạo'),
            Column::make('status')->title('Trạng thái'),
            Column::make('description_error')->title('Mô tả trạng thái lỗi'),
            Column::make('description')->title('Ghi chú'),
            Column::computed('action')->sortable(false)
                ->searching(false)
                ->title('Hành động')
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

    public function htmlInitCompleteFunction(): ?string
    {
        return "
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
        ";
    }
}

