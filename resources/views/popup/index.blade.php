@extends('layouts.default')

@section('content')
        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px" class="uppercase">Quản Lý Popup Công Khai</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Quản lý Popup</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-body col-sm-12">
                    @include('popup._table')
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div id="show_detail_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Thông tin pop up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span></button>
                </div>
                <div class="modal-body" id="modal-detail-popup">
                    <form id="formAction" action="{{route('popupmanage.save')}}" method="POST"
                          onchange="checkEnableSavePopup(this)" onsubmit="validateDataPopup(event,this)">
                        @csrf
                        <input type="hidden" id="id_popup" name="id_popup" value="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="titleVi" class="required_red_dot">Tiêu đề tiếng việt</label>
                                        <input type="text" class="form-control" id="titleVi_popup" name="titleVi"
                                               placeholder="Tiêu đề tiếng việt" value="">
                                    </div>
                                    <div class="form-group" id="image">
                                        <label class="required_red_dot">Ảnh</label>
                                        <input type="file" accept="image/*" name="image" class="form-control"
                                               onchange="handleUploadImagePopup(this,event)"/>
                                        <img id="image_popup"
                                             src=""
                                             alt="your image" class="img-thumbnail img_viewable"
                                             style="max-width: 150px;padding:10px;margin-top:10px"/>
                                        <input name="image_popup_name" id="image_popup_name" value="" hidden/>
                                    </div>
                                    <div class="form-group">
                                        <label class="required_red_dot">Loại popup</label>
                                        <select class="form-control select2" name="templateType" id="templateType_popup"
                                                style="width: 100%;">
                                                <option value="">-- Chọn loại popup --</option>
                                                @foreach($list_type_popup as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="dieuhuong">
                                        <label>Điều hướng</label>
                                        <select class="form-control select2" name="directionId" id="directionId_popup"
                                                style="width: 100%;">
                                                <option value="">-- Chọn nơi điều hướng --</option>
                                            @if($list_route)
                                                @foreach($list_route as $key => $value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="titleEn" class="required_red_dot">Tiêu đề tiếng anh</label>
                                        <input type="input" class="form-control" id="titleEn_popup" name="titleEn"
                                               placeholder="Tiêu đề tiếng anh">
                                    </div>
                                    <div class="form-group" id="buttonImage">
                                        <label>Nút điều hướng</label>
                                        <input type="file" accept="image/*" name="buttonImage" class="form-control"
                                               onchange="handleUploadImagePopup(this,event)"/>
                                        <img id="buttonImage_popup"
                                             src=""
                                             alt="Hình ảnh" class="img-thumbnail img_viewable"
                                             style="max-width: 150px;padding:10px;margin-top:10px"/>
                                        <input name="buttonImage_popup_name" id="buttonImage_popup_name" hidden/>
                                    </div>

                                    <div class="form-group" style="display: none" id="form_directionUrl">
                                        <label for="exampleInputEmail1">URL điều hướng</label>
                                        <input type="input" class="form-control" id="buttonActionValue_popup" name="directionUrl"
                                               placeholder="URL điều hướng">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info" id="submit_data" >Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        showHide();
        actionAjaxPopup();
    </script>
@endpush


