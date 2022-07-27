<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\BannerManageInterface;
use App\DataTables\Hi_FPT\BannerManageDataTable;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\BannerManageRequest\StoreRequest;
use App\Http\Requests\BannerManageRequest\UpdateRequest;
use Illuminate\Http\Request;

class BannerController extends MY_Controller
{
    private $BannerManageRepository;

    public function __construct(BannerManageInterface $BannerManageRepository)
    {
        parent::__construct();
        $this->title = 'Banner Manage';
        $this->BannerManageRepository = $BannerManageRepository;
    }

    public function all(BannerManageDataTable $dataTable, Request $request)
    {
        return $this->BannerManageRepository->all($dataTable, $request);
    }

    public function store(StoreRequest $request)
    {
        return $this->BannerManageRepository->store($request->validated());
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->BannerManageRepository->update($request, $id);
    }

    public function show($id)
    {
        return $this->BannerManageRepository->show($id);
    }

    public function view($id)
    {
        return $this->BannerManageRepository->view($id);
    }
}
