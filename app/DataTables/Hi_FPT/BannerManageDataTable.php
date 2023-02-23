<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use Illuminate\Support\Collection;
use Yajra\DataTables\Html\Column;

class BannerManageDataTable extends BuilderDatatables
{
    protected $ajaxUrl = '';
    public function dataTable($query)
    {
        $paginate = $query['pagination'];
        $totalRecords = $paginate->totalPage * $paginate->perPage;
        $query = $query['data'];
        return datatables()
            ->collection($query)
            ->editColumn('title_vi', function($row) {
                if (strlen($row->title_vi)>60) {
                    $text = mb_substr($row->title_vi, 0, 50, "UTF-8").'<div class="text-bold">...Xem thêm</div>';
                } else {
                    $text = $row->title_vi;
                }

                $check = auth()->user()->role_id;
                if ($check == 1 || $check == 5) {
                    return '<a data-id="'.$row->event_id .'" id="detailBanner" href="#">'.$text.'</a>
                    <div class="row-options">
                        <a data-id="'.$row->event_id .'" id="detailBanner" href="#">View</a> |
                        <a data-id="'.$row->event_id .'" id="button_form_export" href="#" class="text-info">Export</a>
                    </div>';
                }
                return '<a href="#">'.$text.'</a>
                <div class="row-options">
                    <a data-id="'.$row->event_id .'" id="button_form_export" href="#" class="text-info">Export</a>
                </div>';


            })
            ->editColumn('event_type', function($row) {
                return '<span class="infoRow" data-id="'.$row->event_id.'">'.$row->event_type.'</span>';
            })
            ->editColumn('image', function ($row) {
               return '<img src="'.$row->image.'" style="width:100px" onerror="this.onerror=null;this.src='."'/images/img_404.svg'". '"  onclick="window.open(`'.$row->image.'`)" />';
            })
            ->editColumn('status', function($row){
                $data = $row->public_date_end <= now() ? ['Hết hạn', 'badge bg-danger'] : ['Còn hạn', 'badge bg-success'];
                return '<span class="'.$data[1].'">'.$data[0].'</span>';

            })
            ->editColumn('created_by',function($row){
                if(isset($row->cms_note)){
                    $JSONcms_note = json_decode($row->cms_note);
                    return $JSONcms_note->created_by ?? "";
                }else{
                    return "";
                }
            })
            ->editColumn('updated_by', function($row){
                if(!empty($row->cms_note)){
                    $JSONcms_note = json_decode($row->cms_note);
                    return !empty($JSONcms_note->modified_by) ? $JSONcms_note->modified_by : "";
                }else{
                    return "";
                }
            })
            ->editColumn('ordering_on_home', function($row){
                $is_expired = $row->public_date_end <= now() ? 'disabled' : '';
                return '<input type="number" onchange="updateOrdering(this)" style="width:50px" value="'.$row->ordering_on_home.'" '.$is_expired.'/>';
            })
            ->editColumn('is_show_home', function($row) {
                $res = $row->is_show_home ? 'fa-check' : 'fa-times';
                return '<span><i class="fas '.$res.'"></i></span>';
            })
            ->editColumn('checkbox',function($row){
                return '<div class="checkbox"><input type="checkbox" value="'.$row->event_id.'"><label></label></div>';
            })
            ->rawColumns(['title_vi','image','status','checkbox','ordering_on_home','event_type', 'is_show_home'])
            ->setTotalRecords($totalRecords)
            ->skipPaging();
    }

    /**
     * Get query source of dataTable.
     *
     * @param Hi_FPT/Banner $model
     * @return Collection
     */
    public function query()
    {
        return collect($this->data->data) ?? [];
    }

    /**
     * Get columns.
     *
     * @return array
     */
    public function columns()
    {
        return [
            Column::make('event_id')->title('ID'),
            Column::make('title_vi')->title('Tiêu đề'),
            Column::make('image')->title('Ảnh Banner')->sortable(false),
            Column::make('event_type')->title('Loại Banner'),
            Column::make('public_date_start')->title('Ngày Hiển Thị'),
            Column::make('public_date_end')->title('Ngày Kết Thúc'),
            Column::make('ordering_on_home')->title('Độ ưu tiên'),
            Column::make('view_count')->title('Số Lượt Click'),
            Column::make('date_created')->title('Ngày Tạo'),
            Column::make('created_by')->title('Người Tạo')->sortable(false),
            Column::make('is_show_home')->title('Hiện ở home'),
            Column::make('status')->title('Trạng Thái')->sortable(false)

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    public function htmlInitCompleteFunction(): ?string
    {
        return "
            var bannerType = $('#select_filter');
            var table = $('#banner_manage').DataTable();
            $(bannerType).on('change', function () {
                table.ajax.reload();
            });
            var dateRange = $('#daterange');
            $(dateRange).on('change', function () {
                table.ajax.reload();
            });
        ";
    }
}
