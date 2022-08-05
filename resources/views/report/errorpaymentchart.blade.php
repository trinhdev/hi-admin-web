@extends('layouts.default')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="float: left; margin-right: 20px" class="uppercase">Báo cáo data sale theo ngày</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Báo cáo data sale theo ngày</li>
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
                {{-- <div class="container">
                    
                </div> --}}
                <div class="card-body row form-inline filter-section">
                    <div class="col-md-3">
                        <div class="input-group input-group-sm mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Từ: </div>
                            </div>
                            <input type="date" name="show_from_last" class="form-control" id="show_from_last" placeholder="Date From" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group input-group-sm mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Đến: </div>
                            </div>
                            <input type="date" name="show_to_last" class="form-control" id="show_to_last" placeholder="Date To" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group input-group-sm mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Từ: </div>
                            </div>
                            <input type="date" name="show_from" class="form-control" id="show_from" placeholder="Date From" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group input-group-sm mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Đến: </div>
                            </div>
                            <input type="date" name="show_to" class="form-control" id="show_to" placeholder="Date To" />
                        </div>
                    </div>
                    <div class="col-md-12" style="text-align: center">
                        <button id="filter_condition" class="btn btn-sm btn-primary">Tìm kiếm</button>
                    </div>
                </div>
                {{--Start table--}}
                <div class="row">
                    <div class="col-sm-6">
                        <canvas id="payment-error-user-system-ecom" width="100%" ></canvas>
                    </div>
                    <div class="col-sm-6">
                        <canvas id="payment-error-user-system-ftel" width="100%" ></canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <canvas id="payment-error-detail-ecom" width="100%" ></canvas>
                    </div>
                    <div class="col-sm-6">
                        <canvas id="payment-error-detail-ftel" width="100%" ></canvas>
                    </div>
                </div>
                {{--End table--}}
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

@push('scripts')
    {{-- <script src="{{ asset('/custom_js/payment_error_chart.js')}}" type="text/javascript" charset="utf-8"></script> --}}
    <script>
        
        var from = $('#show_from').val();
        var to = $('#show_to').val();
        var detailChart = [];

        drawPaymentErrorDetailEcom();
        drawPaymentErrorDetailFtel();

        function drawPaymentErrorDetailEcom(from = null, to = null) {
            $.ajax({
                url: '/errorpaymentchart/getPaymentErrorDetail',
                type:'POST',
                data: {
                    from: from,
                    to: to,
                    type: 'ecom'
                },
                success: function (response){
                    drawPaymentErrorDetailChart('ecom', response);
                },
                error: function (xhr) {
                    var errorString = '';
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        errorString = value;
                        return false;
                    });
                    showError(errorString);
                    console.log(data);
                }
            });
        }

        function drawPaymentErrorDetailFtel(from = null, to = null) {
            $.ajax({
                url: '/errorpaymentchart/getPaymentErrorDetail',
                type:'POST',
                data: {
                    from: from,
                    to: to,
                    type: 'ftel'
                },
                success: function (response){
                    drawPaymentErrorDetailChart('ftel', response);
                },
                error: function (xhr) {
                    var errorString = '';
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        errorString = value;
                        return false;
                    });
                    showError(errorString);
                    console.log(data);
                }
            });
        }

        function drawPaymentErrorDetailChart(type, data) {
            detailChart[type] = new Chart(document.getElementById("payment-error-detail-" + type), {
                type: 'doughnut',
                options: {
                    title: {
                        display: true,
                        text: 'Báo cáo lỗi thanh toán chi tiết cho ' + type,
                        align: 'center',
                        position: 'bottom'
                    },
                    scales: {
                        yAxes: {
                            beginAtZero: true
                        }
                    }
                },
                data: data,
            });
        }

        
    </script>
@endpush