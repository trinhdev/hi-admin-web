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
                <div class="row justify-content-md-center">
                    <div class="col-sm-6">
                        @php
                            $action = empty($popup) ? route('popupmanage.store') : route('popupmanage.update', [$popup->popupId, $popup->popupType]);
                            $isPopupHome = false;
                            $isPopupPromotion = false;
                            if (!empty($popup) && $popup->popupType == 'promotion') {
                                $isPopupPromotion = true;
                            }
                        @endphp
                        <form action="{{ $action }}" method="POST" onSubmit="validateData(event,this)"
                            onchange="checkEnableSave(this)">
                            @csrf
                            @if (!empty($popup))
                                @method('PUT')
                            @endif
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title uppercase">Thông tin Popup</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title" class="required_red_dot">Tiêu đề tiếng Việt</label>
                                            <input type="text" name="title_vi" class="form-control"
                                                value="{{ !empty($popup) ? $popup->title_vi : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="required_red_dot">Tiêu đề tiếng Anh</label>
                                            <input type="text" name="title_en" class="form-control"
                                                value="{{ !empty($popup) ? $popup->title_en : '' }}">
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="title" class="required_red_dot">Mô tả tiếng Việt</label>
                                            <input type="text" name="descriptionVi" class="form-control"
                                                value="{{ !empty($popup) ? $popup->descriptionVi : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="required_red_dot">Mô tả tiếng Anh</label>
                                            <input type="text" name="descriptionEn" class="form-control"
                                                value="{{ !empty($popup) ? $popup->descriptionEn : '' }}">
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="templateType" class="required_red_dot">Loại Popup</label>
                                            <select type="text" name="templateType" class="form-control"
                                                onchange="templateTypeChanged(this)">
                                                <option value="popup_custom_image_transparent" selected>Loại popup mặc định
                                                    khuyến nghị dùng</option>
                                                <option value="popup_full_screen">Popup full màn hình, có nút "Xem chi tiết"
                                                </option>
                                                <option value="popup_image_full_screen">Một bức ảnh hiển thị tràng full màn
                                                    hình, không có nút “Xem chi tiết”</option>
                                                <option value="popup_image_transparent">Chỉ gồm 1 bức ảnh, nền trong suốt,
                                                    không có nút “Xem chi tiết”</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="path_1">
                                            <label class="required_red_dot">Ảnh</label>
                                            <input type="file" accept="image/*" name="path_1" class="form-control"
                                                onchange="handleUploadImage(this,event)" />
                                            <img id="img_path_1"
                                                src="{{ !empty($popup) ? $popup->image : asset('/images/image_holder.png') }}"
                                                alt="your image" class="img-thumbnail img_viewable"
                                                style="max-width: 150px;padding:10px;margin-top:10px" />
                                            <input name="img_path_1_name" id="img_path_1_name" value="" hidden />
                                        </div>
                                        <div class="form-group" id="path_2" {{ $isPopupPromotion ? '' : 'hidden' }}>
                                            <input type="file" accept="image/*" name="path_2" class="form-control"
                                                onchange="handleUploadImage(this,event)" />
                                            <img id="img_path_2"
                                                src="{{ $isPopupPromotion ? $popup->thumb_image : asset('/images/image_holder.png') }}"
                                                alt="your image" class="img-thumbnail img_viewable"
                                                style="max-width: 150px;padding:10px;margin-top:10px" />
                                            <span class="warning-alert" id="path_2_required_alert" hidden>This field is
                                                required!</span>
                                            <input name="img_path_2_name" id="img_path_2_name" value="" hidden />
                                        </div>
                                        <div class="modal fade" id="img_view_modal" tabindex="-1" role="dialog"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div id="image-viewer modal-body">
                                                        <img class="modal-content" id="full-image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="path_button">
                                            <label class="">Nút điều hướng</label>
                                            <input type="file" accept="image/*" name="path_button" class="form-control"
                                                onchange="handleUploadImage(this,event)" />
                                            <img id="img_path_button"
                                                src="{{ !empty($popup) ? $popup->image : asset('/images/image_holder.png') }}"
                                                alt="your image" class="img-thumbnail img_viewable"
                                                style="max-width: 150px;padding:10px;margin-top:10px" />
                                            <input name="img_path_button_name" id="img_path_button_name" value="" hidden />
                                        </div>
                                        <div class="form-group" id="path_button2" {{ $isPopupPromotion ? '' : 'hidden' }}>
                                            <input type="file" accept="image/*" name="path_2" class="form-control"
                                                onchange="handleUploadImage(this,event)" />
                                            <img id="img_path_button_2"
                                                src="{{ $isPopupPromotion ? $popup->thumb_image : asset('/images/image_holder.png') }}"
                                                alt="your image" class="img-thumbnail img_viewable"
                                                style="max-width: 150px;padding:10px;margin-top:10px" />
                                            <span class="warning-alert" id="path_button_2_required_alert" hidden>This field is
                                                required!</span>
                                            <input name="img_path_button_2_name" id="img_path_button_2_name" value="" hidden />
                                        </div>
                                        <div class="modal fade" id="img_view_modal" tabindex="-1" role="dialog"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div id="image-viewer modal-body">
                                                        <img class="modal-content" id="full-image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="form-group">
                                            <label for="popupType" class="required_red_dot">Vị trí hiển thị</label>
                                            <select type="text" name="{{ !empty($popup) ? '' : 'popupType' }}"
                                                class="form-control" onchange="onchangeTypePopup(this)"
                                                {{ !empty($popup) ? 'disabled' : '' }}>
                                                @if (!empty($list_type_popup))
                                                    @foreach ($list_type_popup as $type)
                                                        <option value='{{ $type->id }}'
                                                            {{ !empty($popup) && $popup->popupType == $type->id ? 'selected' : '' }}>
                                                            {{ $type->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if (!empty($popup))
                                                <input name="popupType"
                                                    value="{{ !empty($popup) ? $popup->popupType : '' }}" hidden />
                                            @endif
                                        </div> --}}
                                        {{-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                                       
                                        
                                        <div class="form-row">
                                            <div class="col">
                                                <label for="show_from" class="required_red_dot">Ngày hiển thị </label>
                                                <input type="datetime-local" name="show_from"
                                                    max="{{ !empty($popup) && !empty($popup->public_date_end) ? $popup->public_date_end : '' }}"
                                                    value="{{ !empty($popup) ? $popup->public_date_start : '' }}"
                                                    class="form-control" onchange="changePublicDateTime(this)" />
                                            </div>
                                            <div class="col">
                                                <label for="show_to" class="required_red_dot"> Ngày kết thúc </label>
                                                <input type="datetime-local" name="show_to"
                                                    min="{{ !empty($popup) && !empty($popup->public_date_start) ? $popup->public_date_start : '' }}"
                                                    value="{{ !empty($popup) ? $popup->public_date_end : '' }}"
                                                    class="form-control" onchange="changePublicDateTime(this)" />
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-footer" style="text-align: center">
                                    <a href="{{ route('popupmanage.index') }}" type="button"
                                        class="btn btn-default">Cancel</a>
                                    <button type="submit" class="btn btn-info" disabled>Save</button>
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
