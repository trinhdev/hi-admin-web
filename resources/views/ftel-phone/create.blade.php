@extends('layouts.default')
@push('header')
    <link media="all" type="text/css" rel="stylesheet" href="{{url('/')}}/base/css/core.css">
@endpush
@section('content')
    @php
        $data = session()->get( 'data' );
    @endphp

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('template.breadcrumb', ['name'=>'Create/Check Phone'])
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
                                @include('template.form-import-phone', [
                                    'form'=> 'template.form-import-phone',
                                    'action'=>route('ftel_phone.store'),
                                    'button'=>'
                                        <button name="action" type="submit" value="data" class="btn btn-info">Submit API</button>
                                        <button name="action" type="submit" value="db" class="btn btn-info ml-2">Submit Database </button>'
                                ])
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
        @include('ftel-phone.export')
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            postPhone('');
            datatableFtelPhoneExport();
        });
    </script>
@endpush
