<?php

namespace App\DataTables\Hi_FPT;

use App\Models\Employees;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use DataTables;

class EmployeesDataTable extends DataTable
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
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('action',function($row) {
                return '<div style="display:flex; justify-content:center" class="infoRow" data-id="' . $row->id . '">
                            <a style="margin-right: 5px" type="button" onclick="getDetail(this)" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>
                            <form action="/employees/destroy/' . $row->id . '" method="POST" onsubmit="handleSubmit(event,this)">
                                '.csrf_field().'
                                '.method_field("DELETE").'
                                <button type="submit" class="btn btn-sm fas fa-trash-alt btn-icon bg-red"></button>
                            </form>
                        </div>';
            })
            ->escapeColumns([])
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hi_FPT/Banner $model
     * @return Builder
     */
    public function query()
    {
        $employees = Employees::query();
        return $this->applyScopes($employees);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('employees')
                    ->columns($this->getColumns())
                    ->lengthMenu([10, 25, 50, 100, 200, 500])
                    ->pageLength(25)
                    ->parameters([
                        'scroll' => false,
                        'scrollX' => true,
                        'searching' => true,
                        'searchDelay' => 500
                    ])
                    ->addTableClass('table table-hover table-striped text-center w-100')
                    ->languageEmptyTable('Không có dữ liệu')
                    ->languageInfoEmpty('Không có dữ liệu')
                    ->languageProcessing('<img width="20px" src="/images/input-spinner.gif" />')
                    ->languageSearchPlaceholder('Nhập thông tin cần tra cứu')
                    ->languageSearch('Tìm kiếm')
                    ->languagePaginateFirst('Đầu')->languagePaginateLast('Cuối')->languagePaginateNext('Sau')->languagePaginatePrevious('Trước')
                    ->languageLengthMenu('Hiển thị _MENU_')
                    ->languageInfo('Hiển thị trang _PAGE_ của _PAGES_ trang');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name')->title('Mobisale ACC')->searching(false),
            Column::make('full_name')->title('Full name')->sortable(false)->searching(false),
            Column::make('phone')->title('Phone')->sortable(false)->searching(false),
            Column::make('emailAddress')->title('Email')->sortable(false)->searching(false),
            Column::make('location_id')->title('Location ID')->sortable(false)->searching(false),
            Column::make('branch_code')->title('Branch code')->sortable(false)->searching(false),
            Column::make('description')->title('Description')->sortable(false)->searching(false),
            Column::make('code')->title('Code')->sortable(false)->searching(false),
            Column::make('organizationCode')->title('Organization code')->sortable(false)->searching(false),
            Column::make('organizationCodePath')->title('Organization code path')->sortable(false)->searching(false),
            Column::make('location')->title('Location')->sortable(false)->searching(false),
            Column::make('isActive')->title('Is active')->sortable(false)->searching(false),
            Column::make('employee_code')->title('Employee code')->sortable(false)->searching(false),
            Column::make('organizationNamePath')->title('Organization name path')->sortable(false)->searching(false),
            Column::make('dept_id')->title('Dept id')->sortable(false)->searching(false),
            Column::make('dept_name_1')->title('Dept name 1')->sortable(false)->searching(false),
            Column::make('dept_name_2')->title('Dept name 2')->sortable(false)->searching(false),
            Column::make('branch_name')->title('Branch name')->sortable(false)->searching(false),
            Column::make('organization_zone_name')->title('Organization zone name')->sortable(false)->searching(false),
            Column::make('organization_branch_code')->title('Organization branch code')->sortable(false)->searching(false),
            Column::make('created_at')->title('Ngày Tạo')->searching(false),
            Column::make('updated_at')->title('Ngày Tạo')->searching(false),
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
