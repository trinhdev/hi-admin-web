<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use App\Models\Customers;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;

class ViewAnalyticsDataTable extends BuilderDatatables
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
            'view' => [
                'title' => 'view',
                'width' => '20px',
            ],
            'url' => [
                'title' => 'url',
                'class' => 'text-start',
            ],
            'avg_time' => [
                'title' => 'AVG. time',
                'class' => 'text-start',
            ],
            'created_at' => [
                'title' => 'created_at',
                'width' => '100px',
            ]
        ];
    }

    public function htmlInitCompleteFunction(): ?string
    {
        return "

        ";
    }
}

