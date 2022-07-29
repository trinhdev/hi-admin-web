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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>ICT<h3>
                    </div>
                    {{-- <h4 class="card-title">HDI</h4> --}}
                    <div class="card-body row">
                        {{-- {{ $ict->table([], true) }} --}}
                        <div class="col-sm-8">
                            <table style="width: 100%">
                                <tr>
                                    <th rowspan="2">Vùng</th>
                                    <th rowspan="2">+/-</th>
                                    <th colspan="3">01/05/2022 - 31/05/2022</th>
                                    <th colspan="3">01/06/2022 - 30/06/2022</th>
                                </tr>
                                <tr>
                                    <th>Doanh thu</th>
                                    <th>Đơn hàng</th>
                                    <th>%</th>
                                    <th>Doanh thu</th>
                                    <th>Đơn hàng</th>
                                    <th>%</th>
                                </tr>
                                @foreach ($ict as $key => $value)
                                    <tr>
                                        <td>{{ !empty($value['branch_name_code']) ? $value['branch_name_code'] : ((!empty($value['branch_code'])) ? $value['branch_code'] : $value['zone_name']) }}</td>
                                        <td>{{ !empty($value['amount_last_time']) ? (round(($value['amount_this_time'] - $value['amount_last_time']) / $value['amount_last_time'], 4) * 100 . '%') : '100%' }}</td>
                                        <td>{{ number_format($value['amount_last_time']) }}</td>
                                        <td>{{ $value['count_last_time'] }}</td>
                                        <td>0%</td>
                                        <td>{{ number_format($value['amount_this_time']) }}</td>
                                        <td>{{ $value['count_this_time'] }}</td>
                                        <td>0%</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <table style="width: 100%">
                                <tr>
                                    <th colspan="3">01/06/2022 - 30/06/2022</th>
                                </tr>
                                <tr>
                                    <th>Loại sản phẩm</th>
                                    <th>Doanh thu</th>
                                    <th>Đơn hàng</th>
                                </tr>
                            </table>
                            <table style="width: 100%; margin-top: 50px">
                                <tr>
                                    <th></th>
                                    <th>Doanh thu</th>
                                    <th>Đơn hàng</th>
                                </tr>
                            </table>
                        </div>
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
    {{-- <script src="{{ asset('/custom_js/supportsystem.js')}}" type="text/javascript" charset="utf-8"></script> --}}
    {{-- {{ $ict->scripts() }} --}}
    {{-- <script>
        const table = $('#banner_manage');
        table.on('preXhr.dt', function(e, settings, data){
            data.bannerType = $('#show_at').val();
            data.public_date_start = $('#show_from').val();
            data.public_date_end = $('#show_to').val();
        });
    </script> --}}
@endpush

<style>
    /* table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th, td {
        text-align: center;
        vertical-align: middle;
        padding: 10px;
    } */

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

    /* footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
    } */
</style>