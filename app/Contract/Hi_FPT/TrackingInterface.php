<?php

namespace App\Contract\Hi_FPT;

interface TrackingInterface
{
    public function index();

    public function show($id);

    public function create();

    public function store($params);

    public function update($params, $id);

    public function delete($params);
}
