@extends('layoutv2.layout.app')
@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="panel_s user-data">
                <div class="panel-body">
                    <div class="horizontal-scrollable-tabs panel-full-width-tabs">
                        <div class="scroller scroller-left arrow-left"><i class="fa fa-angle-left"></i></div>
                        <div class="scroller scroller-right arrow-right"><i class="fa fa-angle-right"></i></div>
                        <div class="horizontal-tabs">
                            <ul class="nav nav-tabs nav-tabs-horizontal" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#table_detail" aria-controls="table_detail" role="tab" data-toggle="tab">
                                        <i class="fa fa-tasks menu-icon"></i> Detail
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#table_overview"
                                       aria-controls="table_overview" role="tab" data-toggle="tab">
                                        <i class="fa-solid fa-chart-gantt menu-icon"></i> Overview
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content tw-mt-5">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="member_filter" class="control-label">Trạng thái</label>
                                    <div class="dropdown bootstrap-select show-tick bs3" style="width: 100%;">
                                        <select name="show_at" id="show_at" class="selectpicker" data-actions-box="1" data-width="100%"
                                                data-none-selected-text="Không có mục nào được chọn" tabindex="-98">
                                            <option data-subtext="--Select--"></option>
                                            <option value="0">Chưa tiếp nhận</option>
                                            <option value="1">Đã chuyển tiếp</option>
                                            <option value="2">Đang xử lí</option>
                                            <option value="3">Đã xử lí</option>
                                            <option value="4">Hủy bỏ</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="phone_filter" class="control-label">Số điện thoại</label>
                                    <input id="phone_filter"  class="form-control" type="text" name="phone_filter"
                                           placeholder="Phone Filter" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="daterange" class="control-label">Chọn ngày</label>
                                    <div class="input-group date">
                                        <input id="daterange"  class="form-control daterange" type="text" name="daterange"
                                               placeholder="Nhập ngày hiển thị" autocomplete="off"/>
                                        <div class="input-group-addon">
                                            <i class="fa-regular fa-calendar calendar-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="submit" class="control-label"></label>
                                    <div class="input-group">
                                        <button type="button"  class="tw-mt-1 btn btn-info"
                                                id="filter_condition">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane active" id="table_detail">
                            {!! $detail->table(['width' => '100%', 'id'=>'table-detail']) !!}
                        </div>
                        <div role="tabpanel" class="tab-pane" id="table_overview">
                            {!! $overview->table(['width' => '100%', 'id'=>'table-overview']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="showDetail_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-md">
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
@push('script')
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
                        alert_float('success',data.html);
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
                        alert_float('danger', errorString);
                    }
                });
            });
        });
    </script>
@endpush
