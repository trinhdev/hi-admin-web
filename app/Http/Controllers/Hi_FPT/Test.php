<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\MY_Controller;

class Test extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->title = 'Test Manage';
    }

    public function index()
    {
        return view('layoutv2.layout.test-layout');
    }
}
