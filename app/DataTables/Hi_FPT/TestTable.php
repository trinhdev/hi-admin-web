<?php

namespace App\DataTables\Hi_FPT;

use App\Contract\Hi_FPT\DeeplinkInterface;
use App\Models\Deeplink;

use App\DataTables\BuilderDatatables;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class TestTable extends BuilderDatatables
{
    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $useDefaultSorting = false;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * DeeplinkTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param DeeplinkInterface $DeeplinkRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, DeeplinkInterface $DeeplinkRepository)
    {
        parent::__construct($table, $urlGenerator, $DeeplinkRepository);

        $this->repository = $DeeplinkRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function ajax()
    {
        $data = $this->table
            ->of($this->query())
            ->editColumn('name', function ($item) {
                if (!Auth::user()->hasPermission('categories.edit')) {
                    return BaseHelper::clean($item->name);
                }

                return Html::link(route('categories.edit', $item->id), $item->indent_text . ' ' . BaseHelper::clean($item->name));
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return changeFormatDateLocal($item->created_at);
            })
            ->editColumn('updated_at', function ($item) {
                return changeFormatDateLocal($item->updated_at);
            })
            ->addColumn('operations', function ($item) {
                return view('table.actions', compact('item'))->render();
            });
        return $this->toJson($data);
    }

    /**
     * {@inheritDoc}
     */
    public function query(Deeplink $model)
    {

        return collect($model->select('*'));
    }

    /**
     * {@inheritDoc}
     */
    public function columns(): array
    {

        return [
            'id' => [
                'title' => 'id',
                'width' => '20px',
            ],
            'name' => [
                'title' => 'name',
                'class' => 'text-start',
            ],
            'created_at' => [
                'title' => 'created_at',
                'width' => '100px',
            ]
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons(): array
    {

        return $this->addCreateButton(route('deeplink.create'), (array)'deeplink.create');
    }

    /**
     * {@inheritDoc}
     */
//    public function bulkActions(): array
//    {
//        return $this->addDeleteAction(route('deeplink.delete'), 'deeplink.destroy', parent::bulkActions());
//    }

    /**
     * {@inheritDoc}
     */
//    public function getBulkChanges(): array
//    {
//        return [
//            'name' => [
//                'title' => trans('core/base::tables.name'),
//                'type' => 'text',
//                'validate' => 'required|max:120',
//            ],
//            'status' => [
//                'title' => trans('core/base::tables.status'),
//                'type' => 'customSelect',
//                'choices' => BaseStatusEnum::labels(),
//                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
//            ],
//            'created_at' => [
//                'title' => trans('core/base::tables.created_at'),
//                'type' => 'date',
//            ],
//        ];
//    }
}
