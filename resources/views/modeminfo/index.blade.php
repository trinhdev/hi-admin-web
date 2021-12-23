@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="font-weight: bold">{{ (!empty($data['ModemInfo']['ModelModem'])) ? $data['ModemInfo']['ModelModem'] : 'N/A' }}</h1><span class="badge bg-primary" style="padding: 0.4em 0.4em">{{ (!empty($data['ModemInfo']['IpAdress'])) ? $data['ModemInfo']['IpAdress'] : '' }}</span>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Modem info v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-bottom: 30px">
                    <div class="col-md-12">
                        <form action="{{ route('modeminfo.searchByContractNoOrId') }}" onsubmit="handleSubmit(event,this)" onKeyPress="return checkSubmit(event)" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Xin nhập số hợp đồng cần tra cứu tại đây" name="modemNo" id="modemNo">
                                <div class="input-group-append">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 bg-info">
                            <span class="info-box-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Upload</span>
                                <span class="info-box-number">{{ (!empty($data['ModemInfo']['upload'])) ? $data['ModemInfo']['upload'] : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 bg-warning">
                            <span class="info-box-icon">
                                <i class="fas fa-cloud-download-alt"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Download</span>
                                <span class="info-box-number">{{ (!empty($data['ModemInfo']['download'])) ? $data['ModemInfo']['download'] : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 bg-success">
                            <span class="info-box-icon">
                                <i class="fas fa-signal"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Online</span>
                                <span class="info-box-number">{{ (!empty($data['ModemInfo']['DayOnline'])) ? $data['ModemInfo']['DayOnline'] : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 bg-danger">
                            <span class="info-box-icon">
                                <i class="fab fa-safari"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Lưu lượng</span>
                                <span class="info-box-number">{{ (!empty($data['ModemInfo']['currentMonthTraffic'])) ? $data['ModemInfo']['currentMonthTraffic'] : '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!empty($data['DevicesConnected']['DevicesWifi']))
                    @foreach ($data['DevicesConnected']['DevicesWifi'] as $key => $value)
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-widget">
                                    <div class="card-header">
                                        <div class="user-block">
                                            <img src="/images/wifi-router.png" alt="Wifi icon">
                                            <span class="username">Mạng Wi-Fi {{ $key }}</span>
                                            <span class="description">Danh sách mạng wifi đang sử dụng</span>
                                        </div>
                                        {{-- <div class="card-tools">
                                            <button class="btn btn-tool" type="button" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div> --}}
                                    </div>
                                    <div class="card-body row">
                                        @if(!empty($value))
                                            @foreach ($value as $wifi)
                                                <div class="col-sm-4">
                                                    <div class="card card-outline card-success">
                                                        <div class="card-header">
                                                            <h3 style="font-weight: bold">{{ $wifi['HostName'] }}</h3>
                                                        </div>
                                                        <div class="card-body row">
                                                            <div class="col-sm-5">Thiết bị</div>
                                                            <div class="col-sm-7"><span class="badge bg-secondary">{{ $wifi['Type'] }}</span></div>
                                                            <div class="col-sm-5">Mac</div>
                                                            <div class="col-sm-7"><span class="badge bg-success">{{ $wifi['MacAddress'] }}</span></div>
                                                            <div class="col-sm-5">IP Address</div>
                                                            <div class="col-sm-7"><span class="badge bg-danger">{{ $wifi['IpAdress'] }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-widget">
                            <div class="card-header">
                                <div class="user-block">
                                    <img src="/images/local-area-network.png" alt="Wifi icon">
                                    <span class="username">Mạng LAN</span>
                                    <span class="description">Danh sách mạng LAN đang sử dụng</span>
                                </div>
                                {{-- <div class="card-tools">
                                    <button class="btn btn-tool" type="button" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div> --}}
                            </div>
                            <div class="card-body row">
                                @if(!empty($data['DevicesConnected']['DevicesLan']))
                                    @foreach ($data['DevicesConnected']['DevicesLan'] as $lan)
                                        <div class="col-sm-4">
                                            <div class="card card-outline card-warning">
                                                <div class="card-header">
                                                    <h3 style="font-weight: bold">{{ $lan['HostName'] }}</h3>
                                                </div>
                                                <div class="card-body row">
                                                    <div class="col-sm-5">Thiết bị</div>
                                                    <div class="col-sm-7"><span class="badge bg-secondary">{{ $lan['Type'] }}</span></div>
                                                    <div class="col-sm-5">Mac</div>
                                                    <div class="col-sm-7"><span class="badge bg-success">{{ $lan['MacAddress'] }}</span></div>
                                                    <div class="col-sm-5">IP Address</div>
                                                    <div class="col-sm-7"><span class="badge bg-danger">{{ $lan['IpAdress'] }}</span></div>
                                                    {{-- <div class="col-sm-5">Lưu lượng sử dụng</div>
                                                    <div class="col-sm-7"><span class="badge bg-warning text-dark">0.0251GB</span></div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <style>
        select {
            font-family: 'Lato', 'Font Awesome 5 Free', 'Font Awesome 5 Brands';
        }
    </style>
@endsection