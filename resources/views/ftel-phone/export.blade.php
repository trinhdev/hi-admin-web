@php
    $data = session()->get( 'data' );
@endphp
@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if(Auth::user()->role_id == ADMIN || $aclCurrentModule->create == 1)
                        <form action="{{ route('ftel_phone.export') }}" type="POST" novalidate="novalidate" autocomplete="off">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="data" value="{{ json_encode($data,TRUE)}}" />
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-download"></i> Export
                            </button>
                        </form>
                        @endif
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
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Phone</th>
                        <th>Mã số nhân viên</th>
                        <th>Email</th>
                        <th>Tên đầy đủ</th>
                        <th>Đơn vị</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($data)
                    @foreach($data as $data)
                    <tr>
                        <td>{{ $data['id'] }}</td>
                        <td>{{ $data['number_phone'] }}</td>
                        <td>{{ $data['code'] }}</td>
                        <td>{{ $data['emailAddress'] }}</td>
                        <td>{{ $data['fullName'] }}</td>    
                        <td>{{ $data['organizationCodePath'] }}</td>                        
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection