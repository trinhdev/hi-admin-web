@extends('layouts.default')
@push('header')
    <link media="all" type="text/css" rel="stylesheet" href="{{url('/')}}/base/css/core.css">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px" class="uppercase"> Quản lí error payment</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Phone</li>
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
                            <form class="form-inline">
                                <div class="col-md-3">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="show_at">Type</label>
                                        </div>
                                        <select class="form-control" name="show_at" id="show_at">
                                            <option value="">-- Select --</option>
                                            <option value="0">Chưa tiếp nhận</option>
                                            <option value="1">Đã xử lí</option>
                                            <option value="3">Đã chuyển tiếp & xử lí</option>
                                            <option value="2">Hủy bỏ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Phone</div>
                                        </div>
                                        <input class="form-control" id="phone_filter" placeholder="Phone Filter" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend ">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i>&nbsp;</div>
                                        </div>
                                        <input class="form-control" id="daterange" type="text" name="daterange" />
                                    </div>
                                </div>
                                <div class="filter-class" style="width: 100%; text-align: center">
                                    <button type="button" id="filter_condition" class="btn btn-sm btn-primary mb-4">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--begin::Table-->
                    {!! $dataTable->table() !!}
                    <!--end::Table-->
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div id="showDetail_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body" id="showDetailBanner_Modal_body">
                    @include('payment-support.modal')
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        const table = $('#PaymentSupport_manage');
        table.on('preXhr.dt', function(e, settings, data){
            data.type = $('#show_at').val();
            data.phone = $('#phone_filter').val();
            data.daterange = $('#daterange').val();
        });

        $(document).ready(function() {
            $('body').on('click', '#detail', function (event) {
                event.preventDefault();
                let id = $(this).data('id');
                $('#showDetail_Modal').modal('toggle');
                window.urlMethod = '/payment-support/update/'+id;
            });

            $('body').on('click', '#submitAjax', function (e){
                $(this).attr('disabled','disabled');
                e.preventDefault();
                let data = $('#formData').serialize();
                $.ajax({
                    url: urlMethod,
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    cache: false,
                    beforeSend: function(){
                        $('#showDetail_Modal').modal('toggle');
                        $("#spinner").addClass("show");
                    },
                    success: (data) => {
                        $("#spinner").removeClass("show");
                        showMessage('success',data.data.message);
                        $('#submitAjax').prop('disabled', false);
                        table.DataTable().ajax.reload();
                    }
                });
            });
        });
    </script>
@endpush
