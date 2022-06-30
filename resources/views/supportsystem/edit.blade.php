@extends('layouts.default')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ (!empty($user)) ? 'CHỈNH SỬA' : 'TẠO MỚI' }} HỖ TRỢ HỆ THỐNG</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('supportsystem.index')}}">Hỗ trợ hệ thống</a></li>
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
                        $action = (empty($data)) ? route('supportsystem.store') : route('supportsystem.update', [$data->id]);
                    @endphp
                    {{-- <form action="{{$action}}" method="POST" onSubmit="validateDataLogReport(event,this)" onchange="checkEnableSaveLogReport(this)" onkeydown="checkEnableSaveLogReport(this)"> --}}
                        <form action="{{$action}}" method="POST" onSubmit="validateDataLogReport(event,this)">
                        @csrf
                        @if(!empty($data))
                            @method('PUT')
                        @endif
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title uppercase">Thông tin Hỗ trợ hệ thống</h3>
                            </div>
                            <div class="card-body" style="overflow-y: scroll">
                                <div class="form-group">
                                    <label for="description" class="required_red_dot">Mô tả</label>
                                    <textarea name="description" id="description" class="form-control">
                                        {{ @$data->description }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="asked_by" class="required_red_dot">Hỏi bởi</label>
                                    <input type="text" name="asked_by" class="form-control" value="{{ !empty($data)?$data->asked_by : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="asked_at">Hỏi lúc</label>
                                    <input type="datetime-local" name="asked_at" class="form-control" id="asked_at" placeholder="Hỏi lúc" value="{{ !empty($data)?$data->asked_at : '' }}" />
                                </div>
                                <div class="form-group">
                                    <label for="group">Kênh tiếp nhận</label>
                                    {{-- <input type="text" class="form-control" name="group" value="{{ @$data->group }}" /> --}}
                                    <select id="group" name="group" class="form-control">
                                        @foreach ($support_system_group as $group)
                                            <option value="{{ $group }}" {{ @$data->group == $group ? 'selected' : '' }}>{{ $group }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select id="status" name="status" class="form-control">
                                        @foreach ($support_code_status as $status)
                                            <option value="{{ $status }}" {{ @$data->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="way_to_solve">Phương thức giải quyết</label>
                                    <textarea class="form-control" name="way_to_solve">{{ @$data->way_to_solve }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="solved_by">Người sửa lỗi</label>
                                    <textarea class="form-control" name="solved_by">{{ @$data->solved_by }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="solved_at" class="required_red_dot">Sửa lúc lúc</label>
                                    <input type="datetime-local" name="solved_at" class="form-control" id="solved_at" placeholder="Hỏi lúc" value="{{ !empty($data)?$data->solved_at : '' }}" />
                                </div>
                                <div class="form-group">
                                    <label for="error_type">Phân loại lỗi</label>
                                    <select id="error_type" name="error_type" class="form-control">
                                        @foreach ($support_system_error_type as $error_type)
                                            <option value="{{ $error_type }}" {{ @$data->error_type == $error_type ? 'selected' : '' }}>{{ $error_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="caused">Nguyên nhân lỗi</label>
                                    <textarea class="form-control" name="caused">{{ @$data->caused }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="note">Ghi chú</label>
                                    <textarea class="form-control" name="note">{{ @$data->note }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer" style="text-align: center">
                                <a href="{{ route('supportsystem.index') }}" type="button" class="btn btn-default">Thoát</a>
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
    <script src="{{ asset('/custom_js/supportsystem.js')}}" type="text/javascript" charset="utf-8"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
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
