<?php

namespace App\Repository\Hi_FPT;

use App\Contract\Hi_FPT\BehaviorInterface;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Models\AppLog;
use App\Models\Behavior;
use Illuminate\Support\Facades\DB;

class BehaviorRepository implements BehaviorInterface
{
    use DataTrait;

    public function index($dataTable, $params)
    {
        return $dataTable->render('behavior.index');
    }

    public function store($params)
    {
        try {
            if ($params->has('excel')) {
                $data_test =  [
                    [
                        'time' => '0-2 ngày',
                        '0' => '22',
                        '1' => '32',
                        '2' => '23',
                        '3' => '12'
                    ],
                    [
                        'time' => '3-5 ngày',
                        '0' => '22',
                        '1' => '32',
                        '2' => '23',
                        '3' => '12'
                    ],
                    [
                        'time' => '6-7 ngày',
                        '0' => '22',
                        '1' => '32',
                        '2' => '23',
                        '3' => '12'
                    ]
                ];
            }
            return back()->with(['data' =>[]]);
        } catch (\Exception $e) {
            return back()->with(['error'=>'Lỗi hệ thống', 'html'=>$e->getMessage()]);
        }
    }
}
