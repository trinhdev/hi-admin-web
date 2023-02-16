<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\TestDataTable;
use App\Http\Controllers\MY_Controller;

class Test extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->title = 'Test Manage';
    }

    public function index(TestDataTable $dataTable)
    {
        return $dataTable->render('layoutv2.layout.test-data.index');
    }

    public function create()
    {
        return view('layoutv2.layout.test-data.create');
    }
}
