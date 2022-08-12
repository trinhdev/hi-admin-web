@extends('layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->
<?php
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="float: left; margin-right: 20px" class="uppercase">Báo cáo data sale theo ngày</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Báo cáo data sale theo ngày</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card-body row form-inline filter-section justify-content-md-center">
                <div class="col-md-3">
                    <div class="input-group input-group-sm mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Từ: </div>
                        </div>
                        <input type="date" name="show_from" class="form-control" id="show_from" placeholder="Date From" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group input-group-sm mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Đến: </div>
                        </div>
                        <input type="date" name="show_to" class="form-control" id="show_to" placeholder="Date To" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Loại dịch vụ: </div>
                        </div>
                        <select class="js-example-basic-multiple " name="services[]" id="services" multiple="multiple" style="width: 70%">
                            @foreach ($services as $service)
                                <option value="{{ $service }}">{{ $service }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <select class="js-example-basic-multiple form-control" name="service[]" multiple="multiple">
                        @foreach ($services as $service)
                            <option value="{{ $service }}">{{ $service }}</option>
                        @endforeach
                    </select> --}}
                </div>
                <div class="col-md-12" style="text-align: center">
                    <button id="filter_condition" class="btn btn-sm btn-primary" onClick="filter()">Tìm kiếm</button>
                </div>
            </div>
            <div id="report-table">
                @include('report.reportsalebydatetable')
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
<!--end::Table-->
@push('scripts')
    <script src="{{ asset('/custom_js/reportsalebydate.js')}}" type="text/javascript" charset="utf-8"></script>
@endpush

<style>
    /* table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th, td {
        text-align: center;
        vertical-align: middle;
        padding: 10px;
    } */

    table {
        margin: 0 auto;
        border-collapse: collapse;
        text-align: center
        /* border-style: hidden; */
        /*Remove all the outside
        borders of the existing table*/
    }
    table td {
        padding: 0.5rem;
        border: 1px solid grey;
    }
    table th {
        padding: 0.5rem;
        border: 1px solid grey;
    }

    /* footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
    } */
</style>