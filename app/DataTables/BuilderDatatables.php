<?php

namespace App\DataTables;

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
    public function __construct(Datatables $table, UrlGenerator $urlGenerator)
    {
        $this->table = $table;
        $this->ajaxUrl = $urlGenerator->current();

        if ($this->type == self::TABLE_TYPE_SIMPLE) {
            $this->pageLength = -1;
        }

        if (!$this->getOption('id')) {
            $this->setOption('id', strtolower(Str::slug(Str::snake(get_class($this)))));
        }

        if (!$this->getOption('class')) {
            $this->setOption('class', 'table table-striped table-hover vertical-middle');
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
     * @return string
     */
    public function getView(): string
    {
        return $this->view;
    }

    /**
     * @param string $view
     * @return $this
     */
    public function setView(string $view): self
    {
        $this->view = $view;

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
        if ($this->request->has('filter_table_id')) {
            $this->bStateSave = false;
        }

        return $this->builder()
            ->columns($this->getColumns())
            ->ajax(['url' => $this->getAjaxUrl(), 'method' => 'POST'])
            ->parameters([
                'dom' => $this->getDom(),
                'buttons' => $this->getBuilderParameters(),
                'initComplete' => $this->htmlInitComplete(),
                'drawCallback' => $this->htmlDrawCallback(),
                'paging' => true,
                'searching' => true,
                'info' => true,
                'searchDelay' => 350,
                'bStateSave' => $this->bStateSave,
                'lengthMenu' => [
                    array_values(array_unique(array_merge(Arr::sortRecursive([10, 30, 50, 100, 500, $this->pageLength]), [-1]))),
                    array_values(array_unique(array_merge(
                        Arr::sortRecursive([10, 30, 50, 100, 500, $this->pageLength]),
                        [trans('core/base::tables.all')]
                    ))),
                ],
                'pageLength' => $this->pageLength,
                'processing' => true,
                'serverSide' => true,
                'bServerSide' => true,
                'bDeferRender' => true,
                'bProcessing' => true,
                'language' => [
                    'aria' => [
                        'sortAscending' => 'orderby asc',
                        'sortDescending' => 'orderby desc',
                        'paginate' => [
                            'next' => trans('pagination.next'),
                            'previous' => trans('pagination.previous'),
                        ],
                    ],
                    'emptyTable' => trans('core/base::tables.no_data'),
                    'info' => '',
                    'infoEmpty' => trans('core/base::tables.no_record'),
                    'lengthMenu' => Html::tag('span', '_MENU_', ['class' => 'dt-length-style'])->toHtml(),
                    'search' => '',
                    'searchPlaceholder' => trans('table.table.search'),
                    'zeroRecords' => trans('core/base::tables.no_record'),
                    'processing' => Html::image('vendor/core/core/base/images/loading-spinner-blue.gif'),
                    'paginate' => [
                        'next' => trans('pagination.next'),
                        'previous' => trans('pagination.previous'),
                    ],
                    'infoFiltered' => trans('table.table.filtered'),
                ],
                'aaSorting' => $this->useDefaultSorting ? [
                    [
                        ($this->hasCheckbox ? $this->defaultSortColumn : 0),
                        'desc',
                    ],
                ] : [],
                'responsive' => true,
                'autoWidth' => false,
            ]);
    }

    /**
     * @return array
     * @since 2.1
     */
    public function getColumns(): array
    {
        $columns = $this->columns();

        if ($this->type == self::TABLE_TYPE_SIMPLE) {
            return $this->repository->getModel();
        }

        foreach ($columns as $key => &$column) {
            $column['class'] = Arr::get($column, 'class') . ' column-key-' . $key;
        }

//        if ($this->repository) {
//            $columns = $this->apply_filters('table_headings', $columns, $this->repository->getModel());
//        }

        if ($this->hasOperations) {
            $columns = array_merge($columns, $this->getOperationsHeading());
        }

        if ($this->hasCheckbox) {
            $columns = array_merge($this->getCheckboxColumnHeading(), $columns);
        }

        return $columns;
    }

    public function getListeners(): array
    {
        foreach ($this->listeners as $listeners) {
            uksort($listeners, function ($param1, $param2) {
                return strnatcmp($param1, $param2);
            });
        }

        return $this->listeners;
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

    public function fire(string $action, array $args)
    {
        $value = $args[0] ?? ''; // get the value, the first argument is always the value
        if (!$this->getListeners()) {
            return $value;
        }

        foreach ($this->getListeners() as $hook => $listeners) { // go through each of the priorities
            ksort($listeners);
            foreach ($listeners as $arguments) { // loop all hooks
                if ($hook === $action) { // if the hook responds to the current filter
                    $parameters = [$value];
                    for ($index = 1; $index < $arguments['arguments']; $index++) {
                        if (isset($args[$index])) {
                            $parameters[] = $args[$index]; // add arguments if it is there
                        }
                    }
                    // filter the value
                    $value = call_user_func_array($this->getFunction($arguments['callback']), $parameters);
                }
            }
        }

        return $value;
    }
    function apply_filters()
    {
        $args = func_get_args();

        return $this->fire(array_shift($args), $args);
    }

    /**
     * @return array
     * @since 2.1
     */
    abstract public function columns();

    /**
     * @return array
     */
    public function getOperationsHeading()
    {
        return [
            'operations' => [
                'title' => trans('core/base::tables.operations'),
                'width' => '134px',
                'class' => 'text-center',
                'orderable' => false,
                'searchable' => false,
                'exportable' => false,
                'printable' => false,
            ],
        ];
    }

    /**
     * @param string|null $edit
     * @param string|null $delete
     * @param mixed $item
     * @param string|null $extra
     * @return string
     */
    protected function getOperations(?string $edit, ?string $delete, $item, ?string $extra = null): string
    {
        return apply_filters('table_operation_buttons', table_actions($edit, $delete, $item, $extra), $item, $edit, $delete, $extra);
    }

    /**
     * @return array
     */
    public function getCheckboxColumnHeading()
    {
        return [
            'checkbox' => [
                'width' => '10px',
                'class' => 'text-start no-sort',
                'title' => Form::input('checkbox', null, null, [
                    'class' => 'table-check-all',
                    'data-set' => '.dataTable .checkboxes',
                ])->toHtml(),
                'orderable' => false,
                'searchable' => false,
                'exportable' => false,
                'printable' => false,
            ],
        ];
    }

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
        $dom = null;

        switch ($this->type) {
            case self::TABLE_TYPE_ADVANCED:
                $dom = "fBrt<'datatables__info_wrap'pli<'clearfix'>>";

                break;
            case self::TABLE_TYPE_SIMPLE:
                $dom = "t<'datatables__info_wrap'<'clearfix'>>";

                break;
        }

        return $dom;
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

        if ($this->type == self::TABLE_TYPE_SIMPLE) {
            return $params;
        }

        $buttons = array_merge($this->getButtons(), $this->getActionsButton());

        $buttons = array_merge($buttons, $this->getDefaultButtons());
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
//        $buttons = $this->apply_filters('base_filter_table_buttons', $this->buttons(), get_class($this->repository->getModel()));
        $buttons = null;
        if (!$buttons) {
            return [];
        }

        $data = [];

        foreach ($buttons as $key => $button) {
            if (Arr::get($button, 'extend') == 'collection') {
                $data[] = $button;
            } else {
                $data[] = [
                    'className' => 'action-item',
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
    public function buttons()
    {
        return [];
    }

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
            'reload',
        ];
    }

    /**
     * @return string
     */
    public function htmlInitComplete(): ?string
    {
        return 'function () {' . $this->htmlInitCompleteFunction() . '}';
    }

    /**
     * @return string
     */
    public function htmlInitCompleteFunction(): ?string
    {
        return '
            if (jQuery().select2) {
                $(document).find(".select-multiple").select2({
                    width: "100%",
                    allowClear: true,
                    placeholder: $(this).data("placeholder")
                });
                $(document).find(".select-search-full").select2({
                    width: "100%"
                });
                $(document).find(".select-full").select2({
                    width: "100%",
                    minimumResultsForSearch: -1
                });
            }
        ';
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
            var pagination = $(this).closest(".dataTables_wrapper").find(".dataTables_paginate");
            pagination.toggle(this.api().page.info().pages > 1);

            var data_count = this.api().data().count();

            var length_select = $(this).closest(".dataTables_wrapper").find(".dataTables_length");
            var length_info = $(this).closest(".dataTables_wrapper").find(".dataTables_info");
            length_select.toggle(data_count >= 10);
            length_info.toggle(data_count > 0);

            if (jQuery().select2) {
                $(document).find(".select-multiple").select2({
                    width: "100%",
                    allowClear: true,
                    placeholder: $(this).data("placeholder")
                });
                $(document).find(".select-search-full").select2({
                    width: "100%"
                });
                $(document).find(".select-full").select2({
                    width: "100%",
                    minimumResultsForSearch: -1
                });
            }

            $("[data-bs-toggle=tooltip]").tooltip({
                placement: "top"
            });
        ';
    }

    /**
     * @param array $data
     * @param array $mergeData
     * @return JsonResponse|View
     * @since 2.4
     */
    public function renderTable(array $data = [], array $mergeData = [])
    {
        return $this->render($this->view, $data, $mergeData);
    }

    /**
     * @param string $view
     * @param array $data
     * @param array $mergeData
     * @return mixed
     */
    public function render($view, $data = [], $mergeData = [])
    {
        $data['id'] = Arr::get($data, 'id', $this->getOption('id'));
        $data['class'] = Arr::get($data, 'class', $this->getOption('class'));

        $this->setAjaxUrl($this->ajaxUrl . '?' . http_build_query(request()->input()));

        $this->setOptions($data);

        $data['table'] = $this;
        return parent::render($view, $data, $mergeData);
    }

    /**
     * @param EloquentBuilder|Builder $query
     * @return mixed
     */
    public function applyScopes($query)
    {
        return parent::applyScopes($query);
    }


    /**
     * @param string|null $title
     * @param string|null $value
     * @param string| null $type
     * @param array $data
     * @return array
     */
    public function getValueInput(?string $title, ?string $value, ?string $type, array $data = []): array
    {
        $inputName = 'value';

        if (empty($title)) {
            $inputName = 'filter_values[]';
        }
        $attributes = [
            'class' => 'form-control input-value filter-column-value',
            'placeholder' => trans('table.table.value'),
            'autocomplete' => 'off',
        ];

        switch ($type) {
            case 'select':
            case 'customSelect':
                $attributes['class'] = $attributes['class'] . ' select';
                $attributes['placeholder'] = trans('table.table.select_option');
                $html = Form::customSelect($inputName, $data, $value, $attributes)->toHtml();

                break;

            case 'select-search':
                $attributes['class'] = $attributes['class'] . ' select-search-full';
                $attributes['placeholder'] = trans('table.table.select_option');
                $html = Form::customSelect($inputName, $data, $value, $attributes)->toHtml();

                break;

            case 'select-ajax':
                $attributes = [
                    'class' => $attributes['class'] . ' select-search-ajax',
                    'data-url' => Arr::get($data, 'url'),
                    'data-minimum-input' => Arr::get($data, 'minimum-input', 2),
                    'multiple' => Arr::get($data, 'multiple', false),
                    'data-placeholder' => Arr::get($data, 'placeholder', $attributes['placeholder']),
                ];
                $html = Form::customSelect($inputName, Arr::get($data, 'selected', []), $value, $attributes)->toHtml();

                break;

            case 'number':
                $html = Form::number($inputName, $value, $attributes)->toHtml();

                break;

            case 'date':
                $attributes['class'] = $attributes['class'] . ' datepicker';
                $attributes['data-date-format'] = config('core.base.general.date_format.js.date');
                $content = Form::text($inputName, $value, $attributes)->toHtml();
                $html = view('table.partials.date-field', compact('content'))->render();

                break;

            default:
                $html = Form::text($inputName, $value, $attributes)->toHtml();

                break;
        }

        return compact('html', 'data');
    }


    /**
     * @param QueryDataTable | CollectionDataTable $data
     * @param array $escapeColumn
     * @param bool $mDataSupport
     * @return mixed
     * @throws Exception
     */
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
