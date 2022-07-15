@extends('layouts.default')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ (!empty($user)) ? 'CHỈNH SỬA' : 'TẠO MỚI' }} BANNER</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('bannermanage.index')}}">Banner</a></li>
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
                    <form action="{{ route('bannermanage.update', [$banner['event_id']]) }}" method="POST" onSubmit="validateData(event,this)">
                        @csrf
                        @method('PUT')
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title uppercase">Thông tin Banner</h3>
                            </div>
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title" class="required_red_dot">Tiêu đề tiếng Việt</label>
                                        <input type="text" name="title_vi" class="form-control" value="{{ $banner['title_vi'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="title" class="required_red_dot">Tiêu đề tiếng Anh</label>
                                        <input type="text" name="title_en" class="form-control" value="{{ $banner['title_en'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="bannerType" class="required_red_dot">Vị trí hiển thị</label>
                                        <select type="text" name="bannerType" class="form-control" onchange="onchangeTypeBanner(this)">
                                            @forelse($list_type_banner as $type)
                                                <option value="{{$type->id}}" {{$banner['event_type'] == $type->key ? 'selected' : 'disabled'}}>{{ $type->name }}</option>
                                            @empty
                                                <option>Error data</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group" id="path_1">
                                        <label class="required_red_dot">Ảnh</label>
                                        <input type="file" accept="image/*" name="path_1" class="form-control" onchange="handleUploadImage(this)" />
                                        <img id="img_path_1" src="{{ $banner['image'] ?? asset('/images/image_holder.png') }}" alt="your image" class="img-thumbnail img_viewable" style="max-width: 150px;padding:10px;margin-top:10px" />
                                        <input name="imageFileName" id="img_path_1_name" value="{{ substr($banner['image'],45) }}" hidden />
                                    </div>
                                    @if($banner['event_type']=='promotion')
                                        <div class="form-group" id="path_2">
                                            <input type="file" accept="image/*" name="path_2" class="form-control" onchange="handleUploadImage(this)" />
                                            <img id="img_path_2" src="{{ $banner['thumb_image'] ?? asset('/images/image_holder.png') }}" alt="your image" class="img-thumbnail img_viewable" style="max-width: 150px;padding:10px;margin-top:10px" />
                                            <span><i>&nbsp; &nbsp;&nbsp;(* đây là ảnh hiển thị ở Home)</i></span>
                                            <span class="warning-alert" id="path_2_required_alert" hidden>Dữ liệu này bắt buộc!</span>
                                            <input name="thumbImageFileName" id="img_path_2_name" value="{{ substr($banner['thumb_image'],45) }}" hidden />
                                        </div>
                                    @endif
                                    <div class="modal fade" id="img_view_modal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div id="image-viewer modal-body">
                                                    <img class="modal-content" id="full-image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="objectType" class="required_red_dot">Loại Đối tượng</label>
                                        <select type="text" name="objectType" class="form-control">
                                            <option value="topic" selected>Nhóm được đăng ký sẵn</option>
                                            <option value="location">Vùng miền</option>
                                            <option value="contract_phone">Số điện thoại</option>
                                            <option value="contract_no">Số hợp đồng</option>
                                            <option value="hifpt_id">ID của user HiFPT</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="objects" class="required_red_dot">Đối tượng</label>
                                        <select type="text" name="objects" class="form-control">
                                            <option value="all" selected>Tất cả KH cài Hi FPT (bao gồm guest)</option>
                                            <option value="all_hifpt">Tất cả KH có dùng dịch vụ (không bao gồm guest)</option>
                                            <option value="guest">Tất cả KH không dùng dịch vụ (guest)</option>
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="show_from" class="required_red_dot">Ngày hiển thị </label>
                                            <input type="datetime-local" name="show_from" max="{{ $banner['public_date_start'] }}" value="{{ $banner['public_date_start'] }}" class="form-control" onchange="changePublicDateTime(this)" />
                                        </div>
                                        <div class="col">
                                            <label for="show_to" class="required_red_dot"> Ngày kết thúc </label>
                                            <input type="datetime-local" name="show_to" min="{{ $banner['public_date_end'] }}" value="{{ $banner['public_date_end'] }}" class="form-control" onchange="changePublicDateTime(this)" />
                                        </div>
                                    </div>
                                    <div class="form-group" id="show_target_route">
                                        <div class="icheck-carrot">
                                            <input type="checkbox" id="has_target_route" name="has_target_route" onchange="onchangeDirection()" value="checked"
                                                {{$banner['direction_id'] || $banner['event_url'] ? 'checked' : ''}}/>
                                            {{-- {{ (!empty($banner) && $banner->direction_id) ? --}}
                                            <label for="has_target_route">Điều hướng</label>
                                        </div>
                                        <div class="border box-target" style="display: {{ $banner['direction_id'] || $banner['event_url'] ? 'block': 'none'}}" id="box_target">
                                            <label for="target_route">Điều hướng đến</label>
                                            <div id="collapseOne" style="transition: height 0.01s;">
                                                {{-- <label for="target_route">Target Id</label> --}}
                                                <select type="file" name="direction_id" class="form-control p" id="target_route" onchange="onchangeTargetRoute()" data-live-search="true" data-size="10">
                                                    @forelse($list_target_route as $target)
                                                    <option value="{{$target->id}}" {{$banner['direction_id'] == $target->id ? 'selected' : ''}}>{{ $target->name }}</option>
                                                    @empty
                                                        <option>Error data</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="form-group" id="direction_url">
                                                <label for="direction_url">URL</label>
                                                <input type="text" id="direction_url" name="directionUrl" class="form-control" value="{{ $banner['direction_url'] ?? ''}}">
                                                <span class="warning-alert" id="direction_url_required_alert" hidden>Dữ liệu này bắt buộc!</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="isShowHomeGroup" class="form-group" style="display: {{ $banner['event_type'] == 'promotion' ? 'block' : 'none' }}">
                                        <div class="icheck-carrot">
                                            <input type="checkbox" id="isShowHome" name="isShowHome" {{$banner['is_show_home'] == 1 ? 'checked' : ''}} />
                                            <label for="isShowHome">Hiện ở Home</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="text-align: center">
                                <a href="{{ route('bannermanage.index') }}" type="button" class="btn btn-default">Thoát</a>
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
    <script src="{{ asset('/custom_js/bannermanage.js')}}"></script>
@endpush
