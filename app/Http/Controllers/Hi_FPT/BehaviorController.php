<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\BannerManageInterface;
use App\Contract\Hi_FPT\BehaviorInterface;
use App\DataTables\Hi_FPT\BehaviorDataTable;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\BehaviorRequest\StoreRequest;
use App\Http\Requests\BehaviorRequest\UpdateRequest;
use Illuminate\Http\Request;

class BehaviorController extends MY_Controller
{
    private $BehaviorRepository;

    public function __construct(BehaviorInterface $BehaviorRepository)
    {
        parent::__construct();
        $this->title = 'Behavior Manage';
        $this->BehaviorRepository = $BehaviorRepository;
    }

    public function index()
    {
        return $this->BehaviorRepository->index();
    }

     public function store(StoreRequest $request)
     {
         return $this->BehaviorRepository->store($request);
     }
}
