<?php

namespace App\Http\Controllers;

use App\Services\ChartService;
use Illuminate\Support\Facades\Redis;

use function PHPSTORM_META\map;

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
        $result = [];
        $keyName = config('constants.REDIS_KEY.CHART_DOANH_THU_BAO_HIEM_HDI');
        if (Redis::exists($keyName)) {
            $result = unserialize(Redis::get($keyName));
            $prev_date = date('d-m-Y', strtotime("-1 days"));
            if (!array_search($prev_date, array_column($result, 'date'))) {
                $data_prev_day = $charService->getDataChartADayAgo();
                if (empty($data_prev_day)) {
                    $data_prev_day[0] = [
                        'REVENUE' => 0,
                        'REVENUE_XEMAY' => 0,
                        'REVENUE_XEOTO' => 0,
                        'TOTAL' => 0,
                        'XEMAY' => 0,
                        'XEOTO' => 0,
                        'date' => $prev_date
                    ];
                }
                $result[$prev_date] = $data_prev_day[0];
                $ttl = Redis::ttl($keyName);
                Redis::setex($keyName,($ttl <= 1) ? 86400 : $ttl, serialize($result));
            }
            
        } else {
            $data = $charService->getDataChart30DaysAgo();
            foreach($data as $doanhthu){
                $result[$doanhthu->date] = $doanhthu;
            }
            Redis::setex($keyName,86400, serialize($result));
        }
        return $result;
    }
}
