<?php

namespace App\Http\Controllers;

use App\Services\ChartService;
use Illuminate\Support\Facades\Redis;

class HomeController extends MY_Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function getDataChart()
    {

        $charService = new ChartService();
        $keyName = config('constants.REDIS_KEY.CHART_DOANH_THU_BAO_HIEM_HDI');
        if (Redis::exists($keyName)) {
            $data = unserialize(Redis::get($keyName));
            if (!array_search(date('d-m-Y',strtotime("-1 days")), array_column($data, 'date'))) {
                $data_prev_day = $charService->getDataChartADayAgo();
                if (!empty($data_prev_day)) {
                    $data[] = $data_prev_day[0];
                    Redis::set($keyName, serialize($data));
                }
            }
        } else {
            $data = $charService->getDataChart30DaysAgo();
            Redis::set($keyName, serialize($data));
        }
        return $data;
    }
}
