@extends('layouts.default')

@push('header')
    <link media="all" type="text/css" rel="stylesheet" href="{{url('/')}}/base/css/core.css">
@endpush

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px" class="uppercase">Thống kê</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {!! breadcrumb() !!}
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="clearfix"></div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-body col-sm-12">
                    <div class="container">
                        <div class="card-body row form-inline">
                            <div class="col-md-3">
                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Từ:</div>
                                    </div>
                                    <input type="datetime-local" name="show_from" class="form-control" id="show_from"
                                           placeholder="Date From"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Đến:</div>
                                    </div>
                                    <input type="datetime-local" name="show_to" class="form-control" id="show_to"
                                           placeholder="Date To"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group input-group-sm mb-4">
                                    <button data-column="2" data-column1="3" id="filter_condition"
                                            class="btn btn-sm btn-info">Time filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tabbable-custom">
                        <ul class="nav mb-3 nav-tabs" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-detail-tab" data-toggle="pill" href="#pills-detail"
                                   role="tab" aria-controls="pills-detail" aria-selected="true">Tổng quan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-overview-tab" data-toggle="pill" href="#pills-overview"
                                   role="tab" aria-controls="pills-overview" aria-selected="false">Chi tiết</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-detail" role="tabpanel"
                                 aria-labelledby="pills-detail-tab">
                                <h4 class="text-center text-capitalize"> {!! $overview_title !!}</h4>
                                {!! $overview->table(['width' => '100%', 'id'=>'table-overview']) !!}
                            </div>
                            <div class="tab-pane fade" id="pills-overview" role="tabpanel"
                                 aria-labelledby="pills-overview-tab">
                                <h4 class="text-center text-capitalize"> {!! $detail_title !!}</h4>
                                {!! $detail->table(['width' => '100%', 'id'=>'table-detail']) !!}
                            </div>
                        </div>
                    </div>
                    {{--End table--}}
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
<!--end::Table-->
@push('scripts')
    {!! $detail->scripts() !!}
    {!! $overview->scripts() !!}
    <script>
        const detail = $('#table-detail');
        const overview = $('#table-overview');

        let data = function (e, settings, data) {
            data.from = $('#show_from').val();
            data.to = $('#show_to').val();
        };

        detail.on('preXhr.dt', data);
        overview.on('preXhr.dt', data);
    </script>

@endpush
