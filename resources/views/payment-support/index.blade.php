@extends('layouts.default')
@push('header')
    <link media="all" type="text/css" rel="stylesheet" href="{{url('/')}}/base/css/core.css">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('template.breadcrumb', ['name'=>'Quản lí error payment'])

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
                                            <option value="1">Đã chuyển tiếp</option>
                                            <option value="2">Đang xử lí</option>
                                            <option value="3">Đã xử lí</option>
                                            <option value="4">Hủy bỏ</option>
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
                                <div class="float-left col-md-1 filter-class" style="width: 100%; text-align: center">
                                    <button type="button" id="filter_condition" class="btn btn-sm btn-primary mb-4">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--begin::Table-->
                    <div class="tabbable-custom">
                        <ul class="nav mb-3 nav-tabs" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-detail-tab" data-toggle="pill" href="#pills-detail"
                                   role="tab" aria-controls="pills-detail" aria-selected="true">Table</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-overview-tab" data-toggle="pill" href="#pills-overview"
                                   role="tab" aria-controls="pills-overview" aria-selected="false">Overview</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-detail" role="tabpanel"
                                 aria-labelledby="pills-detail-tab">
                                {!! $detail->table(['width' => '100%', 'id'=>'table-detail']) !!}
                            </div>
                            <div class="tab-pane fade" id="pills-overview" role="tabpanel"
                                 aria-labelledby="pills-overview-tab">
                                {!! $overview->table(['width' => '100%', 'id'=>'table-overview']) !!}
                            </div>
                        </div>
                    </div>
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
    {!! $detail->scripts() !!}
    {!! $overview->scripts() !!}
    <script>
        const detail = $('#table-detail');
        const overview = $('#table-overview');

        let data = function (e, settings, data) {
            data.type = $('#show_at').val();
            data.phone = $('#phone_filter').val();
            data.daterange = $('#daterange').val();
        };

        detail.on('preXhr.dt', data);
        overview.on('preXhr.dt', data);

        $(document).ready(function() {
            $('body').on('click', '#detail', function (event) {
                event.preventDefault();
                let id = $(this).data('id');
                $('#showDetail_Modal').modal('toggle');
                let urlMethod = '/payment-support/show/'+id;
                $.ajax({
                    url: urlMethod,
                    type: 'GET',
                    success: function (response){
                        console.log(response);
                        for (const [key, value] of Object.entries(response.data)) {
                            $('#' + key).val(value);
                            $('.' + key).val(value);
                            if(key==='status') {
                                $('#'+key).trigger('change');
                            }
                        }
                        $('#showDetailBanner_Modal').modal('toggle');
                        window.urlMethod = '/payment-support/update/'+id;
                    },
                });
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
                        console.log(data);
                        $("#spinner").removeClass("show");
                        showMessage('success',data.html);
                        $('#submitAjax').prop('disabled', false);
                        detail.DataTable().ajax.reload();
                    },
                    error: function (xhr) {
                        $("#spinner").removeClass("show");
                        $('#submitAjax').prop('disabled', false);
                        var errorString = '';
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            errorString = value;
                            return false;
                        });
                        showMessage('error', errorString);
                        console.log(data);

                    }
                });
            });
        });
    </script>
@endpush
