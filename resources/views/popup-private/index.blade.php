{{--
Create by: trinhdev
Update at: 2022/06/22
Contact: trinhhuynhdp@gmail.com

INDEX PAGE
    * import TABLE, import modal_add_update
    * show, filter and search data form api (done)
END INDEX PAGE

--}}

@extends('layouts.default')

@section('content')

        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px" class="uppercase">Quản Lý Popup Định Danh</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Quản lý Popup Định Danh</li>
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
                    @include('popup._table')
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('popup-private._modal_add_update')
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            showHide();
            changeFileFtelPhone();
            methodAjaxPopupPrivate();
            handlePushPopUpPrivate();
        });
    </script>
@endpush


