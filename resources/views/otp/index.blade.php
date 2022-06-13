@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 uppercase">OTP MANAGEMENT</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">module</li>
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
                        <form action="{{ route('manageotp.handle') }}" method="GET" autocomplete="off" onSubmit="handleSubmit(event,this)">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title uppercase">Get OTP by phone</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Please input phone number" value="{{ @$phone }}" >
                                            <input type="hidden" id="action" name="action" value="{{ @$action }}">
                                            @error('phone')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer" style="text-align: center">
                                    <button value="reset_otp" type="submit" onclick="setAction('reset_otp')" class="btn btn-primary">Reset OTP</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-body col-sm-12">
                    {{ $dataTable->table([], true) }}
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
        const table = $('#banner_manage');
        // table.on('preXhr.dt', function(e, settings, data){
        //     data.bannerType = $('#show_at').val();
        //     data.public_date_start = $('#show_from').val();
        //     data.public_date_end = $('#show_to').val();
        // });
    </script>
@endpush