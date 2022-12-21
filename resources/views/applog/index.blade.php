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
                        <h1 style="float: left; margin-right: 20px" class="uppercase">
                            <span>App Log</span>
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
                            <form class="form-inline">
                                <div class="col-md-3">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="inputGroupSelect01">Type</label>
                                        </div>
                                        <select class="form-control" name="position">
                                            <option value="">-- Select --</option>
                                            @if(!empty($type))
                                                @foreach($type as $value)
                                                    <option value="{{$value['screenId']}}">{{$value['screenId']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Phone</div>
                                        </div>
                                        <input class="form-control" id="phone_filter" placeholder="Phone Filter" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">From</div>
                                        </div>
                                        <input type="datetime-local" name="show_from" class="form-control" id="show_from"
                                            placeholder="Date From"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">To</div>
                                        </div>
                                        <input type="datetime-local" name="show_to" class="form-control" id="show_to"
                                            placeholder="Date To"/>
                                    </div>
                                </div>
                                <div class="filter-class" style="width: 100%; text-align: center">
                                    <button id="submit" class="btn btn-sm btn-primary mb-4">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--begin::Table-->
                    {!! $dataTable->table() !!}
                    <!--end::Table-->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
<!--end::Table-->
@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        const table = $('#app-log-table');
        table.on('preXhr.dt', function (e, settings, data) {
            data.type = $('#show_at').val();
            data.phone = $('#phone_filter').val();
            data.date_action_start = $('#show_from').val();
            data.date_action_end = $('#show_to').val();
        });

        $('#submit').on('click', function() {
            if(!$('#phone_filter').val() || !$('#show_from').val() || !$('#show_to').val()) {
                showMessage('error','Xin vui lòng nhập số điện thoại | từ ngày | đến ngày cần tìm kiếm');
                return false;
            }
            table.DataTable().ajax.reload();
            return false;
        })
    </script>

@endpush
