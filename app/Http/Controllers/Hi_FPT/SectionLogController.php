<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\SectionLogInterface;
use App\DataTables\Hi_FPT\SectionLogDataTable;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\SectionLogRequest\StoreRequest;
use App\Http\Requests\SectionLogRequest\UpdateRequest;
use Illuminate\Http\Request;

class SectionLogController extends MY_Controller
{
    private $SectionLogRepository;

    public function __construct(SectionLogInterface $SectionLogRepository)
    {
        parent::__construct();
        $this->title = 'Banner Manage';
        $this->SectionLogRepository = $SectionLogRepository;
    }

    public function all(SectionLogDataTable $dataTable, Request $request)
    {
        return $this->SectionLogRepository->all($dataTable, $request);
    }

    public function show($id)
    {
        return $this->SectionLogRepository->show($id);
    }
}
