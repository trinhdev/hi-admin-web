@extends('layouts.default')

@push('header')
<link rel="stylesheet" href="{{asset('custom_css/close_request.css')}}">
@endpush
@section('content')
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
                <div class="card card-white mb-5">
                    {{-- <pre>
                {{print_r($data)}}
                    </pre> --}}
                    <ul class="list-unstyled">
                        {{-- <li class="position-relative booking">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mb-4">Sunny Apartment <span class="badge badge-primary mx-3">Pending</span><span class="badge badge-danger">Unpaid</span></h5>
                                    <div class="mb-3">
                                        <span class="mr-2 d-block d-sm-inline-block mb-2 mb-sm-0">Booking Date:</span>
                                        <span class="bg-light-blue">02.03.2020 - 04.03.2020</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="mr-2 d-block d-sm-inline-block mb-2 mb-sm-0">Booking Details:</span>
                                        <span class="bg-light-blue">2 Adults</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="mr-2 d-block d-sm-inline-block mb-2 mb-sm-0">Price:</span>
                                        <span class="bg-light-blue">$147</span>
                                    </div>
                                    <div class="mb-5">
                                        <span class="mr-2 d-block d-sm-inline-block mb-1 mb-sm-0">Clients:</span>
                                        <span class="border-right pr-2 mr-2">John Inoue</span>
                                        <span class="border-right pr-2 mr-2"> john@example.com</span>
                                        <span>123-563-789</span>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <a href="#" class="btn-gray mr-2"><i class="far fa-times-circle mr-2"></i> Close</a>
                            </div>
                        </li>

                        <li class="position-relative booking">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mb-4">Burger House <span class="badge badge-success ml-3">Approved</span></h5>
                                    <div class="mb-3">
                                        <span class="mr-2 d-block d-sm-inline-block mb-2 mb-sm-0">Booking Date:</span>
                                        <span class="bg-light-green">06.03.2020 - 07.03.2020</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="mr-2 d-block d-sm-inline-block mb-2 mb-sm-0">Booking Details:</span>
                                        <span class="bg-light-green">2 Adults, 2 Children</span>
                                    </div>

                                    <div class="mb-5">
                                        <span class="mr-2 d-block d-sm-inline-block mb-1 mb-sm-0">Clients:</span>
                                        <span class="border-right pr-2 mr-2">Jaime Cressey</span>
                                        <span class="border-right pr-2 mr-2"> jaime@example.com</span>
                                        <span>355-456-789</span>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <a href="#" class="btn-gray mr-2"><i class="far fa-times-circle mr-2"></i>Close</a>
                            </div>
                        </li> --}}
                        @php
                            $listColor = ['warning','primary','sucess'];
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
                            @if($report->reportTypeId == 6 && $report->isShowBtnCancel == 1)
                            <div class="buttons-to-right">
                                <a onclick="closeRequest(this)" type="button"class="btn-red mr-2"><i class="far fa-times-circle mr-2"></i>Close</a>
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
