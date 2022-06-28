@extends('layouts.default')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ (!empty($user)) ? 'CHỈNH SỬA' : 'TẠO MỚI' }} HELPER</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('helper.index')}}">Helper</a></li>
                        <li class="breadcrumb-item active">{{ (!empty($user)) ? 'chỉnh sửa' : 'Tạo mới' }}</li>
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
                <div class="col-sm-6">
                    @php
                        $action = (empty($data)) ? route('helper.store') : route('helper.update', [$data->id]);
                    @endphp
                    {{-- <form action="{{$action}}" method="POST" onSubmit="validateDataLogReport(event,this)" onchange="checkEnableSaveLogReport(this)" onkeydown="checkEnableSaveLogReport(this)"> --}}
                        <form action="{{$action}}" method="POST" onSubmit="validateDataLogReport(event,this)">
                        @csrf
                        @if(!empty($data))
                            @method('PUT')
                        @endif
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title uppercase">Thông tin Helper</h3>
                            </div>
                            <div class="card-body" style="overflow-y: scroll">
                                <div class="form-group">
                                    <label for="name" class="required_red_dot">Tên</label>
                                    <input type="text" name="name" class="form-control" value="{{ !empty($data)?$data->name : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="description" class="required_red_dot">Mô tả report</label>
                                    <textarea class="form-control" name="description">{{ @$data->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="solve_way" class="required_red_dot">Phương thức giải quyết</label>
                                    <textarea name="solve_way" id="solve_way" class="form-control">
                                        {{ @$data->solve_way }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="solve_time_avg">Thời gian xử lý trung bình</label>
                                    <input type="number" name="solve_time_avg" />
                                </div>
                                <div class="form-group">
                                    <label for="from">Kênh tiếp nhận</label>
                                    <input type="text" name="from" class="form-control" value="{{ @$data->from }}">
                                </div>
                                <div class="form-group">
                                    <label for="error_type">Loại lỗi</label>
                                    <input type="text" name="error_type" class="form-control" value="{{ @$data->error_type }}">
                                </div>
                                <div class="form-group">
                                    <label for="reason">Nguyên nhân lỗi</label>
                                    <textarea class="form-control" name="reason">{{ @$data->reason }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer" style="text-align: center">
                                <a href="{{ route('helper.index') }}" type="button" class="btn btn-default">Thoát</a>
                                <button type="submit" class="btn btn-info">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@push('scripts')
    {{-- <script type="text/javascript" src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/ckeditor/js/ckeditor.js" charset="utf-8"></script> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
    <script src="{{ asset('/custom_js/helper.js')}}" type="text/javascript" charset="utf-8"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#solve_way' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush

<style>
    @import url("https://fonts.googleapis.com/css?family=Montserrat|Roboto+Mono");
    body {
        justify-content: center;
        align-items: center;
        position: absolute;
        height: 100%;
        width: 100%;
        margin: 0;
    }
    @media screen and (max-height: 375px) {
        body {
            position: relative;
            overflow: auto;
        }
    }

    .card {
        width: 100%;
    }
    @media screen and (max-width: 1200px) {
        .card {
            width: 100%;
        }
    }

    #editorWrapper {
        position: relative;
        height: 100%;
        min-height: 45vh;
    }
    @media (min-height: 600px) {
        #editorWrapper {
            height: 55vh;
        }
    }
    @media (min-height: 900px) {
        #editorWrapper {
            height: 65vh;
        }
    }
    #editorWrapper #editor {
        font-family: "Courier Mono", monospace;
        font-size: 14px;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }
</style>
