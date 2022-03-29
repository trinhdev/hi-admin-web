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
                    <h1 style="float: left; margin-right: 20px" class="uppercase">Quản Lý Banner</h1>
                    @if(Auth::user()->role_id == ADMIN || $aclCurrentModule->create == 1)
                    <a href="{{ route('bannermanage.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Thêm Mới
                    </a>
                    @endif
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý Banner</li>
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
                <div class="container">
                    <div class="card-body row form-inline">
                        <div class="col-md-4">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Vị Trí Hiển Thị: </div>
                                </div>
                                <select class="form-control" name="position" id="show_at" placeholder="Show at" onchange="filterData()">
                                    <option value=''>Tất Cả</option>
                                    @if(!empty($list_type_banner))
                                    @foreach($list_type_banner as $type)
                                         <option value="{{$type->id}}">&#8920; {{ $type->id}} &#x22D9;: {{$type->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Từ: </div>
                                </div>
                                <input type="datetime-local" name="show_from" class="form-control" id="show_from" placeholder="Date From" onchange="filterData()" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Đến: </div>
                                </div>
                                <input type="datetime-local" name="show_to" class="form-control" id="show_to" placeholder="Date To" onchange="filterData()" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <table id="banner_manage" class="table table-hover table-striped text-center" style="width:100%; word-wrap:no-wrap;">
                </table> --}}
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
    {{ $dataTable->scripts() }}
    {{-- <script>
        const table = $('#popup_manage_table');
        table.on('preXhr.dt', function(e, settings, data){
            data.templateType = $('#show_at').val();
        });
    </script> --}}
@endpush