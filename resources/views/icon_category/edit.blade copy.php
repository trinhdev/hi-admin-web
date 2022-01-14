@extends('layouts.default')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="float: left; margin-right: 20px">{{$title}}</h1>
                    {{-- <a href="{{$info['controller']}}/{{$info['action_edit']}}" class="btn btn-primary btn-sm">--}}
                    {{-- <i class="fas fa-plus"></i> Add new {{$info['controller']}}--}}
                    {{-- </a>--}}
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Icon management</li>
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
                <div class="col-sm-8">
                    {!! Form::open(array('url' => route('roles.save'),'method'=>'post' ,'id' => 'form-view','action' =>'index','class'=>'form-horizontal','enctype' =>'multipart/form-data','onsubmit'=>"handleSubmit(event,this)")) !!}
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title uppercase">Infomation {{$controller}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- <div class="card-body" style="max-height: 600px; overflow-y: scroll"> --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group" style="text-align: center">
                                        <img src="/images/image_logo.png" alt="" width="200" class="mb-4">
                                        <!-- Upload image input-->
                                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-gray shadow-sm">
                                            <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0">
                                            <label id="upload-label" for="upload" style="color: white; font-weight: bold">Upload image</label>
                                            <div class="input-group-append">
                                                <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                            </div>
                                        </div>
                                        <p class="font-italic text-center">Thông tin, kích thước và định dạng ảnh</p>
                                        <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label text-right">Tên sản phẩm</label>
                                        <div class="col-sm-9">
                                            <input type="name" style="margin-bottom: 15px" class="form-control" id="vi-name" placeholder="Tên tiếng Việt" name="group_name" value="@if(!empty($data)){{$data->group_name}}@endif">
                                            <input type="name" class="form-control" id="en-name" placeholder="Tên tiếng Anh" name="group_name" value="@if(!empty($data)){{$data->group_name}}@endif">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label text-right">Mô tả sản phẩm</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="3" id="comment"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label text-right">Thông tin bổ sung</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="3" id="comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái hiển thị</label>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="icheck-sunflower">
                                            <input type="radio" id="status-show" name="status" value="hide" checked />
                                            <label for="status-show">Bật</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="icheck-sunflower">
                                            <input type="radio" id="status-hide" name="status" value="show" />
                                            <label for="status-hide">Tắt</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="icheck-sunflower">
                                                <input type="radio" id="status-clock" name="status" value="clock" />
                                                <label for="status-clock">Hẹn giờ bật hiển thị</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group row" style="padding-left: 10px">
                                            <label for="inputEmail3" class="col-sm-5 col-form-label text-right">Ngày bắt đầu</label>
                                            <div class="col-sm-7">
                                                <input type="datetime-local" name="show_from" class="form-control" id="show_from" placeholder="Date From" onchange="filterData()" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-5 col-form-label text-right">Ngày bắt đầu</label>
                                            <div class="col-sm-7">
                                                <input type="datetime-local" name="show_from" class="form-control" id="show_from" placeholder="Date From" onchange="filterData()" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2">Hiển thị icon "Mới"</label>
                                <div class="icheck-primary">
                                    <input type="checkbox" id="chb1" />
                                    <label for="chb1"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group row" style="padding-left: 10px">
                                        <label for="inputEmail3" class="col-sm-5 col-form-label text-right">Ngày bắt đầu</label>
                                        <div class="col-sm-7">
                                            <input type="datetime-local" name="show_from" class="form-control" id="show_from" placeholder="Date From" onchange="filterData()" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 col-form-label text-right">Ngày bắt đầu</label>
                                        <div class="col-sm-7">
                                            <input type="datetime-local" name="show_from" class="form-control" id="show_from" placeholder="Date From" onchange="filterData()" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2" for="action">Loại điều hướng</label>
                                <select name="action" id="action" class="form-control selectpicker col-sm-5" data-live-search="true" data-size="10">
                                    <option value="">Please choose action</option>
                                    <option value="1">Hide</option>
                                    <option value="0">Show</option>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label text-right">Link production</label>
                                    <div class="col-sm-7">
                                        <input type="textbox" name="show_from" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label text-right">Link staging</label>
                                    <div class="col-sm-7">
                                        <input type="textbox" name="show_from" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right" style="margin-left: 5px">Lưu</button>
                            <a href="/{{$controller}}" class="btn btn-default float-right">Đóng</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

<style>
    /*
    *
    * ==========================================
    * CUSTOM UTIL CLASSES
    * ==========================================
    *
    */
    #upload {
        opacity: 0;
    }

    #upload-label {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
    }

    .image-area {
        border: 2px dashed rgba(255, 255, 255, 0.7);
        padding: 1rem;
        position: relative;
    }

    .image-area::before {
        content: 'Uploaded image result';
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 0.8rem;
        z-index: 1;
    }

    .image-area img {
        z-index: 2;
        position: relative;
    }

    /*
    *
    * ==========================================
    * FOR DEMO PURPOSES
    * ==========================================
    *
    */
</style>
