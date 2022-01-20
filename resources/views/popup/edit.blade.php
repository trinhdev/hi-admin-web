@extends('layouts.default')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ !empty($user) ? 'EDIT' : 'ADD NEW' }} POPUP</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('popupmanage.index') }}">Popup</a></li>
                            <li class="breadcrumb-item active">{{ !empty($user) ? 'edit' : 'create' }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title uppercase">Thông tin Popup</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="titleVi">Tiêu đề tiếng việt</label>
                                    <input type="text" class="form-control" id="titleVi" name="titleVi"
                                           placeholder="Tiêu đề tiếng việt">
                                </div>
                                <div class="form-group">
                                    <label>Loại popup</label>
                                    <select class="form-control select2" name="templateType" id="listTypePopup"
                                            style="width: 100%;">
                                        @foreach($listTypePopup as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="path_1">
                                    <label class="required_red_dot">Ảnh</label>
                                    <input type="file" accept="image/*" name="path_1" class="form-control"
                                           onchange="handleUploadImagePopup(this,event)"/>
                                    <img id="img_path_1"
                                         src="{{ asset('/images/image_holder.png') }}"
                                         alt="your image" class="img-thumbnail img_viewable"
                                         style="max-width: 150px;padding:10px;margin-top:10px"/>
                                    <input name="img_path_1_name" id="img_path_1_name" value="" hidden/>
                                </div>
                                <div class="form-group" id="dieuhuong">
                                    <label>Điều hướng</label>
                                    <select class="form-control select2" name="directionId" id="directionId"
                                            style="width: 100%;">
                                        <option value="">------------</option>
                                        @foreach($listTargetRoute as $key => $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="titleEn">Tiêu đề tiếng anh</label>
                                    <input type="input" class="form-control" id="titleEn" name="titleEn"
                                           placeholder="Tiêu đề tiếng anh">
                                </div>
                                <div class="form-group">
                                    <label>Thời gian hiển thị:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="reservationtime">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group" id="path_2">
                                    <label class="required_red_dot">Nút điều hướng</label>
                                    <input type="file" accept="image/*" name="path_2" class="form-control"
                                           onchange="handleUploadImagePopup(this,event)"/>
                                    <img id="img_path_2"
                                         src="{{ asset('/images/image_holder.png') }}"
                                         alt="your image" class="img-thumbnail img_viewable"
                                         style="max-width: 150px;padding:10px;margin-top:10px"/>
                                    <span class="warning-alert" id="path_2_required_alert" hidden>This field is
                                                required!</span>
                                    <input name="img_path_2_name" id="img_path_2_name" value="" hidden/>
                                </div>

                                <div class="form-group" style="display: none" id="form_directionUrl">
                                    <label for="exampleInputEmail1">URL điều hướng</label>
                                    <input type="input" class="form-control" id="directionUrl" name="directionUrl"
                                           placeholder="URL điều hướng">
                                </div>

                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{ route('popupmanage.index') }}" type="button"
                           class="btn btn-default">Hủy</a>
                        <button type="submit" class="btn btn-info" id="submit_data" disabled>Lưu</button>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@push('scripts')
    <script src="{{ asset('/custom_js/popupmanage.js')}}"></script>
@endpush
