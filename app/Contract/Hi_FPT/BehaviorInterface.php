<?php

namespace App\Contract\Hi_FPT;

interface BehaviorInterface
{
    public function index($dataTable, $params);

    public function store($request);
}
