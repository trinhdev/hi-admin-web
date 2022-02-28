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
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Log Activities</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid ">
            @if(Auth::user()->role_id == ADMIN)
            <form action="{{route('logactivities.clearLog')}}" method="POST" onsubmit="var formData = new FormData(this);if(formData.get('clear_log_option') == '')return false;">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <select class="form-control" name ="clear_log_option">
                            <option value="" selected>None</option>
                            @foreach(config('constants.ClEAR_LOG_OPTIONS') as $option)
                                <option value={{$option}}>
                                @if($option == 0)
                                Clear all
                                @else
                                Clear {{$option}} days before
                                @endif
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-warning">Clear Log</button>
                    </div>
                </div>
            </form>
            @endif
            <div class="card card-body col-sm-12">
                <table id="logTable" class="display" style="width:100%;word-wrap:no-wrap;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID</th>
                            <th>User Id</th>
                            <th>User Name</th>
                            <th>User role</th>
                            <th>Method</th>
                            <th>URL</th>
                            <th>Time</th>
                            <th>Param</th>
                            <th>Ip</th>
                            <th>User Agent</th>
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
