@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px" class="uppercase"> Tracking dashboard</h1>
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
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Area Chart</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <div id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"><div class="uplot u-hz"><div class="u-wrap" style="width: 1052px; height: 250px;"><div class="u-under" style="left: 50px; top: 17px; width: 977px; height: 183px;"></div><canvas width="1052" height="250"></canvas><div class="u-over" style="left: 50px; top: 17px; width: 977px; height: 183px;"><div class="u-cursor-x u-off" style="transform: translate(-10px, 0px);"></div><div class="u-cursor-y u-off" style="transform: translate(0px, -10px);"></div><div class="u-select" style="left: 0px; width: 0px; top: 0px; height: 0px;"></div><div class="u-cursor-pt u-off" style="width: 5px; height: 5px; margin-left: -2.5px; margin-top: -2.5px; transform: translate(-10px, -10px); background: rgb(60, 141, 188); border-color: rgb(60, 141, 188);"></div><div class="u-cursor-pt u-off" style="width: 5px; height: 5px; margin-left: -2.5px; margin-top: -2.5px; transform: translate(-10px, -10px); background: rgb(193, 199, 209); border-color: rgb(193, 199, 209);"></div></div><div class="u-axis" style="top: 200px; height: 50px; left: 50px; width: 977px;"></div><div class="u-axis" style="left: 0px; width: 50px; top: 17px; height: 183px;"></div></div><table class="u-legend u-inline u-live"><tr class="u-series"><th><div class="u-marker"></div><div class="u-label">Value</div></th><td class="u-value">--</td></tr><tr class="u-series"><th><div class="u-marker" style="border: 2px solid rgb(60, 141, 188); background: rgba(60, 141, 188, 0.7);"></div><div class="u-label">Value</div></th><td class="u-value">--</td></tr><tr class="u-series"><th><div class="u-marker" style="border: 2px solid rgb(193, 199, 209); background: rgba(210, 214, 222, 0.7);"></div><div class="u-label">Value</div></th><td class="u-value">--</td></tr></table></div></div>
                                </div>
                            </div>

                        </div>


                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Line Chart</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <div id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"><div class="uplot u-hz"><div class="u-wrap" style="width: 1052px; height: 250px;"><div class="u-under" style="left: 50px; top: 17px; width: 977px; height: 183px;"></div><canvas width="1052" height="250"></canvas><div class="u-over" style="left: 50px; top: 17px; width: 977px; height: 183px;"><div class="u-cursor-x u-off" style="transform: translate(-10px, 0px);"></div><div class="u-cursor-y u-off" style="transform: translate(0px, -10px);"></div><div class="u-select" style="left: 0px; width: 0px; top: 0px; height: 0px;"></div><div class="u-cursor-pt u-off" style="width: 8.2px; height: 8.2px; margin-left: -4.1px; margin-top: -4.1px; transform: translate(-10px, -10px); background: rgb(60, 141, 188); border-color: rgb(60, 141, 188);"></div><div class="u-cursor-pt u-off" style="width: 8.2px; height: 8.2px; margin-left: -4.1px; margin-top: -4.1px; transform: translate(-10px, -10px); background: rgb(193, 199, 209); border-color: rgb(193, 199, 209);"></div></div><div class="u-axis" style="top: 200px; height: 50px; left: 50px; width: 977px;"></div><div class="u-axis" style="left: 0px; width: 50px; top: 17px; height: 183px;"></div></div><table class="u-legend u-inline u-live"><tr class="u-series"><th><div class="u-marker"></div><div class="u-label">Value</div></th><td class="u-value">--</td></tr><tr class="u-series"><th><div class="u-marker" style="border: 2px solid rgb(60, 141, 188); background: transparent;"></div><div class="u-label">Value</div></th><td class="u-value">--</td></tr><tr class="u-series"><th><div class="u-marker" style="border: 2px solid rgb(193, 199, 209); background: transparent;"></div><div class="u-label">Value</div></th><td class="u-value">--</td></tr></table></div></div>
                                </div>
                            </div>

                        </div>
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
                                        <input class="form-control" id="reportrange" type="text" name="show_from" />
                                    </div>
                                </div>
                                <div class="filter-class" style="width: 100%; text-align: center">
                                    <button type="button" id="filter_condition" class="btn btn-sm btn-primary mb-4">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--begin::Table-->
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
    <script>
        const table = $('#PaymentSupport_manage');
        table.on('preXhr.dt', function(e, settings, data){
            data.type = $('#show_at').val();
            data.phone = $('#phone_filter').val();
            data.public_date_start = $('#show_from').val();
            data.public_date_end = $('#show_to').val();
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

        $(function() {
            var start = moment().subtract(6, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });
    </script>
@endpush
