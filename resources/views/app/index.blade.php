@extends('layouts.default')
@push('header')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('/custom_js/chartApp.js')}}"></script>
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
                    <div class="container">
                        <div class="card-body row form-inline">
                            <div class="col-md-12 row">
                                <div class="col-md-6"><div id="columnchart_values"></div></div>
                                <div class="col-md-6"><div id="columnchart_top"></div>  </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Type </div>
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
                                    <select class="form-control filter_duplicate" id="filter_duplicate" placeholder="Show at">
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
                                    <input type="datetime-local" name="show_from" class="form-control" id="show_from" placeholder="Date From" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">To </div>
                                    </div>
                                    <input type="datetime-local" name="show_to" class="form-control" id="show_to" placeholder="Date To" />
                                </div>
                            </div>
                            <div class="filter-class">
                                <button id="submit" class="btn btn-sm btn-primary mb-4">Filter</button>
                                <button onclick="dialogConfirmWithAjax(exportApp, this)" id="export" class="btn btn-sm btn-primary mb-4">Export</button>
                            </div>
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
        const table = $('#app_table');
        table.on('preXhr.dt', function(e, settings, data){
            data.type = $('#show_at').val();
            data.public_date_start = $('#show_from').val();
            data.public_date_end = $('#show_to').val();
            data.filter_duplicate = $('#filter_duplicate').val();
        });
        function exportApp() {
            let type =$('#show_at').val();
            let start =$('#show_from').val();
            let end =$('#show_to').val();
            let filter_duplicate =$('#filter_duplicate').val();
            params =    "type="+ type + "&" +
                        "start="+ start + "&" +
                        "end="+ end + "&" +
                        "filter_duplicate="+ filter_duplicate
            window.location.href = "/app/export?"+params;
        }

    </script>

@endpush
