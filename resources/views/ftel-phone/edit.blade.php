@extends('layouts.default')

@section('content')
@php
    $uri_config = $Settings->firstWhere('name','uri_config');
    $list_uri = [];
    if(!empty($uri_config)){
        $list_uri = json_decode($uri_config->value);
    }
@endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Phone</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Phone</li>
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
                        <form action="{{ route('ftel_phone.store') }}" method="POST" novalidate="novalidate" autocomplete="off" onSubmit="handleSubmit(event,this)">
                            @csrf
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title uppercase">Phone Info</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="module_name">Phone</label>
                                            <input type="text" id="number_phone" name="number_phone" class="form-control @error('number_phone') is-invalid @enderror" placeholder="Có thể thêm nhiều số điện thoại cách nhau bằng dấu phẩy ','" >
                                            @error('number_phone')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <br>
                                            <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <ul>                                                  
                                                    <b>Note</b>: Nhập bé hơn 1000 số cách nhau bằng dấu phẩy
                                                </ul>
                                            </ol>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer" style="text-align: center">
                                    <a href="/ftel_phone" type="button" class="btn btn-default">Cancel</a>
                                    <button id="check" type="submit" class="btn btn-info">Check</button>
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