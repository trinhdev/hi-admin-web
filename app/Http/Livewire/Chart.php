<?php

namespace App\Http\Livewire;

use App\Charts\UserAnalyticChart;
use App\Models\Customers;
use App\Models\SectionLog;
use App\Services\Livewire\ChartComponent;
use App\Services\Livewire\ChartComponentData;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * Class WanSpeedTests
 *
 * @package App\Http\Livewire
 */
class Chart extends ChartComponent
{

    /**
     * @return string
     */
    protected function view(): string
    {
        return 'livewire.chart';
    }

    /**
     * @return string
     */
    protected function chartClass(): string
    {
        return UserAnalyticChart::class;
    }

    /**
     * @return \App\Services\Livewire\ChartComponentData
     */
    protected function chartData(): ChartComponentData
    {
        if (!Cache::has('chart')) {
            $filter_date = ['2023-02-10 00:00:20', '2023-02-17 00:00:20'];
            $data = Customers::
            select(DB::raw('DATE(customers.date_login) as date'), DB::raw('count(*) as count'), 'customer_locations.location_zone')
                ->whereNotNull('customer_locations.location_zone')
                ->whereBetween('date_login', $filter_date)
                ->leftJoin('customer_locations', 'customers.customer_location_id', 'customer_locations.customer_location_id')
                ->groupBy('customer_locations.location_zone', 'date')
                ->orderBy('customer_locations.location_zone')
                ->get();
            Cache::put('chart', $data, $seconds = 600);
        }

        $data = Cache::get('chart');
        $labels = collect(array_values($data->map(function (Customers $data, $key) {
            return $data->date;
        })->unique()->toArray()));

        $locations = $data->map(function (Customers $data, $key) {
            return $data->location_zone;
        })->unique();

        $dataSet = $data->mapToGroups(function ($row) use ($locations) {
            foreach ($locations as $location) {
                if ($row->location_zone == $location) {
                    return [$row->date => $row->count];
                }
            }
            return [];
        });
        $datasets = [];
        for ($i=0;$i<count($labels);$i++) {
            $datasets[] = $dataSet[$labels[$i]];
        }
        return (new ChartComponentData($labels, collect($datasets)));
    }

}
