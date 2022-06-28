@extends('layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->
<?php
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="float: left; margin-right: 20px" class="uppercase">Quản Lý report</h1>
                    @if(Auth::user()->role_id == ADMIN || $aclCurrentModule->create == 1)
                    <a href="{{ route('helper.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Thêm Mới
                    </a>
                    @endif
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý report</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-body col-sm-12">

                {{ $dataTable->table([], true) }}

            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<div id="showDetailBanner_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body" id="showDetailBanner_Modal_body">
                @include('banners.detail')
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
@endsection
<!--end::Table-->
@push('scripts')
    <script src="{{ asset('/custom_js/helper.js')}}" type="text/javascript" charset="utf-8"></script>
    {{ $dataTable->scripts() }}
    <script>
        const table = $('#banner_manage');
        table.on('preXhr.dt', function(e, settings, data){
            data.bannerType = $('#show_at').val();
            data.public_date_start = $('#show_from').val();
            data.public_date_end = $('#show_to').val();
        });
    </script>
@endpush