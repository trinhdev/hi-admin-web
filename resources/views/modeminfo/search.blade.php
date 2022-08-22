@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-9">
                        <h1 class="m-0" style="font-weight: bold">Tra cứu thông tin bằng mã hợp đồng</span>
                    </div><!-- /.col -->
                    <div class="col-sm-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Search By Obj</li>
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
                        <form action="{{ route('IpMacOnline.searchByObjId') }}" onsubmit="handleSubmit(event,this)" method="GET">
                            {{-- @csrf --}}
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Xin nhập số hợp đồng cần tra cứu tại đây" name="objId" id="modemNo">
                                <div class="input-group-append">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            <div class="row container-fluid d-flex justify-content-center">
                @if(!empty($data))
                    <table class="table">
                        <tr>
                            <th>IPAddress</th>
                            <th>Date</th>
                            <th>MacAddressOnline</th>
                            <th>Model</th>
                            <th>Status</th>
                            <th>ModelRealTime</th>
                        </tr>
                        @foreach($data->Data as $value)
                            <tr>
                                <td>{{$value->IPAddress ?? 'Null'}}</td>
                                <td>{{$value->Date ?? 'Null'}}</td>
                                <td>{{$value->MacAddressOnline ?? 'Null'}}</td>
                                <td>{{$value->Model ?? 'Null'}}</td>
                                <td>{{$value->Status ?? 'Null'}}</td>
                                <td>{{$value->ModelRealTime ?? 'Null'}}</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <table class="table">
                        <tr>
                            <th>IPAddress</th>
                            <th>Date</th>
                            <th>MacAddressOnline</th>
                            <th>Model</th>
                            <th>Status</th>
                            <th>ModelRealTime</th>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-center">Không có dữ liệu</td>
                        </tr>
                    </table>
                @endif
            </div>
            </div>
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
@endsection
