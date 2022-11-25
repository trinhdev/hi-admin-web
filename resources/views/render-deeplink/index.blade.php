@extends('layouts.default')

@section('content')
    @php
        $data = session()->get('data');
    @endphp
        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px" class="uppercase"> Render Deeplink
                            </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Render Deeplink</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-sm-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title uppercase">Form File</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('renderDeeplink.post') }}" method="POST">
                                    @method('POST')
                                    @csrf
                                    <div class="form-group">
                                        <label for="id">ID</label>
                                        <input value="{{old('id')}}" type="text" id="id" name="id" class="form-control"
                                               placeholder="ID (định dạng số nguyên integer)" />
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input value="{{old('title')}}" type="text" id="title" name="title" class="form-control"
                                               placeholder="Title (Định dạng chuỗi string)" />
                                    </div>

                                    <div class="form-group">
                                        <label for="dataAction">Data Action</label>
                                        <input value="{{old('dataAction')}}" type="text" id="dataAction" name="dataAction" class="form-control"
                                               placeholder="dataAction (định dạng chuỗi string)" />
                                    </div>

                                    <div class="form-group">
                                        <label for="iconUrl">Icon Url</label>
                                        <input value="{{old('iconUrl')}}" type="text" id="iconUrl" name="iconUrl" class="form-control"
                                               placeholder="iconUrl (định dạng chuỗi string)" />
                                    </div>

                                    <div class="card-footer" style="text-align: center">
                                        <button name="action" value="back" type="submit" class="btn btn-info">Render
                                        </button>
                                        <a href="/render-deeplink" type="button" class="btn btn-default">Cancel</a>
                                    </div>
                                </form>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="mw-100">
                                            <b>Result</b>:
                                            @if(!empty($data))
                                                <a target="_blank" href="{!! $data !!}">{!! $data !!}</a>
                                            @endif
                                        </li>

                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
