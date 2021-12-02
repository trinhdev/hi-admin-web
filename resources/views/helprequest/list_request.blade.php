@extends('layouts.default')
@section('content')
@push('header')
<link rel="stylesheet" href="{{asset('custom_css/close_request.css')}}">
@endpush
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">CLOSE HELP REQUEST</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">close helpe request</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="col-md-12">
                <div class="card2 card-white mb-5">
                    <ul class="list-unstyled">
                        @php
                            $listColor = ['warning','info','primary','sucess'];
                        @endphp
                        @foreach($listReport as $report)
                        <li class="position-relative booking" id ="{{$report->reportId}}">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mb-4">ID: {{$report->reportId}}

                                    @foreach($report->stepStatus as $key => $value)
                                        <span class="badge badge-{{$listColor[$key]}} ml-3">{{$value->name}}</span>
                                    @endforeach
                                    </h5>
                                    <div class="mb-3">
                                        <span class="mr-2 d-block d-sm-inline-block mb-2 mb-sm-0">Report Type:</span>
                                        <span class="bg-light-green">{{$report->reportType}} - {{$report->reportName}}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="mr-2 d-block d-sm-inline-block mb-2 mb-sm-0">Sub Type name:</span>
                                        <span class="bg-light-green">{{$report->subTypeName}}</span>
                                    </div>

                                    <div class="mb-5">
                                        <span class="mr-2 d-block d-sm-inline-block mb-1 mb-sm-0">Note:</span>
                                        <span class="pr-2 mr-2">{{$report->note}}</span>
                                    </div>
                                </div>
                            </div>
                            @if($report->reportType === 'HT-KYTHUAT' && $report->isShowBtnCancel == 1)
                            <div class="buttons-to-right">
                                <a onclick="dialogConfirmWithAjax(closeRequest,this)" type="button"class="btn-red mr-2"><i class="far fa-times-circle mr-2"></i>Close</a>
                            </div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<style>
    select {
        font-family: 'Lato', 'Font Awesome 5 Free', 'Font Awesome 5 Brands';
    }

</style>
@endsection
