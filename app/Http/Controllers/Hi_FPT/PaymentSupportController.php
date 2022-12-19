<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\PaymentSupportInterface;
use App\DataTables\Hi_FPT\PaymentSupportDataTable;
use App\Http\Controllers\MY_Controller;
use Illuminate\Http\Request;

class PaymentSupportController extends MY_Controller
{
    private $PaymentSupportRepository;

    public function __construct(PaymentSupportInterface $PaymentSupportRepository)
    {
        parent::__construct();
        $this->title = 'PaymentSupport Manage';
        $this->PaymentSupportRepository = $PaymentSupportRepository;
    }

    public function index(PaymentSupportDataTable $dataTable, Request $request)
    {
        return $this->PaymentSupportRepository->index($dataTable, $request);
    }

    public function update(Request $request, $id)
    {
        return $this->PaymentSupportRepository->update($request, $id);
    }
}
