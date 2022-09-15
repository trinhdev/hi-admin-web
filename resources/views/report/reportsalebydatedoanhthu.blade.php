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
            <div class="card-body filter-section justify-content-md-center">
                <form class="row form-inline" action="{{ route('reportsalebydatedoanhthu.index') }}" method="GET">
                    @csrf
                    <div class="col-md-3">
                        <div class="input-group input-group-sm mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Từ: </div>
                            </div>
                            <input type="date" name="show_from1" class="form-control" id="show_from1" placeholder="Date From" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group input-group-sm mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Đến: </div>
                            </div>
                            <input type="date" name="show_to1" class="form-control" id="show_to1" placeholder="Date To" />
                        </div>
                    </div>
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
                        {{-- <button id="filter_condition" class="btn btn-sm btn-primary" onclick="filter()">Tìm kiếm</button> --}}
                        <input type="submit" class="btn btn-sm btn-primary" name="filter" value="Tìm kiếm" />
                        <button class="btn btn-sm btn-secondary" onClick="exportMultiTable(event)">Xuất hết</button>
                    </div>
                </form>
                
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
    <script src="{{ asset('/themes/plugins/xlsx/xlsx.full.min.js')}}" type="text/javascript" charset="utf-8"></script>
    <script>
        var reportdatabyproduct = {!! str_replace("'", "\'", json_encode($productByService)) !!};
        dataChartProduct(reportdatabyproduct);

        var reportdatabycategory = {!! str_replace("'", "\'", json_encode($productByCategory)) !!};
        dataChartCategory(reportdatabycategory);

        
    </script>
@endpush

<style>
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

    .form-control {
        border: 1px solid #ccc;
        border-radius: 3px;
        box-shadow: none !important;
        margin-bottom: 15px;
    }

    .form-control:focus {
        border: 1px solid #34495e;
    }

    .select2.select2-container {
    width: 100% !important;
    }

    .select2.select2-container .select2-selection {
    border: 1px solid #ccc;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    height: 34px;
    margin-bottom: 15px;
    outline: none !important;
    transition: all .15s ease-in-out;
    }

    .select2.select2-container .select2-selection .select2-selection__rendered {
    color: #333;
    line-height: 32px;
    padding-right: 33px;
    }

    .select2.select2-container .select2-selection .select2-selection__arrow {
    background: #f8f8f8;
    border-left: 1px solid #ccc;
    -webkit-border-radius: 0 3px 3px 0;
    -moz-border-radius: 0 3px 3px 0;
    border-radius: 0 3px 3px 0;
    height: 32px;
    width: 33px;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
    background: #f8f8f8;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
    -webkit-border-radius: 0 3px 0 0;
    -moz-border-radius: 0 3px 0 0;
    border-radius: 0 3px 0 0;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
    border: 1px solid #34495e;
    }

    .select2.select2-container .select2-selection--multiple {
    height: auto;
    min-height: 34px;
    }

    .select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
    margin-top: 0;
    height: 32px;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__rendered {
    display: block;
    padding: 0 4px;
    line-height: 29px;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__choice {
    background-color: #f8f8f8;
    border: 1px solid #ccc;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    margin: 4px 4px 0 0;
    padding: 0 6px 0 22px;
    height: 24px;
    line-height: 24px;
    font-size: 12px;
    position: relative;
    color: #000000
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
    position: absolute;
    top: 0;
    left: 0;
    height: 22px;
    width: 22px;
    margin: 0;
    text-align: center;
    color: #e74c3c;
    font-weight: bold;
    font-size: 16px;
    }

    .select2-container .select2-dropdown {
    background: transparent;
    border: none;
    margin-top: -5px;
    }

    .select2-container .select2-dropdown .select2-search {
    padding: 0;
    }

    .select2-container .select2-dropdown .select2-search input {
    outline: none !important;
    border: 1px solid #34495e !important;
    border-bottom: none !important;
    padding: 4px 6px !important;
    }

    .select2-container .select2-dropdown .select2-results {
    padding: 0;
    }

    .select2-container .select2-dropdown .select2-results ul {
    background: #fff;
    border: 1px solid #34495e;
    }

    .select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
    background-color: #3498db;
    }

    /* footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
    } */
</style>