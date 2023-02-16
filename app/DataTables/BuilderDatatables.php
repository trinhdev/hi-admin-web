<?php

namespace App\DataTables;

use App\Contract\Hi_FPT\DeeplinkInterface;
use App\Repository\RepositoryInterface;
use Closure;
use Exception;
use Collective\Html\FormFacade as Form;
use Collective\Html\HtmlFacade as Html;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\CollectionDataTable;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\QueryDataTable;
use Yajra\DataTables\Services\DataTable;

abstract class BuilderDatatables extends DataTable
{
    public const TABLE_TYPE_ADVANCED = 'advanced';

    public const TABLE_TYPE_SIMPLE = 'simple';

    /**
     * @var bool
     */
    protected $bStateSave = true;

    /**
     * @var DataTables
     */
    protected $table;

    /**
     * @var string
     */
    protected $type = self::TABLE_TYPE_ADVANCED;

    /**
     * @var string
     */
    protected $ajaxUrl;

    /**
     * @var int
     */
    protected $pageLength = 10;

    /**
     * @var string
     */
    protected $view = 'table.table';

    /**
     * @var string
     */
    protected $filterTemplate = 'table.filter';

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var bool
     */
    protected $hasCheckbox = true;

    /**
     * @var bool
     */
    protected $hasOperations = true;

    /**
     * @var bool
     */
    protected $hasActions = false;

    /**
     * @var string
     */
    protected $bulkChangeUrl = '';

    /**
     * @var bool
     */
    protected $hasFilter = false;

    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var bool
     */
    protected $useDefaultSorting = true;

    /**
     * @var int
     */
    protected $defaultSortColumn = 1;

    /**
     * @var string
     */
//    protected $exportClass = TableExportHandler::class;

    /**
     * TableAbstract constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     */
    public function __construct(Datatables $table)
    {
        $this->table = $table;

        if ($this->type == self::TABLE_TYPE_SIMPLE) {
            $this->pageLength = -1;
        }

        $this->bulkChangeUrl = '';
    }

