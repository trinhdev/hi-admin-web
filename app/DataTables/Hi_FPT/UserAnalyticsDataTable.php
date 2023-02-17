<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use App\Models\Customers;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;

class UserAnalyticsDataTable extends BuilderDatatables
{
    protected $hasCheckbox = false;
    protected $ajaxUrl = ['data' => 'function(d) { d.table = "detail"; }'];
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

    public function htmlInitCompleteFunctionCustom()
    {
        // TODO: Implement htmlInitCompleteFunctionCustom() method.
    }
}

