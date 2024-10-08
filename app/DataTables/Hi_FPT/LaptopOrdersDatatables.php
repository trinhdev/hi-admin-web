<?php

namespace App\DataTables\Hi_FPT;

use App\Models\AppLog;
use App\Models\Laptop_Orders;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LaptopOrdersDatatables extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('action',function($row){
                return '<div style="display:flex; justify-content:center">
                           <a href="'.route('laptop-orders.edit', [$row->trans_id]).'" id="detail" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>
                       </div>
                ';
            })
            ->rawColumns(['action']);
            ;
    }
    public function query(Laptop_Orders $model)
    {
        return $model->newModelQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('log_support_code_table')
            ->serverSide(true)
                    ->columns($this->getColumns())
                    ->lengthMenu([10,25,50,100,200,500,100000000])
                    ->pageLength(25)
                    ->parameters([
                        'scroll' => false,
                        'scrollX' => true,
                        'searching' => true,
                        'searchDelay' => 500,
                        'sServerMethod' => 'POST'
                    ])
                    ->addTableClass('table table-hover table-striped text-center w-100')
                    ->languageEmptyTable('Không có dữ liệu')
                    ->languageInfoEmpty('Không có dữ liệu')
                    ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
                    ->languageSearchPlaceholder('Nhập thông tin cần tra cứu')
                    ->languageSearch('Tìm kiếm')
                    ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
                    ->languageLengthMenu('Hiển thị _MENU_')
                    ->languageInfo('Hiển thị trang _PAGE_ của _PAGES_ trang')
                    ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('trans_id'),
            Column::make('merchant_id'),
            Column::make('order_id'),
            Column::make('customer_id'),
            Column::make('customer_phone'),
            Column::make('address_id'),
            Column::make('fullname'),
            Column::make('phone_nb'),
            Column::make('address'),
            Column::make('city'),
            Column::make('district'),
            Column::make('ward'),
            Column::make('lat_long'),
            Column::make('amount'),
            Column::make('promotion_code'),
            Column::make('referral_code'),
            Column::make('amount_voucher'),
            Column::make('total_amount_finish'),
            Column::make('appointment_date'),
            Column::make('timezone'),
            Column::make('note'),
            Column::make('payment_method'),
            Column::make('isTokenization'),
            Column::make('order_id_payment'),
            Column::make('payment_status'),
            Column::make('t_create'),
            Column::make('histories_order_id_payment'),
            Column::make('id_fsh'),
            Column::make('email'),
            Column::make('order_state'),
            Column::make('description_state'),
            Column::make('rule_next_step'),
            Column::make('color_code'),
            Column::make('status_ship60'),
            Column::make('list_item'),
            Column::make('list_tracking'),
            Column::make('full_address'),
            Column::make('t_create_str'),
            Column::make('t_deliver'),
            Column::make('agent_id'),
            Column::make('txt_list_item'),
            Column::computed('action')->sortable(false)
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
    protected function filename()
    {
        return 'LogSupportCode_' . date('YmdHis');
    }
}
