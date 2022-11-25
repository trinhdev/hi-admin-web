<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\RenderDeeplinkInterface;
use App\DataTables\Hi_FPT\RenderDeeplinkDataTable;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\RenderDeeplinkRequest\StoreRequest;
use App\Http\Requests\RenderDeeplinkRequest\UpdateRequest;
use Illuminate\Http\Request;

class RenderDeeplinkController extends MY_Controller
{
    private $RenderDeeplinkRepository;

    public function __construct(RenderDeeplinkInterface $RenderDeeplinkRepository)
    {
        parent::__construct();
        $this->title = 'RenderDeeplink Manage';
        $this->RenderDeeplinkRepository = $RenderDeeplinkRepository;
    }

    public function index()
    {
        return $this->RenderDeeplinkRepository->index();
    }


    public function store(StoreRequest $request)
    {
        return $this->RenderDeeplinkRepository->store($request);
    }
}
