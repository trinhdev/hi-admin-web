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
                        <h1 style="float: left; margin-right: 20px" class="uppercase"> Quản lí hành vi người dùng </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Behavior</li>
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
                                <h3 class="card-title uppercase">Form File</h3>
                            </div>
                            <div class="card-body">
                                {!! Form::open(array('url' => route('behavior.post'),'id' => 'importExcel', 'method'=>'post' ,'enctype' =>'multipart/form-data')) !!}
                                @csrf
                                <div class="form-group">
                                    <label class="" for="number_phone_import"><i>Upload with file exel</i></label>
                                    <input onchange="uploadFile()" type="file" id="number_phone_import" name="excel"
                                           class="form-control @error('exel') is-invalid @enderror" accept=".xlsx,.csv">
                                </div>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <ul>
                                                <b>Note</b>: Yêu cầu tải lên file đúng định dạng, tải file mẫu <a
                                                    href="https://docs.google.com/spreadsheets/d/1ifAR0UwfdV03Sidcshjvwl1pn1YmYBD9/edit?usp=sharing&ouid=113322866597815571901&rtpof=true&sd=true"
                                                    target="_blank"> <b> tại đây</b><a/>)
                                            </ul>
                                        </ol>
                                    </nav>
                                <div class="card-footer" style="text-align: center">
                                    <button type="submit" value="data" class="btn btn-info">Submit
                                    </button>
                                    {{--<button name="action" type="submit" value="check" class="btn btn-info">Check nhân
                                        viên
                                    </button>--}}
                                    <a href="/ftel-phone" type="button" class="btn btn-default">Cancel</a>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-body col-sm-12">

                    @include('behavior.export')
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@push('scripts')
    <script>
        $('#behaviorExport').DataTable({
        processing: true,
        lengthChange: false,
        responsive: true,
        autoWidth: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ]
    });
    </script>
@endpush
