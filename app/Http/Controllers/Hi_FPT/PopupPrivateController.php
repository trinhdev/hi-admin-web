<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\PopupPrivateInterface;
use App\DataTables\Hi_FPT\PopUpPrivateDataTable;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\PopupPrivateRequest\ImportRequest;
use App\Http\Requests\PopupPrivateRequest\StoreRequest;
use App\Http\Requests\PopupPrivateRequest\UpdateRequest;
use App\Rules\NumberPhoneRule;
use Illuminate\Http\Request;


class PopupPrivateController extends BaseController
{
    private $PopupPrivateRepository;

    public function __construct(PopupPrivateInterface $PopupPrivateRepository)
    {
        parent::__construct();
        $this->title = 'Popup Private';
        $this->PopupPrivateRepository = $PopupPrivateRepository;
    }

    public function all(PopUpPrivateDataTable $dataTable, Request $request)
    {
        return $this->PopupPrivateRepository->all($dataTable,$request);
    }

    public function paginate(Request $request)
    {
        return $this->PopupPrivateRepository->paginate($request->only(['size','page']));
    }

    public function store(StoreRequest $request)
    {
        return $this->PopupPrivateRepository->store($request->all());
    }

    public function update(UpdateRequest $request)
    {
        return $this->PopupPrivateRepository->update($request->all());
    }

    public function show(Request $request)
    {
        return $this->PopupPrivateRepository->show($request->only(['id']));
    }

    public function destroy(Request $request)
    {
        return $this->PopupPrivateRepository->destroy($request->only(['id', 'check']));
    }

    public function importFile(Request $request)
    {
        return $this->PopupPrivateRepository->importFile($request);
    }

    public function import(ImportRequest $request)
    {
        return $this->PopupPrivateRepository->import($request->all());
    }
}
