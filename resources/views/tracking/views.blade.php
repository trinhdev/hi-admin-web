@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('template.breadcrumb', ['name' => 'Tracking views'])
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
                            <input class="form-control" id="daterange" type="text" name="show_from" />
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
                    <canvas id="bar-chart" width="800" height="250"></canvas>
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
                    <canvas id="line-chart" width="800" height="250"></canvas>
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
                    <canvas id="bar-chart-horizontal" width="800" height="250"></canvas>
                    <!--end::Table-->
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('scripts')
    <script>
        // Bar chart
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [
                    {
                        label: "Population (millions)",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: [2478,5267,734,784,433]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2050'
                }
            }
        });

        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
                datasets: [{
                    data: [86,114,106,106,107,111,133,221,783,2478],
                    label: "Africa",
                    borderColor: "#3e95cd",
                    fill: false
                }, {
                    data: [282,350,411,502,635,809,947,1402,3700,5267],
                    label: "Asia",
                    borderColor: "#8e5ea2",
                    fill: false
                }, {
                    data: [168,170,178,190,203,276,408,547,675,734],
                    label: "Europe",
                    borderColor: "#3cba9f",
                    fill: false
                }, {
                    data: [40,20,10,16,24,38,74,167,508,784],
                    label: "Latin America",
                    borderColor: "#e8c3b9",
                    fill: false
                }, {
                    data: [6,3,2,2,7,26,82,172,312,433],
                    label: "North America",
                    borderColor: "#c45850",
                    fill: false
                }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'World population per region (in millions)'
                }
            }
        });

        new Chart(document.getElementById("bar-chart-horizontal"), {
            type: 'horizontalBar',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [
                    {
                        label: "Population (millions)",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: [2478,5267,734,784,433]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2050'
                }
            }
        });

    </script>
@endpush
