<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\PaymentDataTable;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use Illuminate\Http\Request;

class PaymentController extends MY_Controller
{
    use DataTrait;

    public function __construct()
    {
        parent::__construct();
        $this->title = 'Payment Manage';
    }

    public function index(PaymentDataTable $dataTable, Request $request)
    {
        return $dataTable->with([
            'phone' => $request->number_phone,
            'from' => $request->from,
            'to' => $request->to
        ])->render('payment.index');
    }
}
