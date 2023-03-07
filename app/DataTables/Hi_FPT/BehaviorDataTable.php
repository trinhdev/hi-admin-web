<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use Yajra\DataTables\Html\Column;

class BehaviorDataTable extends BuilderDatatables
{
    protected $hasCheckbox = false;
    protected $ajaxUrl = [
        'type'=>"POST",
        'data' => "function(d) {d.phone = $('#phone_number').val();d.daterange = $('#daterange').val(); }"
    ];
    public function ajax()
    {
        return datatables()
            ->collection($this->query())
            ->make();
    }

    public function query()
    {
        return $this->applyScopes($this->data);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    public function columns()
    {
        return [
            Column::make('Thời gian/Lượt tương tác'),
            Column::make('Không có tương tác'),
            Column::make('=<2'),
            Column::make('2-4'),
            Column::make('>=5')
        ];
    }

    public function htmlInitCompleteFunction(): ?string
    {
        return "
            var btn = $('#submit');
            var table = $('#behavior_manage').DataTable();
            $(btn).on('click', function () {
                table.ajax.reload();
            });
        ";
    }
}
