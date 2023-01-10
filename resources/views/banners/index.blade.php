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
                    <a href="#" class="btn btn-primary btn-sm" id="addBanner">
                        <i class="fas fa-plus"></i> Thêm Mới
                    </a>
                    @endif
                    @if(Auth::user()->role_id == ADMIN || $aclCurrentModule->create == 1)
                        <a href="#" class="btn btn-primary btn-sm text-capitalize" id="updateBannerFconnect">
                            <i class="fas fa-plus"></i> Update banner Fconnect
                        </a>
                    @endif
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {!! breadcrumb() !!}
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
                        <div class="col-md-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Vị Trí Hiển Thị: </div>
                                </div>
                                <select class="form-control" name="position" id="show_at" placeholder="Show at">
                                    <option value=''>Tất Cả</option>
                                    @forelse($list_type_banner as $type)
                                        <option value="{{$type->key}}">&#8920; {{ $type->key}} &#x22D9;: {{$type->name}}</option>
                                    @empty
                                        <option>API Error</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Từ: </div>
                                </div>
                                <input type="datetime-local" name="show_from" class="form-control" id="show_from" placeholder="Date From" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Đến: </div>
                                </div>
                                <input type="datetime-local" name="show_to" class="form-control" id="show_to" placeholder="Date To" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-sm mb-4">
                                <button id="filter_condition" class="btn btn-sm btn-primary">Time filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Start table--}}
                {{ $dataTable->table([], true) }}
                {{--End table--}}
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<div id="showDetailBanner_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông tin banner</h5>
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

<div id="showFormUpdateFconnect_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize">Form update banner Fconnect</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body" id="showDetailBanner_Modal_body">
                @include('banners.update-banner-fconnect')
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
@endsection
<!--end::Table-->
@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        const table = $('#banner_manage');
        table.on('preXhr.dt', function(e, settings, data){
            data.bannerType = $('#show_at').val();
            data.public_date_start = $('#show_from').val();
            data.public_date_end = $('#show_to').val();
        });

        function showHideTitle(_this) {
            $('.hide'+_this).show();
            $('.show'+_this).hide();
        }
        $(document).ready(function() {
            methodAjaxBanner();
        });
    </script>
    <script src="{{ asset('/custom_js/bannermanage.js')}}"></script>
@endpush
