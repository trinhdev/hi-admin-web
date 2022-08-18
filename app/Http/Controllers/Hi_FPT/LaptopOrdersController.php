<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\LaptopOrdersDatatables;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;

class LaptopOrdersController extends MY_Controller
{
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Laptop Order Manager';
    }
    public function index(LaptopOrdersDatatables $dataTable) {
        return $dataTable->render('laptop-order.index');
    }
}
