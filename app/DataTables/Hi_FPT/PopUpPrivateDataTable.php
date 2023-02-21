<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use Yajra\DataTables\Html\Column;

class PopUpPrivateDataTable extends BuilderDatatables
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    protected $orderBy = 7;
    protected $hasCheckbox = false;

    public function dataTable($query)
    {
        $list_template = config('platform_config.type_popup_service');
        return datatables()
            ->collection($query)
            ->editColumn('type', function ($query) use ($list_template) {
                return !empty($list_template[$query->type]) ? $list_template[$query->type] : $query->type;
            })
            ->editColumn('titleVi', function ($row) {
                if ($row->isActive == 1) {
                    $action = 'class="text-danger">Stop</a>';
                } else {
                    $action = 'data-dateend="{{ $model->dateEnd }}" >Continue</a>';
                }
                return '<a id="detailPopup" data-id="' . $row->id . '" href="#">' . $row->titleVi . '</a>
                    <div class="row-options">
                        <a onclick="dialogConfirmWithAjax(deletePopUpPrivate, this)"
                                id="deletePopup" href="#"
                                data-check-delete="' . $row->isActive . '"
                                data-id="' . $row->id . '"' . $action . ' |
                        <a id="detailPopup" data-id="' . $row->id . '" href="#" class="text-warning">Edit</a> |
                        <a id="exportPopup" href="#" data-id="' . $row->id . '" class="text-info">Export</a> |
                        <a id="updatePhoneNumber" href="#" data-id="' . $row->id . '" class="text-info">Import</a>
                    </div>';

            })
            ->editColumn('iconUrl', function ($query) {
                return '
                        <img src="' . env('URL_STATIC') . '/upload/images/event/' . $query->iconUrl . '" width="100" height="100"/>
                ';
            })
            ->editColumn('iconButtonUrl', function ($query) {
                if (!empty($query->iconButtonUrl)) {
                    $image = env("URL_STATIC") . '/upload/images/event/' . $query->iconButtonUrl;
                } else {
                    $image = '/images/image_holder.png';
                }
                return '<img src="' . $image . '" window.open(`' . $image . '`) width="100" height="100"/>';
            })
            ->editColumn('isActive', function ($query) {
                if ($query->isActive === 1) {
                    return '<span style="color: rgb(0,86,13)" class="badge border border-blue" >Running <i class="fas fa-check-circle"></i></span>';
                } else {
                    return '<span style="color: #9f3535" class="badge border border-blue" >Stop <i class="fas fa-circle"></i></span>';
                }
            })
            ->rawColumns(['iconUrl', 'iconButtonUrl', 'titleVi', 'isActive', 'type', 'popupType']);
    }

    public function query()
    {
        return collect($this->data->data) ?? [];
    }

    public function columns(): array
    {
        return [
            'temPerId'          => ['title'=> 'ID'],
            'titleVi'           => ['title'=> 'Tiêu đề'],
            'iconUrl'           => ['title'=> 'Ảnh', 'sortable' => false],
            'iconButtonUrl'     => ['title'=> 'Ảnh button', 'sortable' => false],
            'dataAction'        => ['title'=> 'Nơi điều hướng'],
            'type'              => ['title'=> 'Loại template'],
            'quantity'          => ['title'=> 'Tổng SDT'],
            'quantityDistinct'  => ['title'=> 'Unique SDT'],
            'viewCount'         => ['title'=> 'Click'],
            'dateBegin'         => ['title'=> 'Ngày bắt đầu'],
            'dateEnd'           => ['title'=> 'Ngày kết thúc'],
            'dateCreated'       => ['title'=> 'Ngày tạo'],
            'isActive'          => ['title'=> 'Trạng thái']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Popup_private_' . date('YmdHis');
    }
}
