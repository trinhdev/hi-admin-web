<?php

namespace App\Http\Livewire;

use App\Services\TrackingService;
use Livewire\Component;

class ChartFilter extends Component
{
    public array $dataset = [];
    public array $labels = [];
    public string $type = 'line';

    protected $listeners = [
        'date-selected' => 'dateSelected',
    ];

    public function dateSelected(string $chart, string $date, string $typ, int $limit, int $duration)
    {
        if (split_date($date)) {
            $from = \Carbon\Carbon::parse(split_date($date)[0])->format('Y-m-d');
            $to = \Carbon\Carbon::parse(split_date($date)[1])->format('Y-m-d');
        }
        $service = new TrackingService();
        try {
            $data = $service->get_active_customers($chart,$from ?? '', $to ?? '', $limit??10, $duration??0);
            $datasets = collect($data->detail)['values'];

            foreach ($datasets as $key => $value) {
                $color = rand_color();
                $dataset[] = [
                    'label' => $key,
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    'borderWidth' => 2,
                    'pointRadius' => 3,
                    'data' => $value
                ];
            }
            $labels = collect($data->detail)['labels'];
            $this->emit('updateChart', [
                'datasets' => $dataset,
                'labels' => $labels,
                'type' => $typ,
                'chart' => $chart
            ]);
        } catch (\Exception $e) {
            return redirect()->with('danger', $e->getMessage());
        }
    }

    public function mount()
    {
        $service = new TrackingService();
        try {
            $data = $service->get_active_customers('DAU', '2023-02-17', '2023-02-20');
        } catch (\Exception $e) {
            dd($e);
        }
        $lables = collect($data->detail)['labels'];
        $datasets = collect($data->detail)['values'];

        $this->labels = $lables;
        foreach ($datasets as $key => $value) {
            $color = rand_color();
            $this->dataset[] = [
                'label' => $key,
                'backgroundColor' => $color,
                'borderColor' => $color,
                'borderWidth' => 2,
                'pointRadius' => 3,
                'data' => $value
            ];
        }
    }
}
