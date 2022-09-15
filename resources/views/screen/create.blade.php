@extends('layouts.default')

@section('content')
    @php
        $data = session()->get( 'data' );
    @endphp
        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Thêm mới màn hình</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Screen</li>
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
                                <form action="{{ route('screen.store') }}" method="POST">
                                    @method('POST')
                                @csrf
                                    <div class="form-group">
                                        <label for="screenId">ID màn hình</label>
                                        <input type="text" id="screenId" name="screenId" class="form-control"
                                                  placeholder="Id của màn hình" />
                                    </div>

                                    <div class="form-group">
                                        <label for="screenName">Tên màn hình</label>
                                        <input type="text" id="screenName" name="screenName" class="form-control"
                                               placeholder="Tên màn hình" />
                                    </div>

                                    <div class="form-group">
                                        <label for="typeLog">Loại Log</label>
                                        <input type="text" id="typeLog" name="typeLog" class="form-control"
                                               placeholder="Loại Log" />
                                    </div>

                                    <div class="form-group">
                                        <label for="api_url">URL</label>
                                        <input type="text" id="api_url" name="api_url" class="form-control"
                                               placeholder="URL" />
                                    </div>

{{--                                    <div class="form-group">--}}
{{--                                        <label for="image">Hình ảnh</label>--}}
{{--                                        <input type="file" id="image" name="image" class="form-control"--}}
{{--                                             placeholder="Hình ảnh" />--}}
{{--                                    </div>--}}

                                    <div class="form-group">
                                        <label for="example_code">Code mẫu</label>
                                        <textarea type="text" id="example_code" name="example_code" class="form-control"
                                               placeholder="Code mẫu"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input id="status" name="status" class="form-check-input" type="checkbox" checked>
                                            <label>Status</label>
                                        </div>
                                    </div>

                                    <div class="card-footer" style="text-align: center">
                                        <button name="action" value="back" type="submit" class="btn btn-info">Lưu
                                        </button>
                                        <button name="action" value="stay" type="submit" class="btn btn-info">Lưu và chỉnh sửa
                                        </button>
                                        <a href="/screen" type="button" class="btn btn-default">Cancel</a>
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
