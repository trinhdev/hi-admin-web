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
                    <h1 class="m-0 uppercase">Check Log</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Log Sms</li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-sm-12">
                    <form action=" {{ route('smsworld.logs')}}" method="GET" autocomplete="off">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">INPUT</h3>
                            </div>
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="form-group col-sm-2">
                                                <label for="country_code">Country Code</label>
                                                <input type="number" class="form-control" name="country_code" id="country_code" placeholder="Country Code" value="{{ request()->input('country_code', old('country_code')) }}" required>
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label for="phone">Phone</label>
                                                <input type="number" class="form-control" name="phone" placeholder="Phone Number " value="{{ request()->input('phone', old('phone')) }}" required>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="date">Month / Year</label>
                                                <input type="month" class="form-control" name="date" placeholder="Date Check" value="{{ request()->input('date', old('date')) }}"required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer" style="text-align: center">
                                <button type="submit" class="btn btn-info">Get Logs</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="card-primary col-md-12">
            <div class="mb-5" id="showLogs">
            </div>
        </div> --}}
        <div class="row" style="margin-top: 20px">
            <div class="card card-body col-sm-12">
                <table id="smsworld_table" class="display nowrap" style="width:100%">
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
<script>
    var data = <?php echo !empty($data) ? json_encode($data) : 'null'; ?>;
</script>
@endsection
