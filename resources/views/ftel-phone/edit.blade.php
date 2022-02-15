@extends('layouts.default')

@section('content')
@php
    $uri_config = $Settings->firstWhere('name','uri_config');
    $list_uri = [];
    if(!empty($uri_config)){
        $list_uri = json_decode($uri_config->value);
    }
    $data = session()->get( 'data' );
    $dataExcel = session()->get( 'dataExcel' );
    $id = 1;
@endphp

@if(Session::has('download.in.the.next.request'))
         <meta http-equiv="refresh" content="5;url={{ Session::get('export') }}">
@endif
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
                        <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title uppercase">Phone Info </h3>
                                </div>
                        <form id="importExcel" action="{{ route('ftel_phone.import') }}" method="POST" novalidate="novalidate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="" for="number_phone_import"><i>Upload with file exel</i></label>
                                        <input type="file" id="number_phone_import" name="excel" class="form-control @error('exel') is-invalid @enderror">           
                                    </div>
                        </form>
                        <form action="{{ route('ftel_phone.store') }}" method="POST" novalidate="novalidate" autocomplete="off" onSubmit="handleSubmit(event,this)">
                            @csrf
                                        <div class="form-group">
                                            <label for="number_phone">Phone</label>
                                            @if($dataExcel!=null)
                                                <input value="{{ str_replace(['[', ']', '"'], '', json_encode($dataExcel,TRUE)) }}" type="text" id="number_phone" name="number_phone" class="form-control @error('number_phone') is-invalid @enderror" placeholder="Có thể thêm nhiều số điện thoại cách nhau bằng dấu phẩy ','" >
                                            @else
                                            <input type="text" id="number_phone" name="number_phone" class="form-control @error('number_phone') is-invalid @enderror" placeholder="Có thể thêm nhiều số điện thoại cách nhau bằng dấu phẩy ','" >                                           
                                            @endif
                                            @error('number_phone')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <br>
                                            <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <ul>                                                  
                                                    <b>Note</b>: Nhập bé hơn 1000 số cách nhau bằng dấu phẩy (đối với file exel, lưu 1 cột duy nhất theo hàng dọc, tải file mẫu tại <a href="https://docs.google.com/spreadsheets/d/1ifAR0UwfdV03Sidcshjvwl1pn1YmYBD9/edit?usp=sharing&ouid=113322866597815571901&rtpof=true&sd=true" target="_blank">đây</a>)
                                                </ul>
                                            </ol>
                                            </nav>
                                        </div>
                                    </div>
                                <div class="card-footer" style="text-align: center">
                                    <a href="/ftel-phone" type="button" class="btn btn-default">Cancel</a>
                                    <button id="check" type="submit" class="btn btn-info">Check</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                        @if($data!=null && Auth::user()->role_id == ADMIN)
                        <form action="{{ route('ftel_phone.export') }}" type="POST" novalidate="novalidate" autocomplete="off">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="data" value="{{ json_encode($data,TRUE)}}" />
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-download"></i> Export
                            </button>
                        </form>
                        @endif
                <div class="card card-body col-sm-12 mt-2">
                    <table id="phoneExport" class="display nowrap" style="width:100%">

                    @if($data!=null)
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Phone</th>
                        <th>Mã số nhân viên</th>
                        <th>Email</th>
                        <th>Tên đầy đủ</th>
                        <th>Đơn vị</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($data as $data)
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>{{ $data['number_phone'] }}</td>
                        <td>{{ $data['code'] }}</td>
                        <td>{{ $data['emailAddress'] }}</td>
                        <td>{{ $data['fullName'] }}</td>    
                        <td>{{ $data['organizationCodePath'] }}</td>                        
                    </tr>
                    @endforeach
                    @else
                    <h3 class="text-center"><i>No Data</i></h3>
                    @endif
                    </tbody>
                    </table>
                    
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
    $('#number_phone_import').change(function() {
        $('#importExcel').submit();
    });
    $(function() {
        $('#phoneExport').DataTable({
            processing: true
        });
    });
    
        
    </script>

@endsection