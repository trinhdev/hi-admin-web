<?php

namespace App\DataTables\Hi_FPT;

use App\DataTables\BuilderDatatables;
use App\Models\Screen;
use Illuminate\Support\Collection;
use Yajra\DataTables\Html\Column;

class ScreenDataTable extends BuilderDatatables
{
    protected $hasCheckbox = false;

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

    public function columns()
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

    public function htmlInitCompleteFunction(): ?string
    {
        return "
            var filter_condition = $('#filter_condition');
            var table = $('#screen_manage').DataTable();
            $(filter_condition).on('click', function () {
                table.ajax.reload();
            });
        ";
    }
}
