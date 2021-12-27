@extends('layouts.default')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ (!empty($user)) ? 'EDIT' : 'ADD NEW' }} BANNER</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('bannermanage.index')}}">Banner</a></li>
                        <li class="breadcrumb-item active">{{ (!empty($user)) ? 'edit' : 'create' }}</li>
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
                    $action = (empty($banner)) ? route('bannermanage.store') : route('bannermanage.update', [$banner->bannerId, $banner->bannerType]);
                    $isBannerHome = false;
                    $isBannerPromotion = false;
                    if(!empty($banner) && $banner->bannerType == 'promotion'){
                        $isBannerPromotion = true;
                    }
                    @endphp
                    <form action="{{$action}}" method="POST" onSubmit="validateData(event,this)" onchange="checkEnableSave(this)">
                        @csrf
                        @if(!empty($banner))
                        @method('PUT')
                        @endif
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Banner Info</h3>
                            </div>
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title" class="required_red_dot">Title VI</label>
                                        <input type="text" name="title_vi" class="form-control" value="{{ !empty($banner)?$banner->title_vi : ''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="title" class="required_red_dot">Title EN</label>
                                        <input type="text" name="title_en" class="form-control" value="{{ !empty($banner)?$banner->title_en : ''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="bannerType" class="required_red_dot">Show At</label>
                                        <select type="text" name="bannerType" class="form-control" onchange="onchangeTypeBanner(this)" hi>
                                            @if(!empty($list_type_banner))
                                            @foreach($list_type_banner as $type)
                                            <option value='{{$type->id}}' {{ ( !empty($banner) && $banner->bannerType == $type->id) ? 'selected' : ''}}>{{$type->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group" id="path_1">
                                        <label class="required_red_dot">File</label>
                                        <input type="file" accept="image/*" name="path_1" class="form-control" onchange="handleUploadImage(this,event)" />
                                        <img id="img_path_1" src="{{ (!empty($banner)) ? $banner->image :asset('/images/image_holder.png') }}" alt="your image" class="img-thumbnail img_viewable" style="max-width: 150px;padding:10px;margin-top:10px" />
                                        <input name="img_path_1_name" id="img_path_1_name" value="" hidden/>
                                    </div>
                                    <div class="form-group" id="path_2" {{ ($isBannerPromotion) ? '':'hidden' }}>
                                        <input type="file" accept="image/*" name="path_2" class="form-control" onchange="handleUploadImage(this,event)" />
                                        <img id="img_path_2" src="{{ ($isBannerPromotion) ? $banner->thumb_image :asset('/images/image_holder.png') }}" alt="your image" class="img-thumbnail img_viewable" style="max-width: 150px;padding:10px;margin-top:10px" />
                                        <span class="warning-alert" id="path_2_required_alert" hidden>This field is required!</span>
                                         <input name="img_path_2_name" id="img_path_2_name" value="" hidden/>
                                    </div>
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
                                        <label for="object_type" class="required_red_dot">Object Type</label>
                                        <select type="text" name="object_type" class="form-control">
                                            <option value="topic" selected>Nhóm được đăng ký sẵn</option>
                                            <option value="location">Vùng miền</option>
                                            <option value="contract_phone">Số điện thoại</option>
                                            <option value="contract_no">Số hợp đồng</option>
                                            <option value="hifpt_id">ID của user HiFPT</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="object" class="required_red_dot">Object</label>
                                        <select type="text" name="object" class="form-control">
                                            <option value="all" selected>Tất cả KH cài Hi FPT (bao gồm guest)</option>
                                            <option value="all_hifpt">Tất cả KH có dùng dịch vụ (không bao gồm guest)</option>
                                            <option value="guest">Tất cả KH không dùng dịch vụ (guest)</option>
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="show_from" class="required_red_dot">Show From </label>
                                            <input type="datetime-local" name="show_from" value="{{ !empty($banner)?$banner->public_date_start:''}}" class="form-control" />
                                        </div>
                                        <div class="col">
                                            <label for="show_to" class="required_red_dot"> Show To </label>
                                            <input type="datetime-local" name="show_to" value="{{ !empty($banner)?$banner->public_date_end:''}}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group" id="show_target_route">
                                        <div class="icheck-carrot">
                                            <input type="checkbox" id="has_target_route" name="has_target_route" onchange="onchangeDirection()" {{ (!empty($banner) && (!empty($banner->direction_id) || !empty($banner->direction_url)) ) ? 'checked="true"' : ''}}/>
                                            {{-- {{ (!empty($banner) && $banner->direction_id) ? --}}
                                            <label for="has_target_route" >Has Target Route</label>
                                        </div>
                                        <div class="{{ (!empty($banner) && (!empty($banner->direction_id) || !empty($banner->direction_url) ) ) ? "border box-target" : ''}}" {{ (!empty($banner) && (!empty($banner->direction_id) || !empty($banner->direction_url))) ? '' : 'hidden'}} id="box_target">

                                            <div id="collapseOne" tyle="transition: height 0.01s;">
                                                {{-- <label for="target_route">Target Id</label> --}}
                                                <select type="file" name="direction_id" class="form-control" id="target_route">
                                                    <option selected value>None</option>
                                                    @if(!empty($list_target_route))
                                                    @foreach($list_target_route as $target)
                                                    <option value='{{$target->id}}' {{ ( !empty($banner) && ($banner->direction_id === $target->key) ) ? 'selected' : $banner->direction_id}}>{{$target->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group" id="direction_url" >
                                                <label for="direction_url">Target URL</label>
                                                <input type="text" name="direction_url" class="form-control" value="{{ !empty($banner)? $banner->direction_url:''}}">
                                                <span class="warning-alert" id="direction_url_required_alert" hidden>This field is required!</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="icheck-carrot">
                                            <input type="checkbox" id="isHighlight" name="isHighlight" {{ (!empty($banner) && $banner->is_highlight) ? 'checked' : ''}}/>
                                            <label for="isHighlight">Highlight</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="text-align: center">
                                <a href="{{ route('bannermanage.index') }}" type="button" class="btn btn-default">Cancel</a>
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
