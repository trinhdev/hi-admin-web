<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\BannerManageInterface;
use App\DataTables\Hi_FPT\BannerManageDataTable;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\BannerManageRequest\ExportRequest;
use App\Http\Requests\BannerManageRequest\StoreRequest;
use App\Http\Requests\BannerManageRequest\UpdateRequest;
use Illuminate\Http\Request;

class BannerController extends BaseController
{
    private $BannerManageRepository;

    public function __construct(BannerManageInterface $BannerManageRepository)
    {
        parent::__construct();
        $this->title = 'Banner Manage';
        $this->BannerManageRepository = $BannerManageRepository;
    }

    public function index(BannerManageDataTable $dataTable, Request $request)
    {
        return $this->BannerManageRepository->all($dataTable, $request);
    }

    public function store(StoreRequest $request)
    {
        return $this->BannerManageRepository->store($request);
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->BannerManageRepository->update($request, $id);
    }

    public function show($id)
    {
        return $this->BannerManageRepository->show($id);
    }

    public function export_click_phone(Request $request, $id)
    {
        return $this->BannerManageRepository->export_click_phone($request, $id);
    }

    public function update_order(Request $request)
    {
        return $this->BannerManageRepository->update_order($request);
    }

    public function update_banner_fconnect(Request $request)
    {
        return $this->BannerManageRepository->update_banner_fconnect($request);
    }
}
