<?php

namespace App\DataTables\Hi_FPT;

use App\Models\Banner;
use App\Services\NewsEventService;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class BannerDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    private $perPage = 10;
    private $orderBy = null;
    private $orderDirection  = null;
    private $currentPage = 1;
    public function dataTable($query)
    {
        $NewsEventService = new NewsEventService();
        $listRoute = collect($NewsEventService->getListTargetRoute()->data);
        $list_banner_type = $NewsEventService->getListTypeBanner();
        $list_banner_type = (isset($list_banner_type->statusCode) && $list_banner_type->statusCode == 0) ? $list_banner_type->data : [];
        $tmp = $query;
        $query = $query['data'];
        $paginate = $tmp['pagination'];
        $totalRecords = $paginate->totalPage * $paginate->perPage;
        return datatables()
            ->collection($query)
            ->addIndexColumn()
            ->editColumn('event_type', function($row){
                return '<span class="infoRow" data-id="'.$row->event_id.'">'.$row->event_type.'</span>';
            })
            ->editColumn('image', function ($row) {
               return '<img src="'.$row->image.'" style="width:150px" onerror="this.onerror=null;this.src='."'/images/img_404.svg'". '"  onclick="window.open(`'.$row->image.'`)" />';
            })
            ->editColumn('status', function($row){
                $is_expired = $row->public_date_end <= now() ? 'Hết hạn' : 'Còn Hạn';
                $badge = $is_expired == 'Hết hạn' ? 'badge badge-danger' : 'badge badge-success';
                return '<h4 class="'.$badge.'">'.$is_expired.'</h4>';
                
            })
            ->editColumn('created_by',function($row){
                if(!empty($row->cms_note)){
                    $JSONcms_note = json_decode($row->cms_note);
                    return !empty($JSONcms_note->created_by) ? $JSONcms_note->created_by : "";
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
            ->editColumn('ordering', function($row){
                $is_expired = $row->public_date_end <= now() ? 'disabled' : '';
                return '<input type="number" onchange="updateOrdering(this)" style="width:50px" value="'.$row->ordering.'" '.$is_expired.'/>';
            })
            ->editColumn('action',function($row) use ($list_banner_type){
                $bannerType = $row->event_type;
                if ($bannerType == 'highlight') {
                    $bannerType = 'bannerHome';
                };
                $exists = array_search($bannerType, array_column($list_banner_type, 'id'));
                if ($exists === false){
                    return "";
                }
                return '<div style="display:flex; justify-content:center">
                    <a style="float: left; margin-right: 5px" type="button" onclick="viewBanner(this)" class="btn btn-sm fas fa-eye btn-icon bg-primary"></a>
                   <a style="" type="button" onclick="getDetailBanner(this)" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>';
            })
            ->rawColumns(['image','status','action','ordering','event_type'])
            ->setTotalRecords($totalRecords)
            ->skipPaging()
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hi_FPT/Banner $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(NewsEventService $service)
    {
        $this->perPage = $this->length ?? 10;
        if(!isset($this->currentPage) || $this->start == 0){
            $this->currentPage = 1;
        }
        if($this->start != 0){
            $this->currentPage =  ($this->start / $this->perPage) + 1 ;
        };
        //$this->start == 0 ? $this->currentPage = 1 : $this->currentPage =  ($this->start / $this->perPage) + 1;
        $orderColumn = $this->order[0]['column'];
        $this->orderBy = $this->columns[$orderColumn]['data'] == "DT_RowIndex" ? null : $this->columns[$orderColumn]['data'];
        $this->orderDirection = $this->order[0]['dir'];
        $this->templateType = $this->templateType ?? '';
        $param = [
            'bannerType' => empty($this->bannerType) ? null : $this->bannerType,
            'publicDateStart' => empty($this->public_date_from) ? null : Carbon::parse($this->public_date_from)->format('Y-m-d H:i:s'),
            'publicDateEnd' => empty($this->public_date_to) ? null : Carbon::parse($this->public_date_to)->format('Y-m-d H:i:s'),
            'order_by' => $this->orderBy,
            'per_page' => $this->perPage,
            'current_page' => $this->currentPage,
            'order_direction' => empty($this->orderBy) ? null : $this->orderDirection
        ];
        // dd($param);
        $model = $service->getListbanner($param);
        if(isset($model->statusCode) && $model->statusCode == 0) {
            return collect($model->data);
        }
        session()->flash('error');
        return $model = [];
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
                    ->parameters([
                        'scrollX' => true,
                        'searching' => true,
                        'searchDelay' => 500,
                        'initComplete' => "function () {
                            var templateType = $('#show_at');
                            var table = $('#popup_manage_table').DataTable();
                            $(templateType).on('change', function () { 
                                table.ajax.reload();
                            });
                         }"
                    ])
                    ->addTableClass('table table-hover table-striped text-center w-100')
                    ->languageEmptyTable('Không có dữ liệu')
                    ->languageInfoEmpty('Không có dữ liệu')
                    ->languageProcessing('Đang tải')
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
            Column::make('DT_RowIndex')
                    ->title('STT')
                    ->width(20)
                    ->sortable(false),
            Column::make('title_vi')->title('Tiêu đề'),
            Column::make('image')->title('Ảnh Banner')->sortable(false),
            Column::make('event_type')->title('Loại Banner'),
            Column::make('event_type')->title('Ngày Hiển Thị'),
            Column::make('public_date_start')->title('Ngày Kết Thúc'),
            Column::make('public_date_end')->title('Ngày Kết Thúc'),
            Column::make('status')->title('Trạng Thái'),
            Column::make('ordering')->title('Độ ưu tiên'),
            Column::make('view_count')->title('Số Lượt Click'),
            Column::make('date_created')->title('Ngày Tạo'),
            Column::make('created_by')->title('Người Tạo'),
            Column::make('updated_by')->title('Người Cập Nhật'),
            Column::computed('action')
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
