@extends('layouts.default')

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
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-sm-6">
                        <form action="/closehelprequest/getListReportByContract" method="POST" autocomplete="off">
                            @csrf
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Get Contract Info</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="phone">Contract Number</label>
                                            <input type="text" id="contractNo" name="contractNo" class="form-control" placeholder="Please input contract number" >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer" style="text-align: center">
                                    <button type="submit" class="btn btn-info">Get Contract Info</button>
                                </div>
                            </div>
                        </form>
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