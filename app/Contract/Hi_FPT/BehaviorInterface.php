<?php

namespace App\Contract\Hi_FPT;

interface BehaviorInterface
{
    public function index();
    public function checkinDataAnalysis($params);


    public function store($params);
}
