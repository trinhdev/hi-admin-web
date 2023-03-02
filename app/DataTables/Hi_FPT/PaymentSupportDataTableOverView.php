<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PaymentSupportDataTableOverView extends BuilderDatatables
{
    protected $ajaxUrl = ['data' => 'function(d) { d.table = "overview"; }'];
    protected $hasCheckbox = false;
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->editColumn('status', function($row){
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
                    $date = explode(' - ', request('daterange'));
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

    public function columns()
    {
        return [
            Column::make('status')->title('Status'),
            Column::make('count'),
        ];
    }

}

