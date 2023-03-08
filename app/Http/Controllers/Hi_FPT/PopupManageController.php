<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\PopupManageInterface;
use App\DataTables\Hi_FPT\PopUpDataTable;
use App\DataTables\Hi_FPT\PopupDetailDataTable;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\PopupManageRequest\PushRequest;
use App\Http\Requests\PopupManageRequest\StoreRequest;
use App\Http\Traits\DataTrait;
use App\Services\ExportClickService;
use Illuminate\Http\Request;

class PopupManageController extends BaseController
{
    private $PopupManageRepository;

    public function __construct(PopupManageInterface $PopupManageRepository)
    {
        parent::__construct();
        $this->title = 'Popup Manage';
        $this->PopupManageRepository = $PopupManageRepository;
    }

    public function index(PopUpDataTable $dataTable, Request $request)
    {
        return $this->PopupManageRepository->all($dataTable, $request);
    }

    public function store(StoreRequest $request)
    {
        $this->addToLog($request);
        return $this->PopupManageRepository->store($request->all());
    }

    public function push(PushRequest $request)
    {
        $this->addToLog($request);
        return $this->PopupManageRepository->push($request->all());
    }

    public function show(PopupDetailDataTable $dataTable, $id)
    {
        return $this->PopupManageRepository->show($dataTable, $id);
    }

    public function detail($id)
    {
        return $this->PopupManageRepository->detail($id);
    }

    public function getDetailPersonalMaps($id)
    {
        return $this->PopupManageRepository->getDetailPersonalMaps($id);
    }

    public function export_click(Request $request, $id)
    {
        $this->addToLog($request);
        return $this->PopupManageRepository->export_click_phone($request, $id);
    }
}
