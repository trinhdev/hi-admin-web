<?php

namespace App\Charts;

use App\Services\Livewire\ChartComponentData;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

/**
 * Class WanSpeedTestsChart
 *
 * @package App\Charts
 */
class UserAnalyticChart extends Chart
{

    /**
     * WanSpeedTestsChart constructor.
     *
     * @param \App\Services\Livewire\ChartComponentData $data
     */
    public function __construct(ChartComponentData $data)
    {
        parent::__construct();

        $this->loader(true);

        $this->options([
            'maintainAspectRatio' => false,
            'legend' => [
                'display' => true,
            ],
            'scales' => [
                'yAxes' => [
                    [
                        'ticks' => [
                            'maxTicksLimit' => 10,
                            'beginAtZero' => true,
                        ],
                    ],
                ],
                'xAxes' => [
                    [
                        'display' => true,
                    ],
                ],
            ],
            'elements' => [
                'line' => [
                    'fill' => false
                ]
            ]
        ]);
        $this->labels($data->labels());
        foreach ($data->datasets() as $key => $value) {
            $color = rand_color();
            $this->dataset($key, "line", $value)->options([
                'backgroundColor' => $color,
                'borderColor' => $color,
                'pointBackgroundColor' => $color,
                'pointBorderColor' => $color,
                'pointHoverBackgroundColor' => $color,
                'pointHoverBorderColor' => $color,
                'borderWidth' => 5,
                'pointRadius' => 10,
            ]);
        }
    }

}
