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
                        <h1 class="m-0">Reset Password Lock</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Reset Password Lock</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-lg-center">
                    <div class="col-sm-6">
                        <form action=" {{ route('reset_password_wrong.store')}}" method="POST" autocomplete="off">
                            @csrf
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title uppercase">Reset Password Lock</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" name="numberPhone" class="form-control" placeholder="Please input phone number">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer" style="text-align: center">
                                    <button type="submit" class="btn btn-info">Reset</button>
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
