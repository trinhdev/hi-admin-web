<?php

namespace App\DataTables\Admin;

use App\DataTables\BuilderDatatables;
use App\Models\User;

class UserDataTable extends BuilderDatatables
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('name', function ($row) {
                return '
                    <a href="'.route('user.edit', $row->id).'">'.$row->name.'</a>
                    <div class="row-options">
                        <a href="'.route('user.edit', $row->id).'">View</a> |
                        <a href="#" data-id="'.$row->id.'" onclick="dialogConfirmWithAjax(deleteUser, this)" class="text-danger">Remove</a>
                    </div>
                ';
            })
            ->editColumn('checkbox',function($row){
                return '<div class="checkbox"><input type="checkbox" value="'.$row->event_id.'"><label></label></div>';
            })
            ->rawColumns(['name', 'checkbox']);
    }

    public function query(User $model)
    {
        return $model->newQuery();
    }

    public function columns(): array
    {
        return [
            'id' => [
                'title' => 'ID',
                'width' => '20px',
            ],
            'name' => [
                'title' => 'Tên',
            ],
            'email' => [
                'title' => 'Email',
            ],
            'role_id' => [
                'title' => 'Quyền Hạn',
            ],
            'created_at' => [
                'title' => 'Ngày tạo',
            ]
        ];
    }
}
