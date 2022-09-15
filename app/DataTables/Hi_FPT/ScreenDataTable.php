<?php

namespace App\DataTables\Hi_FPT;

use App\Models\Screen;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ScreenDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_by',function($row){
                return !empty($row->created_by) ? $row->createdBy->email : '';
            })
            ->editColumn('status',function($row){
                $data = $row->status == 0 ? ['Inactive', 'badge badge-danger'] : ['Active', 'badge badge-success'];
                return '<h4 class="'.$data[1].'">'.$data[0].'</h4>';
            })
            ->editColumn('action',function($row){
                return '<div style="display:flex; justify-content:center">
                           <a href="'.route('screen.edit', [$row->id]).'" id="detail" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>
                           <form action="'.route('screen.delete', [$row->id]).'" onsubmit="handleSubmit(event,this)">
                                <button type="submit" id="delete" class="btn btn-sm fas fa-trash-alt btn-icon bg-danger"></button>
                           </form>
                       </div>
                ';
            })
            ->rawColumns(['status','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Hi_FPT/screen $model
     * @return Collection
     */
    public function query(Screen $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('screen_manage')
                    ->columns($this->getColumns())
                    ->responsive()
                    ->autoWidth(true)
                    ->orderBy(0, 'DESC')
                    ->parameters([
                        'scroll' => false,
                        'searching' => false,
                        'searchDelay' => 500,
                        'initComplete' => "function () {
                            var filter_condition = $('#filter_condition');
                            var table = $('#screen_manage').DataTable();
                            $(filter_condition).on('click', function () {
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
            Column::make('id')->title('ID'),
            Column::make('screenId')->title('ID màn hình'),
            Column::make('screenName')->title('Tên màn hình'),
            Column::make('typeLog')->title('Loại Log'),
            Column::make('api_url')->title('URL'),
            Column::make('image')->title('Hình ảnh'),
            Column::make('example_code')->title('Code example'),
            Column::make('created_at')->title('Ngày Tạo'),
            Column::make('created_by')->title('Người Tạo'),
            Column::make('status')->title('Trạng thái'),
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
        return 'screen_' . date('YmdHis');
    }
}
