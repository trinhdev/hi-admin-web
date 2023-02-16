<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\TrackingInterface;
use App\DataTables\Hi_FPT\SessionAnalyticsDataTable;
use App\DataTables\Hi_FPT\UserAnalyticsDataTable;
use App\Http\Controllers\MY_Controller;
use Illuminate\Http\Request;

class TrackingController extends MY_Controller
{
    private $TrackingRepository;

    public function __construct(TrackingInterface $TrackingRepository)
    {
        parent::__construct();
        $this->title = 'Tracking Manage';
        $this->model = $this->getModel('Tracking');
        $this->TrackingRepository = $TrackingRepository;
    }

    public function views()
    {
        return $this->TrackingRepository->views();
    }

    public function userAnalytics(UserAnalyticsDataTable $dataTable, Request $request)
    {
        return $this->TrackingRepository->userAnalytics($dataTable, $request);
    }

    public function sessionAnalytics(SessionAnalyticsDataTable $dataTable, Request $request)
    {
        return $this->TrackingRepository->sessionAnalytics($dataTable, $request);
    }

    public function journeyAnalysis()
    {
        return $this->TrackingRepository->journeyAnalysis();
    }

    public function create()
    {
        return $this->TrackingRepository->create();
    }

    public function store(StoreRequest $request)
    {
        return $this->TrackingRepository->store($request);
    }

    public function show($id)
    {
        return $this->TrackingRepository->show($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->TrackingRepository->update($request, $id);
    }


    public function delete($id)
    {
        return $this->TrackingRepository->delete($id);
    }
}
