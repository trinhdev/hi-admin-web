<?php

namespace App\DataTables\Hi_FPT;

use App\Services\PaymentService;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class PaymentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     */
    public function dataTable($query)
    {
        return datatables()
            ->collection($query);
    }

    public function query(PaymentService $model)
    {
        $phone = $this->phone ?? null;
        $from = $this->from ? Carbon::parse($this->from)->format('Y-m-d H:i:s'): null;
        $to = $this->to ? Carbon::parse($this->to)->format('Y-m-d H:i:s'): null;
        $data = $model->get_transaction_by_phone($phone, $from, $to);
        if(empty($phone && $from && $to && $data)) {
            return [];
        }
        return collect($data->data);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('payment_table')
            ->columns($this->getColumns())
            ->responsive()
            ->autoWidth(true)
            ->lengthMenu([10,25,50])
            ->pageLength(10)
            ->parameters([
                'scroll' => false,
                'searching' => true,
                'searchDelay' => 500,
                'dom' => '<"row container mx-auto"<"col-md-4"B><"col-md-4 mt-2 "l><"col-md-2 mt-2"f>>irtp',
                'buttons' => [ 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf' ],
                'initComplete' => "function () {
                    var table = $('#payment_table').DataTable();
                    var button = $('#button');
                    $(button).on('click', function () {
                        var phone = $('#number_phone').val();
                        var from = $('#show_from').val();
                        var to = $('#show_to').val();
                        var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
                        if ($.trim(phone) == '' || $.trim(from) == '' || $.trim(to) == ''){
                            showError('Hãy chắc chắn nhập đủ các trường');
                            return false;
                        }
                        if (vnf_regex.test(phone) == false || phone.length!=10)
                        {
                            showError('Số điện thoại của bạn không đúng định dạng!');
                        }
                        table.ajax.reload();
                    });
                 }"
            ])
            ->addTableClass('table table-hover table-striped text-center w-100')
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
            Column::make('customer_id')->title('ID KH'),
            Column::make('customer_phone')->title('SDT'),
            Column::make('merchant_order_id')->title('ID đơn hàng'),
            Column::make('amount')->title('Giá'),
            Column::make('order_status')->title('Trạng thái'),
            Column::make('payment_type')->title('Hình thức TT'),
            Column::make('payment_method')->title('Phương thức TT'),
            Column::make('payment_provider')->title('TT bằng'),
            Column::make('payment_provider_status')->title('Trạng thái TT'),
            Column::make('payment_provider_date_success')->title('Thời gian'),
            Column::make('tokenization_id')->title('ID mã hóa'),
            Column::make('merchant_id')->title('ID người bán'),
            Column::make('gateway_description')->title('Mô tả cổng TT'),
            Column::make('date_created')->title('Ngày tạo'),
        ];
    }

    protected function filename()
    {
        return 'PaymentDatatabke_' . date('YmdHis');
    }
}
