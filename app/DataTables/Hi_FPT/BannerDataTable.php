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
        // $NewsEventService = new NewsEventService();
        // $listRoute = collect($NewsEventService->getListTargetRoute()->data);
        $list_banner_type = $query['list_type_banner'];
        $tmp = $query['result'];
        $query = $query['result']['data'];
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
            ->editColumn('ordering_on_home', function($row){
                $is_expired = $row->public_date_end <= now() ? 'disabled' : '';
                return '<input type="number" onchange="updateOrdering(this)" style="width:50px" value="'.$row->ordering_on_home.'" '.$is_expired.'/>';
            })
            ->editColumn('is_show_home', function($row) {
                if($row->is_show_home) {
                    return '<span><i style="color: green" class="fas fa-check-circle"></i></span>';
                }
                else {
                    return '<span><i style="color: red" class="fas fa-times-circle"></i></span>';
                }
            })
            ->editColumn('action',function($row) use ($list_banner_type){
                // check if banner type is defined
                // $bannerType = $row->event_type;
                // if ($bannerType == 'highlight') {
                //     $bannerType = 'bannerHome';
                // };
                // $exists = array_search($bannerType, array_column($list_banner_type, 'id'));
                // end check
                // if ($exists === false){
                //     return "";
                // }
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
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(NewsEventService $service)
    {
        $result = [
            'result' => [],
            'list_type_banner' => $this->list_type_banner
        ];
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
        $publicDateStart = $this->public_date_start;
        $publicDateEnd = $this->public_date_end;
        $param = [
            'banner_type' => $this->bannerType,
            'public_date_start' => !empty($publicDateStart) ? Carbon::parse($publicDateStart)->format('Y-m-d H:i:s'): null,
            'public_date_end' => !empty($publicDateEnd) ? Carbon::parse($publicDateEnd)->format('Y-m-d H:i:s') : null,
            'order_by' => $this->orderBy,
            'per_page' => $this->perPage,
            'current_page' => $this->currentPage,
            'order_direction' => empty($this->orderBy) ? null : $this->orderDirection
        ];
        $model = $service->getListbanner($param);
        // print_r($param);
        // dd($model);
        if(isset($model->statusCode) && $model->statusCode == 0) {
            $result['result'] = !empty($model->data) ? collect($model->data) : [];
            return $result;
        }
        session()->flash('error');
        return $result;
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
                            $(public_date_start).on('change', function () { 
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
            Column::make('public_date_start')->title('Ngày Hiển Thị'),
            Column::make('public_date_end')->title('Ngày Kết Thúc'),
            Column::make('status')->title('Trạng Thái')->sortable(false),
            Column::make('ordering_on_home')->title('Độ ưu tiên'),
            Column::make('view_count')->title('Số Lượt Click'),
            Column::make('is_show_home')->title('Có hiện ở home'),
            Column::make('date_created')->title('Ngày Tạo'),
            Column::make('created_by')->title('Người Tạo')->sortable(false),
            Column::make('updated_by')->title('Người Cập Nhật')->sortable(false),
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
