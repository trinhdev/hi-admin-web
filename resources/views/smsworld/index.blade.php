@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Sms world</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Login Sms World</li>
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
                    <div class="col-sm-12">
                        <form action="{{ route('smsworld.login') }}" method="POST" autocomplete="off">
                            @csrf

                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Login</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="username">Phone</label>
                                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Please input phone number" >
                                            <label for="password">Password</label>
                                            <input type="password" name="password"class="form-control @error('password') is-invalid @enderror" placeholder="Please input phone number" >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer" style="text-align: center">
                                    <button name="action" type="submit" class="btn btn-info">Login</button>
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