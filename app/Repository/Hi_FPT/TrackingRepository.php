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
        $table_detail = $dataTable->with([ 'data_detail'=> DB::connection('mysql4')->table('customers')->select('*')]);
        $total = $this->model->count();
        $new = $this->model->where('created_at', today())->count();
        $unique = $this->model->groupBy('phone')->count();
        $dataChart = $this->model->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
            ->groupBy('date');
        if ($request->date) {
            $dataChart->whereBetween('created_at', split_date($request->date));
        }
        if ($request->ajax() && request()->get('table') == 'detail') {
            return $table_detail->render('tracking.user');
        }
        return view('tracking.user', [
            'detail'    => $table_detail->html(),
            'data'      => ['total_section' => $total, 'new_section'=>$new, 'unique_section'=>$unique],
            'dataChart' => $dataChart->get()->toArray()
        ]);
    }

    public function views()
    {
        return view('tracking.views');
    }

    public function sessionAnalytics($dataTable, $request)
    {
        $table_detail = $dataTable->with([ 'data_detail'=> $this->model->select('*')]);
        $total = $this->model->count();
        $new = $this->model->where('created_at', today())->count();
        $unique = $this->model->groupBy('phone')->count();

        $dataChart = $this->model->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
            ->groupBy('date');
        if ($request->date) {
            $dataChart->whereBetween('created_at', split_date($request->date));
        }
        if ($request->ajax() && request()->get('table') == 'detail') {
            return $table_detail->render('tracking.session');
        }
        return view('tracking.session', [
            'detail'    => $table_detail->html(),
            'data'      => ['total_section' => $total, 'new_section'=>$new, 'unique_section'=>$unique],
            'dataChart' => $dataChart->get()->toArray()
        ]);
    }

    public function journeyAnalysis()
    {
        return view('tracking.journey-analysis');
    }

}
