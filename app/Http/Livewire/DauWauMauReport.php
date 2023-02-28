<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\DAU_Report;

class DauWauMauReport extends Component
{
    public $showDiv = false;
    public string $selectedDate = '';
    public $selectedLimit = 10;
    public $selectedDuration = 0;
    public string $selectedType = 'bar';
    public string $selectedChart = '';

    public $dataset = [];
    public $lables = [];

    protected $listeners = [
        'date-selected' => 'filteringChart',
    ];

    public function render()
    {
        return view('livewire.dau-wau-mau-report');
    }

    public function filteringChart($selectedDate) {
        $data = $this->readDatabase($selectedDate);
        $this->emit('updateChart', [
            'datasets'      => $data['dataset'],
            'labels'        => $data['labels'],
            'report_date'   => $selectedDate
            // 'chart'     => $chart
        ]);
    }

    public function readDatabase($selectedDate) {
        try {
            $data = DAU_Report::where('to_date', $selectedDate)->where('location_zone', '!=', '')->selectRaw('dau_report.type, location_zone, SUM(count_login) AS count_login')->groupBy(['location_zone', 'type'])->orderBy('location_zone')->orderBy('dau_report.type')->get()->toArray();
            $list_zone = array_values(array_unique(array_column($data, 'location_zone')));
            $list_default_value_zone = array_fill_keys($list_zone, 0);
            foreach ($data as $key => $value) {
                if(empty($color[$value['type']])) {
                    $color[$value['type']] = rand_color();
                }

                if(empty($dataset[$value['type']])) {
                    $dataset[$value['type']] = [
                        'label'             => $value['type'],
                        'backgroundColor'   => $color[$value['type']],
                        'borderColor'       => $color[$value['type']],
                        'borderWidth'       => 2,
                        'pointRadius'       => 3,
                        'data'              => []
                    ];
                    $dataset[$value['type']]['data'][] = $value['count_login'];
                }
                else {
                    $dataset[$value['type']]['data'][] = $value['count_login'];
                }

                // $data_miss = array_diff_key($dataset[$value['type']]['data'], $list_default_value_zone);
                // print_r($data_miss);
            }
            return ['dataset' => array_values($dataset), 'labels' => array_values(array_unique(array_column($data, 'location_zone')))];
        } catch (\Exception $e) {
            return redirect()->with('danger', $e->getMessage());
        }
    }

    public function mount() {
        $selectedDate = date('Y-m-d', strtotime('today midnight'));
        $data = $this->readDatabase($selectedDate, 'bar');
        $this->dataset = $data['dataset'];
        $this->labels = $data['labels'];
    }
}
