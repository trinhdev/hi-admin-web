<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use App\Models\FtelPhone;
use Yajra\DataTables\Html\Column;

class FtelPhoneDatatable extends BuilderDatatables
{
    protected $hasCheckbox = false;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query);
    }

    public function query(FtelPhone $model)
    {
        return $model->where('code', '!=' , 'null');
    }


    public function columns()
    {
        return [
            Column::make('id'),
            Column::make('number_phone'),
            Column::make('code'),
            Column::make('emailAddress'),
            Column::make('fullName'),
            Column::make('organizationNamePath'),
            Column::make('organizationCodePath'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'FtelPhone_' . date('YmdHis');
    }
}
