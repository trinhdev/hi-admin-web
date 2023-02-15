<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use App\Models\Deeplink;
use Illuminate\Support\Collection;
use Yajra\DataTables\Html\Column;

class TestDataTable extends BuilderDatatables
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('checkbox', function ($row) {
                return '<div class="checkbox"><input type="checkbox" value="2"><label></label></div>
                ';
            })
            ->editColumn('name', function ($row) {
                return '<a href="">'.$row->name.'</a>
                    <div class="row-options">
                        <a href="">View</a> |
                        <a href="" class="text-danger _delete">Xóa </a>
                    </div>
                ';
            })
            ->rawColumns(['checkbox', 'operations', 'name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Hi_FPT/Deeplink $model
     * @return Collection
     */
    public function query(Deeplink $model)
    {
        return $model->newQuery();
    }

    public function columns()
    {
        return [
            'id' => [
                'title' => 'Id',
                'width' => '20px',
            ],
            'name' => [
                'title' => 'Tiêu đề',
            ],
            'direction' => [
                'title' => 'Điều hướng',
            ],
            'url' => [
                'title' => 'Url',
            ],
            'created_at' => [
                'title' => 'Ngày Tạo',
                'width' => '100px',
            ]
        ];
    }

    public function htmlInitCompleteFunctionCustom(): ?string
    {
        return "
            var filter_condition = $('#filter_condition');
            var table = $('#banner_manage').DataTable();
            $(filter_condition).on('click', function () {
                table.ajax.reload();
            });
        ";
    }
}
