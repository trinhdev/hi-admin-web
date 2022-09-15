@extends('layouts.default')
@push('header')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/chart.js/Chart.js"></script>
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px" class="uppercase">
                            <span>App Log</span>
                            <a href="{{route('app.index')}}" class="btn btn-sm btn-primary">View Data</a>
                        </h1>
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

    </script>

@endpush
