<?php

namespace App\Repository\Hi_FPT;

use App\Contract\Hi_FPT\PaymentSupportInterface;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Models\PaymentUnpaid;
use App\Repository\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentSupportRepository extends RepositoryAbstract implements PaymentSupportInterface
{
    protected $model;
    public function __construct(PaymentUnpaid $model)
    {
        parent::__construct($model);
    }

    public function index($dataTable, $params)
    {
        $model = new PaymentUnpaid();
        $type = $params->type ?? null;
        $public_date_start = $params->public_date_start ?? null;
        $public_date_end = $params->public_date_end ?? null;
        $phone_filter = $params->phone ?? null;
        if($public_date_start && $public_date_end) {
            $date_action_start = date('Y-m-d H:i:s', strtotime($public_date_start));
            $date_action_end = date('Y-m-d H:i:s', strtotime($public_date_end));
            $model->whereBetween('created_at', [$date_action_start, $date_action_end]);
        }

        if($type) {
            $model->where('status', $type);
        }

        if($phone_filter) {
            $model->where('customer_phone', $phone_filter);
        }
        $db = $model->groupBy('customer_phone', 'created_at');

        return $dataTable->with([
            'data'=> $db
        ])->render('payment-support.index');
    }

    public function update($params, $id)
    {
        $description_error_code = $params->input('description_error_code');
        $status = $params->input('status');
        DB::table('payment_unpaid')
            ->where('customer_phone', DB::table('payment_unpaid')->find($id)->customer_phone)
            ->update(['status'=> $status, 'description'=>$description_error_code]);

        return redirect()->back()->with(['success' => 'Thành công', 'html' => 'Update thành công!']);
    }

}
