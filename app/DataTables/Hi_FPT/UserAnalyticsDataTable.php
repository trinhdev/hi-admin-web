<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use App\Models\Customers;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;

class UserAnalyticsDataTable extends BuilderDatatables
{
    protected $hasCheckbox = false;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query);
    }

    public function query(Customers $model)
    {
        return $model->newQuery();
    }
    public function columns()
    {
        return [
            Column::make('customer_id'),
            Column::make('phone'),
            Column::make('date_created'),
            Column::make('app_version')
        ];
    }

    public function htmlInitCompleteFunction(): ?string
    {
        return "
            var cusId = $('#select_filter');
            var table = $('#user_detail').DataTable();
            $(cusId).on('change', function () {
                table.ajax.reload();
            });
            var filter_date = $('#filter_date');
            $(filter_date).on('change', function () {
                table.ajax.reload();
            });
        ";
    }
}

