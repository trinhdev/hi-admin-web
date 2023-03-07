<?php

namespace App\Http\Controllers\Hi_FPT;


use App\Contract\Hi_FPT\BehaviorInterface;
use App\Http\Controllers\BaseController;
use App\Http\Requests\BehaviorRequest\StoreRequest;

class BehaviorController extends BaseController
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
