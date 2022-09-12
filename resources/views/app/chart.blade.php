@extends('layouts.default')
@push('header')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/chart.js/Chart.js"></script>
@endpush
@section('content')

    <style>
        .trinhdev {
            position: absolute;
            top: -75px;
            left: 25%;
        }

        .trinhdev-2 {
            margin-bottom: -40px;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px" class="uppercase">App Log</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">App Log</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-body col-sm-12">
                    <div class="col-md-12 container">
{{--                        <div class="col-md-12">--}}
{{--                            <p class="text-center text-bold-500">BIỂU ĐỒ THỂ HIỆN SỐ LƯỢNG LOG</p>--}}
{{--                            <canvas id="myChart" width="400" height="100"></canvas>--}}
{{--                        </div>--}}
                        <div class="col-md-12 row">
                            <div class="col-md-6">
                                <div id="columnchart_day"></div>
                            </div>
                            <div class="col-md-6">
                                <div id="columnchart_month"></div>
                            </div>
                            <div class="col-md-6">
                                <div id="columnchart_month_current"></div>
                            </div>

                            <div class="col-md-6">
                                <div id="columnchart_total"></div>
                            </div>
                        </div>

                    </div>
                    <div class="container">
                        <div class="card-body row form-inline">
                            <div class="col-md-3">
                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Type</div>
                                    </div>
                                    <select class="form-control" name="position" id="show_at" placeholder="Show at">
                                        <option value=''>All</option>
                                        @if(!empty($type))
                                            @foreach($type as $value)
                                                <option value="{{$value['type']}}">{{$value['type']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Duplicate filter</div>
                                    </div>
                                    <select class="form-control filter_duplicate" id="filter_duplicate"
                                            placeholder="Show at">
                                        <option value=''>All</option>
                                        <option value='yes'>Yes</option>
                                        <option value='no'>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">From</div>
                                    </div>
                                    <input type="datetime-local" name="show_from" class="form-control" id="show_from"
                                           placeholder="Date From"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">To</div>
                                    </div>
                                    <input type="datetime-local" name="show_to" class="form-control" id="show_to"
                                           placeholder="Date To"/>
                                </div>
                            </div>
                            <div class="filter-class">
                                <button id="submit" class="btn btn-sm btn-primary mb-4">Filter table</button>
{{--                                <button id="filter_chart" class="btn btn-sm btn-primary mb-4">Filter chart</button>--}}
                                <button
                                    onclick='dialogConfirmWithAjax(exportApp, this, "Cảnh báo: Để hạn chế mất dữ liệu, hãy export tối đa 150.000 dòng, khuyến khích export theo dữ liệu ngày! Nếu cần xuất data lớn vui lòng liên hệ trinhhdp@fpt.com.vn")'
                                    id="export" class="btn btn-sm btn-primary mb-4">Export
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
<!--end::Table-->
@push('scripts')
    <script>
        //chart
        google.charts.load("current", {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChartDataMonth);
        google.charts.setOnLoadCallback(drawChartDataDay);
        google.charts.setOnLoadCallback(drawChartToTal);
        google.charts.setOnLoadCallback(drawChartMonthCurrent);

        function drawChartDataDay() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {role: "style"}],
                    @forelse($data_day as $value)
                ["{{$value->type}}", {{$value->count}}, "rgb(67, 116, 224)"],
                    @empty
                ["No data", 0, "rgb(67, 116, 224)"],
                @endforelse
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2]);

            var options = {
                title: "Biểu đồ thể hiện số lượt truy cập các màn hình trong ngày {{date("d/m/Y")}}",
                width: 800,
                height: 300,
                bar: {groupWidth: "95%"},
                legend: {position: "none"},
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_day"));
            chart.draw(view, options);
        }

        function drawChartDataMonth() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {role: "style"}],
                    @foreach($data_month as $value)
                ["{{$value->type}}", {{$value->count}}, "rgb(67, 116, 224)"],
                @endforeach
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2]);

            var options = {
                title: "Biểu đồ thể hiện lưu lượng log trong 30 ngày gần nhất",
                width: 800,
                height: 300,
                bar: {groupWidth: "95%"},
                legend: {position: "none"},
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_month"));
            chart.draw(view, options);
        }

        function drawChartToTal() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {role: "style"}],
                    @foreach($data_total as $value)
                ["{{$value->type}}", {{$value->count}}, "rgb(67, 216, 224)"],
                @endforeach
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2]);

            var options = {
                title: "Biểu đồ thể hiện số lượng user truy cập app trong 30 ngày gần nhất ",
                width: 800,
                height: 300,
                bar: {groupWidth: "95%"},
                legend: {position: "none"},
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_total"));
            chart.draw(view, options);
        }

        function drawChartMonthCurrent() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {role: "style"}],
                    @foreach($data_month_current as $value)
                ["{{$value->type}}", {{$value->count}}, "rgb(67, 216, 224)"],
                @endforeach
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2]);

            var options = {
                title: "Biểu đồ thể hiện số lượng user truy cập vào app trong ngày {{date("d/m/Y")}}",
                width: 800,
                height: 300,
                bar: {groupWidth: "95%"},
                legend: {position: "none"},
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_month_current"));
            chart.draw(view, options);
        }


        // const ctx = document.getElementById('myChart').getContext('2d');
        // const d = new Date();
        // let dateArr =[];
        // for (let i=6;i>=0;i--) {
        //     let date = new Date(new Date().setDate(new Date().getDate()-i))
        //     dateArr.push(date.toLocaleDateString().split('/',3).join('/'))
        // }
        //example
        {{--const data = {--}}
        {{--    labels: dateArr,--}}
        {{--    datasets: [--}}
        {{--        @forelse($data_day['data'] as $value)--}}
        {{--        {--}}
        {{--            --}}{{--label: ['{!! date('m/d/Y', strtotime($value->date_action)) !!}'],--}}
        {{--            label: ['{!! $value->type !!}'],--}}
        {{--            data: ["{!! $data_day['count'] !!}"],--}}
        {{--            fill: false,--}}
        {{--            borderColor: [--}}
        {{--                'rgb(255,99,132)'--}}
        {{--            ]--}}
        {{--        },--}}
        {{--        @empty--}}
        {{--        {--}}
        {{--            label: ['# No result'],--}}
        {{--            data: [12, 19, 3, 5, 2, 3],--}}
        {{--            fill: false,--}}
        {{--            borderColor: [--}}
        {{--                'rgba(255, 99, 132, 1)'--}}
        {{--            ]--}}
        {{--        },--}}
        {{--        @endforelse--}}

        {{--    ]--}}
        {{--};--}}
        {{--let myChart = new Chart(ctx, {--}}
        {{--    type: 'line',--}}
        {{--    data: data--}}
        {{--});--}}

        {{--$('#submit').on('click', function () {--}}
        {{--    $.ajax({--}}
        {{--        type: 'POST',--}}
        {{--        url: "{!! route('app.chart') !!}",--}}
        {{--        dataType: "json",--}}
        {{--        success: function (result, textStatus, jqXHR)--}}
        {{--        {--}}
        {{--            console.log(result);--}}
        {{--            myChart.data = result;--}}
        {{--            myChart.update();--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

    </script>

@endpush
