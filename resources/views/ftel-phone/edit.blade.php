@extends('layouts.default')

@section('content')
@php
    $data = session()->get( 'data' );
@endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Check Phone FPT Telecom</h1>
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
                        <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title uppercase">Form Phone Number </h3>
                                </div>
                                <div class="card-body">
                                    {!! Form::open(array('url' => route('ftel_phone.import'),'id' => 'importExcel', 'method'=>'post' ,'enctype' =>'multipart/form-data')) !!}
                                        @csrf
                                        <div class="form-group">
                                            <label class="" for="number_phone_import"><i>Upload with file exel</i></label>
                                            <input onchange="uploadFile()" type="file" id="number_phone_import" name="excel" class="form-control @error('exel') is-invalid @enderror" accept=".xlsx">
                                        </div>
                                    {!! Form::close() !!}

                                    {!! Form::open(array('url' => route('ftel_phone.store'),'method'=>'post' ,'enctype' =>'multipart/form-data')) !!}
                                        @csrf
                                        <div class="form-group">
                                            <label for="number_phone">Phone</label>
                                                <textarea type="text" id="number_phone" name="number_phone" class="form-control" placeholder="Có thể thêm nhiều số điện thoại cách nhau bằng dấu phẩy ','" ></textarea>
                                            <br>
                                            <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <ul>
                                                    <b>Note</b>: Nhập bé hơn {{ LIMIT_PHONE }} số cách nhau bằng dấu phẩy  q</a>)
                                                </ul>
                                            </ol>
                                            </nav>
                                        </div>
                                    <div class="card-footer" style="text-align: center">
                                        <button name="action" type="submit" value="check" class="btn btn-info">Check nhân viên</button>
                                        <button name="action" type="submit" value="data" class="btn btn-info">GET DATA API</button>
                                        <button name="action" type="submit" value="db" class="btn btn-info">GET DATA SYSTEM</button>
                                        <a href="/ftel-phone" type="button" class="btn btn-default">Cancel</a>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
        @include('ftel-phone.export')
    </div>
    <!-- /.content-wrapper -->
    <style>
        select {
            font-family: 'Lato', 'Font Awesome 5 Free', 'Font Awesome 5 Brands';
        }
    </style>
@push('scripts')
<script>
    $( document ).ready(function() {
        changeFileFtelPhone();
        datatableFtelPhoneExport();
    });
    $(document).on('pjax:complete', function() {
        changeFileFtelPhone();
        datatableFtelPhoneExport();
    });
</script>
@endpush
@endsection
