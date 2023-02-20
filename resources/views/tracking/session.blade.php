@extends('layouts.default')
@push('header')
    <link media="all" type="text/css" rel="stylesheet" href="{{url('/')}}/base/css/core.css">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('template.breadcrumb', ['name' => 'session analytics'])
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form class="form-inline">
                    <div class="col-md-3">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="show_at">Start point</label>
                            </div>
                            <select class="form-control" name="show_at" id="start_point">
                                <option value="">-- Select --</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="show_at">End point</label>
                            </div>
                            <select class="form-control" name="show_at" id="end_point">
                                <option value="">-- Select --</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend ">
                                <div class="input-group-text"><i class="fa fa-calendar"></i>&nbsp;</div>
                            </div>
                            <input class="form-control" id="daterange" type="text" name="date" />
                        </div>
                    </div>
                    <div class="filter-class col-md-1" style="width: 100%; text-align: center">
                        <button type="button" id="filter_condition" class="btn btn-sm btn-primary mb-4">Search</button>
                    </div>
                </form>
            </div>
        </section>

        <!-- /.content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-body col-sm-12">
                    <!--begin::Table-->
                    <canvas id="line-chart" width="800" height="200"></canvas>
                    <div class="row">
                        @foreach($data as $key => $value)
                            <div class="col-2">
                                <div class="small-box">
                                    <div class="inner">
                                        <h3>{{ $value }}</h3>
                                        <p class="text-capitalize">{{ explode('_', $key)[0]. ' '. explode('_', $key)[1] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--end::Table-->
                </div>
            </div>

        </section>
        <!-- /.content -->
        <!-- /.content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-body col-sm-12">
                    <!--begin::Table-->
                    {!! $detail->table(['width' => '100%', 'id'=>'table-detail']) !!}
                    <!--end::Table-->
                </div>
            </div>

        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
@endsection
@php
    $label = '';
    $views = '';
    $views1 = '';
    $views2 = '';

    foreach ($dataChart as $value) {
        $label.= '"'.$value['date'].'",';
        $views.= $value['views'].',';
        $views1.= ($value['views']+500).',';
        $views2.= ($value['views']+135).',';
    }
    dd($label);
@endphp
@push('scripts')
    {!! $detail->scripts() !!}
    <script>
        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: [{!! $label !!}],
                datasets: [
                    {
                    data: [{{$views}}],
                    label: "Test 1",
                    borderColor: "#3e95cd",
                    fill: false
                }, {
                    data: [{{$views1}}],
                    label: "Test 2",
                    borderColor: "#8e5ea2",
                    fill: false
                }, {
                    data: [{{$views2}}],
                    label: "Test 3",
                    borderColor: "#3cba9f",
                    fill: false
                }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Section Analytics'
                }
            }
        });
    </script>
@endpush
