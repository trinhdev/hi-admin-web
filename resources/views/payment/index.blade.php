@extends('layouts.default')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Get Transaction By Phone</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Get Transaction By Phone</li>
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
                                <h3 class="card-title uppercase">Form Post</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row container mx-auto">
                                    <div class="col-md-4">
                                        <input type="text" id="number_phone" name="number_phone" class="form-control" placeholder="Nhập số điện thoại cần tra cứu.." >
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-sm mb-4">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Từ: </div>
                                            </div>
                                            <input type="datetime-local" name="show_from" class="form-control" id="show_from" placeholder="Date From" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-sm mb-4">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Đến: </div>
                                            </div>
                                            <input type="datetime-local" name="show_to" class="form-control" id="show_to" placeholder="Date To" />
                                        </div>
                                    </div>
                                    <br>

                                </div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mt-2">
                                        <ul>
                                            <b>Note</b>: Nhập số điện thoại việt nam đúng định dạng, không được bỏ  trống trường nào, nếu có thắc mắc nào vui lòng liên hệ <a href="https://fpt.workplace.com/profile.php?id=100076727237575">hỗ trợ</a>)
                                        </ul>
                                    </ol>
                                </nav>
                                <div class="card-footer" style="text-align: center">
                                    <button id="button" name="action" type="button" value="data" class="btn btn-info">Find Data</button>
                                    <a href="/payment" type="button" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-body col-sm-12 mt-2">
                    {!! $dataTable->table() !!}
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
@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        const table = $('#payment_table');
        table.on('preXhr.dt', function(e, settings, data){
            data.number_phone = $('#number_phone').val();
            data.from = $('#show_from').val();
            data.to = $('#show_to').val();
        });
    </script>

@endpush
