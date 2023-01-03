@extends('layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="float: left; margin-right: 20px" class="uppercase">Báo cáo hành vi khách hàng theo tháng</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Báo cáo hành vi khách hàng theo tháng</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card-body row form-inline filter-section justify-content-md-center">
                {{-- <form class="form-inline" action="{{ route('reportsalebydate.index') }}" method="GET"> --}}
                <form class="form-inline" method="GET" id="report-filter">
                    @csrf
                    <div class="col-md-3">
                        <div class="input-group input-group-sm mb-4" style="margin-bottom: unset !important;">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Từ: </div>
                            </div>
                            <input type="text" name="show_from" class="form-control" id="show_from" placeholder="Month" value="{{ @$from2 }}" />
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="input-group input-group-sm mb-4" style="margin-bottom: unset !important;">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Đến: </div>
                            </div>
                            <input type="date" name="show_to" class="form-control" id="show_to" placeholder="Date To" value="{{ @$to2 }}" />
                        </div>
                    </div> --}}

                    {{-- <div class="col-md-3">
                        <div class="input-group input-group-sm mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Loại báo cáo: </div>
                            </div>
                            <select style="form-control" name="chisobaocao[]" id="chisobaocao" multiple="multiple">
                                @foreach ($chisobaocaos as $chisobaocao)
                                    @if (in_array($chisobaocao, $filter['chisobaocao']))
                                    <option value="{{ $chisobaocao }}" selected>{{ $chisobaocao }}</option>
                                    @else
                                    <option value="{{ $chisobaocao }}">{{ $chisobaocao }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-md-3" style="text-align: center">
                        <!-- <button id="filter_condition" class="btn btn-sm btn-primary" onclick="filter()">Tìm kiếm</button> -->
                        <input type="submit" class="btn btn-sm btn-primary" name="filter" value="Tìm kiếm" />
                        <!-- <button class="btn btn-sm btn-primary" onClick="exportMultiTable(event)">Xuất hết</button> -->
                    </div>
                </form>
                
            </div>
            <div class="card card-body row filter-section justify-content-md-center" id="report-table">
                <div class="form-inline" style="align-items: inherit">
                    <div class="col-sm-6">
                        <h3 id="total-active-monthly-label"></h3>
                    </div>
                    <div class="col-sm-6">
                        <h3 id="activeNet-label"></h3>
                    </div>
                    <div class="col-sm-6 row-eq-height">
                        <table style="height: 100%" id="activeNet">
                        </table>
                    </div>
    
                    <div class="col-sm-6 row-eq-height">
                        <table style="margin-bottom: 20px" id="total-active-monthly">
                            {{-- <tr class="header">
                                <th rowspan="2">Vùng</th>
                                <th colspan="4">Active</th>
                            </tr> --}}
                            {{-- <tr class="header">
                                <th>T9.2022</th>
                                <th>T10.2022</th>
                                <th>Tăng/giảm</th>
                                <th>Tỷ lệ</th>
                            </tr> --}}
                        </table>
    
                        <table>
                            {{-- <tr class="header">
                                <th>Phát triển mới</th>
                                <th>PTTB của FTEL</th>
                                <th>Tỷ lệ phát triển mới/PTTB của FTEL</th>
                            </tr> --}}
                            {{-- <tr>
                                <td>29,644</td>
                                <td>71,050</td>
                                <td>42.00%</td>
                            </tr> --}}
                            {{-- <tr>
                                <td id="total-new-service"></td>
                                <td id="total-pttb"></td>
                            </tr> --}}
                            <tr>
                                <td>ĐANG PHÁT TRIỂN</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-sm-12" style="margin-top: 20px">
                        <h3>Thanh toán</h3>
                    </div>
                    <div class="col-sm-6 row-eq-height">
                        <table id="sl-thanh-toan">
                            {{-- <tr class="header">
                                <th rowspan="2">Vùng</th>
                                <th colspan="4">SL Thanh toán</th>
                            </tr> --}}
                        </table>
                    </div>
                    <div class="col-sm-6 row-eq-height">
                        <table id="tien-thanh-toan">
                            {{-- <tr class="header">
                                <th rowspan="2">Vùng</th>
                                <th colspan="4">Tổng tiền thanh toán</th>
                            </tr> --}}
                            
                        </table>
                    </div>

                    <div class="col-sm-6" style="margin-top: 20px">
                        <h3>Số lượng đăng ký dịch vụ FTEL (Sale platform)</h3>
                    </div>
                    <div class="col-sm-6" style="margin-top: 20px">
                        <h3>Số lượng nâng cấp gói dịch vụ</h3>
                    </div>
                    <div class="col-sm-6 row-eq-height">
                        <table id="newServiceRegister">
                        </table>
                    </div>
                    <div class="col-sm-6 row-eq-height">
                        <table style="height: 100%" id="upgradeServiceRegister">
                            
                        </table>
                    </div>
                    <div class="col-sm-6" style="margin-top: 20px">
                        <h3>Số lượng thực hiện đổi quà FGold</h3>
                    </div>
                    
                    <div>
                        <h3 style="margin-top: 20px">Số lượng thực hiện Giới thiệu bạn bè</h3>
                    </div>
                    <div class="col-sm-6 row-eq-height">
                        <table style="height: 100%">
                            {{-- <tr class="header">
                                <th>Chức năng</th>
                                <th>Tháng 9</th>
                                <th>Tháng 10</th>
                                <th>Tăng/Giảm</th>
                                <th>Tỷ lệ</th>
                            </tr>
                            <tr>
                                <td>Super80</td>
                                <td>108</td>
                                <td>143</td>
                                <td>35</td>
                                <td>32.00%</td>
                            </tr>
                            <tr>
                                <td>Super100</td>
                                <td>108</td>
                                <td>143</td>
                                <td>35</td>
                                <td>32.00%</td>
                            </tr>
                            <tr>
                                <td>Super150</td>
                                <td>108</td>
                                <td>143</td>
                                <td>35</td>
                                <td>32.00%</td>
                            </tr>
                            <tr>
                                <td>Lux500</td>
                                <td>108</td>
                                <td>143</td>
                                <td>35</td>
                                <td>32.00%</td>
                            </tr>
                            <tr>
                                <td>Lux800</td>
                                <td>108</td>
                                <td>143</td>
                                <td>35</td>
                                <td>32.00%</td>
                            </tr>
                            <tr class="footer">
                                <td>Tổng</td>
                                <td>108</td>
                                <td>143</td>
                                <td>35</td>
                                <td>32.00%</td>
                            </tr> --}}
                            <tr>
                                <td>ĐANG PHÁT TRIỂN</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-6 row-eq-height">
                        <table>
                            {{-- <tr class="header">
                                <th rowspan="2">Vùng</th>
                                <th colspan="4">Thực hiện giới thiệu thành công</th>
                            </tr>
                            <tr class="header">
                                <th>T9.2022</th>
                                <th>T10.2022</th>
                                <th>Tăng/giảm</th>
                                <th>Tỷ lệ</th>
                            </tr>
                            <tr>
                                <td>Vung 1</td>
                                <td>17,222</td>
                                <td>16,362</td>
                                <td>(860)</td>
                                <td>-4.99%</td>
                            </tr>
                            <tr>
                                <td>Vung 2</td>
                                <td>3,329</td>
                                <td>3,349</td>
                                <td>20</td>
                                <td>0.60%</td>
                            </tr>
                            <tr>
                                <td>Vung 3</td>
                                <td>2,620</td>
                                <td>2,573</td>
                                <td>(47)</td>
                                <td>-1.79%</td>
                            </tr>
                            <tr>
                                <td>Vung 4</td>
                                <td>5,295</td>
                                <td>11,173</td>
                                <td>(3,047)</td>
                                <td>-21.43%</td>
                            </tr>
                            <tr>
                                <td>Vung 5</td>
                                <td>24,078</td>
                                <td>15,325</td>
                                <td>(8,753)</td>
                                <td>-36.35%</td>
                            </tr>
                            <tr>
                                <td>Vung 6</td>
                                <td>19,192</td>
                                <td>12,273</td>
                                <td>(6,919)</td>
                                <td>-36.05%</td>
                            </tr>
                            <tr>
                                <td>Vung 7</td>
                                <td>10,698</td>
                                <td>8,134</td>
                                <td>(2,564)</td>
                                <td>-23.97%</td>
                            </tr>
                            <tr class="footer">
                                <td>Tổng</td>
                                <td>116,955</td>
                                <td>80,120</td>
                                <td>(36,835)</td>
                                <td>-31.50%</td>
                            </tr> --}}
                            <tr>
                                <td>ĐANG PHÁT TRIỂN</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-sm-6" style="margin-top: 20px">
                        <h3>Yêu cầu phục vụ</h3>
                    </div>
                    <div class="col-sm-6" style="margin-top: 20px">
                        <h3>Số lượt tương tác các tính năng modem</h3>
                    </div>
                    
                    <div class="col-sm-6 row-eq-height" style="margin-bottom: 20px">
                        <table>
                            {{-- <tr class="header">
                                <th rowspan="2">Vùng</th>
                                <th colspan="4">YCPV</th>
                            </tr>
                            <tr class="header">
                                <th>T9.2022</th>
                                <th>T10.2022</th>
                                <th>Tăng/giảm</th>
                                <th>Tỷ lệ</th>
                            </tr>
                            <tr>
                                <td>Vung 1</td>
                                <td>17,222</td>
                                <td>16,362</td>
                                <td>(860)</td>
                                <td>-4.99%</td>
                            </tr>
                            <tr>
                                <td>Vung 2</td>
                                <td>3,329</td>
                                <td>3,349</td>
                                <td>20</td>
                                <td>0.60%</td>
                            </tr>
                            <tr>
                                <td>Vung 3</td>
                                <td>2,620</td>
                                <td>2,573</td>
                                <td>(47)</td>
                                <td>-1.79%</td>
                            </tr>
                            <tr>
                                <td>Vung 4</td>
                                <td>5,295</td>
                                <td>11,173</td>
                                <td>(3,047)</td>
                                <td>-21.43%</td>
                            </tr>
                            <tr>
                                <td>Vung 5</td>
                                <td>24,078</td>
                                <td>15,325</td>
                                <td>(8,753)</td>
                                <td>-36.35%</td>
                            </tr>
                            <tr>
                                <td>Vung 6</td>
                                <td>19,192</td>
                                <td>12,273</td>
                                <td>(6,919)</td>
                                <td>-36.05%</td>
                            </tr>
                            <tr>
                                <td>Vung 7</td>
                                <td>10,698</td>
                                <td>8,134</td>
                                <td>(2,564)</td>
                                <td>-23.97%</td>
                            </tr>
                            <tr class="footer">
                                <td>Tổng</td>
                                <td>116,955</td>
                                <td>80,120</td>
                                <td>(36,835)</td>
                                <td>-31.50%</td>
                            </tr> --}}
                            <tr>
                                <td>ĐANG PHÁT TRIỂN</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-sm-6 row-eq-height" style="margin-bottom: 20px">
                        <table style="height: 100%">
                            {{-- <tr class="header">
                                <th rowspan="2">Vùng</th>
                                <th colspan="4">Modem</th>
                            </tr>
                            <tr class="header">
                                <th>T9.2022</th>
                                <th>T10.2022</th>
                                <th>Tăng/giảm</th>
                                <th>Tỷ lệ</th>
                            </tr>
                            <tr>
                                <td>Vung 1</td>
                                <td>17,222</td>
                                <td>16,362</td>
                                <td>(860)</td>
                                <td>-4.99%</td>
                            </tr>
                            <tr>
                                <td>Vung 2</td>
                                <td>3,329</td>
                                <td>3,349</td>
                                <td>20</td>
                                <td>0.60%</td>
                            </tr>
                            <tr>
                                <td>Vung 3</td>
                                <td>2,620</td>
                                <td>2,573</td>
                                <td>(47)</td>
                                <td>-1.79%</td>
                            </tr>
                            <tr>
                                <td>Vung 4</td>
                                <td>5,295</td>
                                <td>11,173</td>
                                <td>(3,047)</td>
                                <td>-21.43%</td>
                            </tr>
                            <tr>
                                <td>Vung 5</td>
                                <td>24,078</td>
                                <td>15,325</td>
                                <td>(8,753)</td>
                                <td>-36.35%</td>
                            </tr>
                            <tr>
                                <td>Vung 6</td>
                                <td>19,192</td>
                                <td>12,273</td>
                                <td>(6,919)</td>
                                <td>-36.05%</td>
                            </tr>
                            <tr>
                                <td>Vung 7</td>
                                <td>10,698</td>
                                <td>8,134</td>
                                <td>(2,564)</td>
                                <td>-23.97%</td>
                            </tr>
                            <tr class="footer">
                                <td>Tổng</td>
                                <td>116,955</td>
                                <td>80,120</td>
                                <td>(36,835)</td>
                                <td>-31.50%</td>
                            </tr> --}}
                            <tr>
                                <td>ĐANG PHÁT TRIỂN</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-6 row-eq-height">
                        <table>
                            {{-- <tr class="header">
                                <th>Tháng</th>
                                <th>Đổi tên wifi</th>
                                <th>Đổi mật khẩu wifi</th>
                                <th>Tắt/Mở wifi</th>
                                <th>Khởi động lại wifi</th>
                                <th>Tổng</th>
                            </tr>
                            <tr>
                                <td>T9.2022</td>
                                <td>17,196</td>
                                <td>44,576</td>
                                <td>63,152</td>
                                <td>63,152</td>
                                <td>63,152</td>
                            </tr>
                            <tr>
                                <td>T10.2022</td>
                                <td>17,196</td>
                                <td>44,576</td>
                                <td>63,152</td>
                                <td>63,152</td>
                                <td>63,152</td>
                            </tr>
                            <tr>
                                <td>+/-</td>
                                <td>17,196</td>
                                <td>44,576</td>
                                <td>63,152</td>
                                <td>63,152</td>
                                <td>63,152</td>
                            </tr>
                            <tr>
                                <td>Tỷ lệ</td>
                                <td>17,196</td>
                                <td>44,576</td>
                                <td>63,152</td>
                                <td>63,152</td>
                                <td>63,152</td>
                            </tr> --}}
                            <tr>
                                <td>ĐANG PHÁT TRIỂN</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-6 row-eq-height">
                        <h3>Số lượng chat FTEL được khởi tạo qua kênh chat HiFPT</h3>
                        <table style="line-height: 30px">
                            {{-- <tr class="header">
                                <th>Chức năng</th>
                                <th>Tháng 9</th>
                                <th>Tháng 10</th>
                                <th>Tăng/Giảm</th>
                                <th>Tỷ lệ</th>
                            </tr>
                            <tr>
                                <td>Chat FTEL</td>
                                <td>11,832</td>
                                <td>12,752</td>
                                <td>932</td>
                                <td>8.00%</td>
                            </tr> --}}
                            <tr>
                                <td>ĐANG PHÁT TRIỂN</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-sm-12" style="margin-top: 20px">
                        <h3>Confirm HDDT</h3>
                    </div>
                    <div class="col-sm-6 row-eq-height">
                        <table style="height: 100%">
                            {{-- <tr class="header">
                                <th rowspan="2">Vùng</th>
                                <th colspan="4">Confirm HDDT</th>
                            </tr>
                            <tr class="header">
                                <th>T9.2022</th>
                                <th>T10.2022</th>
                                <th>Tăng/giảm</th>
                                <th>Tỷ lệ</th>
                            </tr>
                            <tr>
                                <td>Vung 1</td>
                                <td>17,222</td>
                                <td>16,362</td>
                                <td>(860)</td>
                                <td>-4.99%</td>
                            </tr>
                            <tr>
                                <td>Vung 2</td>
                                <td>3,329</td>
                                <td>3,349</td>
                                <td>20</td>
                                <td>0.60%</td>
                            </tr>
                            <tr>
                                <td>Vung 3</td>
                                <td>2,620</td>
                                <td>2,573</td>
                                <td>(47)</td>
                                <td>-1.79%</td>
                            </tr>
                            <tr>
                                <td>Vung 4</td>
                                <td>5,295</td>
                                <td>11,173</td>
                                <td>(3,047)</td>
                                <td>-21.43%</td>
                            </tr>
                            <tr>
                                <td>Vung 5</td>
                                <td>24,078</td>
                                <td>15,325</td>
                                <td>(8,753)</td>
                                <td>-36.35%</td>
                            </tr>
                            <tr>
                                <td>Vung 6</td>
                                <td>19,192</td>
                                <td>12,273</td>
                                <td>(6,919)</td>
                                <td>-36.05%</td>
                            </tr>
                            <tr>
                                <td>Vung 7</td>
                                <td>10,698</td>
                                <td>8,134</td>
                                <td>(2,564)</td>
                                <td>-23.97%</td>
                            </tr>
                            <tr class="footer">
                                <td>Tổng</td>
                                <td>116,955</td>
                                <td>80,120</td>
                                <td>(36,835)</td>
                                <td>-31.50%</td>
                            </tr> --}}
                            <tr>
                                <td>ĐANG PHÁT TRIỂN</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
<!--end::Table-->
@push('scripts')
    <script src="{{ asset('/custom_js/reportsalebydate.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('/themes/plugins/xlsx/xlsx.full.min.js')}}" type="text/javascript" charset="utf-8"></script>
    <script>
        $( document ).ready(function() {
            $('#show_from').datetimepicker({
                format: "YYYY-MM",
                useCurrent: false,
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
                }
            });

            $( "#report-filter" ).submit(function( event ) {
                // alert( "Handler for .submit() called." );
                event.preventDefault();
                filter();
            });

            filter();
        });

        function filter() {
            $.ajax({
                url: 'reporttrackingcusbehaviormonthly/activeNet',
                data: {
                    'from_month': $('#show_from').val()
                },
                type: 'GET',
                success: function(data, status) {
                    var total_active = 0;
                    var total_active_net = 0;
                    $('#activeNet').html('');
                    $('#activeNet-label').html('Tổng kích hoạt tháng ' + data['time']['to']);
                    $('#activeNet').append(`
                        <tr class="header">
                            <th>Vùng</th>
                            <th>Active HiFPT đến ${data['time']['to']}</th>
                            <th>Active HiFPT / Active net</th>
                        </tr>
                    `);
                    $.each(data['data'], function(key, value) {
                        var active = parseInt(value['active']);
                        var active_net = parseInt(value['active_net']);
                        total_active += active;
                        total_active_net += active_net;

                        $('#activeNet tr:last').after(`
                            <tr>
                                <td>${value['location_zone']}</td>
                                <td>${active.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${ (active_net != 0) ? ((active / active_net) * 100).toFixed(2) : 0 }</td>
                            </tr>
                        `);
                    });
                    $('#activeNet tr:last').after(`
                        <tr class="footer">
                            <td>Tổng</td>
                            <td>${total_active.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${ (total_active != 0) ? ((total_active / total_active_net) * 100).toFixed(2) : 0 }</td>
                        </tr>
                    `);

                    // $('#total-pttb').append(total_active_net);
                },
                async:   true,
                dataType: 'json'
            }); 

            $.ajax({
                url: 'reporttrackingcusbehaviormonthly/getDataActiveMonthly',
                data: {
                    'from_month': $('#show_from').val()
                },
                type: 'GET',
                success: function(data, status) {
                    var total_last_month = 0;
                    var total_this_month = 0;
                    $('#total-active-monthly').html('');
                    $('#total-active-monthly').append(`
                        <tr class="header">
                            <th rowspan="2">Vùng</th>
                            <th colspan="4">Active</th>
                        </tr>
                    `);
                    $('#total-active-monthly-label').html('Báo cáo tổng hợp tháng ' + data['time']['to']);
                    $('#total-active-monthly tr:last').after(`
                        <tr class="header">
                            <th>${data['time']['from']}</th>
                            <th>${data['time']['to']}</th>
                            <th>Tăng/giảm</th>
                            <th>Tỷ lệ</th>
                        </tr>
                    `);

                    $.each(data['data'], function(key, value) {
                        total_last_month += parseInt(value['count_last_month']);
                        total_this_month += parseInt(value['count_this_month']);
                        var count_last_month = parseInt(value['count_last_month']);
                        var count_this_month = parseInt(value['count_this_month']);
                        var different = count_this_month - count_last_month;
                        $('#total-active-monthly tr:last').after(`
                            <tr>
                                <td>${value['location_zone']}</td>
                                <td>${count_last_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${count_this_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${different.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${(count_last_month != 0) ? ((different / count_last_month) * 100).toFixed(2) : 0 }</td>
                            </tr>
                        `);
                    });
                    $('#total-active-monthly tr:last').after(`
                        <tr class="footer">
                            <td>Tổng</td>
                            <td>${total_last_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${total_this_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${(total_this_month - total_last_month).toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${(total_last_month != 0) ? ((total_this_month - total_last_month) / total_last_month * 100).toFixed(2) : 0}</td>
                        </tr>
                    `);
                },
                async:   true,
                dataType: 'json'
            }); 

            // $.ajax({
            //     url: 'reporttrackingcusbehaviormonthly/getDataActivePttbMonthly',
            //     success: function(data, status) {
            //         console.log(data);
                    
            //     },
            //     async:   true,
            //     dataType: 'json'
            // }); 

            $.ajax({
                url: 'reporttrackingcusbehaviormonthly/newServiceRegister',
                data: {
                    'from_month': $('#show_from').val()
                },
                type: 'GET',
                success: function(data, status) {
                    $('#newServiceRegister').html('');
                    $('#newServiceRegister').append(`
                        <tr class="header">
                            <th>Vùng</th>
                            <th>Dịch vụ</th>
                            <th>${data['time']['from']}</th>
                            <th>${data['time']['to']}</th>
                            <th>Tăng/giảm</th>
                            <th>Tỷ lệ</th>
                        </tr>
                    `);
                    total_last_month = 0;
                    total_this_month = 0;

                    $.each(data['data'], function(key, value) {
                        total_last_month += parseInt(value['count_last_month']);
                        total_this_month += parseInt(value['count_this_month']);

                        var count_last_month = parseInt(value['count_last_month']);
                        var count_this_month = parseInt(value['count_this_month']);
                        var different = count_this_month - count_last_month;

                        $('#newServiceRegister tr:last').after(`
                            <tr>
                                <td>${(value['location_zone']) ? value['location_zone'] : ''}</td>
                                <td>${value['service_key']}</td>
                                <td>${count_last_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${count_this_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${different.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${(count_last_month != 0) ? ((different / count_last_month) * 100).toFixed(2) : 0 }</td>
                            </tr>
                        `);
                    });

                    $('#newServiceRegister tr:last').after(`
                        <tr class="footer">
                            <td colspan="2">Tổng</td>
                            <td>${total_last_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${total_this_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${(total_this_month - total_last_month).toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${(total_last_month != 0) ? ((total_this_month - total_last_month) / total_last_month * 100).toFixed(2) : 0}</td>
                        </tr>
                    `);

                    // $('#total-new-service').append(count_this_month);
                },
                async:   true,
                dataType: 'json'
            }); 

            $.ajax({
                url: 'reporttrackingcusbehaviormonthly/paymentMonthly',
                data: {
                    'from_month': $('#show_from').val()
                },
                type: 'GET',
                success: function(data, status) {
                    // sl-thanh-toan
                    var total_last_month = 0;
                    var total_this_month = 0;
                    var total_amount_last_month = 0;
                    var total_amount_this_month = 0;
                    $('#sl-thanh-toan').html('');
                    $('#sl-thanh-toan').append(`
                        <tr class="header">
                            <th rowspan="2">Vùng</th>
                            <th colspan="4">SL Thanh toán</th>
                        </tr>
                    `);
                    $('#sl-thanh-toan tr:last').after(`
                        <tr class="header">
                            <th>${data['time']['from']}</th>
                            <th>${data['time']['to']}</th>
                            <th>Tăng/giảm</th>
                            <th>Tỷ lệ</th>
                        </tr>
                    `);
                    $('#tien-thanh-toan').html('');
                    $('#tien-thanh-toan').append(`
                        <tr class="header">
                            <th rowspan="2">Vùng</th>
                            <th colspan="4">Tiền Thanh toán</th>
                        </tr>
                    `);
                    $('#tien-thanh-toan tr:last').after(`
                        <tr class="header">
                            <th>${data['time']['from']}</th>
                            <th>${data['time']['to']}</th>
                            <th>Tăng/giảm</th>
                            <th>Tỷ lệ</th>
                        </tr>
                    `);

                    $.each(data['data'], function(key, value) {
                        total_last_month += parseInt(value['count_last_month']);
                        total_this_month += parseInt(value['count_this_month']);
                        total_amount_last_month += parseInt(value['amount_last_month']);
                        total_amount_this_month += parseInt(value['amount_this_month']);

                        var count_last_month = parseInt(value['count_last_month']);
                        var count_this_month = parseInt(value['count_this_month']);
                        var different = count_this_month - count_last_month;

                        var amount_last_month = parseInt(value['amount_last_month']);
                        var amount_this_month = parseInt(value['amount_this_month']);
                        var amount_different = amount_this_month - amount_last_month;

                        $('#sl-thanh-toan tr:last').after(`
                            <tr>
                                <td>${value['location_zone']}</td>
                                <td>${count_last_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${count_this_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${different.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${(count_last_month != 0) ? ((different / count_last_month) * 100).toFixed(2) : 0 }</td>
                            </tr>
                        `);

                        $('#tien-thanh-toan tr:last').after(`
                            <tr>
                                <td>${value['location_zone']}</td>
                                <td>${amount_last_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${amount_this_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${amount_different.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${(amount_last_month != 0) ? ((amount_different / amount_last_month) * 100).toFixed(2) : 0 }</td>
                            </tr>
                        `);
                    });
                    $('#sl-thanh-toan tr:last').after(`
                        <tr class="footer">
                            <td>Tổng</td>
                            <td>${total_last_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${total_this_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${(total_this_month - total_last_month).toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${(total_last_month != 0) ? ((total_this_month - total_last_month) / total_last_month * 100).toFixed(2) : 0}</td>
                        </tr>
                    `);
                    $('#tien-thanh-toan tr:last').after(`
                        <tr class="footer">
                            <td>Tổng</td>
                            <td>${total_amount_last_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${total_amount_this_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${(total_amount_this_month - total_amount_last_month).toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${(total_amount_last_month != 0) ? ((total_amount_this_month - total_amount_last_month) / total_amount_last_month * 100).toFixed(2) : 0}</td>
                        </tr>
                    `);
                },
                async:   true,
                dataType: 'json'
            }); 

            $.ajax({
                url: 'reporttrackingcusbehaviormonthly/upgradeServiceRegister',
                data: {
                    'from_month': $('#show_from').val()
                },
                type: 'GET',
                success: function(data, status) {
                    $('#upgradeServiceRegister').html('');
                    $('#upgradeServiceRegister').append(`
                        <tr class="header">
                            <th>Vùng</th>
                            <th>Dịch vụ</th>
                            <th>${data['time']['from']}</th>
                            <th>${data['time']['to']}</th>
                            <th>Tăng/giảm</th>
                            <th>Tỷ lệ</th>
                        </tr>
                    `);
                    total_last_month = 0;
                    total_this_month = 0;

                    $.each(data['data'], function(key, value) {
                        var count_last_month = (value['count_last_month']) ? parseInt(value['count_last_month']) : 0;
                        var count_this_month = (value['count_this_month']) ? parseInt(value['count_this_month']) : 0;
                        var different = count_this_month - count_last_month;
                        total_last_month += count_last_month;
                        total_this_month += count_this_month;

                        $('#upgradeServiceRegister tr:last').after(`
                            <tr>
                                <td>${value['location_zone']}</td>
                                <td>${value['service_name_new']}</td>
                                <td>${count_last_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${count_this_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${different.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                                <td>${(count_last_month != 0) ? ((different / count_last_month) * 100).toFixed(2) : 0 }</td>
                            </tr>
                        `);
                    });

                    $('#upgradeServiceRegister tr:last').after(`
                        <tr class="footer">
                            <td colspan="2">Tổng</td>
                            <td>${total_last_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${total_this_month.toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${(total_this_month - total_last_month).toLocaleString('en-US', {maximumFractionDigits: 2})}</td>
                            <td>${(total_last_month != 0) ? ((total_this_month - total_last_month) / total_last_month * 100).toFixed(2) : 0}</td>
                        </tr>
                    `);
                },
                async:   true,
                dataType: 'json'
            }); 
        }
        
    </script>
@endpush

<style>
    table {
        margin: 0 auto;
        border-collapse: collapse;
        text-align: center
        /* border-style: hidden; */
        /*Remove all the outside
        borders of the existing table*/
    }
    table td {
        padding: 0.5rem;
        border: 1px solid grey;
    }
    table th {
        padding: 0.5rem;
        border: 1px solid grey;
    }

    .form-control {
        border: 1px solid #ccc;
        border-radius: 3px;
        box-shadow: none !important;
        margin-bottom: 15px;
    }

    .form-control:focus {
        border: 1px solid #34495e;
    }

    .select2.select2-container {
    width: 100% !important;
    }

    .select2.select2-container .select2-selection {
    border: 1px solid #ccc;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    height: 34px;
    margin-bottom: 15px;
    outline: none !important;
    transition: all .15s ease-in-out;
    }

    .select2.select2-container .select2-selection .select2-selection__rendered {
    color: #333;
    line-height: 32px;
    padding-right: 33px;
    }

    .select2.select2-container .select2-selection .select2-selection__arrow {
    background: #f8f8f8;
    border-left: 1px solid #ccc;
    -webkit-border-radius: 0 3px 3px 0;
    -moz-border-radius: 0 3px 3px 0;
    border-radius: 0 3px 3px 0;
    height: 32px;
    width: 33px;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
    background: #f8f8f8;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
    -webkit-border-radius: 0 3px 0 0;
    -moz-border-radius: 0 3px 0 0;
    border-radius: 0 3px 0 0;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
    border: 1px solid #34495e;
    }

    .select2.select2-container .select2-selection--multiple {
    height: auto;
    min-height: 34px;
    }

    .select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
    margin-top: 0;
    height: 32px;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__rendered {
    display: block;
    padding: 0 4px;
    line-height: 29px;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__choice {
    background-color: #f8f8f8;
    border: 1px solid #ccc;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    margin: 4px 4px 0 0;
    padding: 0 6px 0 22px;
    height: 24px;
    line-height: 24px;
    font-size: 12px;
    position: relative;
    color: #000000
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
    position: absolute;
    top: 0;
    left: 0;
    height: 22px;
    width: 22px;
    margin: 0;
    text-align: center;
    color: #e74c3c;
    font-weight: bold;
    font-size: 16px;
    }

    .select2-container .select2-dropdown {
    background: transparent;
    border: none;
    margin-top: -5px;
    }

    .select2-container .select2-dropdown .select2-search {
    padding: 0;
    }

    .select2-container .select2-dropdown .select2-search input {
    outline: none !important;
    border: 1px solid #34495e !important;
    border-bottom: none !important;
    padding: 4px 6px !important;
    }

    .select2-container .select2-dropdown .select2-results {
    padding: 0;
    }

    .select2-container .select2-dropdown .select2-results ul {
    background: #fff;
    border: 1px solid #34495e;
    }

    .select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
    background-color: #3498db;
    }

    /* footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
    } */

    table {
        width: 100%;
    }

    .card {
        display: block!important
    }

    .header {
        background-color: #B5D89E;
        font-weight: bold;
    }

    .footer {
        font-weight: bold;
    }

    h3 {
        font-weight: bold;
    }
</style>