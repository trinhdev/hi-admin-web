@extends('layouts.default')
@push('header')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
                    <div class="col-md-12 container d-flex">
                        <div class="col-md-3">
                            <div id="columnchart_values-detail"></div>
                        </div>
                        <div class="col-md-3">
                            <div id="columnchart_values"></div>
                        </div>
                        <div class="col-md-3">
                            <div id="columnchart_top"></div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="card-body row form-inline">
                            <div class="col-md-3">
                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Search</div>
                                    </div>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
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
                                <button id="submit" class="btn btn-sm btn-primary mb-4">Filter</button>
                            </div>
                        </div>
                    </div>
                    <!--begin::Table-->
{{--                    {!! $dataTable->table() !!}--}}
                    <!--end::Table-->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
<!--end::Table-->
