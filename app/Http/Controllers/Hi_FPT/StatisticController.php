<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\StatisticInterface;
use App\DataTables\Hi_FPT\StatisticDataTable;
use App\DataTables\Hi_FPT\StatisticDataTableDetail;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\StatisticRequest\StoreRequest;

class StatisticController extends BaseController
{
    private $StatisticRepository;

    public function __construct(StatisticInterface $StatisticRepository)
    {
        parent::__construct();
        $this->title = 'Statistic Manage';
        $this->StatisticRepository = $StatisticRepository;
    }

    public function index(StatisticDataTable $dataTable, StatisticDataTableDetail $dataTableDetail, StoreRequest $request)
    {
        return $this->StatisticRepository->index($dataTable, $dataTableDetail, $request);
    }

    public function detail(StatisticDataTable $dataTable, StoreRequest $request)
    {
        $this->addToLog($request);
        return $this->StatisticRepository->detail($dataTable, $request);

    }
}
