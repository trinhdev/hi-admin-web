@extends('layouts.default')

@section('content')
    @php
        $list_template_popup = config('platform_config.type_popup_service');
    @endphp
        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px" class="uppercase">Quản Lý Popup</h1>
                        @if(Auth::user()->role_id == ADMIN || $aclCurrentModule->create == 1)
                            <a href="{{ route('popupmanage.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Thêm Mới
                            </a>
                        @endif
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Quản lý Popup</li>
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
                    @include('popup._custom-search')
                    @include('popup._table')
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div id="show_detail_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Thông tin pop up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span></button>
                </div>
                <div class="modal-body" id="modal-detail-popup">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        actionAjaxPopup();
    </script>
@endpush


