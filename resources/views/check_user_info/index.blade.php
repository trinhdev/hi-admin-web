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
                    <h1 class="m-0 uppercase">Check User Information</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active"> Check User</li>
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
                    <form action=" {{ route('checkuserinfo.index')}}" method="GET" autocomplete="off">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Check User Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="input">Input</label>
                                        <input type="text" id="input" name="input" class="form-control" placeholder="Please enter Contract Number or Phone Number">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer" style="text-align: center">
                                <button type="submit" class="btn btn-info">Check User Info</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-5" id="showList">
            
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
<script>
var a = '{{$data}}';
console.log(a);
</script>
@endsection
