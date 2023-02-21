<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use App\Services\AirDirectionService;
use Yajra\DataTables\Html\Column;

class AirDirectionDataTable extends BuilderDatatables
{
    protected $hasCheckbox = false;
    public function dataTable($query)
    {
        return datatables()
            ->collection($query)
            ->editColumn('name', function ($row) {
                return '
                    <a data-id="'.$row->id .'" onclick="detailAirDirection(this)" href="#">'.$row->name.'</a>
                    <div class="row-options">
                        <a data-id="'.$row->id .'" onclick="detailAirDirection(this)" href="#">View</a> |
                        <a onclick="dialogConfirmWithAjax(deleteAirDirection, this)" data-key="'.$row->key.'" data-id="'.$row->id .'" id="detailBanner" href="#" class="text-danger">Remove</a>
                    </div>
                ';
            })
            ->editColumn('is_deleted', function ($query) {
                if ($query->is_deleted === 0) {
                    return '<span style="color: rgb(0,86,13)" class="badge border border-blue" >Active <i class="fas fa-check-circle"></i></span>';
                } else {
                    return '<span style="color: #9f3535" class="badge border border-blue" >Stop <i class="fas fa-circle"></i></span>';
                }
            })
            ->rawColumns(['name','is_deleted']);
    }

    public function query()
    {
        $service = new AirDirectionService();
        $data_air_direction = $service->get();
        return collect(get_data_api($data_air_direction)) ??  [];
    }

    public function columns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('name')->title('Tên'),
            Column::make('decription')->title('Mô tả'),
            Column::make('key')->title('Khóa'),
            Column::make('value')->title('Giá trị'),
            Column::make('data')->title('Dữ liệu'),
//            Column::make('product_id')->title('Mã sản phẩm'),
            Column::make('is_deleted')->title('Trạng thái'),
            Column::make('date_created')->title('Ngày tạo'),
            Column::make('date_modified')->title('Ngày sửa')

        ];
    }
}
