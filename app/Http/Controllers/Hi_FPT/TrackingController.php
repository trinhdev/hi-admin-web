<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\TrackingInterface;
use App\DataTables\Hi_FPT\SessionAnalyticsDataTable;
use App\DataTables\Hi_FPT\UserAnalyticsDataTable;
use App\DataTables\Hi_FPT\ViewAnalyticsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    private $TrackingRepository;

    public function __construct(TrackingInterface $TrackingRepository)
    {
        $this->title = 'Tracking Manage';
        $this->TrackingRepository = $TrackingRepository;
    }

    public function views(ViewAnalyticsDataTable $dataTable, Request $request)
    {
        return $this->TrackingRepository->views($dataTable, $request);
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
}
