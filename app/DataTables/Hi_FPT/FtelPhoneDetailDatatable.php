<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use Yajra\DataTables\Html\Column;

class FtelPhoneDetailDatatable extends BuilderDatatables
{
    protected $hasCheckbox = false;
    protected $ajaxUrl = [
        'type'=>"POST",
        'data' => "function(d) {d.phone = $('#number_phone').val();d.action_data = $('#btn-data').val();d.action_db = $('#btn-db').val(); }"
    ];
    public function ajax()
    {
        return datatables()
            ->collection($this->query())
            ->editColumn('emailAddress', function($row) {
                return '<a href="#">'.$row['emailAddress'].'</a>
                <div class="row-options">
                    <a href="#" data-phone="'.$row['phoneNumber'].'" onclick="detailFtelPhone(this)" class="text-info">Edit</a>
                </div>';
            })
            ->rawColumns(['emailAddress'])
            ->make();

    }

    public function query()
    {
        return $this->applyScopes($this->data);
    }


    public function columns()
    {
        return [
            'code' => [
                'title' => 'Mã nhân viên',
            ],
            'emailAddress' => [
                'title' => 'Email',
            ],
            'phoneNumber' => [
                'title' => 'Số điện thoại',
            ],
            'fullName' => [
                'title' => 'Họ tên',
            ],
            'organizationCode' => [
                'title' => 'Mã đơn vị',
            ],
            'organizationCodePath' => [
                'title' => 'Mã đơn vị đầy đủ',
            ],
            'organizationNamePath' => [
                'title' => 'Tên đơn vị đầy đủ',
            ]
        ];
    }

    public function htmlInitCompleteFunction(): ?string
    {
        return "
            var btnData = $('#btn-data');
            var btnDb = $('#btn-db');
            var table = $('#table_manage').DataTable();
            $(btnData).on('click', function () {
                btnDb.val('')
                btnData.val('data')
                table.ajax.reload();
            });
            $(btnDb).on('click', function () {
                btnData.val('')
                btnDb.val('data')
                table.ajax.reload();
            });
        ";
    }
}
