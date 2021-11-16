@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px">Log Activities Tables</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
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
                    {{-- <table class="table table-bordered" id="logTable">
                        <tr>
                            <th>No</th>
                            <th>Subject</th>
                            <th>URL</th>
                            <th>Method</th>
                            <th>Ip</th>
                            <th width="300px">User Agent</th>
                            <th>User Id</th>
                            <th>Action</th>
                        </tr>
                        @if($logs->count())
                            @foreach($logs as $key => $log)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $log->subject }}</td>
                                <td class="text-success">{{ $log->url }}</td>
                                <td><label class="label label-info">{{ $log->method }}</label></td>
                                <td class="text-warning">{{ $log->ip }}</td>
                                <td class="text-danger">{{ $log->agent }}</td>
                                <td>{{ $log->user_id }}</td>
                                <td><button class="btn btn-danger btn-sm">Delete</button></td>
                            </tr>
                            @endforeach
                        @endif
                    </table> --}}
                    <table id="logTable" class="display" style="width:100%;word-wrap: break-word;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Method</th>
                            <th>URL</th>
                            <th>Param</th>
                            <th>Ip</th>
                            <th>User Agent</th>
                            <th>User Id</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection