<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use App\Models\Customers;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Yajra\DataTables\Html\Column;

class UserAnalyticsDataTable extends BuilderDatatables
{
    protected $hasCheckbox = false;
    protected $total = 0;
    protected $ajaxUrl = [
        'type'=>"POST",
        'data' => "function(d) {d.daterange = $('#filter_date_datatable').val();d.cusId = $('#customer_id').val(); }"
    ];
    public function dataTable($query)
    {
        if (count($query)) {
            $query = $query['histories'];
        }
        return datatables()
            ->collection($query)
            ->editColumn('screen_id', function($row) {
                return (!empty($row->previous_screen_id) ?$row->previous_screen_id: 'NULL').' -> '.$row->screen_id;
            })
            ->setTotalRecords($this->total)
            ->skipPaging();
    }

    public function query()
    {
        if ($this->data) {
            $this->total = $this->data->row_count;
            return collect($this->data);
        }
        return [];
    }

    public function columns()
    {
        return [
            'id' => [
                'title' => 'ID',
                'width' => '20px',
            ],
            'customer_id' => [
                'title' => 'CUSTOMER ID',
            ],
            'session_id' => [
                'title' => 'SESSION ID',
            ],
            'screen_id' => [
                'title' => 'PREV->SCREEN ID',
            ],
            'mili_duration' => [
                'title' => 'DURATION (ms)',
            ],
            'key_activity' => [
                'title' => 'KEY ACTIVITY',
            ],
            'meta_data' => [
                'title' => 'META DATA',
                'width' => '100',
            ],
            'identity_id' => [
                'title' => 'IDENTITY ID',
            ],
            'received_date' => [
                'title' => 'RECEIVED DATE',
            ],
            'external_id' => [
                'title' => 'EXTERNAL ID',
            ]
        ];
    }

    public function htmlInitCompleteFunction(): ?string
    {
        return "
            var cusId = $('#customer_id');
            var table = $('#user_detail').DataTable();
            $(cusId).on('change', function () {
                table.ajax.reload();
            });
            var filter_date = $('#filter_date_datatable');
            $(filter_date).on('change', function () {
                table.ajax.reload();
            });
        ";
    }
}

