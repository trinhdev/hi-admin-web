<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\DeeplinkInterface;
use App\DataTables\Hi_FPT\DeeplinkDataTable;
use App\Http\Controllers\BaseController;
use App\Http\Requests\DeeplinkRequest\StoreRequest;
use App\Http\Requests\DeeplinkRequest\UpdateRequest;
use Illuminate\Http\Request;

class DeeplinkController extends BaseController
{
    private $DeeplinkRepository;

    public function __construct(DeeplinkInterface $DeeplinkRepository)
    {
        parent::__construct();
        $this->title = 'Deeplink Manage';
        $this->DeeplinkRepository = $DeeplinkRepository;
    }

    public function index(DeeplinkDataTable $dataTable, Request $request)
    {
        return $this->DeeplinkRepository->index($dataTable, $request);
    }

    public function create()
    {
        return $this->DeeplinkRepository->create();
    }

    public function store(StoreRequest $request)
    {
        return $this->DeeplinkRepository->store($request);
    }

    public function show($id)
    {
        return $this->DeeplinkRepository->show($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->DeeplinkRepository->update($request, $id);
    }


    public function delete($id)
    {
        return $this->DeeplinkRepository->delete($id);
    }
}
