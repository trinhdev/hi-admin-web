@extends('layouts.default')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ (!empty($user)) ? 'CHỈNH SỬA' : 'TẠO MỚI' }} EMPLOYEES</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Employees</a></li>
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
                        $action = (empty($data)) ? route('employees.store') : route('employees.update', [$data->id]);
                    @endphp
                    {{-- <form action="{{$action}}" method="POST" onSubmit="validateDataLogReport(event,this)" onchange="checkEnableSaveLogReport(this)" onkeydown="checkEnableSaveLogReport(this)"> --}}
                        <form action="{{$action}}" method="POST" onSubmit="validateDataLogReport(event,this)">
                        @csrf
                        @if(!empty($data))
                            @method('PUT')
                        @endif
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title uppercase">Thông tin Employees</h3>
                            </div>
                            <div class="card-body" style="overflow-y: scroll">
                                <div class="form-group">
                                    <label for="name">Mobisale ACC</label>
                                    <input type="text" name="name" class="form-control" value="{{ !empty($data)?$data->name : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Full name</label>
                                    <input type="text" name="full_name" class="form-control" value="{{ !empty($data)?$data->full_name : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ !empty($data)?$data->phone : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="text" name="emailAddress" class="form-control" value="{{ !empty($data)?$data->emailAddress : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Location id</label>
                                    <input type="number" name="location_id" class="form-control" value="{{ !empty($data)?$data->location_id : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Branch code</label>
                                    <input type="number" name="branch_code" class="form-control" value="{{ !empty($data)?$data->branch_code : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description">{{ @$data->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Code</label>
                                    <input type="text" name="code" class="form-control" value="{{ !empty($data)?$data->code : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Organization code</label>
                                    <input type="text" name="organizationCode" class="form-control" value="{{ !empty($data)?$data->organizationCode : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Organization code path</label>
                                    <input type="text" name="organizationCodePath" class="form-control" value="{{ !empty($data)?$data->organizationCodePath : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Location</label>
                                    <input type="text" name="location" class="form-control" value="{{ !empty($data)?$data->location : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Is active</label>
                                    <input type="number" name="isActive" class="form-control" value="{{ !empty($data)?$data->isActive : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Employee code</label>
                                    <input type="text" name="employee_code" class="form-control" value="{{ !empty($data)?$data->employee_code : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Organization name path</label>
                                    <input type="text" name="organizationNamePath" class="form-control" value="{{ !empty($data)?$data->organizationNamePath : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Dept id</label>
                                    <input type="number" name="dept_id" class="form-control" value="{{ !empty($data)?$data->dept_id : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Dept name 1</label>
                                    <input type="text" name="dept_name_1" class="form-control" value="{{ !empty($data)?$data->dept_name_1 : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Dept name 2</label>
                                    <input type="text" name="dept_name_2" class="form-control" value="{{ !empty($data)?$data->dept_name_2 : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Updated from</label>
                                    <textarea type="text" name="updated_from" class="form-control">{{ !empty($data)?$data->updated_from : ''}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Branch name</label>
                                    <input type="text" name="branch_name" class="form-control" value="{{ !empty($data)?$data->branch_name : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Organization zone name</label>
                                    <input type="text" name="organization_zone_name" class="form-control" value="{{ !empty($data)?$data->organization_zone_name : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Organization branch code</label>
                                    <input type="text" name="organization_branch_code" class="form-control" value="{{ !empty($data)?$data->organization_branch_code : ''}}">
                                </div>
                            <div class="card-footer" style="text-align: center">
                                <a href="{{ route('employees.index') }}" type="button" class="btn btn-default">Thoát</a>
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
    <script src="{{ asset('/custom_js/employees.js')}}" type="text/javascript" charset="utf-8"></script>
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
