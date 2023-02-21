<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use App\Models\Deeplink;
use Illuminate\Support\Collection;
use Yajra\DataTables\Html\Column;

class DeeplinkDataTable extends BuilderDatatables
{
    protected $ajaxUrl = '';

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('name',function($row){
                return '<a href="'.route('deeplink.edit', [$row->id]).'">'.$row->name.'</a>
                    <div class="row-options">
                        <a href="'.route('deeplink.edit', [$row->id]).'">Edit</a> |
                        <a href="#" onclick="deleteItem(this)" data-id="'.$row->id.'" class="text-danger">Remove</a>
                    </div>';

            })
            ->editColumn('checkbox', function ($row) {
                return '<div class="checkbox"><input type="checkbox" value="'.$row->id.'"><label></label></div>
                ';
            })
            ->rawColumns(['name','checkbox']);
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
            Column::make('id')->title('ID'),
            Column::make('name')->title('Tên deeplink'),
            Column::make('direction')->title('Điều hướng'),
            Column::make('url')->title('URL'),
            Column::make('created_at')->title('Ngày Tạo')
        ];
    }
}
