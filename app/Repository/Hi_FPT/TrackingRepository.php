<?php

namespace App\Repository\Hi_FPT;

use App\Contract\Hi_FPT\TrackingInterface;
use App\Models\SectionLog;
use App\Repository\RepositoryAbstract;
use Illuminate\Support\Facades\DB;

class TrackingRepository extends RepositoryAbstract implements TrackingInterface
{
    protected $model;
    public function __construct(SectionLog $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function userAnalytics($dataTable, $request)
    {
        return view('tracking.user');
    }

    public function views()
    {
        return view('tracking.views');
    }

    public function sessionAnalytics($dataTable, $request)
    {
        $total = $this->model->count();
        $new = $this->model->where('created_at', today())->count();
        $unique = $this->model->groupBy('phone')->count();

        return view('tracking.session', [
            'detail'    => $dataTable->html(),
            'data'      => ['total_section' => $total, 'new_section'=>$new, 'unique_section'=>$unique]
        ]);
    }

    public function journeyAnalysis()
    {
        return view('tracking.journey-analysis');
    }

}
