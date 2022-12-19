@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Chỉnh sửa deeplink {{ $data->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Deeplink</li>
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
                                <h3 class="card-title uppercase">Form thêm mới màn hình</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('deeplink.update', [$data->id]) }}" method="POST">
                                @csrf
                                    <div class="form-group">
                                        <label for="id">ID màn hình</label>
                                        <input type="text" id="id" value="{{ $data->id }}" name="id" class="form-control"
                                                  placeholder="Id của màn hình" readonly/>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Tên deeplink</label>
                                        <input type="text" id="name" value="{{ $data->name }}" name="name" class="form-control"
                                               placeholder="Tên deeplink" />
                                    </div>

                                    <div class="form-group">
                                        <label for="direction">Điều hướng</label>
                                        <input type="text" id="direction" value="{{ $data->direction }}" name="direction" class="form-control"
                                               placeholder="Điều hướng" />
                                    </div>

                                    <div class="form-group">
                                        <label for="url">URL</label>
                                        <input type="text" id="url" value="{{ $data->url }}" name="url" class="form-control"
                                               placeholder="URL" />
                                    </div>

                                    <div class="card-footer" style="text-align: center">
                                        <button name="action" value="back" type="submit" class="btn btn-info">Lưu
                                        </button>
                                        <button name="action" value="stay" type="submit" class="btn btn-info">Lưu và chỉnh sửa
                                        </button>
                                        <a href="/deeplink" type="button" class="btn btn-default">Cancel</a>
                                    </div>
                                </form>
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
