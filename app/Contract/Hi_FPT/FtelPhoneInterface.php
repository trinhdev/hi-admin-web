<?php

namespace App\Contract\Hi_FPT;

interface FtelPhoneInterface
{
    public function all($dataTable, $params);

    public function show($id);

    public function store($params);

    public function update($params, $id);
}
