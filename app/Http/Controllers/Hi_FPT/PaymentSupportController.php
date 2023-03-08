<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\PaymentSupportInterface;
use App\DataTables\Hi_FPT\PaymentSupportDataTable;
use App\DataTables\Hi_FPT\PaymentSupportDataTableOverView;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\PaymentSupportRequest\StoreRequest;
use Illuminate\Http\Request;

class PaymentSupportController extends BaseController
{
    private $PaymentSupportRepository;

    public function __construct(PaymentSupportInterface $PaymentSupportRepository)
    {
        parent::__construct();
        $this->title = 'PaymentSupport Manage';
        $this->PaymentSupportRepository = $PaymentSupportRepository;
    }

    public function index(PaymentSupportDataTable $dataTable, PaymentSupportDataTableOverView $dataTableOverview, Request $request)
    {
        return $this->PaymentSupportRepository->index($dataTable, $dataTableOverview, $request);
    }

    public function show($id)
    {
        return $this->PaymentSupportRepository->show($id);
    }

    public function update(StoreRequest $request, $id)
    {
        $this->addToLog($request);
        return $this->PaymentSupportRepository->update($request, $id);
    }
}
