<?php

namespace App\Repository\Hi_FPT;

use App\Contract\Hi_FPT\PaymentSupportInterface;
use App\Models\PaymentUnpaid;
use App\Repository\RepositoryAbstract;
use Illuminate\Support\Facades\DB;

class PaymentSupportRepository extends RepositoryAbstract implements PaymentSupportInterface
{
    protected $model;
    public function __construct(PaymentUnpaid $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function index($dataTable, $params)
    {
        return $dataTable->with([
            'data'=> $this->model->groupBy('customer_phone', 'created_at')
        ])->render('payment-support.index');
    }

    public function update($params, $id)
    {
        $description_error_code = $params->input('description_error_code');
        $description_error = $params->input('description_error');
        $status = $params->input('status');
        $this->model
            ->where('customer_phone', DB::table('payment_unpaid')->find($id)->customer_phone)
            ->update(['status'=> $status, 'description_error'=>$description_error, 'description'=>$description_error_code]);

        return redirect()->back()->with(['success' => 'Thành công', 'html' => 'Update thành công!']);
    }

}
