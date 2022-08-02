<?php

namespace App\Contract\Hi_FPT;

interface BannerManageInterface
{
    public function all($dataTable, $params);

    public function show($id);

    public function store($params);

    public function update($params, $id);

    public function update_order($params);
}
