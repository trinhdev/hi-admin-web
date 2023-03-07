<!-- Create by: trinhdev || Update at: 2022/06/22 || Contact: trinhhuynhdp@gmail.com -->
@extends('layoutv2.layout.app')
@push('style')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/chart.js/Chart.js"></script>
@endpush
@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="_buttons">
                        <a href="#" onclick="alert('Liên hệ trinhhdp@fpt.com.vn nếu xảy ra lỗi không mong muốn!')" class="btn btn-default pull-left display-block mright5">
                            <i class="fa-regular fa-user tw-mr-1"></i>Liên hệ
                        </a>
                        <div class="visible-xs">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel_s tw-mt-2 sm:tw-mt-4">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="control-label">Type</div>
                                        <select class="form-control selectpicker" name="position" id="show_at" placeholder="Show at" data-live-search="true">
                                            <option value="">-- Select --</option>
                                            @if(!empty($type))
                                                @foreach($type as $value)
                                                    <option value="{{$value['type']}}">{{$value['type']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <div class="control-label">Phone</div>
                                        </div>
                                        <input class="form-control" id="phone_filter" placeholder="Phone Filter" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="control-label">Duplicate</div>
                                        <select class="form-control filter_duplicate selectpicker" id="filter_duplicate"
                                                placeholder="Show at">
                                            <option value=''>-- Select --</option>
                                            <option value='yes'>Yes</option>
                                            <option value='no'>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="control-label">From</div>
                                        <input type="datetime-local" name="show_from" class="form-control datepicker" id="show_from"
                                               placeholder="Date From"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="control-label">To</div>
                                        <input type="datetime-local" name="show_to" class="form-control datepicker" id="show_to"
                                               placeholder="Date To"/>
                                    </div>
                                </div>
                                <div class="col-md-12 filter-class tw-mb-3">
                                    <button id="submit" class="btn btn-sm btn-primary mb-4">Filter table</button>
                                    <button id="filter_chart" class="btn btn-sm btn-primary mb-4">Filter chart</button>
                                    <button
                                        onclick='dialogConfirmWithAjax(exportApp, this, "Cảnh báo: Để hạn chế mất dữ liệu, hãy export tối đa 150.000 dòng, khuyến khích export theo dữ liệu ngày! Nếu cần xuất data lớn vui lòng liên hệ trinhhdp@fpt.com.vn")'
                                        id="export" class="btn btn-sm btn-primary mb-4">Export
                                    </button>
                                </div>
                            </div>
                            <div class="panel-table-full">
                                {{ $dataTable->table(['id' => 'app_table'], $footer = false) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{ $dataTable->scripts() }}
    <script>
        const table = $('#app_table');
        table.on('preXhr.dt', function (e, settings, data) {
            data.type = $('#show_at').val();
            data.phone = $('#phone_filter').val();
            data.public_date_start = $('#show_from').val();
            data.public_date_end = $('#show_to').val();
            data.filter_duplicate = $('#filter_duplicate').val();
        });

        function exportApp() {
            let type = $('#show_at').val();
            let phone = $('#phone_filter').val();
            let start = $('#show_from').val();
            let end = $('#show_to').val();
            let filter_duplicate = $('#filter_duplicate').val();
            params = "type=" + type + "&" +
                "start=" + start + "&" +
                "end=" + end + "&" +
                "phone=" + phone + "&" +
                "filter_duplicate=" + filter_duplicate
            window.location.href = "/app/export?" + params;
        }
        //chart
        google.charts.load("current", {packages: ['corechart']});
        $(window).on('load', function(e) {
            $.ajax( {
                url: '{!! route('app.post.chart') !!}',
                type: 'POST',
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $("#spinner").addClass("show");
                },
                success: function(response) {
                    $("#spinner").removeClass("show");
                    google.charts.setOnLoadCallback(drawChartDataDay(response.data_month,"Biểu đồ thể hiện lưu lượng log trong 30 ngày gần nhất","columnchart_month"));
                    google.charts.setOnLoadCallback(drawChartDataDay(response.data_day, "Biểu đồ thể hiện số lượt truy cập các màn hình trong ngày {{date("d/m/Y")}}","columnchart_day"));
                    google.charts.setOnLoadCallback(drawChartDataDay(response.data_total,"Biểu đồ thể hiện số lượng user truy cập app trong 30 ngày gần nhất","columnchart_total"));
                    google.charts.setOnLoadCallback(drawChartDataDay(response.data_month_current,"Biểu đồ thể hiện số lượng user truy cập vào app trong 1 tuần gần nhất","columnchart_month_current"));
                },
                error: function (xhr) {
                    $("#spinner").removeClass("show");
                    var errorString = '';
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        errorString = value;
                        return false;
                    });
                    showMessage('error',errorString);
                }
            } );
            e.preventDefault();
        });


        function drawChartDataDay(response, title, id) {
            var dataChart=[["Element", "Density", {role: "style"}]];
            if(!$.trim(response)) {
                dataChart.push(["No data", 0, "rgb(67, 116, 224)"])
            } else {
                response.forEach((item, index) => {
                    dataChart.push([item.data, parseInt(item.count), "rgb(67, 116, 224)"],)
                })
            }
            var data = google.visualization.arrayToDataTable(dataChart);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2]);

            var options = {
                title: title,
                width: 800,
                height: 300,
                bar: {groupWidth: "95%"},
                legend: {position: "none"},
            };
            var chart = new google.visualization.ColumnChart(document.getElementById(id));
            chart.draw(view, options);
        }
    </script>

@endpush



