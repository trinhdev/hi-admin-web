<?php

namespace App\DataTables\Hi_FPT;

use App\Contract\Hi_FPT\DeeplinkInterface;
use App\DataTables\BuilderDatatables;
use App\Models\Deeplink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Validation\Rule;
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
    protected $hasFilter = true;

    /**
     * @var string
     */
//    protected $exportClass = ContactExport::class;

    /**
     * ContactTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param DeeplinkInterface $contactRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, DeeplinkInterface $contactRepository)
    {
        parent::__construct($table, $urlGenerator);

        $this->repository = $contactRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->addColumn('operations', function ($item) {
                return $this->getOperations('contacts.edit', 'contacts.destroy', $item);
            });
        return $this->toJson($data);
    }

    /**
     * {@inheritDoc}
     */
    public function query()
    {
        $query = Deeplink::select([
            'id',
            'name',
            'direction',
            'url',
            'created_at'
        ]);
        return $this->applyScopes($query);
    }

    /**
     * {@inheritDoc}
     */
    public function columns(): array
    {
        return [
            'id' => [
                'title' => trans('id'),
                'width' => '20px',
            ],
            'name' => [
                'title' => trans('name'),
                'class' => 'text-start',
            ],
            'email' => [
                'title' => trans('email'),
                'class' => 'text-start',
            ],
            'phone' => [
                'title' => trans('phone'),
            ],
            'created_at' => [
                'title' => trans('created_at'),
                'width' => '100px',
            ]
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultButtons(): array
    {
        return [
            'export',
            'reload',
        ];
    }
}