    /**
     * @param string $key
     * @return string
     */
    public function getOption(string $key): ?string
    {
        return Arr::get($this->options, $key);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function setOption(string $key, $value): self
    {
        $this->options[$key] = $value;

        return $this;
    }

    /**
     * @return bool
     */
    public function isHasFilter(): bool
    {
        return $this->hasFilter;
    }

    /**
     * @param bool $hasFilter
     * @return $this
     */
    public function setHasFilter(bool $hasFilter): self
    {
        $this->hasFilter = $hasFilter;

        return $this;
    }

    /**
     * @return RepositoryInterface
     */
    public function getRepository(): RepositoryInterface
    {
        return $this->repository;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     *
     * @since 2.1
     */


    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->responsive()
            ->orderBy(1, 'DESC')
            ->parameters([
                'scroll' => false,
                'searching' => true,
                'searchDelay' => 350,
                'bDeferRender' => true,
                'bDestroy' => true,
                'autoWidth' => false,
                'serverSide' => true,
                'retrieve' => false,
                'initComplete' => $this->htmlInitComplete(),
                'drawCallback' => $this->htmlDrawCallback(),
                'dom' => $this->getDom(),
                'buttons' => $this->getBuilderParameters(),
                'columnDefs' => [
                    ['searchable' => false,
                        'targets' => 'notsearchable'],
                    [
                        'sortable' => false,
                        'targets' => 'notsortable'
                    ],
                ],
            ])
            ->addTableClass('table-responsive')
            ->language([
                'emptyTable' => preg_replace("/{(\d+)}/", ('dt_entries'), ('Không có dữ liệu')),
                'info' => preg_replace("/{(\d+)}/", ('dt_entries'), 'Hiển thị trang _PAGE_ của _PAGES_ trang'),
                'infoEmpty' => preg_replace("/{(\d+)}/", ('dt_entries'), ('Không có dữ liệu')),
                'infoFiltered' => preg_replace("/{(\d+)}/", ('dt_entries'), ('dt_info_filtered')),
                'lengthMenu' => '_MENU_',
                'loadingRecords' => ('Đang tải'),
                'processing' => '<div class="dt-loader"></div>',
                'search' => '<div class="input-group"><span class="input-group-addon"><span class="fa fa-search"></span></span>',
                'searchPlaceholder' => ('Tìm kiếm'),
                'zeroRecords' => '<p class="text-center">Không có dữ liệu</p>',
                'paginate' => [
                    'first' => 'Trước',
                    'last' => ('Cuối'),
                    'next' => ('Tiếp'),
                    'previous' => ('Sau'),
                ],
                'aria' => [
                    'sortAscending' => (''),
                    'sortDescending' => ('Sắp sếp giảm dần'),
                ],
            ]);
    }

    /**
     * @return array
     * @since 2.1
     */
    public function getColumns(): array
    {
        $columns = $this->columns();
        foreach ($columns as $key => &$column) {
            $column['class'] = Arr::get($column, 'class') . ' column-key-' . $key;
        }

        if ($this->hasCheckbox) {
            $columns = array_merge($this->getCheckboxColumnHeading(), $columns);
        }


        return $columns;
    }

    public function getCheckboxColumnHeading()
    {
        return [
            'checkbox' => [
                'orderable' => false,
                'searchable' => false,
                'exportable' => false,
                'printable' => false,
                'width' => '10px',
                'class' => 'text-center',
                'title' => '<div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="responsive"><label></label></div>',
            ]
        ];
    }

    protected function addCreateButton(string $url, array $buttons = []): array
    {
        $buttons['create'] = [
            'link' => $url,
            'title' => 'Tạo mới',
        ];
        return $buttons;
    }

    protected function getFunction($callback)
    {
        if (is_string($callback)) {
            if (strpos($callback, '@')) {
                $callback = explode('@', $callback);

                return [app('\\' . $callback[0]), $callback[1]];
            }

            return $callback;
        } elseif ($callback instanceof Closure) {
            return $callback;
        } elseif (is_array($callback)) {
            return $callback;
        }
        return false;
    }

    /**
     * @return array
     * @since 2.1
     */
    abstract public function columns();

    /**
     * @return string
     */
    public function getAjaxUrl(): string
    {
        return $this->ajaxUrl;
    }

    /**
     * @param string $ajaxUrl
     * @return $this
     */
    public function setAjaxUrl(string $ajaxUrl): self
    {
        $this->ajaxUrl = $ajaxUrl;

        return $this;
    }

    /**
     * @return null|string
     */
    protected function getDom(): ?string
    {
        return "<'row'><'row'<'col-md-7'lB><'col-md-5'f>>rt<'row'<'col-md-4'i><'col-md-8 dataTables_paging'<'#colvis'><'.dt-page-jump'>p>>";
    }

    /**
     * @return array
     * @since 2.1
     */
    public function getBuilderParameters(): array
    {
        $params = [
            'stateSave' => true,
        ];

        $buttons = array_merge($this->getButtons(), $this->getDefaultButtons());
        if (!$buttons) {
            return $params;
        }
        return $params + compact('buttons');
    }

    /**
     * @return array
     * @since 2.1
     */
    public function getButtons(): array
    {
        $buttons = $this->buttons();
        if (!$buttons) {
            return [];
        }

        $data = [];

        foreach ($buttons as $key => $button) {
            if (Arr::get($button, 'extend') == 'collection') {
                $data[] = $button;
            } else {
                $data[] = [
                    'className' => 'btn btn-default btn-sm btn-default-dt-options',
                    'text' => Html::tag('span', $button['text'], [
                        'data-action' => $key,
                        'data-href' => Arr::get($button, 'link'),
                    ])->toHtml(),
                ];
            }
        }

        return $data;
    }

    /**
     * @return array
     * @since 2.1
     */
    public function buttons(){}

    /**
     * @return array
     */
    public function getActionsButton(): array
    {
        if (!$this->getActions()) {
            return [];
        }

        return [
            [
                'extend' => 'collection',
                'text' => '<span>' . trans('core/base::forms.actions') . ' <span class="caret"></span></span>',
                'buttons' => $this->getActions(),
            ],
        ];
    }

    /**
     * @return array
     * @since 2.1
     */
    public function getActions(): array
    {
        if ($this->type == self::TABLE_TYPE_SIMPLE || !$this->actions()) {
            return [];
        }

        $actions = [];

        foreach ($this->actions() as $key => $action) {
            $actions[] = [
                'className' => 'action-item',
                'text' => '<span data-action="' . $key . '" data-href="' . $action['link'] . '"> ' . $action['text'] . '</span>',
            ];
        }

        return $actions;
    }

    /**
     * @return array
     * @since 2.1
     */
    public function actions()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getDefaultButtons(): array
    {
        return [
            [
                'extend' => 'collection',
                'text' => 'Xuất ra',
                'autoClose' => true,
                'attr' => [
                    'class' => 'btn btn-default buttons-collection btn-sm btn-default-dt-options'
                ],
                'buttons' => [
                    [
                        'text' => 'Excel',
                        'extend' => 'excel'
                    ],
                    [
                        'text' => 'CSV',
                        'extend' => 'csv'
                    ],
                    [
                        'text' => 'PDF',
                        'extend' => 'pdf'
                    ],[
                        'text' => 'Print',
                        'extend' => 'print'
                    ]
                ]
            ],
            [
                'extend' => 'colvis',
                'text' => '<i class="fa fa-cog"></i>',
                'autoClose' => true,
                'attr' => [
                    'class' => 'btn btn-default btn-sm btn-default-dt-options btn-dt-colvis'
                ],
            ],
            [
                'extend' => 'collection',
                'text' => '<i class="fa fa-refresh"></i>',
                'autoClose' => true,
                'attr' => [
                    'class' => 'btn btn-default btn-sm btn-default-dt-options btn-dt-reload'
                ],
                'action'    => 'function ( e, dt, node, config ) {dt.ajax.reload();}',
            ]
        ];
    }

    /**
     * @return string
     */
    public function htmlInitComplete(): ?string
    {
        return 'function () {' . $this->htmlInitCompleteFunction() . '}';
    }

    abstract public function htmlInitCompleteFunctionCustom();

    /**
     * @return string
     */
    public function htmlInitCompleteFunction(): ?string
    {
        return $this->htmlInitCompleteFunctionCustom() . $this->htmlInitCompleteFunctionDefault();
    }

    public function htmlInitCompleteFunctionDefault(): ?string
    {
        return "
            var t = this;
            t.parents('.table-loading').removeClass('table-loading');
            t.removeClass('dt-table-loading');
            var btnReload = $('.btn-dt-reload');
            btnReload.attr('data-toggle', 'tooltip');
            btnReload.attr('title', 'Tải lại');

            if (is_mobile() && $(window).width() < 400  && t.find('tbody td:first-child input[type=`checkbox`]').length > 0) {
                t.DataTable().column(0).visible(false, false).columns.adjust();
                $('a[data-target*=`bulk_actions`]').addClass('hide');
              }
        ";
    }

    /**
     * @return string
     */
    public function htmlDrawCallback(): ?string
    {
        if ($this->type == self::TABLE_TYPE_SIMPLE) {
            return null;
        }

        return 'function () {' . $this->htmlDrawCallbackFunction() . '}';
    }

    /**
     * @return string
     */
    public function htmlDrawCallbackFunction(): ?string
    {
        return '

        ';
    }

    public function toJson($data, array $escapeColumn = [], bool $mDataSupport = true)
    {
//        if ($this->repository && $this->repository->getModel()) {
//            $data = apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel());
//        }

        return $data
            ->escapeColumns($escapeColumn)
            ->make($mDataSupport);
    }
}
