@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Chỉnh sửa referral code</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Chỉnh sửa referral code</li>
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
                                <h3 class="card-title uppercase">Form edit</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('laptop-orders.update', [$data->trans_id]) }}" method="POST">
                                @csrf
                                    <div class="form-group">
                                        <label for="referral_code">referral_code</label>
                                        <input type="text" id="referral_code" value="{{ $data->referral_code }}" name="referral_code" class="form-control"
                                                  placeholder="referral_code"/>
                                    </div>

                                    <div class="card-footer" style="text-align: center">
                                        <button name="action" value="back" type="submit" class="btn btn-info">Lưu
                                        </button>
                                        <button name="action" value="stay" type="submit" class="btn btn-info">Lưu và chỉnh sửa
                                        </button>
                                        <a href="/laptop-orders" type="button" class="btn btn-default">Cancel</a>
                                    </div>
                                </form>
                            </div>
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
