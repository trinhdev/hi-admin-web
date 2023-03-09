<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use App\Models\AppLog;
use Carbon\Carbon;

class AppDataTable extends BuilderDatatables
{
    protected $hasCheckbox = false;
    protected $ajaxUrl = [
        'type'=>"POST",
        'data' => "function(d) {
        d.type = $('#show_at').val();
        d.phone = $('#phone_filter').val();
        d.public_date_start = $('#show_from').val();
        d.public_date_end = $('#show_to').val();
        d.filter_duplicate = $('#filter_duplicate').val() }"
    ];
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('type', function ($row) {
                return $row->screen->screenName;
            })
            ->filter(function ($query) {
                if (request()->has('phone')) {
                    $query->where('phone', request('phone'));
                }
            }, false)
            ;
    }

    public function query(AppLog $query)
    {
        if (request()->has('type')) {
            $query->where('type', request('type'));
        }

        if (!empty(request('phone'))) {
            $query->where('phone', request('phone'));
        }
        if (!empty(request('public_date_start')) && !empty(request('public_date_end'))) {
            $publicDateStart = request('public_date_start') ? Carbon::parse(request('public_date_start'))->format('Y-m-d H:i:s'): null;
            $publicDateEnd = request('public_date_end') ? Carbon::parse(request('public_date_end'))->format('Y-m-d H:i:s'): null;
            $query->whereBetween('date_action', [$publicDateStart,$publicDateEnd]);
        }  $query->groupBy(['phone','type'])->distinct();
        if (request()->filter_duplicate =='yes') {
            \DB::statement("SET SQL_MODE=''");
            $query->groupBy(['phone','type'])->distinct();
        }
        return $query->newQuery();
    }

    public function columns()
    {
        return [
            'id'            => ['title'=> 'ID'],
            'type'          => ['title'=> 'Loại'],
            'phone'         => ['title'=> 'Số điện thoại'],
            'url'           => ['title'=> 'URL'],
            'date_action'   => ['title'=> 'Ngày log']
        ];
    }

    public function htmlInitCompleteFunction(): ?string
    {
        return "
            var table = $('#app_table').DataTable();
            $('#submit').on('click', function () {
                table.ajax.reload();
            });
        ";
    }

}
