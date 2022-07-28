<?php

namespace App\DataTables\Hi_FPT;

use App\Models\Banner;
use App\Services\NewsEventService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class BannerManageDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

    public function dataTable($query)
    {
        $paginate = $query['pagination'];
        $totalRecords = $paginate->totalPage * $paginate->perPage;
        $query = $query['data'];
        return datatables()
            ->collection($query)
            ->editColumn('event_type', function($row) {
                return '<span class="infoRow" data-id="'.$row->event_id.'">'.$row->event_type.'</span>';
            })
            ->editColumn('image', function ($row) {
               return '<img src="'.$row->image.'" style="width:150px" onerror="this.onerror=null;this.src='."'/images/img_404.svg'". '"  onclick="window.open(`'.$row->image.'`)" />';
            })
            ->editColumn('status', function($row){
                $data = $row->public_date_end <= now() ? ['Hết hạn', 'badge badge-danger'] : ['Còn hạn', 'badge badge-success'];
                return '<h4 class="'.$data[1].'">'.$data[0].'</h4>';

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
            ->editColumn('action',function($row){
                return '<div style="display:flex; justify-content:center">
                    <a style="float: left; margin-right: 5px" type="button" onclick="viewBanner(this)" class="btn btn-sm fas fa-eye btn-icon bg-primary"></a>
                   <a style="" type="button" onclick="getDetailBanner(this)" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>';
            })
            ->rawColumns(['image','status','action','ordering_on_home','event_type', 'is_show_home'])
            ->setTotalRecords($totalRecords)
            ->skipPaging();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hi_FPT/Banner $model
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return collect($this->data->data) ?? [];
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('banner_manage')
                    ->columns($this->getColumns())
                    ->responsive()
                    ->autoWidth(true)
                    ->orderBy(0)
                    ->parameters([
                        'scroll' => false,
                        'searching' => false,
                        'searchDelay' => 500,
                        'initComplete' => "function () {
                            var bannerType = $('#show_at');
                            var public_date_start = $('#show_from');
                            var public_date_end = $('#show_to');
                            var table = $('#banner_manage').DataTable();
                            $(bannerType).on('change', function () {
                                table.ajax.reload();
                            });
                            $(public_date_end).on('change', function () {
                                table.ajax.reload();
                            });
                         }"
                    ])
                    ->addTableClass('table table-hover table-striped text-center w-100')
                    ->languageEmptyTable('Không có dữ liệu')
                    ->languageInfoEmpty('Không có dữ liệu')
                    ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
                    ->languageSearch('Tìm kiếm')
                    ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
                    ->languageLengthMenu('Hiển thị _MENU_ dòng mỗi trang')
                    ->languageInfo('Hiển thị trang _PAGE_ của _PAGES_ trang
                    ')
                    ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
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
            Column::make('is_show_home')->title('Có hiện ở home'),
            Column::make('status')->title('Trạng Thái')->sortable(false),
            Column::computed('action')->sortable(false)
                  ->searching(false)
                  ->width(80)
                  ->addClass('text-center')

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Banner_' . date('YmdHis');
    }
}
