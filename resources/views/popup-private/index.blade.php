<!--
Create by: trinhdev
Update at: 2022/06/22
Contact: trinhhuynhdp@gmail.com
-->

@extends('layouts.default')
@push('header')
    <link media="all" type="text/css" rel="stylesheet" href="{{url('/')}}/base/css/core.css">
@endpush
@section('content')

        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('template.breadcrumb', ['name' => 'Quản lí popup định danh'])

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
    @include('template.modal', ['id' => 'show_form_export', 'title'=>'Export Data User Click', 'form'=>'popup.export'])
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            showHide();
            postPhone('/popup-private/importPrivate');
            methodAjaxPopupPrivate();
            handlePushPopUpPrivate();
            checkStatusPopUpPrivate();
            $('body').on('click', '#exportPopup', function (e) {
                e.preventDefault();
                $('#show_form_export').modal('toggle');
                document.getElementById('formExport').reset();
                let id = $(this).data('id');
                document.getElementById("formExport").action = "/popupmanage/export/" + id;
            });
            $('body').on('click', '#exportPopup', function (e){
                $('#show_form_export').modal('toggle');
            });
        });
    </script>
@endpush


