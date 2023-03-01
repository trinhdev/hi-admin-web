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
    public $selectedZones = [];

    public $dataset = [];
    public $lables = [];
    public $zones = [];
    public $total = [];

    protected $listeners = [
        'date-selected' => 'filteringChart',
    ];

    public function render()
    {
        return view('livewire.dau-wau-mau-report');
    }

    public function filteringChart($selectedDate, $selectedZones) {
        $data = $this->readDatabase($selectedDate, $selectedZones);
        $this->emit('updateChart', [
            'datasets'      => $data['dataset'],
            'labels'        => $data['labels'],
            'report_date'   => $selectedDate,
            'total'         => $data['total']
            // 'chart'     => $chart
        ]);
    }

    public function readDatabase($selectedDate, $selectedZones) {
        try {
            $total = [
                'DAU'   => 0,
                'WAU'   => 0,
                'MAU'   => 0
            ];

            $query = DAU_Report::where('to_date', $selectedDate)->where('location_zone', '!=', '')->selectRaw('dau_report.type, location_zone, SUM(count_login) AS count_login');
            if(!empty($selectedZones)) {
                $selectedZones = $query->whereIn('location_zone', $selectedZones);
            }
            $data = $query->groupBy(['location_zone', 'type'])->orderBy('location_zone')->orderBy('dau_report.type')->get()->toArray();
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
                    
                }
                $dataset[$value['type']]['data'][] = $value['count_login'];
                $total[$value['type']] += $value['count_login'];
            }
            return ['dataset' => array_values($dataset), 'labels' => array_values(array_unique(array_column($data, 'location_zone'))), 'total' => $total];
        } catch (\Exception $e) {
            return redirect()->with('danger', $e->getMessage());
        }
    }

    public function mount() {
        $zones = DAU_Report::where('location_zone', '!=', '')->select('location_zone')->groupBy(['location_zone'])->orderBy('location_zone')->get()->toArray();
        $selectedDate = date('Y-m-d', strtotime('today midnight'));
        $data = $this->readDatabase($selectedDate, []);
        $this->dataset = $data['dataset'];
        $this->labels = $data['labels'];
        $this->zones = array_column($zones, 'location_zone');
        $this->total = $data['total'];
    }
}
