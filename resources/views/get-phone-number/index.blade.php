@extends('layouts.default')

@section('content')
    @php
        $data = session()->get('data');
    @endphp
        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px" class="uppercase"> Get phone number by customer
                            id </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">GetPhoneNumber</li>
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
                                {!! Form::open(array('url' => route('getPhoneNumber.store'),'id' => 'importExcel', 'method'=>'post' ,'enctype' =>'multipart/form-data')) !!}
                                @csrf
                                <div class="row justify-content-center mt-2 mb-2">
                                    <div class="col-md-4">
                                        <div class="input-group input-group-sm mb-4">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Lọc từ ngày: </div>
                                            </div>
                                            <input type="datetime-local" name="show_from" class="form-control" id="show_from" placeholder="Date From" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-sm mb-4">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Đến ngày: </div>
                                            </div>
                                            <input type="datetime-local" name="show_to" class="form-control" id="show_to" placeholder="Date To" />
                                        </div>
                                    </div>
                                </div>

                                <nav aria-label="breadcrumb">
                                    <ol class="col-md-8 m-auto mt-2 breadcrumb">
                                        <ul class="m-auto">
                                            <b>Hoặc </b> lấy dữ liệu bằng excel, tải file mẫu
                                            <a href="https://docs.google.com/spreadsheets/d/15BN-xWvYwVZpFXM9fKsm9mctvb4X45G1HS_2sjK6ebQ/edit#gid=0"
                                               target="_blank"> <b> tại đây </b></a>
                                            <input onchange="uploadFile()" type="file" id="number_phone_import" name="excel"
                                           class= "text-center ml-5 @error('exel') is-invalid @enderror" accept=".xlsx,.csv">
                                        </ul>
                                    </ol>
                                </nav>

                                <div class="mt-4 card-footer" style="text-align: center">
                                    <button type="submit" value="data" class="btn btn-info">Submit
                                    </button>
                                    {{--<button name="action" type="submit" value="check" class="btn btn-info">Check nhân
                                        viên
                                    </button>--}}
                                    <a href="/get-phone-number" type="button" class="btn btn-default">Cancel</a>
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
                    @include('get-phone-number.export')
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@push('scripts')
    <script>
        $('#GetPhoneNumberExport').DataTable({
            processing: true,
            lengthChange: false,
            responsive: true,
            autoWidth: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, ':visible']
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
