@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px" class="uppercase">Quản Lý Popup</h1>
                        {{--                        @if(Auth::user()->role_id == ADMIN || $aclCurrentModule->create == 1)--}}
                        {{--                            <a href="{{ route('popupmanage.create') }}" class="btn btn-primary btn-sm">--}}
                        {{--                                <i class="fas fa-plus"></i> Thêm Mới--}}
                        {{--                            </a>--}}
                        {{--                        @endif--}}
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
    <div id="show_detail_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Thông tin pop up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span></button>
                </div>
                <div class="modal-body" id="modal-detail-popup">
                    <form id="formAction" action="{{route('popupmanage.save')}}" method="POST"
                          onchange="checkEnableSavePopup(this)" onSubmit="validateDataPopup(event,this)">
                        @csrf
                        <input type="hidden" name="id_popup">
                        <div class="card-body" style="margin: 0;padding: 0">
                            <div class="row">
                                <div class="col-md-12 text-sm">
                                    <div class="form-group d-flex">
                                        <div class="col-md-3">
                                            <label for="titleVi_popup">Tiêu đề tiếng
                                                việt</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="titleVi_popup"
                                                   name="titleVi"
                                                   placeholder="Tiêu đề tiếng việt (Nếu có)" value="">
                                        </div>

                                    </div>

                                    <div class="form-group d-flex">
                                        <div class="col-md-3">
                                            <label for="titleEn_popup">Tiêu đề tiếng
                                                anh</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="input" class="form-control" id="titleEn_popup"
                                                   name="titleEn"
                                                   placeholder="Tiêu đề tiếng anh (Nếu có)">
                                        </div>
                                    </div>

                                    <div class="form-group d-flex">
                                        <div class="col-md-3">
                                            <label for="desEn_popup">Mô tả tiếng
                                                việt</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="input" class="form-control" id="desEn_popup"
                                                   name="desVi"
                                                   placeholder="Mô tả tiếng việt (Nếu có)">
                                        </div>
                                    </div>

                                    <div class="form-group d-flex">
                                        <div class="col-md-3">
                                            <label for="desEn_popup">Mô tả tiếng
                                                anh</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="input" class="form-control" id="desEn_popup"
                                                   name="desEn"
                                                   placeholder="Mô tả tiếng anh (Nếu có)">
                                        </div>
                                    </div>

                                    <div class="form-group d-flex">
                                        <div class="col-md-3">
                                            <label class="required_red_dot">Loại popup</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="form-control select2" name="type"
                                                    id="templateType_popup"
                                                    style="width: 100%;">
                                                <option value="">-- Chọn loại popup --</option>
                                                @foreach($list_type_popup as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group d-flex" id="dieuhuong">
                                        <div class="col-md-3">
                                            <label>Điều hướng</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="form-control select2" name="dataAction"
                                                    id="directionId_popup"
                                                    style="width: 100%;">
                                                <option value="" selected>-- Chọn nơi điều hướng --</option>
                                                @if($list_route)
                                                    @foreach($list_route as $key => $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group d-flex" id="image">
                                        <div class="col-md-3">
                                            <label class="required_red_dot">Ảnh</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="file" accept="image/*" name="image" class="form-control"
                                                   onchange="handleUploadImagePopup(this,event)"/>
                                            <img id="image_popup" src=""
                                                 alt="Ảnh Popup" class="img-thumbnail img_viewable"
                                                 style="max-width: 150px;padding:10px;margin-top:10px"/>
                                            <input name="iconUrl" id="image_popup_name" value="" hidden/>
                                        </div>

                                    </div>

                                    <div class="form-group d-flex" id="buttonImage">
                                        <div class="col-md-3">
                                            <label>Nút điều hướng</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="file" accept="image/*" name="buttonImage" class="form-control"
                                                   onchange="handleUploadImagePopup(this,event)"/>
                                            <img id="buttonImage_popup"
                                                 src="/images/image_holder.png"
                                                 alt="Ảnh button" class="img-thumbnail img_viewable"
                                                 style="max-width: 150px;padding:10px;margin-top:10px"/>
                                            <span class="warning-alert" id="path_2_required_alert" hidden>This field is
                                                    required!</span>
                                            <input name="iconButtonUrl" id="buttonImage_popup_name" hidden/>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex" id="form_directionUrl">
                                        <div class="col-md-3">
                                            <label for="buttonActionValue_popup">URL điều hướng</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="input" class="form-control" id="buttonActionValue_popup"
                                                   name="dataAction"
                                                   placeholder="URL điều hướng">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right" id="submit_data" disabled>Lưu</button>
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
        methodAjaxPopupPrivate();
    </script>
@endpush


