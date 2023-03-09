<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\TrackingInterface;
use App\DataTables\Hi_FPT\SessionAnalyticsDataTable;
use App\DataTables\Hi_FPT\UserAnalyticsDataTable;
use App\DataTables\Hi_FPT\ViewAnalyticsDataTable;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use Illuminate\Http\Request;

class UserAnalyticController extends BaseController
{
    private $TrackingRepository;

    public function __construct(TrackingInterface $TrackingRepository)
    {
        parent::__construct();
        $this->title = 'User Analytics';
        $this->TrackingRepository = $TrackingRepository;
    }

    public function index(UserAnalyticsDataTable $dataTable, Request $request)
    {
        return $this->TrackingRepository->userAnalytics($dataTable, $request);
    }
}
