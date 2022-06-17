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
                    <h1 style="float: left; margin-right: 20px" class="uppercase">Quản lý reset mã hỗ trợ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Mã hỗ trợ</li>
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
                        <div class="col-md-6" style="text-align: center">
                            <div class="input-group input-group-sm mb-6">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Mã hỗ trợ: </div>
                                </div>
                                <input type="text" class="form-control" id="support-code" name="supportCode" placeholder="Xin vui lòng nhập mã hỗ trợ cần tìm tại đây" />
                            </div>
                        </div>
                    </div>
                </div>

                {{ $dataTable->table([], true) }}
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<div id="noteForLogs_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="noteForLogs_Modal_body">
                <form id="open-support-code-form" action="{{ route('supportcode.openSupportCode') }}" method="POST" onSubmit="handleSubmit(event,this)">
                    @csrf
                    <div class="form-group">
                        <label for="supportCode">Mã hỗ trợ</label>
                        <input type="text" id="support-code-modal" class="form-control" name="supportCode" readonly />
                    </div>
                    <div class="form-group">
                        <label for="note">Ghi chú</label>
                        <textarea class="form-control" name="note"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="show_from">Ngày tạo</label>
                        <input type="datetime-local" name="created_at" class="form-control" id="created_at" placeholder="Ngày tạo" />
                        {{-- <div class='input-group date' id='datetimepicker2'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                         </div> --}}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="open-support-code-form"  class="btn btn-primary">Mở thiết bị</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
@endsection
<!--end::Table-->
@push('scripts')
    <script src="{{ asset('/custom_js/supportcode.js')}}"></script>
    {{ $dataTable->scripts() }}
    <script>
        const table = $('#support-code-table');
        table.on('preXhr.dt', function(e, settings, data) {
            console.log($('#support-code').val());
            data.supportCode = $('#support-code').val();
        });
        $('#created_at').datetimepicker({
            format: "YYYY-MM-DD HH:mm:ss",
            useCurrent: true,
            sideBySide: true,
            icons: {
                time: 'fas fa-clock',
                date: 'fas fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-arrow-left',
                next: 'fas fa-arrow-right',
                today: 'fas fa-calendar-day',
                clear: 'fas fa-trash',
                close: 'fas fa-window-close'
            },
        });
    </script>
@endpush