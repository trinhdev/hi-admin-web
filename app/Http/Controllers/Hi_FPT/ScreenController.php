<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\BannerManageInterface;
use App\Contract\Hi_FPT\ScreenInterface;
use App\DataTables\Hi_FPT\ScreenDataTable;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\ScreenRequest\StoreRequest;
use App\Http\Requests\ScreenRequest\UpdateRequest;
use Illuminate\Http\Request;

class ScreenController extends BaseController
{
    private $ScreenRepository;

    public function __construct(ScreenInterface $ScreenRepository)
    {
        parent::__construct();
        $this->title = 'Screen Manage';
        $this->ScreenRepository = $ScreenRepository;
    }

    public function index(ScreenDataTable $dataTable, Request $request)
    {
        return $this->ScreenRepository->index($dataTable, $request);
    }

    public function create()
    {
        return $this->ScreenRepository->create();
    }

    public function store(StoreRequest $request)
    {
        $this->addToLog($request);
        return $this->ScreenRepository->store($request);
    }

    public function show($id)
    {
        return $this->ScreenRepository->show($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->addToLog($request);
        return $this->ScreenRepository->update($request, $id);
    }


    public function delete(Request $request)
    {
        $this->addToLog($request);
        return $this->ScreenRepository->delete($request->only('id'));
    }
}
