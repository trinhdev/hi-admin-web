@extends('layouts.default')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('template.breadcrumb', ['name'=>'Quản lí FPT phone'])
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-body col-sm-12">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
